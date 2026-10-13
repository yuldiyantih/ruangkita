<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <title>
        Laporan Pengeluaran RuangKita
    </title>


    <style>
        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            padding: 25px;

            color: #24384b;

            font-family:
                DejaVu Sans,
                Arial,
                sans-serif;

            font-size: 10px;
        }


        .header {

            margin-bottom: 20px;

            border-bottom:
                2px solid #0877d4;

            padding-bottom: 12px;
        }


        .brand {

            color: #0d3458;

            font-size: 22px;

            font-weight: bold;
        }


        .title {

            margin-top: 4px;

            color: #17334c;

            font-size: 15px;

            font-weight: bold;
        }


        .date {

            margin-top: 5px;

            color: #71869a;

            font-size: 9px;
        }


        .summary {

            width: 100%;

            margin-bottom: 18px;

            border-collapse: separate;

            border-spacing: 8px 0;
        }


        .summary td {

            width: 33.33%;

            padding: 12px;

            border:
                1px solid #dfe8ef;

            border-radius: 6px;

            background:
                #f8fbfd;
        }


        .summary-label {

            color: #71869a;

            font-size: 9px;
        }


        .summary-value {

            margin-top: 5px;

            color: #102e49;

            font-size: 14px;

            font-weight: bold;
        }


        table.data {

            width: 100%;

            border-collapse:
                collapse;
        }


        table.data th {

            padding: 8px 6px;

            border:
                1px solid #dce6ee;

            background:
                #eaf4fc;

            color:
                #17334c;

            text-align: left;

            font-size: 9px;
        }


        table.data td {

            padding: 7px 6px;

            border:
                1px solid #e4ebf0;

            vertical-align: top;
        }


        .amount {

            text-align: right;

            white-space: nowrap;
        }


        .center {
            text-align: center;
        }


        .category-box {

            margin-top: 18px;
        }


        .category-title {

            margin-bottom: 8px;

            color: #102e49;

            font-size: 12px;

            font-weight: bold;
        }


        .category-table {

            width: 45%;

            border-collapse:
                collapse;
        }


        .category-table td {

            padding: 6px 8px;

            border:
                1px solid #e4ebf0;
        }


        .footer {

            margin-top: 20px;

            padding-top: 10px;

            border-top:
                1px solid #e0e7ed;

            color: #71869a;

            font-size: 8px;

            text-align: right;
        }
    </style>

</head>


<body>


    {{-- HEADER --}}

    <div class="header">

        <div class="brand">
            RuangKita
        </div>

        <div class="title">
            Laporan Pengeluaran Proyek
        </div>

        <div class="date">

            Dicetak:
            {{ now()->format('d M Y H:i') }}

        </div>

    </div>



    {{-- SUMMARY --}}

    <table class="summary">

        <tr>

            <td>

                <div class="summary-label">
                    Total Pengeluaran
                </div>

                <div class="summary-value">

                    Rp {{
                        number_format(
                            $totalExpense,
                            0,
                            ',',
                            '.'
                        )
                    }}

                </div>

            </td>


            <td>

                <div class="summary-label">
                    Dana Proyek
                </div>

                <div class="summary-value">

                    Rp {{
                        number_format(
                            $projectFundExpense,
                            0,
                            ',',
                            '.'
                        )
                    }}

                </div>

            </td>


            <td>

                <div class="summary-label">
                    Uang Pribadi
                </div>

                <div class="summary-value">

                    Rp {{
                        number_format(
                            $personalFundExpense,
                            0,
                            ',',
                            '.'
                        )
                    }}

                </div>

            </td>

        </tr>

    </table>



    {{-- TABLE --}}

    <table class="data">

        <thead>

            <tr>

                <th>No</th>

                <th>Tanggal</th>

                <th>Proyek</th>

                <th>Keterangan</th>

                <th>Kategori</th>

                <th>Sumber Dana</th>

                <th>Jumlah</th>

                <th>Toko</th>

                <th>Client</th>

            </tr>

        </thead>


        <tbody>

            @forelse($expenses as $expense)

            @php

            $categoryLabel =
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

            @endphp


            <tr>

                <td class="center">
                    {{ $loop->iteration }}
                </td>


                <td>
                    {{
                            optional(
                                $expense->expense_date
                            )->format('d-m-Y')
                        }}
                </td>


                <td>
                    {{
                            $expense->project->project_name
                            ??
                            '-'
                        }}
                </td>


                <td>
                    {{
                            $expense->description
                            ??
                            '-'
                        }}
                </td>


                <td>
                    {{ $categoryLabel }}
                </td>


                <td>

                    {{
                            $expense->funding_source
                            ===
                            'personal'
                                ? 'Uang Pribadi'
                                : 'Dana Proyek'
                        }}

                </td>


                <td class="amount">

                    Rp {{
                            number_format(
                                $expense->amount,
                                0,
                                ',',
                                '.'
                            )
                        }}

                </td>


                <td>

                    {{
                            $expense->store_name
                            ??
                            '-'
                        }}

                </td>


                <td>

                    {{
                            $expense->is_visible_to_client
                                ? 'Tampil'
                                : 'Sembunyi'
                        }}

                </td>

            </tr>


            @empty

            <tr>

                <td
                    colspan="9"
                    class="center">
                    Belum ada data pengeluaran.
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>



    {{-- CATEGORY SUMMARY --}}

    <div class="category-box">

        <div class="category-title">
            Ringkasan Kategori
        </div>


        <table class="category-table">

            @forelse(
            $categorySummary
            as $category => $amount
            )

            @php

            $label =
            match ($category) {

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

            @endphp


            <tr>

                <td>
                    {{ $label }}
                </td>

                <td class="amount">

                    Rp {{
                            number_format(
                                $amount,
                                0,
                                ',',
                                '.'
                            )
                        }}

                </td>

            </tr>


            @empty

            <tr>

                <td>
                    Belum ada data.
                </td>

            </tr>

            @endforelse

        </table>

    </div>



    <div class="footer">

        RuangKita —
        Kelola Proyek Renovasi dengan Lebih Mudah

    </div>


</body>

</html>