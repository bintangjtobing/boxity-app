<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Report Sales Order</title>
</head>

<body>
    <header class="clearfix">
        <table id="headTable">
            <tr>
                <td style="text-align: left" id="logo">
                    <img src="{{ $image }}">
                </td>
                <td style="text-align: left; width: 65%">
                    <h1 style="margin: 0 0 10px">Inventory Item Report</h1>
                    <table>
                        <tr>
                            <td style="text-align: left;width: 20%">
                                Item Name
                            </td>
                            <td style="text-align: left">
                                : {{ $itemName }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;width: 20%">
                                Unit
                            </td>
                            <td style="text-align: left">
                                : {{ $unit }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;width: 20%">
                                Periode
                            </td>
                            <td style="text-align: left">
                                : {{ $periode }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </header>
    <main>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th width=90px>Date</th>
                    <th>Document</th>
                    <th>Remark</th>
                    <th>QtyIn</th>
                    <th>QtyOut</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                <?php
            foreach ($items as $item) {
          ?>
                <tr>
                    <td style="text-align: center;">{{ $item['date'] }}</td>
                    <td style="text-align: center;">{{ $item['documentCode'] }}</td>
                    <td style="text-align: left;">{{ $item['remark'] }}</td>
                    <td style="text-align: center;">{{ $item['qtyIn'] }}</td>
                    <td style="text-align: center;">{{ $item['qtyOut'] }}</td>
                    <td style="text-align: center;">{{ $item['saldo'] }}</td>
                </tr>
                <?php
            }
          ?>
            </tbody>
        </table>
    </main>
    <footer>
        Report was created on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap');

    @font-face {
        font-family: 'Lato', sans-serif;
    }

    .tab {
        margin-left: 40px;
    }

    .tab3 {
        margin-left: 93px;
    }

    .tab2 {
        margin-left: 67px;
    }

    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    #barcode img {
        margin-top: 0;
    }

    a {
        color: #f35e00;
        text-decoration: none;
    }

    body {
        position: relative;
        height: 21cm;
        margin: 0 auto;
        color: #777;
        background: #FFFFFF;
        font-family: 'Lato', sans-serif;
    }

    #invoice .to,
    #client .to {
        margin: 0 0 10px 0;
    }

    header {
        padding: 0 0 10px;
        margin-bottom: 20px;
        border-bottom: 1px solid #AAAAAA;
    }

    header table td {
        font-size: .85rem;
        padding: 0;
    }

    header tbody {
        background: #fff;
    }

    #headTable td h2 {
        font-size: 1.2rem;
    }

    #logo {
        float: left;
        margin-top: 8px;
    }

    #logo img {
        height: 60px;
    }

    #company {
        width: 45%;
        float: right;
        font-size: .85rem;
        text-align: right;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
    }

    table th,
    table td {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }

    table th {
        white-space: nowrap;
        font-weight: normal;
    }

    table td {
        text-align: right;
    }

    table .desc {
        text-align: left;
    }

    table .qty {
        text-align: center;
    }

    thead tr {
        background: #f35e00;
        color: #fff;
    }

    tbody {
        background: rgb(246, 246, 246);
    }

    thead tr th {
        font-weight: 700;
        font-size: .90rem;
    }

    thead tr .price,
    thead tr .total {
        text-align: right;
    }

    tbody tr .desc {
        color: #777;
    }

    tbody tr {
        color: #777;
    }

    table tfoot td {
        padding: 10px 20px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: .90rem;
        white-space: nowrap;
        border-top: 1px solid #AAAAAA;
    }

    table tfoot tr:first-child td {
        border-top: none;
    }

    table tfoot tr:last-child td {
        color: #fff;
        font-size: .90rem;
        font-weight: 700;
        border-top: 1px solid #fff;
        background: #f35e00;
    }

    table tfoot tr td:first-child {
        border: none;
    }

    footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
    }

    #invoice .purchasing_title {
        font-weight: 700;
    }

</style>
