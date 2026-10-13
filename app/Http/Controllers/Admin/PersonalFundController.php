<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonalFund;
use App\Models\Project;
use Illuminate\Http\Request;

use Dompdf\Dompdf;
use Dompdf\Options;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PersonalFundController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = $request->get('search');
        $projectId = $request->get('project');
        $status = $request->get('status');

        $personalFunds = PersonalFund::with([
            'user',
            'expense.project.client.user',
            'expense.creator',
        ])

            /*
            |--------------------------------------------------------------------------
            | SEARCH
            |--------------------------------------------------------------------------
            */

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('notes', 'like', '%' . $search . '%')

                        ->orWhereHas('user', function ($user) use ($search) {
                            $user->where('name', 'like', '%' . $search . '%');
                        })

                        ->orWhereHas('expense', function ($expense) use ($search) {

                            $expense
                                ->where('description', 'like', '%' . $search . '%')
                                ->orWhere('store_name', 'like', '%' . $search . '%')

                                ->orWhereHas('project', function ($project) use ($search) {
                                    $project->where(
                                        'project_name',
                                        'like',
                                        '%' . $search . '%'
                                    );
                                });
                        });
                });
            })

            /*
            |--------------------------------------------------------------------------
            | PROJECT FILTER
            |--------------------------------------------------------------------------
            */

            ->when($projectId, function ($query) use ($projectId) {

                $query->whereHas('expense', function ($expense) use ($projectId) {

                    $expense->where(
                        'project_id',
                        $projectId
                    );
                });
            })

            /*
            |--------------------------------------------------------------------------
            | STATUS FILTER
            |--------------------------------------------------------------------------
            */

            ->when($status, function ($query) use ($status) {

                $query->where(
                    'reimbursement_status',
                    $status
                );
            })

            /*
            |--------------------------------------------------------------------------
            | ORDER
            |--------------------------------------------------------------------------
            */

            ->latest()
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | PROJECTS
        |--------------------------------------------------------------------------
        */

        $projects = Project::with('client.user')
            ->orderBy('project_name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        $totalPersonalFund =
            PersonalFund::sum('amount');


        $unpaidPersonalFund =
            PersonalFund::where(
                'reimbursement_status',
                'unpaid'
            )->sum('amount');


        $paidPersonalFund =
            PersonalFund::where(
                'reimbursement_status',
                'paid'
            )->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | BULAN INI
        | Berdasarkan tanggal transaksi Expense
        |--------------------------------------------------------------------------
        */

        $thisMonthPersonalFund =
            PersonalFund::whereHas(
                'expense',
                function ($expense) {

                    $expense
                        ->whereYear(
                            'expense_date',
                            now()->year
                        )
                        ->whereMonth(
                            'expense_date',
                            now()->month
                        );
                }
            )->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | STATUS SUMMARY
        |--------------------------------------------------------------------------
        */

        $unpaidCount =
            PersonalFund::where(
                'reimbursement_status',
                'unpaid'
            )->count();


        $paidCount =
            PersonalFund::where(
                'reimbursement_status',
                'paid'
            )->count();


        return view(
            'admin.personal-funds.index',
            compact(
                'personalFunds',
                'projects',
                'search',
                'projectId',
                'status',
                'totalPersonalFund',
                'unpaidPersonalFund',
                'paidPersonalFund',
                'thisMonthPersonalFund',
                'unpaidCount',
                'paidCount'
            )
        );
    }


    private function exportQuery(Request $request)
    {
        $search = $request->get('search');
        $projectId = $request->get('project');
        $status = $request->get('status');


        $query = PersonalFund::with([
            'user',
            'expense.project.client.user',
            'expense.creator',
        ]);


        /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

        if ($search) {

            $query->where(function ($q) use ($search) {

                $q->where(
                    'notes',
                    'like',
                    '%' . $search . '%'
                )

                    ->orWhereHas(
                        'user',
                        function ($user) use ($search) {

                            $user->where(
                                'name',
                                'like',
                                '%' . $search . '%'
                            );
                        }
                    )

                    ->orWhereHas(
                        'expense',
                        function ($expense) use ($search) {

                            $expense
                                ->where(
                                    'description',
                                    'like',
                                    '%' . $search . '%'
                                )

                                ->orWhere(
                                    'store_name',
                                    'like',
                                    '%' . $search . '%'
                                )

                                ->orWhereHas(
                                    'project',
                                    function ($project) use ($search) {

                                        $project->where(
                                            'project_name',
                                            'like',
                                            '%' . $search . '%'
                                        );
                                    }
                                );
                        }
                    );
            });
        }


        /*
    |--------------------------------------------------------------------------
    | PROJECT
    |--------------------------------------------------------------------------
    */

        if ($projectId) {

            $query->whereHas(
                'expense',
                function ($expense) use ($projectId) {

                    $expense->where(
                        'project_id',
                        $projectId
                    );
                }
            );
        }


        /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

        if ($status) {

            $query->where(
                'reimbursement_status',
                $status
            );
        }

        return $query
            ->orderByDesc('id');
    }

    public function exportExcel(Request $request)
    {
        $personalFunds =
            $this
            ->exportQuery($request)
            ->get();


        $spreadsheet =
            new Spreadsheet();


        $sheet =
            $spreadsheet
            ->getActiveSheet();


        $sheet->setTitle(
            'Uang Pribadi'
        );


        /*
    |--------------------------------------------------------------------------
    | JUDUL
    |--------------------------------------------------------------------------
    */

        $sheet->mergeCells(
            'A1:I1'
        );

        $sheet->setCellValue(
            'A1',
            'LAPORAN UANG PRIBADI RUANGKITA'
        );


        $sheet->mergeCells(
            'A2:I2'
        );

        $sheet->setCellValue(
            'A2',
            'Tanggal Export: ' .
                now()->format('d-m-Y H:i')
        );


        /*
    |--------------------------------------------------------------------------
    | HEADER
    |--------------------------------------------------------------------------
    */

        $headers = [

            'No',
            'Tanggal',
            'Nama Tim',
            'Proyek',
            'Keterangan',
            'Jumlah',
            'Status',
            'Tanggal Diganti',
            'Client',

        ];


        $column = 'A';


        foreach ($headers as $header) {

            $sheet->setCellValue(
                $column . '4',
                $header
            );

            $column++;
        }


        /*
    |--------------------------------------------------------------------------
    | DATA
    |--------------------------------------------------------------------------
    */

        $row = 5;

        $no = 1;

        $total = 0;


        foreach ($personalFunds as $personalFund) {


            $status =

                $personalFund
                ->reimbursement_status
                ===
                'paid'

                ? 'Sudah Diganti'

                : 'Belum Diganti';


            $sheet->setCellValue(
                'A' . $row,
                $no
            );


            $sheet->setCellValue(
                'B' . $row,
                optional(
                    $personalFund
                        ->expense
                        ?->expense_date
                )->format('d-m-Y')
            );


            $sheet->setCellValue(
                'C' . $row,
                $personalFund
                    ->user
                    ?->name
                    ??
                    '-'
            );


            $sheet->setCellValue(
                'D' . $row,
                $personalFund
                    ->expense
                    ?->project
                    ?->project_name
                    ??
                    '-'
            );


            $sheet->setCellValue(
                'E' . $row,
                $personalFund->notes
                    ??
                    $personalFund
                    ->expense
                    ?->description
                    ??
                    '-'
            );


            $sheet->setCellValue(
                'F' . $row,
                (float)
                $personalFund->amount
            );


            $sheet->setCellValue(
                'G' . $row,
                $status
            );


            $sheet->setCellValue(
                'H' . $row,

                $personalFund
                    ->reimbursement_date

                    ? $personalFund
                    ->reimbursement_date
                    ->format('d-m-Y')

                    : '-'
            );


            $sheet->setCellValue(
                'I' . $row,
                $personalFund
                    ->expense
                    ?->project
                    ?->client
                    ?->user
                    ?->name
                    ??
                    '-'
            );


            $total +=
                (float)
                $personalFund->amount;


            $row++;

            $no++;
        }


        /*
    |--------------------------------------------------------------------------
    | TOTAL
    |--------------------------------------------------------------------------
    */

        $sheet->mergeCells(
            'A' . $row .
                ':E' . $row
        );


        $sheet->setCellValue(
            'A' . $row,
            'TOTAL UANG PRIBADI'
        );


        $sheet->setCellValue(
            'F' . $row,
            $total
        );


        /*
    |--------------------------------------------------------------------------
    | FORMAT
    |--------------------------------------------------------------------------
    */

        $sheet
            ->getStyle('A1:I1')
            ->getFont()
            ->setBold(true)
            ->setSize(16);


        $sheet
            ->getStyle('A4:I4')
            ->getFont()
            ->setBold(true);


        $sheet
            ->getStyle(
                'A' . $row .
                    ':I' . $row
            )
            ->getFont()
            ->setBold(true);


        $sheet
            ->getStyle(
                'F5:F' . $row
            )
            ->getNumberFormat()
            ->setFormatCode(
                '"Rp" #,##0'
            );


        foreach (
            range('A', 'I')
            as $column
        ) {

            $sheet
                ->getColumnDimension(
                    $column
                )
                ->setAutoSize(true);
        }


        /*
    |--------------------------------------------------------------------------
    | DOWNLOAD
    |--------------------------------------------------------------------------
    */

        $fileName =
            'uang-pribadi-ruangkita-' .
            now()->format('Ymd-His') .
            '.xlsx';


        return response()
            ->streamDownload(

                function () use ($spreadsheet) {

                    $writer =
                        new Xlsx(
                            $spreadsheet
                        );

                    $writer->save(
                        'php://output'
                    );
                },

                $fileName,

                [

                    'Content-Type' =>
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',

                ]

            );
    }

    public function exportPdf(Request $request)
    {
        $personalFunds =
            $this
            ->exportQuery($request)
            ->get();


        $totalPersonalFund =
            $personalFunds
            ->sum('amount');


        $unpaidPersonalFund =
            $personalFunds
            ->where(
                'reimbursement_status',
                'unpaid'
            )
            ->sum('amount');


        $paidPersonalFund =
            $personalFunds
            ->where(
                'reimbursement_status',
                'paid'
            )
            ->sum('amount');


        $html =
            view(
                'admin.personal-funds.pdf',

                compact(
                    'personalFunds',
                    'totalPersonalFund',
                    'unpaidPersonalFund',
                    'paidPersonalFund'
                )

            )->render();


        $options =
            new Options();


        $options->set(
            'isRemoteEnabled',
            true
        );


        $options->set(
            'defaultFont',
            'Arial'
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


        $fileName =
            'uang-pribadi-ruangkita-' .
            now()->format('Ymd-His') .
            '.pdf';


        return response(

            $dompdf->output(),

            200,

            [

                'Content-Type' =>
                'application/pdf',

                'Content-Disposition' =>
                'attachment; filename="' .
                    $fileName .
                    '"',

            ]

        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(PersonalFund $personalFund)
    {
        $personalFund->load([
            'user',
            'expense.project.client.user',
            'expense.material',
            'expense.creator',
        ]);

        return view(
            'admin.personal-funds.show',
            compact('personalFund')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TANDAI SUDAH DIGANTI
    |--------------------------------------------------------------------------
    */

    public function markAsPaid(PersonalFund $personalFund)
    {
        $personalFund->update([
            'reimbursement_status' => 'paid',
            'reimbursement_date' => now()->toDateString(),
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Uang pribadi berhasil ditandai sebagai sudah diganti.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | BATALKAN PENGGANTIAN
    |--------------------------------------------------------------------------
    */

    public function markAsUnpaid(PersonalFund $personalFund)
    {
        $personalFund->update([
            'reimbursement_status' => 'unpaid',
            'reimbursement_date' => null,
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Status penggantian berhasil dikembalikan menjadi belum diganti.'
            );
    }
}
