<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Laporan RuangKita</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #243447;
        }

        h1 {
            margin-bottom: 4px;
            font-size: 20px;
            color: #123b5d;
        }

        .subtitle {
            margin-bottom: 20px;
            color: #66788a;
        }

        .summary {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .summary td {
            width: 25%;
            padding: 10px;
            border: 1px solid #d9e2ea;
        }

        .summary-label {
            color: #74879a;
            font-size: 8px;
        }

        .summary-value {
            margin-top: 4px;
            font-size: 13px;
            font-weight: bold;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
        }

        .report-table th {
            padding: 7px;
            border: 1px solid #d9e2ea;
            background: #eaf3fb;
            color: #123b5d;
            text-align: left;
        }

        .report-table td {
            padding: 7px;
            border: 1px solid #d9e2ea;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .footer {
            margin-top: 18px;
            color: #7a8b9c;
            font-size: 8px;
            text-align: right;
        }
    </style>

</head>

<body>


    <h1>
        Laporan Proyek RuangKita
    </h1>

    <div class="subtitle">
        Dicetak pada {{ now()->format('d M Y H:i') }}
    </div>


    <table class="summary">

        <tr>

            <td>

                <div class="summary-label">
                    Total Proyek
                </div>

                <div class="summary-value">
                    {{ $totalProjects }}
                </div>

            </td>


            <td>

                <div class="summary-label">
                    Total Anggaran
                </div>

                <div class="summary-value">
                    Rp {{ number_format($totalBudget, 0, ',', '.') }}
                </div>

            </td>


            <td>

                <div class="summary-label">
                    Total Pengeluaran
                </div>

                <div class="summary-value">
                    Rp {{ number_format($totalExpense, 0, ',', '.') }}
                </div>

            </td>


            <td>

                <div class="summary-label">
                    Rata-rata Progress
                </div>

                <div class="summary-value">
                    {{ $averageProgress }}%
                </div>

            </td>

        </tr>

    </table>


    <table class="report-table">

        <thead>

            <tr>
                <th>No</th>
                <th>Nama Proyek</th>
                <th>Client</th>
                <th>Anggaran</th>
                <th>Pengeluaran</th>
                <th>Sisa</th>
                <th>Progress</th>
                <th>Status</th>
            </tr>

        </thead>


        <tbody>

            @forelse($reportProjects as $project)

            @php
            $statusLabel = match($project->status) {
            'ongoing' => 'Berjalan',
            'completed' => 'Selesai',
            'paused' => 'Ditunda',
            default => 'Perencanaan',
            };
            @endphp

            <tr>

                <td class="center">
                    {{ $loop->iteration }}
                </td>


                <td>
                    {{ $project->project_name }}
                </td>


                <td>
                    {{ optional(optional($project->client)->user)->name ?? '-' }}
                </td>


                <td class="right">
                    Rp {{ number_format($project->budget_total ?? 0, 0, ',', '.') }}
                </td>


                <td class="right">
                    Rp {{ number_format($project->report_expense ?? 0, 0, ',', '.') }}
                </td>


                <td class="right">
                    Rp {{ number_format($project->report_remaining ?? 0, 0, ',', '.') }}
                </td>


                <td class="center">
                    {{ $project->progress_percentage ?? 0 }}%
                </td>


                <td>
                    {{ $statusLabel }}
                </td>

            </tr>

            @empty

            <tr>

                <td
                    colspan="8"
                    class="center">
                    Belum ada data laporan.
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>


    <div class="footer">
        RuangKita — Sistem Manajemen Proyek Renovasi
    </div>


</body>

</html>