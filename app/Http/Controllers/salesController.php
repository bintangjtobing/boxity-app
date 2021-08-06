<?php

namespace App\Http\Controllers;

use App\itemsSales;
use App\salesDeliveryReceipt;
use App\salesInvoice;
use App\salesOrder;
use App\salesReturn;
use App\userLogs;
use App\company_details;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;

// Generate PDF
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use PDF;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Mail;

class salesController extends Controller
{
    // Ssales
    // Sales Order
    public function getSalesOrder()
    {
        return response()->json(salesOrder::with('customer')->with('createdby')->orderBy('created_at', 'DESC')->get());
    }

    public function getSalesOrderById($id)
    {
        try {
            $salesOrder = salesOrder::where('id', $id)->with('customer')->first();
        } catch (\Throwable $th) {
            return response()->json($th);
        }
        return response()->json($salesOrder);
    }

    public function postSalesOrder(Request $request)
    {
        $salesOrd = new salesOrder();
        $salesOrd->so_number = $request->so_number;
        $salesOrd->customer = $request->customer;
        $salesOrd->order_date = $request->order_date;
        $salesOrd->remarks = $request->remarks;
        $salesOrd->status = 0;
        $salesOrd->created_by = Auth::id();
        $salesOrd->updated_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new Sales Order ' . $salesOrd->so_number . '.';
        $saveLogs->save();

        $salesOrd->save();
        DB::table('items_sales')
            ->where('so_status', '=', '1')
            // PO Status 2, means having a purchasing ID
            ->update(array('salesingId' => $salesOrd->so_number, 'so_status' => '2'));

        return response()->json($salesOrd, 200);
    }

    public function postSalesOrderById($id, Request $request)
    {
        $salesOrd = salesOrder::find($id);
        $salesOrd->so_number = $request->so_number;
        $salesOrd->customer = $request->customer;
        $salesOrd->order_date = $request->order_date;
        $salesOrd->remarks = $request->remarks;
        $salesOrd->updated_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Modify Sales Order ' . $salesOrd->so_number . '.';
        $saveLogs->save();

        $salesOrd->save();
        return response()->json($salesOrd, 200);
    }
    public function deleteSalesOrderById($id)
    {
        return response()->json(salesOrder::find($id)->delete());
    }
    public function countSalesOrder()
    {
        $ItemCount = DB::table('sales_orders')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    // Sales Invoices
    public function getSalesInvoice()
    {
        return response()->json(salesInvoice::with('customer')->with('createdby')->orderBy('created_at', 'DESC')->get());
    }
    public function postSalesInvoice(Request $request)
    {
        $salesInv = new salesInvoice();
        $salesInv->si_number = $request->si_number;
        $salesInv->customer = $request->customer;
        $salesInv->invoice_date = $request->invoice_date;
        $salesInv->toGL = $request->toGL;
        $salesInv->status = $request->status;
        $salesInv->created_by = Auth::id();
        $salesInv->updated_by = Auth::id();
        $salesInv->save();
        return response()->json($salesInv, 200);
    }
    public function getSalesInvoiceById($id)
    {
        return response()->json(salesInvoice::find($id));
    }
    public function postSalesInvoiceById($id, Request $request)
    {
        $salesInv = salesInvoice::find($id);
        $salesInv->si_number = $request->si_number;
        $salesInv->customer = $request->customer;
        $salesInv->invoice_date = $request->invoice_date;
        $salesInv->toGL = $request->toGL;
        $salesInv->status = $request->status;
        $salesInv->updated_by = Auth::id();
        $salesInv->save();
        return response()->json($salesInv, 200);
    }
    public function deleteSalesInvoiceById($id)
    {
        return response()->json(salesInvoice::find($id)->delete());
    }
    public function countSalesInvoice()
    {
        $ItemCount = DB::table('sales_invoices')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    // Sales Return
    public function getSalesReturn()
    {
        return response()->json(salesReturn::with('customer')->with('createdby')->orderBy('created_at', 'DESC')->get());
    }
    public function postSalesReturn(Request $request)
    {
        $salesRet = new salesReturn();
        $salesRet->return_number = $request->return_number;
        $salesRet->customer = $request->customer;
        $salesRet->return_date = $request->return_date;
        $salesRet->toGL = $request->toGL;
        $salesRet->status = $request->status;
        $salesRet->created_by = Auth::id();
        $salesRet->updated_by = Auth::id();
        $salesRet->save();
        return response()->json($salesRet, 200);
    }
    public function getSalesReturnById($id)
    {
        return response()->json(salesReturn::find($id));
    }
    public function postSalesReturnById($id, Request $request)
    {
        $salesRet = salesReturn::find($id);
        $salesRet->return_number = $request->return_number;
        $salesRet->customer = $request->customer;
        $salesRet->return_date = $request->return_date;
        $salesRet->toGL = $request->toGL;
        $salesRet->status = $request->status;
        $salesRet->updated_by = Auth::id();
        $salesRet->save();
        return response()->json($salesRet, 200);
    }
    public function deleteSalesReturnById($id)
    {
        return response()->json(salesReturn::find($id)->delete());
    }
    public function countSalesReturn()
    {
        $ItemCount = DB::table('sales_returns')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }

    // DELIVERY RECEIPT
    public function getDeliveryReceipt()
    {
        if (Auth::user()->role == 'customer') {
            return salesDeliveryReceipt::where('created_by', Auth::id())->with('customers')->with('warehouse')->with('createdby')->orderBy('created_at', 'DESC')->get();
        } else {
            return salesDeliveryReceipt::with('customers')->with('warehouse')->with('createdby')->orderBy('created_at', 'DESC')->get();
        }
    }
    public function postDeliveryReceipt(Request $request)
    {
        $deliveryReceiptOrd = new salesDeliveryReceipt();
        $deliveryReceiptOrd->sdr_number = $request->sdr_number;
        $deliveryReceiptOrd->customer = $request->customer;
        $deliveryReceiptOrd->sdr_date = $request->sdr_date;
        $deliveryReceiptOrd->drivers = $request->drivers;
        $deliveryReceiptOrd->reference_no = $request->reference_no;
        $deliveryReceiptOrd->vehicle_no = $request->vehicle_no;
        $deliveryReceiptOrd->deliver_to = $request->deliver_to;
        $deliveryReceiptOrd->remarks = $request->remarks;
        $deliveryReceiptOrd->created_by = Auth::id();
        $deliveryReceiptOrd->updated_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new Sales Delivery Receipt ' . $deliveryReceiptOrd->sdr_number . '.';
        $saveLogs->save();

        $deliveryReceiptOrd->save();

        $itemGet = DB::table('items_sales')
            ->where('sdr_status', '=', '1')
            // PO Status 2, means having a purchasing ID
            ->update(array('salesingId' => $deliveryReceiptOrd->sdr_number, 'sdr_status' => '2'));
        return 200;
    }
    public function getDeliveryReceiptBySdrNumber($sdr_number)
    {
        return response()->json(salesDeliveryReceipt::where('sdr_number', $sdr_number)->with('customers', 'warehouse')->first());
    }
    public function postDeliveryReceiptBySdrNumber($sdr_number, Request $request)
    {
        $purchasingUpdate = DB::table('sales_delivery_receipts')
            ->where(
                'sdr_number',
                '=',
                $sdr_number
            )
            ->update(array(
                'customer' => $request->customer,
                'sdr_date' => $request->sdr_date,
                'deliver_to' => $request->deliver_to,
                'drivers' => $request->drivers,
                'reference_no' => $request->reference_no,
                'vehicle_no' => $request->vehicle_no,
                'remarks' => $request->remarks,
                'updated_by' => Auth::id(),
            ));

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Update Purchase Invoice ' . $sdr_number . '.';
        $saveLogs->save();
        return response()->json($purchasingUpdate, 200);
    }
    public function deleteDeliveryReceiptById($id, Request $request)
    {
        $purchaseOrd = salesDeliveryReceipt::find($id);
        $itemPurchase = itemsSales::where('sdr_number', $purchaseOrd->sdr_number)->get();
        foreach ($itemPurchase as $itemPurchases) {
            $itemPurchases->delete();
        }
        $itemsHistory = itemHistory::where('itemOutId', $purchaseOrd->sdr_number)->get();
        foreach ($itemsHistory as $itemHistory) {
            $itemHistory->delete();
        }

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Delete Sales Delivery Receipt ' . $purchaseOrd->sdr_number . '.';
        $saveLogs->save();
        $purchaseOrd->delete();
        return response()->json(201);
    }
    public function countDeliveryReceipt()
    {
        $ItemCount = DB::table('sales_delivery_receipts')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    public function reportSdr($id)
    {
        $getSdr = salesDeliveryReceipt::where('id', $id)->with('customers', 'warehouse')->first();
        $getItemOnPI = itemsSales::where('sdr_number', $getSdr->sdr_number)->with('item')->get();
        $client = new Party([
            'name'          => $getSdr->customers->customerName,
            'address'         => $getSdr->customers->customerAddress,
        ]);

        $customer = new Party([
            'name'          => $getSdr->warehouse->warehouse_name,
            'address'       => $getSdr->warehouse->address,
        ]);

        // $items = [
        //     (new InvoiceItem())->title('Service 1')->pricePerUnit(47.79)->quantity(2)->discount(10),
        //     (new InvoiceItem())->title('Service 2')->pricePerUnit(71.96)->quantity(2),
        //     (new InvoiceItem())->title('Service 3')->pricePerUnit(4.56),
        //     (new InvoiceItem())->title('Service 4')->pricePerUnit(87.51)->quantity(7)->discount(4)->units('kg'),
        //     (new InvoiceItem())->title('Service 5')->pricePerUnit(71.09)->quantity(7)->discountByPercent(9),
        //     (new InvoiceItem())->title('Service 6')->pricePerUnit(76.32)->quantity(9),
        //     (new InvoiceItem())->title('Service 7')->pricePerUnit(58.18)->quantity(3)->discount(3),
        //     (new InvoiceItem())->title('Service 8')->pricePerUnit(42.99)->quantity(4)->discountByPercent(3)
        // ];
        foreach ($getItemOnPI as $getItemOnPI) {
            $items[] = (new InvoiceItem())->title($getItemOnPI->item->item_name)->pricePerUnit('0')->quantity($getItemOnPI->qtyShipped)->units($getItemOnPI->unit);
        }

        // NOTES FOR INVOICING
        if ($getSdr->remarks == null) {
            $notes = '';
        } else {
            $notes = $getSdr->remarks;
        }
        // $notes = implode("<br>", $notes);

        $invoice = InvoiceInvoice::make('Purchase Invoice')
            ->series($getSdr->sdr_number)
            ->seller($client)
            ->buyer($customer)
            ->date($getSdr->created_at)
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('Rp')
            ->currencyCode('Rupiahs')
            ->currencyFormat('{SYMBOL}. {VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($client->name . ' ' . $customer->name)
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('webpage/images/logo.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
        // return $getItemOnPO;
        // return response(purchaseOrder::find($id)->with('supplier')->with('recipient')->with('createdby')->get());
        // return view('report.index');
    }

    public function reportSalesOrder($id)
    {
        $company = company_details::first();
        $salesOrder = salesOrder::where('id', $id)->with('customers')->first();
        $itemSales = itemsSales::where('salesingId', $salesOrder->so_number)->with('item')->get();

        $item = [];
        foreach ($itemSales as $x) {
            $data = [
                "name" => $x->item->item_name,
                "price" => $x->price,
                "qty" => $x->qtyOrdered,
                "remark" => $x->remarks,
                "unit" => $x->unit,
                "priceAmount" => $x->price * $x->qtyOrdered
            ];
            array_push($item, $data);
        }

        $data = [
            "companyName" => $company->company_name,
            "companyAddress" => $company->address,
            "companyPhone" => $company->phone,
            "companyEmail" => $company->email,
            "soNumber" => $salesOrder->so_number,
            "orderDate" => $salesOrder->order_date,
            "remark" => $salesOrder->remarks,
            "customerName" => $salesOrder->customers->customerName,
            "customerAddress" => $salesOrder->customers->customerAddress,
            "customerEmail" => $salesOrder->customers->customerEmail,
            "items" => $item,
            "qrcode" => base64_encode(QrCode::format('svg')->size(100)->generate(url('/api/report/sales-order/' . $id))),
            "image" => $company->logoblack,
        ];

        $pdf = PDF::loadView('vendor.invoices.templates.sales-order', $data)->setPaper('a4', 'potrait');
        return $pdf->stream();
        // return $itemSales;
    }

    public function reportSSdr($sdr_number)
    {
        $company = company_details::first();
        $deliveryReceiptData = salesDeliveryReceipt::where('sdr_number', $sdr_number)->with('customers')->first();
        $itemSales = itemsSales::where('salesingId', $deliveryReceiptData->sdr_number)->with('item')->get();

        $item = [];
        foreach ($itemSales as $x) {
            $data = [
                "name" => $x->item->item_name,
                "price" => $x->price,
                "qty" => $x->qtyShipped,
                "remark" => $x->remarks,
                "unit" => $x->unit,
                "item_code" => $x->item->item_code,
            ];
            array_push($item, $data);
        }

        $data = [
            "companyName" => $company->company_name,
            "companyAddress" => $company->address,
            "companyPhone" => $company->phone,
            "companyEmail" => $company->email,
            "soNumber" => $deliveryReceiptData->sdr_number,
            "orderDate" => $deliveryReceiptData->sdr_date,
            "remark" => $deliveryReceiptData->remarks,
            "drivers" => $deliveryReceiptData->drivers,
            "vehicleNo" => $deliveryReceiptData->vehicle_no,
            "customerName" => $deliveryReceiptData->customers->customerName,
            "customerAddress" => $deliveryReceiptData->customers->customerAddress,
            "customerEmail" => $deliveryReceiptData->customers->customerEmail,
            "items" => $item,
            "qrcode" => base64_encode(QrCode::format('svg')->size(70)->generate(url('/report/deliver-receipt/' . $sdr_number))),
            "image" => $company->logoblack,
        ];

        $pdf = PDF::loadView('report.deliveryReceipt', $data)->setPaper('a4', 'potrait');
        return $pdf->stream();
        // return $getSales;
    }
}
