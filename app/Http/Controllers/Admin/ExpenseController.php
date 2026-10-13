<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Material;
use App\Models\PersonalFund;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $projectId = $request->get('project');
        $category = $request->get('category');
        $fundingSource = $request->get('funding_source');
        $visibility = $request->get('visibility');

        $expenses = Expense::with([
            'project.client.user',
            'material',
            'creator',
            'personalFund',
        ])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('description', 'like', '%' . $search . '%')
                        ->orWhere('store_name', 'like', '%' . $search . '%')
                        ->orWhereHas('project', function ($project) use ($search) {
                            $project->where(
                                'project_name',
                                'like',
                                '%' . $search . '%'
                            );
                        });
                });
            })
            ->when($projectId, function ($query) use ($projectId) {
                $query->where('project_id', $projectId);
            })
            ->when($category, function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->when($fundingSource, function ($query) use ($fundingSource) {
                $query->where('funding_source', $fundingSource);
            })
            ->when(
                $visibility !== null && $visibility !== '',
                function ($query) use ($visibility) {
                    $query->where(
                        'is_visible_to_client',
                        (bool) $visibility
                    );
                }
            )
            ->orderByDesc('expense_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $projects = Project::with('client.user')
            ->orderBy('project_name')
            ->get();

        $totalExpense = Expense::sum('amount');

        $thisMonthExpense = Expense::whereYear(
            'expense_date',
            now()->year
        )
            ->whereMonth(
                'expense_date',
                now()->month
            )
            ->sum('amount');

        $projectFundExpense = Expense::where(
            'funding_source',
            'project'
        )
            ->sum('amount');

        $personalFundExpense = Expense::where(
            'funding_source',
            'personal'
        )
            ->sum('amount');

        $categorySummary = Expense::selectRaw(
            'category, SUM(amount) as total'
        )
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        return view(
            'admin.expenses.index',
            compact(
                'expenses',
                'projects',
                'totalExpense',
                'thisMonthExpense',
                'projectFundExpense',
                'personalFundExpense',
                'categorySummary',
                'search',
                'projectId',
                'category',
                'fundingSource',
                'visibility'
            )
        );
    }


    public function create()
    {
        $projects = Project::with('client.user')
            ->orderBy('project_name')
            ->get();

        $materials = Material::with('project')
            ->orderBy('material_name')
            ->get();

        return view(
            'admin.expenses.create',
            compact(
                'projects',
                'materials'
            )
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => [
                'required',
                'exists:projects,id',
            ],

            'material_id' => [
                'nullable',
                'exists:materials,id',
            ],

            'expense_date' => [
                'required',
                'date',
            ],

            'store_name' => [
                'nullable',
                'string',
                'max:150',
            ],

            'category' => [
                'required',
                'in:material,labor,transport,equipment,other',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'funding_source' => [
                'required',
                'in:project,personal',
            ],

            'receipt' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:5120',
            ],

            'is_visible_to_client' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | MATERIAL HARUS SESUAI PROYEK
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['material_id'])) {
            $material = Material::findOrFail(
                $validated['material_id']
            );

            if (
                (int) $material->project_id
                !==
                (int) $validated['project_id']
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'material_id' =>
                        'Material yang dipilih tidak sesuai dengan proyek.',
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD BUKTI
        |--------------------------------------------------------------------------
        */

        $receiptPath = null;

        if ($request->hasFile('receipt')) {
            $receiptPath = $request
                ->file('receipt')
                ->store(
                    'expenses/receipts',
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN EXPENSE
        |--------------------------------------------------------------------------
        */

        $expense = Expense::create([
            'project_id' =>
            $validated['project_id'],

            'material_id' =>
            $validated['material_id']
                ?? null,

            'created_by' =>
            Auth::id(),

            'expense_date' =>
            $validated['expense_date'],

            'store_name' =>
            $validated['store_name']
                ?? null,

            'category' =>
            $validated['category'],

            'description' =>
            $validated['description']
                ?? null,

            'amount' =>
            $validated['amount'],

            'funding_source' =>
            $validated['funding_source'],

            'receipt_path' =>
            $receiptPath,

            'is_visible_to_client' =>
            $request->boolean(
                'is_visible_to_client'
            ),
        ]);


        /*
        |--------------------------------------------------------------------------
        | JIKA SUMBER DANA = UANG PRIBADI
        |--------------------------------------------------------------------------
        */

        if (
            $expense->funding_source === 'personal'
        ) {

            PersonalFund::create([
                'expense_id' => $expense->id,
                'user_id' => Auth::id(),
                'amount' => $expense->amount,
                'reimbursement_status' => 'unpaid',
                'reimbursement_date' => null,
                'notes' => $expense->description,
            ]);
        }


        return redirect()
            ->route('admin.expenses.index')
            ->with(
                'success',
                'Pengeluaran berhasil ditambahkan.'
            );
    }


    public function show(Expense $expense)
    {
        $expense->load([
            'project.client.user',
            'material',
            'creator',
            'personalFund',
        ]);

        return view(
            'admin.expenses.show',
            compact('expense')
        );
    }


    public function edit(Expense $expense)
    {
        $projects = Project::with('client.user')
            ->orderBy('project_name')
            ->get();

        $materials = Material::with('project')
            ->orderBy('material_name')
            ->get();

        return view(
            'admin.expenses.edit',
            compact(
                'expense',
                'projects',
                'materials'
            )
        );
    }


    public function update(
        Request $request,
        Expense $expense
    ) {
        $validated = $request->validate([
            'project_id' => [
                'required',
                'exists:projects,id',
            ],

            'material_id' => [
                'nullable',
                'exists:materials,id',
            ],

            'expense_date' => [
                'required',
                'date',
            ],

            'store_name' => [
                'nullable',
                'string',
                'max:150',
            ],

            'category' => [
                'required',
                'in:material,labor,transport,equipment,other',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'funding_source' => [
                'required',
                'in:project,personal',
            ],

            'receipt' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:5120',
            ],

            'is_visible_to_client' => [
                'nullable',
                'boolean',
            ],
        ]);


        if (!empty($validated['material_id'])) {
            $material = Material::findOrFail(
                $validated['material_id']
            );

            if (
                (int) $material->project_id
                !==
                (int) $validated['project_id']
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'material_id' =>
                        'Material yang dipilih tidak sesuai dengan proyek.',
                    ]);
            }
        }


        $receiptPath =
            $expense->receipt_path;


        if ($request->hasFile('receipt')) {

            if ($receiptPath) {
                Storage::disk('public')
                    ->delete($receiptPath);
            }

            $receiptPath = $request
                ->file('receipt')
                ->store(
                    'expenses/receipts',
                    'public'
                );
        }


        $oldFundingSource =
            $expense->funding_source;


        $expense->update([
            'project_id' =>
            $validated['project_id'],

            'material_id' =>
            $validated['material_id']
                ?? null,

            'expense_date' =>
            $validated['expense_date'],

            'store_name' =>
            $validated['store_name']
                ?? null,

            'category' =>
            $validated['category'],

            'description' =>
            $validated['description']
                ?? null,

            'amount' =>
            $validated['amount'],

            'funding_source' =>
            $validated['funding_source'],

            'receipt_path' =>
            $receiptPath,

            'is_visible_to_client' =>
            $request->boolean(
                'is_visible_to_client'
            ),
        ]);


        /*
        |--------------------------------------------------------------------------
        | SINKRONISASI PERSONAL FUND
        |--------------------------------------------------------------------------
        */

        if (
            $expense->funding_source === 'personal'
        ) {
            PersonalFund::updateOrCreate(
                [
                    'expense_id' => $expense->id,
                ],
                [
                    'user_id' => $expense->personalFund?->user_id ?? Auth::id(),
                    'amount' => $expense->amount,
                    'notes' => $expense->description,
                ]
            );
        }


        if (
            $oldFundingSource === 'personal'
            &&
            $expense->funding_source === 'project'
        ) {
            PersonalFund::where(
                'expense_id',
                $expense->id
            )->delete();
        }


        return redirect()
            ->route(
                'admin.expenses.show',
                $expense
            )
            ->with(
                'success',
                'Pengeluaran berhasil diperbarui.'
            );
    }

    public function destroy(Expense $expense)
    {
        /*
    |--------------------------------------------------------------------------
    | HAPUS DATA UANG PRIBADI TERKAIT
    |--------------------------------------------------------------------------
    */

        if ($expense->personalFund) {
            $expense->personalFund()->delete();
        }


        /*
    |--------------------------------------------------------------------------
    | HAPUS FILE BUKTI
    |--------------------------------------------------------------------------
    */

        if (
            $expense->receipt_path
            &&
            Storage::disk('public')->exists($expense->receipt_path)
        ) {
            Storage::disk('public')->delete($expense->receipt_path);
        }


        /*
    |--------------------------------------------------------------------------
    | HAPUS TRANSAKSI
    |--------------------------------------------------------------------------
    */

        $expense->delete();


        return redirect()
            ->route('admin.expenses.index')
            ->with(
                'success',
                'Pengeluaran berhasil dihapus.'
            );
    }
    private function exportQuery(Request $request)
    {
        $search =
            $request->input('search');

        $projectId =
            $request->input('project');

        $category =
            $request->input('category');

        $fundingSource =
            $request->input('funding_source');

        $visibility =
            $request->input('visibility');


        $query =
            Expense::with([
                'project.client.user',
                'material',
                'creator',
                'personalFund',
            ]);


        if ($search) {

            $query->where(function ($q) use ($search) {

                $q->where(
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
                        function ($projectQuery) use ($search) {

                            $projectQuery->where(
                                'project_name',
                                'like',
                                '%' . $search . '%'
                            );
                        }
                    );
            });
        }


        if ($projectId) {

            $query->where(
                'project_id',
                $projectId
            );
        }


        if ($category) {

            $query->where(
                'category',
                $category
            );
        }


        if ($fundingSource) {

            $query->where(
                'funding_source',
                $fundingSource
            );
        }


        if ($visibility !== null && $visibility !== '') {

            $query->where(
                'is_visible_to_client',
                $visibility
            );
        }


        return $query
            ->orderByDesc('expense_date')
            ->orderByDesc('id');
    }

    public function exportExcel(Request $request)
    {
        $expenses =
            $this->exportQuery($request)
            ->get();


        $spreadsheet =
            new Spreadsheet();


        $sheet =
            $spreadsheet->getActiveSheet();


        $sheet->setTitle(
            'Pengeluaran'
        );


        /*
    |--------------------------------------------------------------------------
    | JUDUL
    |--------------------------------------------------------------------------
    */

        $sheet->mergeCells(
            'A1:J1'
        );

        $sheet->setCellValue(
            'A1',
            'LAPORAN PENGELUARAN RUANGKITA'
        );


        $sheet->mergeCells(
            'A2:J2'
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
            'Proyek',
            'Keterangan',
            'Kategori',
            'Sumber Dana',
            'Jumlah',
            'Toko / Supplier',
            'Client',
            'Dibuat Oleh',
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


        foreach ($expenses as $expense) {

            $category =
                match ($expense->category) {

                    'material' =>
                    'Material',

                    'labor' =>
                    'Upah',

                    'transport' =>
                    'Transportasi',

                    'equipment' =>
                    'Peralatan',

                    default =>
                    'Lain-lain',
                };


            $fundingSource =
                $expense->funding_source === 'personal'
                ? 'Uang Pribadi'
                : 'Dana Proyek';


            $clientVisibility =
                $expense->is_visible_to_client
                ? 'Tampil'
                : 'Sembunyi';


            $sheet->setCellValue(
                'A' . $row,
                $no
            );

            $sheet->setCellValue(
                'B' . $row,
                optional($expense->expense_date)
                    ->format('d-m-Y')
            );

            $sheet->setCellValue(
                'C' . $row,
                $expense->project->project_name
                    ??
                    '-'
            );

            $sheet->setCellValue(
                'D' . $row,
                $expense->description
                    ??
                    '-'
            );

            $sheet->setCellValue(
                'E' . $row,
                $category
            );

            $sheet->setCellValue(
                'F' . $row,
                $fundingSource
            );

            $sheet->setCellValue(
                'G' . $row,
                (float) $expense->amount
            );

            $sheet->setCellValue(
                'H' . $row,
                $expense->store_name
                    ??
                    '-'
            );

            $sheet->setCellValue(
                'I' . $row,
                $clientVisibility
            );

            $sheet->setCellValue(
                'J' . $row,
                $expense->creator->name
                    ??
                    '-'
            );


            $total +=
                (float) $expense->amount;


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
                ':F' . $row
        );

        $sheet->setCellValue(
            'A' . $row,
            'TOTAL PENGELUARAN'
        );

        $sheet->setCellValue(
            'G' . $row,
            $total
        );


        /*
    |--------------------------------------------------------------------------
    | FORMAT
    |--------------------------------------------------------------------------
    */

        $sheet
            ->getStyle('A1:J1')
            ->getFont()
            ->setBold(true)
            ->setSize(16);


        $sheet
            ->getStyle('A4:J4')
            ->getFont()
            ->setBold(true);


        $sheet
            ->getStyle(
                'A' . $row .
                    ':J' . $row
            )
            ->getFont()
            ->setBold(true);


        $sheet
            ->getStyle(
                'G5:G' . $row
            )
            ->getNumberFormat()
            ->setFormatCode(
                '"Rp" #,##0'
            );


        foreach (
            range('A', 'J')
            as $column
        ) {

            $sheet
                ->getColumnDimension($column)
                ->setAutoSize(true);
        }


        /*
    |--------------------------------------------------------------------------
    | DOWNLOAD
    |--------------------------------------------------------------------------
    */

        $fileName =
            'pengeluaran-ruangkita-' .
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
        $expenses =
            $this->exportQuery($request)
            ->get();


        $totalExpense =
            $expenses->sum('amount');


        $projectFundExpense =
            $expenses
            ->where(
                'funding_source',
                'project'
            )
            ->sum('amount');


        $personalFundExpense =
            $expenses
            ->where(
                'funding_source',
                'personal'
            )
            ->sum('amount');


        $categorySummary =
            $expenses
            ->groupBy('category')
            ->map(
                function ($items) {

                    return
                        $items->sum(
                            'amount'
                        );
                }
            );


        $html =
            view(
                'admin.expenses.pdf',
                compact(
                    'expenses',
                    'totalExpense',
                    'projectFundExpense',
                    'personalFundExpense',
                    'categorySummary'
                )
            )
            ->render();


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
            'pengeluaran-ruangkita-' .
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
}
