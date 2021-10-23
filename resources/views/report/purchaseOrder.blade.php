<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Purchase Order Receipt</title>
</head>

<body>
    <header class="clearfix">
        <table id="headTable">
            <tr>
                <td style="text-align: left;" id="logo">
                    <img src="{{ $image }}">
                </td>
                <td>
                    <h2>{{ $companyName }}</h2>
                    <div>{{ $companyAddress }}</div>
                    <div>{{ $companyPhone }}</div>
                    <div><a href=<?php echo "mailto:".$companyEmail ?>>{{ $companyEmail }}</a></div>
                </td>
                <td id="barcode">
                    <img src="data:image/png;base64,{!! $qrcode !!}">
                </td>
            </tr>
        </table>
    </header>
    <main>
        {{-- Info Purchasing --}}
        <div id="details" class="clearfix">
            <div id="invoice">
                <div class="purchasing_title">Purchase Order</div>
                <h1>{{$poNumber}}</h1>
                <div>
                    Order date <span class="tab">: {{$orderDate}}</span>
                </div>
            </div>
        </div>
        {{-- INFO SUPPLIER AND WAREHOUSE --}}
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">Deliver To</div>
                <h2>{{ $warehouseName }}</h2>
                <div class="address">{{$warehouseAddress}}</div>
            </div>
            <div id="invoice">
                <div class="to">Supplier</div>
                <h2>{{$supplierName}}</h2>
                <div class="address">{{$supplierAddress}}</div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="desc">Item</th>
                    <th class="qty">Qty/UOM</th>
                    <th class="price">Price</th>
                    <th class="remarks">Remarks</th>
                    <th class="total">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
            $i = 0; $total = 0;
            foreach ($items as $item) {
          ?>
                <tr>
                    <td class="desc">
                        {{ $item['name'] }}
                    </td>
                    <td class="qty">{{ $item['qty'] }} {{ $item['unit'] }}</td>
                    <td class="price">Rp. {{ number_format($item['price'],2) }}</td>
                    <td class="remarks">{{ $item['remark'] }}</td>
                    <td class="total">Rp. {{ number_format($item['priceAmount'],2) }}</td>
                </tr>
                <?php
              $total = $total+$item['priceAmount'];
              $i++;
            }
          ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">Total</td>
                    <td>Rp. {{ number_format($total,2) }}</td>
                </tr>
            </tfoot>
        </table>
        <div id="notices">
            <div>Notes:</div>
            <div class="notice">{{ $remark }}</div>
        </div>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
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

    #details {
        margin-bottom: 1.4rem;
    }

    #client {
        width: 40%;
        padding-right: 6px;
        border-right: 6px solid #f35e00;
        float: right;
        text-align: right;
    }

    #invoice {
        width: 100%;
        float: left;
        text-align: left;
    }

    #client .to {
        font-size: .85rem;
        color: #777777;
    }

    #client .address,
    #client .email {
        font-size: .85rem;
    }

    #company h2,
    #client h2,
    #invoice h2 {
        font-size: 1.2rem;
        font-weight: bolder;
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
