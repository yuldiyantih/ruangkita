<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <title>
        Laporan Uang Pribadi RuangKita
    </title>


    <style>
        body {

            font-family: Arial, sans-serif;

            font-size: 10px;

            color: #202a35;

        }


        .header {

            margin-bottom: 18px;

        }


        .brand {

            font-size: 22px;

            font-weight: bold;

            color: #0877d4;

        }


        .subtitle {

            margin-top: 3px;

            color: #6f7d8a;

        }


        .summary {

            width: 100%;

            margin-bottom: 18px;

        }


        .summary td {

            width: 33.33%;

            padding: 10px;

            border: 1px solid #dde3e8;

        }


        .summary-label {

            margin-bottom: 5px;

            color: #6f7d8a;

            font-size: 9px;

        }


        .summary-value {

            font-size: 15px;

            font-weight: bold;

        }


        table.data {

            width: 100%;

            border-collapse: collapse;

        }


        table.data th {

            padding: 8px;

            border: 1px solid #d9e0e5;

            background: #eef4f8;

            text-align: left;

            font-size: 9px;

        }


        table.data td {

            padding: 7px;

            border: 1px solid #e1e5e8;

            vertical-align: top;

        }


        .amount {

            text-align: right;

            white-space: nowrap;

        }


        .paid {

            color: #17823b;

            font-weight: bold;

        }


        .unpaid {

            color: #d98600;

            font-weight: bold;

        }


        .footer {

            margin-top: 20px;

            color: #84919b;

            font-size: 8px;

            text-align: center;

        }
    </style>

</head>


<body>


    <div class="header">

        <div class="brand">
            RuangKita
        </div>

        <div class="subtitle">
            Laporan Uang Pribadi
        </div>

        <div class="subtitle">
            Dicetak:
            {{ now()->format('d-m-Y H:i') }}
        </div>

    </div>



    <table class="summary">

        <tr>

            <td>

                <div class="summary-label">
                    Total Uang Pribadi
                </div>

                <div class="summary-value">

                    Rp {{
                    number_format(
                        $totalPersonalFund,
                        0,
                        ',',
                        '.'
                    )
                }}

                </div>

            </td>


            <td>

                <div class="summary-label">
                    Belum Diganti
                </div>

                <div class="summary-value">

                    Rp {{
                    number_format(
                        $unpaidPersonalFund,
                        0,
                        ',',
                        '.'
                    )
                }}

                </div>

            </td>


            <td>

                <div class="summary-label">
                    Sudah Diganti
                </div>

                <div class="summary-value">

                    Rp {{
                    number_format(
                        $paidPersonalFund,
                        0,
                        ',',
                        '.'
                    )
                }}

                </div>

            </td>

        </tr>

    </table>



    <table class="data">

        <thead>

            <tr>

                <th>No</th>

                <th>Tanggal</th>

                <th>Nama Tim</th>

                <th>Proyek</th>

                <th>Keterangan</th>

                <th>Jumlah</th>

                <th>Status</th>

                <th>Tanggal Diganti</th>

            </tr>

        </thead>


        <tbody>


            @forelse ($personalFunds as $personalFund)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>


                <td>

                    {{
                    optional(
                        $personalFund
                            ->expense
                            ?->expense_date
                    )->format('d-m-Y')
                }}

                </td>


                <td>

                    {{
                    $personalFund
                        ->user
                        ?->name
                    ??
                    '-'
                }}

                </td>


                <td>

                    {{
                    $personalFund
                        ->expense
                        ?->project
                        ?->project_name
                    ??
                    '-'
                }}

                </td>


                <td>

                    {{
                    $personalFund->notes
                    ??
                    $personalFund
                        ->expense
                        ?->description
                    ??
                    '-'
                }}

                </td>


                <td class="amount">

                    Rp {{
                    number_format(
                        $personalFund->amount,
                        0,
                        ',',
                        '.'
                    )
                }}

                </td>


                <td>

                    @if(
                    $personalFund
                    ->reimbursement_status
                    ===
                    'paid'
                    )

                    <span class="paid">
                        Sudah Diganti
                    </span>

                    @else

                    <span class="unpaid">
                        Belum Diganti
                    </span>

                    @endif

                </td>


                <td>

                    {{
                    $personalFund
                        ->reimbursement_date

                    ? $personalFund
                        ->reimbursement_date
                        ->format('d-m-Y')

                    : '-'
                }}

                </td>

            </tr>


            @empty


            <tr>

                <td
                    colspan="8"
                    style="text-align:center;">
                    Belum ada data uang pribadi.
                </td>

            </tr>


            @endforelse


        </tbody>


    </table>


    <div class="footer">

        RuangKita —
        Kelola Proyek Renovasi dengan Lebih Mudah

    </div>


</body>

</html>