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
                <td style="text-align: left;" id="logo">
                    <img src="{{ $image }}">
                </td>
                <td id="title">
                    <span>{{ $title }}</span>
                </td>
            </tr>
        </table>
        <hr/>
        <table style="text-align: center !important;">
            <tr style="font-size: 12px; color: #190902;">
                <td>Invoice Date</td>
                <td>Created Date</td>
                <td>Invoice No.</td>
            </tr>
            <tr style="font-size: 15px; font-weight: 700; color: #F95B12;">
                <td>{{ $orderDate }}</td>
                <td>{{ $createdAt }}</td>
                <td>{{ $soNumber }}</td>
            </tr>
            <hr/>
        </table>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div style="font-size:15px; font-weight:700; color: #F95B12;">DELIVER TO</div>
                <div style="font-size: 12px; color: #190902;">{{ $customerName }}</div>
                <div style="font-size: 10px; color: #190902;">{{ $customerAddress }}</div>
                <br>
                <div style="font-size: 12px; color: #190902;">021 - 5978 - 9900</div>
                <div style="font-size: 12px; color: #190902;">{{ $customerEmail }}</div>
            </div>
            <div id="invoice">
                <div style="font-size:15px; font-weight:700; color: #F95B12;">SUPPLIER</div>
                <div style="font-size: 12px; color: #190902;">{{ $customerName }}</div>
                <div style="font-size: 10px; color: #190902;">{{ $customerAddress }}</div>
                <br>
                <div style="font-size: 12px; color: #190902;">021 - 5978 - 9900</div>
                <div style="font-size: 12px; color: #190902;">{{ $customerEmail }}</div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr style="font-size: 15px; font-weight: 700 !important;">
                    <th style="width: 25%;text-align: left">Item Description</th>
                    <th style="width: auto;text-align: center">Qty/UOM</th>
                    <th style="width: 20%;text-align: center">Price</th>
                    <th style="width: auto; text-align: center">Remarks</th>
                    <th style="width: 25%">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
            $i = 0; $total = 0;
            foreach ($items as $item) {
          ?>
                <tr style="font-size: 12px; color: #190902;">
                    <td style="width: 25%;text-align: left">{{ $item['name'] }}{{ $item['remark'] }}</td>
                    <td style="width: auto;text-align: center">{{ $item['qty'] }}</td>
                    <td style="width: 20%;text-align: center">Rp. {{ number_format($item['price'],2) }}</td>
                    <td style="width: auto; text-align: center">{{ $item['unit'] }}</td>
                    <td style="width: 25%;text-align: right">Rp. {{ number_format($item['priceAmount'],2) }}</td>
                </tr>
                <?php
              $i++;
            }
          ?>
            </tbody>
            <tfoot style="font-size: 12px; color: #190902;">
                <tr>
                    <td colspan="2" rowspan="3" style="text-align: left !important; vertical-align: top; ">
                        <div style="font-size:15px; font-weight:700; color: #F95B12; margin: 0 0 7px 0">Payment Method</div>
                        <div style="font-size: 12px; font-weight:700; color: #190902;">Bank Central Asia</div>
                        <div style="font-size: 12px; color: #190902;">PT COMPANY TERDETEKSI</div>
                        <div style="font-size: 12px; color: #190902;">365 123 4567</div>
                    </td>
                    <td></td>
                    <td style="text-align: center !important">Sub Total</td>
                    <td style="text-align: right !important">Rp. {{ number_format($total,2) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: center !important">Tax Vat {{ $tax }}%</td>
                    <td style="text-align: right !important">Rp. {{ number_format($taxVat,2) }}</td>
                </tr>
                <tr style="font-size: 15px; font-weight: 700; color: #F95B12;">
                    <td></td>
                    <td style="text-align: center !important">Grand Total</td>
                    <td style="text-align: right !important">Rp. {{ number_format($grandTotal,2) }}</td>
                </tr>
            </tfoot>
        </table>
        <table id="counted">
            <tr>
                <td style="font-size: 15px; font-weight: 700; color: #F95B12;">Terbilang</td>
            </tr>
            <tr>
                <td style="font-size: 12px; font-weight: 700; color: #190902;"><i>{{ $counted }}</i></td>
            </tr>
            <!-- <span style="font-size: 15px; font-weight: 700; color: #F95B12;">Terbilang</span>
            <span style="font-size: 12px; font-weight: 700; color: #190902;">{{ $counted }}</span> -->
        </table>
    </main>
    <footer>
        <table id="note">
            <tr>
                <td style="width:80% !important;">
                    <div style="font-size:15px; font-weight:700; color: #F95B12;">NOTES</div>
                    <div style="font-size: 12px; color: #190902;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </div>
                </td>
                <td id="barcode" style="text-align: right !important;">
                    <img src="data:image/png;base64,{!! $qrcode !!}">
                </td>
            </tr>
        </table>
        <br>
        <table style="width: 50%; text-align:left !important">
            <tr style="font-size: 12px; color: #190902;">
                <td>Diketahui Oleh</td>
                <td>Disetujui Oleh</td>
            </tr>
            <tr>
                <td style="height: 30px"></td>
                <td style="height: 30px"></td>
            </tr>
            <tr style="font-size: 12px; color: #190902;">
                <td>Hello World</td>
                <td>Hello World</td>
            </tr>
        </table>
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
        /* margin: 0 auto; */
        color: #777;
        background: #FFFFFF;
        font-family: 'Lato', sans-serif;
    }

    header {
        padding: 0 0 10px;
        margin-bottom: 20px;
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
        height: 75px;
    }
    
    #title span {
        font-size: 32px;
        font-weight: 700;
        color: #F95B12;
    }
    
    #subHeader {
        text-align: center !important;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }

    #company {
        width: 45%;
        float: right;
        font-size: .85rem;
        text-align: right;
    }

    #details {
        margin-bottom: 1.4rem;
    }

    #client {
        width: 40%;
        float: right;
        text-align: right;
    }

    #invoice {
        width: 100%;
        float: left;
        text-align: left;
    }

    #invoice .address {
        font-size: .65rem;
    }

    #invoice h1 {
        color: #f35e00;
        font-size: 1.2rem;
        line-height: 1em;
        font-weight: normal;
        margin: 0 0 2px 0;
    }

    #invoice h2 {
        line-height: 1em;
        margin: 0 0 6px 0;
    }

    #invoice .date {
        font-size: 1rem;
        color: #777777;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
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
    }
    
    main thead th {
        padding: 13px 20px !important;
        color: #FFF;
        text-align:center !important;
    }
    
    main tbody tr:nth-child(odd) {
        background: #FEDED0;
    }
    
    main tbody tr:nth-child(even) {
        background: #FDBDA0;
    }
    
    main tbody td {
        padding: 13px 20px !important;
    }

    main tfoot td {
        padding: 7px 20px !important;
    }
    
    main #counted td {
        padding: 0 !important;
        background: #FFF;
        text-align: left;
    }
    
    footer #note tr{
        background: #FFF;
    }

    footer #note td {
        text-align: left;
    }
    
    #notices {
        padding-left: 6px;
        border-left: 6px solid #f35e00;
    }

    #notices .notice {
        font-size: .90rem;
    }

    footer {
        color: #777777;
        width: 100%;
        position: absolute;
        bottom: 0;
        text-align: center;
    }

    #invoice .purchasing_title {
        font-weight: 700;
    }

</style>
