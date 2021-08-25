<?php

namespace App\Http\Controllers;

use App\itemsSales;
use App\salesDeliveryReceipt;
use App\salesInvoice;
use App\salesOrder;
use App\salesReturn;
use App\userLogs;
use App\company_details;
use App\itemHistory;
use App\inventoryItem;

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
    public function getSalesInvoice(Request $request)
    {
        $query = [];
        if ($request->feature === 'deliveryReceipt') {
            $query = salesInvoice::with('customers')->with('createdby')->with('items.item')->whereNotIn('si_number', $request->si_number)->orderBy('created_at', 'DESC')->get();
        } else {
            $query = salesInvoice::with('customers')->with('createdby')->orderBy('created_at', 'DESC')->get();
        }
        return response()->json($query);
    }
    public function postSalesInvoice(Request $request)
    {
        $salesInv = new salesInvoice();
        $salesInv->si_number = $request->si_number;
        $salesInv->customer = $request->customer;
        $salesInv->invoice_date = $request->invoice_date;
        $salesInv->toGL = 0;
        $salesInv->drivers = $request->drivers;
        $salesInv->vehicle_no = $request->vehicle_no;
        $salesInv->remarks = $request->remarks;
        $salesInv->created_by = Auth::id();
        $salesInv->updated_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new Sales Invoice ' . $salesInv->si_number . '.';
        $saveLogs->save();

        $salesInv->save();

        $itemGet = DB::table('items_sales')
            ->where(
                'si_status',
                '=',
                '1'
            )
            // PO Status 2, means having a purchasing ID
            ->update(array('salesingId' => $salesInv->si_number, 'si_status' => '2'));

        $getItemOnSI = itemsSales::where('salesingId', $salesInv->si_number)->get();
        // Jika item yang ada di PI lebih dari 1
        if (count($getItemOnSI) > 0) {
            foreach ($getItemOnSI as $getItemOnSI) {
                $inputToHistory = new itemHistory();
                $inputToHistory->itemId = $getItemOnSI->item_code;
                $inputToHistory->itemOutId = $salesInv->si_number;
                $inputToHistory->type = 2;
                $inputToHistory->date = $salesInv->created_at;
                $inputToHistory->qtyOut = $getItemOnSI->qtyShipped;
                $inputToHistory->remarks = $getItemOnSI->remarks;
                $inputToHistory->save();

                // Get inventory item related
                $itemRelated = inventoryItem::where('id', $getItemOnSI->item_code)->first();
                $getQtyItem = $itemRelated->qty;
                $getInputQtyValue = $getItemOnSI->qtyShipped;
                // Sum the value between get Qty Item and Get Value Inputted
                $sumQty = $getQtyItem - $getInputQtyValue;

                // Update to inventory item
                $getInventory = DB::table('inventory_items')
                    ->where('id', $getItemOnSI->item_code)
                    ->update(array(
                        'qty' => $sumQty,
                    ));
            }
        }
        return 200;
    }
    public function getSalesInvoiceBySiNumber($si_number)
    {
        return response()->json(salesInvoice::where('si_number', $si_number)->with('customers', 'createdby')->first());
    }
    public function postSalesInvoiceBySiNumber($si_number, Request $request)
    {
        $purchasingUpdate = DB::table('sales_invoices')
            ->where(
                'si_number',
                '=',
                $si_number
            )
            ->update(array(
                'customer' => $request->customer,
                'invoice_date' => $request->invoice_date,
                'drivers' => $request->drivers,
                'vehicle_no' => $request->vehicle_no,
                'remarks' => $request->remarks,
                'updated_by' => Auth::id(),
            ));

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Update Sales Invoice ' . $si_number . '.';
        $saveLogs->save();
        return response()->json($purchasingUpdate, 200);
    }
    public function deleteSalesInvoiceById($id, Request $request)
    {
        $salesInvoic = salesInvoice::find($id);
        $itemPurchase = itemsSales::where('salesingId', $salesInvoic->si_number)->get();
        foreach ($itemPurchase as $itemPurchases) {
            $itemPurchases->delete();
        }
        $itemsHistory = itemHistory::where('itemOutId', $salesInvoic->si_number)->get();
        foreach ($itemsHistory as $itemHistory) {
            $itemHistory->delete();
        }

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Delete Sales Invoice ' . $salesInvoic->si_number . '.';
        $saveLogs->save();
        $salesInvoic->delete();
        return response()->json(201);
    }
    public function countSalesInvoice()
    {
        $ItemCount = DB::table('sales_invoices')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    public function reportSI($si_number)
    {
        $company = company_details::first();
        $salesInvoice = salesInvoice::where('si_number', $si_number)->with('customers', 'createdby')->first();
        $itemPurchasing = itemsSales::where('salesingId', $salesInvoice->si_number)->with('item')->get();

        $item = [];
        foreach ($itemPurchasing as $x) {
            $data = [
                "name" => $x->item->item_name,
                "price" => $x->price,
                "qty" => $x->qtyShipped,
                "remark" => $x->remarks,
                "unit" => $x->unit,
                "priceAmount" => $x->price * $x->qtyShipped
            ];
            array_push($item, $data);
        }

        $data = [
            "companyName" => $company->company_name,
            "companyAddress" => $company->address,
            "companyPhone" => $company->phone,
            "companyEmail" => $company->email,
            "customerName" => $salesInvoice->customers->customerName,
            "customerAddress" => $salesInvoice->customers->customerAddress,
            "customerNPWP" => $salesInvoice->customers->customerNPWP,
            "customerEmail" => $salesInvoice->customers->customerEmail,
            "customerPhone" => $salesInvoice->customers->customerPhone,
            "siNumber" => $salesInvoice->si_number,
            "orderDate" => $salesInvoice->invoice_date,
            "remark" => $salesInvoice->remarks,
            "items" => $item,
            "qrcode" => base64_encode(QrCode::format('svg')->size(70)->generate(url('/report/sales/invoices/' . $si_number))),
            "image" => $company->logoblack,
        ];

        $pdf = PDF::loadView('report.salesInvoice', $data)->setPaper('a4', 'potrait');
        return $pdf->stream();
        // return $itemPurchasing;
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
        $salesRet->toGL = 0;
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
        $salesRet->toGL = 0;
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
            "title" => "SALES ORDER",
            "companyName" => $company->company_name,
            "companyAddress" => $company->address,
            "companyPhone" => $company->phone,
            "companyEmail" => $company->email,
            "soNumber" => $salesOrder->so_number,
            "orderDate" => $this->format_date($salesOrder->order_date),
            "createdAt" => $this->format_date($salesOrder->created_at),
            "remark" => $salesOrder->remarks,
            "customerName" => $salesOrder->customers->customerName,
            "customerAddress" => $salesOrder->customers->customerAddress,
            "customerEmail" => $salesOrder->customers->customerEmail,
            "items" => $item,
            "tax" => 10,
            "qrcode" => base64_encode(QrCode::format('svg')->size(100)->generate(url('/api/report/sales-order/' . $id))),
            "image" => $company->logoblack,
        ];

        $pdf = PDF::loadView('vendor.invoices.templates.sales-order', $data)->setPaper('a4', 'potrait');
        return $pdf->stream();
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
    
    function format_date($date){
        $date = date_format(date_create($date),"d-m-Y");
        $moon = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $temp = explode('-', $date);
        
        // variabel temp 0 = date
        // variabel temp 1 = moon
        // variabel temp 2 = tahun
     
        return $temp[0] . ' ' . $moon[ (int)$temp[1] ] . ' ' . $temp[2];
    }
     
}
