<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;1,100;1,400&display=swap"
        rel="stylesheet">
    <title>{{$invoice->name}}</title>

    <style>
        body {
            font-family: 'Lato', sans-serif;
            color: #777;
        }

        body h1 {
            line-height: 1.1;
            font-weight: 700;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 100%;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 14px;
            line-height: 24px;
            font-family: 'Lato', sans-serif;
            color: #555;
        }

        hr {
            border: 0.1px solid rgba(0, 0, 0, 0.15);
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: left;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 1rem;
        }

        .invoice-box table tr.top table td.title {
            font-size: 20px;
            line-height: 15px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 1.5rem;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: 500;
        }

        .invoice-box table tr.details td {
            padding-bottom: 1.5rem;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: 500;
        }

        .table thead {
            background-color: #1f1a51;
            color: #fff;
        }

        .table thead th {
            font-weight: 400;
        }

        .table tbody {
            background-color: #f6f6f6;
        }

        .table .total-amount {
            background-color: #1f1a51;
            color: #fff;
        }

        thead th {
            padding: 6px;
        }

        .border-0 h2 {
            margin-bottom: 0;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                @if($invoice->logo)
                                <img src="{{ $invoice->getLogo() }}" alt="logo" height="100">
                                @endif
                            </td>
                            <td class="border-0 pl-0">
                                <span>
                                    <h2>{{$invoice->name}}</h2>
                                </span>
                                <span>{{ __('invoices::invoice.serial') }}
                                    <strong>{{ $invoice->getSerialNumber() }}</strong></span><br>
                                <span>{{ __('invoices::invoice.date') }}:
                                    <strong>{{ $invoice->getDate() }}</strong></span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        {{-- Seller Buyer Information --}}
        <table class="table">
            <thead>
                <tr>
                    <th align="left">Delivery Address</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="buyer">
                        @if($invoice->buyer->name)
                        <span class="buyer-name">
                            <strong>{{ $invoice->buyer->name }}</strong>
                        </span><br>
                        @endif

                        @if($invoice->buyer->address)
                        <span class="buyer-address">
                            {!! $invoice->buyer->address !!}
                        </span><br>
                        @endif

                        @if($invoice->buyer->code)
                        <span class="buyer-code">
                            {{ __('invoices::invoice.code') }}: {{ $invoice->buyer->code }}
                        </span><br>
                        @endif

                        @if($invoice->buyer->vat)
                        <span class="buyer-vat">
                            {{ __('invoices::invoice.vat') }}: {{ $invoice->buyer->vat }}
                        </span><br>
                        @endif

                        @if($invoice->buyer->phone)
                        <span class="buyer-phone">
                            {{ __('invoices::invoice.phone') }}: {{ $invoice->buyer->phone }}
                        </span><br>
                        @endif
                        <br>
                        @foreach($invoice->buyer->custom_fields as $key => $value)
                        <span class="buyer-custom-field">
                            {{ ucfirst($key) }}: {{ $value }}
                        </span><br>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Table --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="border-0 pl-0" align="left">{{ __('invoices::invoice.description') }}</th>
                    <th scope="col" class="text-left border-0" align="left">{{ __('invoices::invoice.quantity') }}</th>
                    @if($invoice->hasItemUnits)
                    <th scope="col" class="text-left border-0" align="left">{{ __('invoices::invoice.units') }}</th>
                    @endif
                    <th scope="col" class="text-left border-0" align="left">{{ __('invoices::invoice.price') }}</th>
                    @if($invoice->hasItemDiscount)
                    <th scope="col" class="text-left border-0" align="left">{{ __('invoices::invoice.discount') }}</th>
                    @endif
                    @if($invoice->hasItemTax)
                    <th scope="col" class="text-left border-0" align="left">{{ __('invoices::invoice.tax') }}</th>
                    @endif
                    <th scope="col" class="text-left border-0 pr-0" align="left">{{ __('invoices::invoice.sub_total') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- Items --}}
                @foreach($invoice->items as $item)
                <tr>
                    <td class="pl-0">{{ $item->title }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    @if($invoice->hasItemUnits)
                    <td class="text-left">{{ $item->units }}</td>
                    @endif
                    <td class="text-left">
                        {{ $invoice->formatCurrency($item->price_per_unit) }}
                    </td>
                    @if($invoice->hasItemDiscount)
                    <td class="text-left">
                        {{ $invoice->formatCurrency($item->discount) }}
                    </td>
                    @endif
                    @if($invoice->hasItemTax)
                    <td class="text-left">
                        {{ $invoice->formatCurrency($item->tax) }}
                    </td>
                    @endif

                    <td class="text-left pr-0">
                        {{ $invoice->formatCurrency($item->sub_total_price) }}
                    </td>
                </tr>
                @endforeach
                {{-- Summary --}}
                @if($invoice->hasItemOrInvoiceDiscount())
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="text-left pl-0">{{ __('invoices::invoice.total_discount') }}</td>
                    <td class="text-left pr-0">
                        {{ $invoice->formatCurrency($invoice->total_discount) }}
                    </td>
                </tr>
                @endif
                @if($invoice->taxable_amount)
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="text-left pl-0">{{ __('invoices::invoice.taxable_amount') }}</td>
                    <td class="text-left pr-0">
                        {{ $invoice->formatCurrency($invoice->taxable_amount) }}
                    </td>
                </tr>
                @endif
                @if($invoice->tax_rate)
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="text-left pl-0">{{ __('invoices::invoice.tax_rate') }}</td>
                    <td class="text-left pr-0">
                        {{ $invoice->tax_rate }}%
                    </td>
                </tr>
                @endif
                @if($invoice->hasItemOrInvoiceTax())
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="text-left pl-0">{{ __('invoices::invoice.total_taxes') }}</td>
                    <td class="text-left pr-0">
                        {{ $invoice->formatCurrency($invoice->total_taxes) }}
                    </td>
                </tr>
                @endif
                @if($invoice->shipping_amount)
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="text-left pl-0">{{ __('invoices::invoice.shipping') }}</td>
                    <td class="text-left pr-0">
                        {{ $invoice->formatCurrency($invoice->shipping_amount) }}
                    </td>
                </tr>
                @endif
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="text-left pl-0 total-amount">{{ __('invoices::invoice.total_amount') }}</td>
                    <td class="text-left pr-0">
                        {{ $invoice->formatCurrency($invoice->total_amount) }}
                    </td>
                </tr>
            </tbody>
        </table>
        <span>
            Notes: {!! $invoice->notes !!}
        </span><br>

        <script type="text/php">
            if (isset($pdf) && $PAGE_COUNT > 1) {
                $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 8;
                $font = $fontMetrics->getFont("Lato");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    </div>
</body>

</html>
