<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Project;
use Illuminate\Http\Request;

use Dompdf\Dompdf;
use Dompdf\Options;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN LAPORAN
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $data = $this->buildReportData($request);

        return view(
            'admin.reports.index',
            $data
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DATA LAPORAN
    |--------------------------------------------------------------------------
    */

    private function buildReportData(Request $request): array
    {
        $projectId =
            $request->get('project');

        $period =
            $request->get(
                'period',
                'all'
            );


        /*
        |--------------------------------------------------------------------------
        | PROJECT QUERY
        |--------------------------------------------------------------------------
        */

        $projectQuery =
            Project::query()
            ->with([
                'client.user',
            ]);


        if ($projectId) {

            $projectQuery->where(
                'id',
                $projectId
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER PERIODE
        |--------------------------------------------------------------------------
        */

        if ($period === 'this_month') {

            $projectQuery
                ->whereYear(
                    'start_date',
                    now()->year
                )
                ->whereMonth(
                    'start_date',
                    now()->month
                );
        } elseif ($period === 'this_year') {

            $projectQuery
                ->whereYear(
                    'start_date',
                    now()->year
                );
        }


        $reportProjects =
            $projectQuery
            ->orderByDesc(
                'created_at'
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | SELECT PROJECT
        |--------------------------------------------------------------------------
        */

        $projects =
            Project::query()
            ->orderBy(
                'project_name'
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PROJECT IDS
        |--------------------------------------------------------------------------
        */

        $projectIds =
            $reportProjects
            ->pluck('id');


        /*
        |--------------------------------------------------------------------------
        | EXPENSE
        |--------------------------------------------------------------------------
        */

        $expenseQuery =
            Expense::query()
            ->whereIn(
                'project_id',
                $projectIds
            );


        if ($period === 'this_month') {

            $expenseQuery
                ->whereYear(
                    'expense_date',
                    now()->year
                )
                ->whereMonth(
                    'expense_date',
                    now()->month
                );
        } elseif ($period === 'this_year') {

            $expenseQuery
                ->whereYear(
                    'expense_date',
                    now()->year
                );
        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL EXPENSE PER PROJECT
        |--------------------------------------------------------------------------
        */

        $expenseByProject =
            (clone $expenseQuery)
            ->selectRaw(
                'project_id, SUM(amount) as total'
            )
            ->groupBy(
                'project_id'
            )
            ->pluck(
                'total',
                'project_id'
            );


        /*
        |--------------------------------------------------------------------------
        | TAMBAHAN DATA REPORT
        |--------------------------------------------------------------------------
        */

        $reportProjects =
            $reportProjects->map(
                function ($project)
                use ($expenseByProject) {

                    $project->report_expense =
                        (float) (
                            $expenseByProject[$project->id]
                            ?? 0
                        );


                    $budget =
                        (float) (
                            $project
                            ->budget_total
                            ?? 0
                        );


                    $project->report_remaining =
                        $budget
                        -
                        $project
                        ->report_expense;


                    return $project;
                }
            );


        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        $totalProjects =
            $reportProjects->count();


        $totalBudget =
            (float)
            $reportProjects
                ->sum(
                    'budget_total'
                );


        $totalExpense =
            (float)
            $reportProjects
                ->sum(
                    'report_expense'
                );


        $averageProgress =
            $totalProjects > 0
            ?
            round(
                $reportProjects
                    ->avg(
                        'progress_percentage'
                    ),
                1
            )
            :
            0;


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        $statusSummary = [

            'planning' =>
            $reportProjects
                ->where(
                    'status',
                    'planning'
                )
                ->count(),

            'ongoing' =>
            $reportProjects
                ->where(
                    'status',
                    'ongoing'
                )
                ->count(),

            'completed' =>
            $reportProjects
                ->where(
                    'status',
                    'completed'
                )
                ->count(),

            'paused' =>
            $reportProjects
                ->where(
                    'status',
                    'paused'
                )
                ->count(),

        ];


        /*
        |--------------------------------------------------------------------------
        | CHART
        |--------------------------------------------------------------------------
        */

        $chartProjects =
            $reportProjects
            ->sortByDesc(
                'budget_total'
            )
            ->take(6)
            ->values();


        $chartLabels =
            $chartProjects
            ->pluck(
                'project_name'
            );


        $chartBudgets =
            $chartProjects
            ->map(
                fn($project) =>
                (float) (
                    $project
                    ->budget_total
                    ?? 0
                )
            );


        $chartExpenses =
            $chartProjects
            ->pluck(
                'report_expense'
            );


        /*
        |--------------------------------------------------------------------------
        | INSIGHT
        |--------------------------------------------------------------------------
        */

        $highestExpenseProject =
            $reportProjects
            ->sortByDesc(
                'report_expense'
            )
            ->first();


        $almostFinishedCount =
            $reportProjects
            ->filter(
                function ($project) {

                    $progress =
                        (float) (
                            $project
                            ->progress_percentage
                            ?? 0
                        );

                    return
                        $progress >= 70
                        &&
                        $progress < 100;
                }
            )
            ->count();


        $overBudgetCount =
            $reportProjects
            ->filter(
                function ($project) {

                    $budget =
                        (float) (
                            $project
                            ->budget_total
                            ?? 0
                        );

                    return
                        $budget > 0
                        &&
                        $project
                        ->report_expense
                        >
                        $budget;
                }
            )
            ->count();


        return compact(
            'projects',
            'reportProjects',
            'projectId',
            'period',
            'totalProjects',
            'totalBudget',
            'totalExpense',
            'averageProgress',
            'statusSummary',
            'chartLabels',
            'chartBudgets',
            'chartExpenses',
            'highestExpenseProject',
            'almostFinishedCount',
            'overBudgetCount'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT PDF
    |--------------------------------------------------------------------------
    */

    public function exportPdf(Request $request)
    {
        $data =
            $this->buildReportData(
                $request
            );


        $html =
            view(
                'admin.reports.pdf',
                $data
            )->render();


        $options =
            new Options();


        $options->set(
            'defaultFont',
            'DejaVu Sans'
        );


        $options->set(
            'isRemoteEnabled',
            true
        );


        $dompdf =
            new Dompdf(
                $options
            );


        $dompdf->loadHtml(
            $html
        );


        $dompdf->setPaper(
            'A4',
            'landscape'
        );


        $dompdf->render();


        $filename =
            'laporan-ruangkita-'
            .
            now()->format(
                'Y-m-d-His'
            )
            .
            '.pdf';


        return response(
            $dompdf->output()
        )
            ->header(
                'Content-Type',
                'application/pdf'
            )
            ->header(
                'Content-Disposition',
                'attachment; filename="'
                    .
                    $filename
                    .
                    '"'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT EXCEL
    |--------------------------------------------------------------------------
    */

    public function exportExcel(Request $request)
    {
        $data =
            $this->buildReportData(
                $request
            );


        $spreadsheet =
            new Spreadsheet();


        $sheet =
            $spreadsheet
            ->getActiveSheet();


        $sheet->setTitle(
            'Laporan Proyek'
        );


        /*
        |--------------------------------------------------------------------------
        | TITLE
        |--------------------------------------------------------------------------
        */

        $sheet->setCellValue(
            'A1',
            'LAPORAN PROYEK RUANGKITA'
        );


        $sheet->mergeCells(
            'A1:I1'
        );


        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true)
            ->setSize(16);


        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        $sheet->setCellValue(
            'A3',
            'Total Proyek'
        );

        $sheet->setCellValue(
            'B3',
            $data['totalProjects']
        );


        $sheet->setCellValue(
            'C3',
            'Total Anggaran'
        );

        $sheet->setCellValue(
            'D3',
            $data['totalBudget']
        );


        $sheet->setCellValue(
            'E3',
            'Total Pengeluaran'
        );

        $sheet->setCellValue(
            'F3',
            $data['totalExpense']
        );


        $sheet->setCellValue(
            'G3',
            'Rata-rata Progress'
        );

        $sheet->setCellValue(
            'H3',
            $data['averageProgress']
                .
                '%'
        );


        /*
        |--------------------------------------------------------------------------
        | HEADER TABLE
        |--------------------------------------------------------------------------
        */

        $headers = [
            'No',
            'Nama Proyek',
            'Client',
            'Anggaran',
            'Pengeluaran',
            'Sisa Anggaran',
            'Progress',
            'Status',
            'Terakhir Diperbarui',
        ];


        $column = 1;


        foreach ($headers as $header) {

            $sheet->setCellValue(
                [
                    $column,
                    5
                ],
                $header
            );

            $column++;
        }


        $sheet
            ->getStyle(
                'A5:I5'
            )
            ->getFont()
            ->setBold(true);


        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $row = 6;


        foreach (
            $data['reportProjects']
            as $index => $project
        ) {

            $statusLabel =
                match ($project->status) {

                    'ongoing'
                    => 'Berjalan',

                    'completed'
                    => 'Selesai',

                    'paused'
                    => 'Ditunda',

                    default
                    => 'Perencanaan',
                };


            $clientName =
                optional(
                    optional(
                        $project->client
                    )->user
                )->name
                ?? '-';


            $sheet->setCellValue(
                "A{$row}",
                $index + 1
            );


            $sheet->setCellValue(
                "B{$row}",
                $project
                    ->project_name
            );


            $sheet->setCellValue(
                "C{$row}",
                $clientName
            );


            $sheet->setCellValue(
                "D{$row}",
                (float) (
                    $project
                    ->budget_total
                    ?? 0
                )
            );


            $sheet->setCellValue(
                "E{$row}",
                $project
                    ->report_expense
            );


            $sheet->setCellValue(
                "F{$row}",
                $project
                    ->report_remaining
            );


            $sheet->setCellValue(
                "G{$row}",
                (
                    $project
                    ->progress_percentage
                    ?? 0
                )
                    .
                    '%'
            );


            $sheet->setCellValue(
                "H{$row}",
                $statusLabel
            );


            $sheet->setCellValue(
                "I{$row}",
                optional(
                    $project
                        ->updated_at
                )->format(
                    'd-m-Y'
                )
                    ?? '-'
            );


            $row++;
        }


        /*
        |--------------------------------------------------------------------------
        | FORMAT RUPIAH
        |--------------------------------------------------------------------------
        */

        $lastRow =
            max(
                6,
                $row - 1
            );


        $sheet
            ->getStyle(
                "D6:F{$lastRow}"
            )
            ->getNumberFormat()
            ->setFormatCode(
                '"Rp" #,##0'
            );


        /*
        |--------------------------------------------------------------------------
        | AUTO SIZE
        |--------------------------------------------------------------------------
        */

        foreach (
            range(
                'A',
                'I'
            )
            as $columnLetter
        ) {

            $sheet
                ->getColumnDimension(
                    $columnLetter
                )
                ->setAutoSize(true);
        }


        /*
        |--------------------------------------------------------------------------
        | OUTPUT
        |--------------------------------------------------------------------------
        */

        $filename =
            'laporan-ruangkita-'
            .
            now()->format(
                'Y-m-d-His'
            )
            .
            '.xlsx';


        $writer =
            new Xlsx(
                $spreadsheet
            );


        $tempFile =
            tempnam(
                sys_get_temp_dir(),
                'ruangkita_'
            );


        $writer->save(
            $tempFile
        );


        return response()
            ->download(
                $tempFile,
                $filename
            )
            ->deleteFileAfterSend(
                true
            );
    }
}
