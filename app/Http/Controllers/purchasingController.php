<?php

namespace App\Http\Controllers;

use App\company_details;
use App\inventoryItem;
use App\itemHistory;
use App\itemsPurchase;
use App\purchaseInvoice;
use App\purchaseOrder;
use App\purchaseRequest;
use App\purchaseReturn;
use App\userLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;

// Generate PDF
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\InvoiceRequest;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\InvoiceInvoice;
use LaravelDaily\Invoices\InvoiceReturn;
use Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

use App\User;

class purchasingController extends Controller
{
    public function getCompany()
    {
        return company_details::first();
    }
    // Purchasing
    // PURCHASE ORDER
    public function getPurchaseOrder()
    {
        if (Auth::user()->role == 'customer') {
            return purchaseOrder::where('created_by', Auth::id())->with('suppliers')->with('warehouse')->with('createdby')->orderBy('created_at', 'DESC')->get();
        } else {
            return purchaseOrder::with('suppliers')->with('warehouse')->with('createdby')->orderBy('created_at', 'DESC')->get();
        }
    }
    public function postPurchaseOrder(Request $request)
    {
        $purchasingOrd = new purchaseOrder();
        $purchasingOrd->po_number = $request->po_number;
        $purchasingOrd->supplier = $request->supplier;
        $purchasingOrd->order_date = $request->order_date;
        $purchasingOrd->deliver_to = $request->deliver_to;
        $purchasingOrd->remarks = $request->remarks;
        $purchasingOrd->created_by = Auth::id();
        $purchasingOrd->updated_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new Purchase Order ' . $purchasingOrd->po_number . '.';
        $saveLogs->save();

        $purchasingOrd->save();

        $itemGet = DB::table('items_purchases')
            ->where('po_status', '=', '1')
            // PO Status 2, means having a purchasing ID
            ->update(array('purchasingId' => $purchasingOrd->po_number, 'po_status' => '2'));
        return response()->json($purchasingOrd, 200);
    }
    public function getPurchaseOrderByPoNumber($po_number)
    {
        return response()->json(purchaseOrder::where('po_number', $po_number)->with('suppliers', 'warehouse')->first());
    }
    public function postPurchaseOrderByPoNumber($po_number, Request $request)
    {
        $purchasingUpdate = DB::table('purchase_orders')
            ->where('po_number', '=', $po_number)
            ->update(array(
                'supplier' => $request->supplier,
                'order_date' => $request->order_date,
                'deliver_to' => $request->deliver_to,
                'remarks' => $request->remarks,
                'updated_by' => Auth::id(),
            ));

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Update Purchase Order ' . $po_number . '.';
        $saveLogs->save();

        return response()->json($purchasingUpdate, 200);
    }
    public function approvePurchaseOrderByPoNumber($po_number, Request $request)
    {
        // Update status to 1, means it is approved
        $statusPRE = purchaseOrder::where('po_number', $po_number)
            ->update(array(
                'status' => 1,
                'approvedBy' => Auth::id(),
            ));
        return response()->json($detailsToPO);
    }
    public function deletePurchaseOrderById($id, Request $request)
    {
        $purchaseOrd = purchaseOrder::find($id);
        $itemPurchase = itemsPurchase::where('purchasingId', $purchaseOrd->po_number)->get();
        foreach ($itemPurchase as $itemPurchases) {
            $itemPurchases->delete();
        }

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Delete Purchase Order ' . $purchaseOrd->po_number . '.';
        $saveLogs->save();

        $purchaseOrd->delete();
        return response()->json(201);
    }
    public function countPurchaseOrder()
    {
        $ItemCount = DB::table('purchase_orders')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    public function reportPO($po_number)
    {
        $company = company_details::first();
        $purchaseOrder = purchaseOrder::where('po_number', $po_number)->with('suppliers', 'warehouse')->first();
        $itemPurchasing = itemsPurchase::where('purchasingId', $purchaseOrder->po_number)->with('item')->get();

        $item = [];
        foreach ($itemPurchasing as $x) {
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
            "warehouseName" => $purchaseOrder->warehouse->warehouse_name,
            "warehouseAddress" => $purchaseOrder->warehouse->address,
            "supplierName" => $purchaseOrder->suppliers->customerName,
            "supplierAddress" => $purchaseOrder->suppliers->customerAddress,
            "supplierNPWP" => $purchaseOrder->suppliers->customerNPWP,
            "supplierEmail" => $purchaseOrder->suppliers->customerEmail,
            "supplierPhone" => $purchaseOrder->suppliers->customerPhone,
            "poNumber" => $purchaseOrder->po_number,
            "orderDate" => $purchaseOrder->order_date,
            "remark" => $purchaseOrder->remarks,
            "items" => $item,
            "qrcode" => base64_encode(QrCode::format('svg')->size(70)->generate(url('/report/purchase/order/' . $po_number))),
            "image" => $company->logoblack,
        ];

        $pdf = PDF::loadView('report.purchaseOrder', $data)->setPaper('a4', 'potrait');
        return $pdf->stream();
        // return $itemPurchasing;
    }

    // PURCHASE INVOICE
    public function getPurchaseInvoice()
    {
        if (Auth::user()->role == 'customer') {
            return purchaseInvoice::where('created_by', Auth::id())->with('suppliers')->with('warehouse')->with('createdby')->orderBy('created_at', 'DESC')->get();
        } else {
            return purchaseInvoice::with('suppliers')->with('warehouse')->with('createdby')->orderBy('created_at', 'DESC')->get();
        }
    }
    public function postPurchaseInvoice(Request $request)
    {
        $purchasingOrd = new purchaseInvoice();
        $purchasingOrd->pi_number = $request->pi_number;
        $purchasingOrd->supplier = $request->supplier;
        $purchasingOrd->invoice_date = $request->order_date;
        $purchasingOrd->drivers = $request->drivers;
        $purchasingOrd->vehicle_no = $request->vehicle_no;
        $purchasingOrd->deliver_to = $request->deliver_to;
        $purchasingOrd->remarks = $request->remarks;
        $purchasingOrd->created_by = Auth::id();
        $purchasingOrd->updated_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new Purchase Invoice ' . $purchasingOrd->pi_number . '.';
        $saveLogs->save();

        $purchasingOrd->save();

        $itemGet = DB::table('items_purchases')
            ->where('pi_status', '=', '1')
            // PO Status 2, means having a purchasing ID
            ->update(array('purchasingId' => $purchasingOrd->pi_number, 'pi_status' => '2'));

        $getItemOnPI = itemsPurchase::where('purchasingId', $purchasingOrd->pi_number)->get();
        // Jika item yang ada di PI lebih dari 1
        if (count($getItemOnPI) > 0) {
            foreach ($getItemOnPI as $getItemOnPi) {
                $inputToHistory = new itemHistory();
                $inputToHistory->itemId = $getItemOnPi->item_code;
                $inputToHistory->itemInId = $purchasingOrd->pi_number;
                $inputToHistory->type = 1;
                $inputToHistory->date = $purchasingOrd->created_at;
                $inputToHistory->qtyIn = $getItemOnPi->qtyShipped;
                $inputToHistory->remarks = $getItemOnPi->remarks;
                $inputToHistory->save();

                // Get inventory item related
                $itemRelated = inventoryItem::where('id', $getItemOnPi->item_code)->first();
                $getQtyItem = $itemRelated->qty;
                $getInputQtyValue = $getItemOnPi->qtyShipped;
                // Sum the value between get Qty Item and Get Value Inputted
                $sumQty = $getQtyItem + $getInputQtyValue;

                // Update to inventory item
                $getInventory = DB::table('inventory_items')
                    ->where('id', $getItemOnPi->item_code)
                    ->update(array(
                        'qty' => $sumQty,
                    ));
            }
        }
        return 200;
    }
    public function getPurchaseInvoiceByPiNumber($pi_number)
    {
        return response()->json(purchaseInvoice::where('pi_number', $pi_number)->with('suppliers', 'warehouse')->first());
    }
    public function postPurchaseInvoiceByPiNumber($pi_number, Request $request)
    {
        $purchasingUpdate = DB::table('purchase_invoices')
            ->where('pi_number', '=', $pi_number)
            ->update(array(
                'supplier' => $request->supplier,
                'invoice_date' => $request->invoice_date,
                'deliver_to' => $request->deliver_to,
                'drivers' => $request->drivers,
                'vehicle_no' => $request->vehicle_no,
                'remarks' => $request->remarks,
                'updated_by' => Auth::id(),
            ));

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Update Purchase Invoice ' . $pi_number . '.';
        $saveLogs->save();
        return response()->json($purchasingUpdate, 200);
    }
    public function deletePurchaseInvoiceById($id, Request $request)
    {
        $purchaseOrd = purchaseInvoice::find($id);
        $itemPurchase = itemsPurchase::where('purchasingId', $purchaseOrd->pi_number)->get();
        foreach ($itemPurchase as $itemPurchases) {
            $itemPurchases->delete();
        }
        $itemsHistory = itemHistory::where('itemInId', $purchaseOrd->pi_number)->get();
        foreach ($itemsHistory as $itemHistory) {
            $itemHistory->delete();
        }

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Delete Purchase Invoice ' . $purchaseOrd->pi_number . '.';
        $saveLogs->save();
        $purchaseOrd->delete();
        return response()->json(201);
    }
    public function countPurchaseInvoice()
    {
        $ItemCount = DB::table('purchase_invoices')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    public function reportPI($pi_number)
    {
        $company = company_details::first();
        if (Auth::user()->role == 'customer') {
            $customer = User::find(Auth::id())->first();
        }
        $purchaseInvoice = purchaseInvoice::where('pi_number', $pi_number)->with('suppliers', 'warehouse')->first();
        $itemPurchasing = itemsPurchase::where('purchasingId', $purchaseInvoice->pi_number)->with('item')->get();

        $item = [];
        foreach ($itemPurchasing as $x) {
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
        if ($purchaseInvoice->suppliers == null && $purchaseInvoice->warehouse == null) {
            $data = [
                "companyName" => $company->company_name,
                "companyAddress" => $company->address,
                "companyPhone" => $company->phone,
                "companyEmail" => $company->email,
                "warehouseName" => $customer->customerName,
                "warehouseAddress" => $customer->customerAddress,
                "supplierName" => $customer->customerName,
                "supplierAddress" => $customer->customerAddress,
                "supplierNPWP" => $customer->customerNPWP,
                "supplierEmail" => $customer->customerEmail,
                "supplierPhone" => $customer->customerPhone,
                "poNumber" => $purchaseInvoice->pi_number,
                "orderDate" => $purchaseInvoice->invoice_date,
                "remark" => $purchaseInvoice->remarks,
                "items" => $item,
                "qrcode" => base64_encode(QrCode::format('svg')->size(70)->generate(url('/report/purchase/invoices/' . $pi_number))),
                "image" => $company->logoblack,
            ];
        } else if ($purchaseInvoice->suppliers == null) {
            $data = [
                "companyName" => $company->company_name,
                "companyAddress" => $company->address,
                "companyPhone" => $company->phone,
                "companyEmail" => $company->email,
                "warehouseName" => $purchaseInvoice->warehouse->warehouse_name,
                "warehouseAddress" => $purchaseInvoice->warehouse->address,
                "supplierName" => $customer->customerName,
                "supplierAddress" => $customer->customerAddress,
                "supplierNPWP" => $customer->customerNPWP,
                "supplierEmail" => $customer->customerEmail,
                "supplierPhone" => $customer->customerPhone,
                "poNumber" => $purchaseInvoice->pi_number,
                "orderDate" => $purchaseInvoice->invoice_date,
                "remark" => $purchaseInvoice->remarks,
                "items" => $item,
                "qrcode" => base64_encode(QrCode::format('svg')->size(70)->generate(url('/report/purchase/invoices/' . $pi_number))),
                "image" => $company->logoblack,
            ];
        } else if ($purchaseInvoice->warehouse == null) {
            $data = [
                "companyName" => $company->company_name,
                "companyAddress" => $company->address,
                "companyPhone" => $company->phone,
                "companyEmail" => $company->email,
                "warehouseName" => $customer->customerName,
                "warehouseAddress" => $customer->customerAddress,
                "supplierName" => $purchaseInvoice->suppliers->customerName,
                "supplierAddress" => $purchaseInvoice->suppliers->customerAddress,
                "supplierNPWP" => $purchaseInvoice->suppliers->customerNPWP,
                "supplierEmail" => $purchaseInvoice->suppliers->customerEmail,
                "supplierPhone" => $purchaseInvoice->suppliers->customerPhone,
                "poNumber" => $purchaseInvoice->pi_number,
                "orderDate" => $purchaseInvoice->invoice_date,
                "remark" => $purchaseInvoice->remarks,
                "items" => $item,
                "qrcode" => base64_encode(QrCode::format('svg')->size(70)->generate(url('/report/purchase/invoices/' . $pi_number))),
                "image" => $company->logoblack,
            ];
        } else {
            $data = [
                "companyName" => $company->company_name,
                "companyAddress" => $company->address,
                "companyPhone" => $company->phone,
                "companyEmail" => $company->email,
                "warehouseName" => $purchaseInvoice->warehouse->warehouse_name,
                "warehouseAddress" => $purchaseInvoice->warehouse->address,
                "supplierName" => $purchaseInvoice->suppliers->customerName,
                "supplierAddress" => $purchaseInvoice->suppliers->customerAddress,
                "supplierNPWP" => $purchaseInvoice->suppliers->customerNPWP,
                "supplierEmail" => $purchaseInvoice->suppliers->customerEmail,
                "supplierPhone" => $purchaseInvoice->suppliers->customerPhone,
                "poNumber" => $purchaseInvoice->pi_number,
                "orderDate" => $purchaseInvoice->invoice_date,
                "remark" => $purchaseInvoice->remarks,
                "items" => $item,
                "qrcode" => base64_encode(QrCode::format('svg')->size(70)->generate(url('/report/purchase/invoices/' . $pi_number))),
                "image" => $company->logoblack,
            ];
        }


        $pdf = PDF::loadView('report.purchaseInvoice', $data)->setPaper('a4', 'potrait');
        // return $pdf->stream();
        return $customer;
    }

    // PURCHASE REQUEST
    public function getPurchaseRequest()
    {
        if (Auth::user()->role == 'customer') {
            return purchaseRequest::where('created_by', Auth::id())->with('warehouse')->with('createdby')->orderBy('created_at', 'DESC')->get();
        } else {
            return purchaseRequest::with('warehouse')->with('createdby')->orderBy('created_at', 'DESC')->get();
        }
    }
    public function postPurchaseRequest(Request $request)
    {
        $purchasingOrd = new purchaseRequest();
        $purchasingOrd->pre_number = $request->pre_number;
        $purchasingOrd->pr_date = $request->pr_date;
        $purchasingOrd->priority = $request->priority;
        $purchasingOrd->to = $request->to;
        $purchasingOrd->remarks = $request->remarks;
        $purchasingOrd->created_by = Auth::id();
        $purchasingOrd->updated_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new Purchase Request ' . $purchasingOrd->pre_number . '.';
        $saveLogs->save();

        $purchasingOrd->save();

        $itemGet = DB::table('items_purchases')
            ->where('prequest_status', '=', '1')
            // PO Status 2, means having a purchasing ID
            ->update(array('purchasingId' => $purchasingOrd->pre_number, 'prequest_status' => '2'));
        return response()->json($purchasingOrd, 200);
    }
    public function getPurchaseRequestByPreNumber($pre_number)
    {
        return response()->json(purchaseRequest::where('pre_number', $pre_number)->with('warehouse')->first());
    }
    public function getPurchaseRequestMakePOByPreNumber($pre_number)
    {
        $getPRE = purchaseRequest::where('pre_number', $pre_number)->with('warehouse')->first();
        $getItemOnPRE = itemsPurchase::where('purchasingId', $pre_number)->with('item', 'usedBy', 'requestedBy')->orderBy('created_at', 'DESC')->get();

        $getNumberFromPONum = substr($getPRE->pre_number, 4, 13);

        for ($i = 0; $i < count($getItemOnPRE); $i++) {
            $detailsToItemOnPO = new itemsPurchase();
            $detailsToItemOnPO->item_code = $getItemOnPRE[$i]->item_code;
            $detailsToItemOnPO->qtyOrdered = $getItemOnPRE[$i]->qtyRequested;
            $detailsToItemOnPO->qtyShipped = '0';
            $detailsToItemOnPO->unit = $getItemOnPRE[$i]->unit;

            // po status 2 means stored at database with the purchase order id above;
            $detailsToItemOnPO->po_status = '2';
            $detailsToItemOnPO->purchasingId = 'PO.' . $getNumberFromPONum;
            $detailsToItemOnPO->created_by = Auth::id();
            $detailsToItemOnPO->updated_by = Auth::id();
            $detailsToItemOnPO->save();
        }
        $detailsToPO = new purchaseOrder();
        $detailsToPO->po_number = 'PO.' . $getNumberFromPONum;
        $detailsToPO->supplier = '0';
        $detailsToPO->order_date = date("Y-m-d");
        $detailsToPO->deliver_to = $getPRE->to;
        $detailsToPO->status = 0;
        $detailsToPO->created_by = Auth::id();
        $detailsToPO->updated_by = Auth::id();
        $detailsToPO->save();

        // Update status to 3, means it is approve and already has PO created
        $statusPRE = purchaseRequest::where('pre_number', $pre_number)
            ->update(array(
                'status' => 3,
            ));
        return response()->json($detailsToPO);
    }
    public function approvePurchaseRequestByPreNumber($pre_number)
    {
        // Update status to 1, means it is approved
        $statusPRE = purchaseRequest::where('pre_number', $pre_number)
            ->update(array(
                'status' => 1,
                'approvedBy' => Auth::id(),
            ));
        return response()->json($detailsToPO);
    }
    public function postPurchaseRequestByPreNumber($pre_number, Request $request)
    {
        $purchasingUpdate = DB::table('purchase_requests')
            ->where('pre_number', '=', $pre_number)
            ->update(array(
                'pr_date' => $request->pr_date,
                'priority' => $request->priority,
                'to' => $request->to,
                'remarks' => $request->remarks,
                'updated_by' => Auth::id(),
            ));

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Update Purchase Request ' . $pre_number . '.';
        $saveLogs->save();

        return response()->json($purchasingUpdate, 200);
    }
    public function deletePurchaseRequestById($id, Request $request)
    {
        $purchaseOrd = purchaseRequest::find($id);
        $itemPurchase = itemsPurchase::where('purchasingId', $purchaseOrd->pre_number)->get();
        foreach ($itemPurchase as $itemPurchases) {
            $itemPurchases->delete();
        }

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Delete Purchase Request ' . $purchaseOrd->pre_number . '.';
        $saveLogs->save();
        $purchaseOrd->delete();
        return response()->json(201);
    }
    public function countPurchaseRequest()
    {
        $ItemCount = DB::table('purchase_requests')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    public function reportPRE($pre_number)
    {
        $company = company_details::first();
        $purchaseRequest = purchaseRequest::where('pre_number', $pre_number)->with('warehouse')->first();
        $itemPurchasing = itemsPurchase::where('purchasingId', $purchaseRequest->pre_number)->with('item')->get();

        $item = [];
        foreach ($itemPurchasing as $x) {
            $data = [
                "name" => $x->item->item_name,
                "qty" => $x->qtyRequested,
                "remark" => $x->remarks,
                "unit" => $x->unit,
            ];
            array_push($item, $data);
        }

        $data = [
            "companyName" => $company->company_name,
            "companyAddress" => $company->address,
            "companyPhone" => $company->phone,
            "companyEmail" => $company->email,
            "warehouseName" => $purchaseRequest->warehouse->warehouse_name,
            "warehouseAddress" => $purchaseRequest->warehouse->address,
            "poNumber" => $purchaseRequest->pre_number,
            "orderDate" => $purchaseRequest->pr_date,
            "remark" => $purchaseRequest->remarks,
            "items" => $item,
            "qrcode" => base64_encode(QrCode::format('svg')->size(70)->generate(url('/report/purchase/order/' . $pre_number))),
            "image" => $company->logoblack,
        ];

        $pdf = PDF::loadView('report.purchaseRequest', $data)->setPaper('a4', 'potrait');
        return $pdf->stream();
        // return $itemPurchasing;
    }
    // PURCHASE RETURN
    public function getPurchaseReturn()
    {
        if (Auth::user()->role == 'customer') {
            return purchaseReturn::where('created_by', Auth::id())->with('suppliers')->with('createdby')->orderBy('created_at', 'DESC')->get();
        } else {
            return purchaseReturn::with('suppliers')->with('createdby')->orderBy('created_at', 'DESC')->get();
        }
    }
    public function postPurchaseReturn(Request $request)
    {
        $purchasingOrd = new purchaseReturn();
        $purchasingOrd->pr_number = $request->pr_number;
        $purchasingOrd->supplier = $request->supplier;
        $purchasingOrd->return_date = $request->return_date;
        $purchasingOrd->ref_no = $request->ref_no;
        $purchasingOrd->status = '0';
        $purchasingOrd->remarks = $request->remarks;
        $purchasingOrd->created_by = Auth::id();
        $purchasingOrd->updated_by = Auth::id();

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Add new Purchase Return ' . $purchasingOrd->pr_number . '.';
        $saveLogs->save();

        $purchasingOrd->save();

        $itemGet = DB::table('items_purchases')
            ->where('preturn_status', '=', '1')
            // PO Status 2, means having a purchasing ID
            ->update(array('purchasingId' => $purchasingOrd->pr_number, 'preturn_status' => '2'));
        return response()->json($purchasingOrd, 200);
    }
    public function getPurchaseReturnByPrNumber($pr_number)
    {
        return response()->json(purchaseReturn::where('pr_number', $pr_number)->with('suppliers')->first());
    }
    public function postPurchaseReturnByPrNumber($pr_number, Request $request)
    {
        $purchasingUpdate = DB::table('purchase_returns')
            ->where('pr_number', '=', $pr_number)
            ->update(array(
                'supplier' => $request->supplier,
                'return_date' => $request->return_date,
                'ref_no' => $request->ref_no,
                'status' => $request->status,
                'remarks' => $request->remarks,
                'updated_by' => Auth::id(),
            ));

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Update Purchase Return ' . $pr_number . '.';
        $saveLogs->save();
        return response()->json($purchasingUpdate, 200);
    }
    public function deletePurchaseReturnById($id, Request $request)
    {
        $purchaseOrd = purchaseReturn::find($id);
        $itemPurchase = itemsPurchase::where('purchasingId', $purchaseOrd->pr_number)->get();
        foreach ($itemPurchase as $itemPurchases) {
            $itemPurchases->delete();
        }

        // Save to logs
        $saveLogs = new userLogs();
        $saveLogs->userId = Auth::id();
        $saveLogs->ipAddress = $request->ip();
        $saveLogs->notes = 'Delete Purchase Return ' . $purchaseOrd->pr_number . '.';
        $saveLogs->save();
        $purchaseOrd->delete();
        return response()->json(201);
    }
    public function countPurchaseReturn()
    {
        $ItemCount = DB::table('purchase_returns')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    public function reportPR($pr_number)
    {
        $company = company_details::first();
        $purchaseReturn = purchaseReturn::where('pr_number', $pr_number)->with('suppliers')->first();
        $itemPurchasing = itemsPurchase::where('purchasingId', $purchaseReturn->pr_number)->with('item')->get();

        $item = [];
        foreach ($itemPurchasing as $x) {
            $data = [
                "name" => $x->item->item_name,
                "price" => $x->price,
                "qty" => $x->qtyReturns,
                "remark" => $x->remarks,
                "unit" => $x->unit,
                "priceAmount" => $x->price * $x->qtyReturns
            ];
            array_push($item, $data);
        }

        $data = [
            "companyName" => $company->company_name,
            "companyAddress" => $company->address,
            "companyPhone" => $company->phone,
            "companyEmail" => $company->email,
            "supplierName" => $purchaseReturn->suppliers->customerName,
            "supplierAddress" => $purchaseReturn->suppliers->customerAddress,
            "supplierNPWP" => $purchaseReturn->suppliers->customerNPWP,
            "supplierEmail" => $purchaseReturn->suppliers->customerEmail,
            "supplierPhone" => $purchaseReturn->suppliers->customerPhone,
            "poNumber" => $purchaseReturn->pr_number,
            "orderDate" => $purchaseReturn->return_date,
            "remark" => $purchaseReturn->remarks,
            "items" => $item,
            "qrcode" => base64_encode(QrCode::format('svg')->size(70)->generate(url('/report/purchase/order/' . $pr_number))),
            "image" => $company->logoblack,
        ];

        $pdf = PDF::loadView('report.purchaseReturn', $data)->setPaper('a4', 'potrait');
        return $pdf->stream();
        // return $itemPurchasing;
    }
    public function reportTest()
    {
        $pdf = PDF::loadView('report.test')->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}
