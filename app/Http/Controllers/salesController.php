<?php

namespace App\Http\Controllers;

use App\itemSales;
use App\salesDeliveryReceipt;
use App\salesInvoice;
use App\salesOrder;
use App\salesReturn;
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

use Mail;

class salesController extends Controller
{
    // Ssales
    // Sales Order
    public function getSalesOrder()
    {
        return response()->json(salesOrder::with('customer')->with('createdby')->orderBy('created_at', 'DESC')->get());
    }
    public function postSalesOrder(Request $request)
    {
        $salesOrd = new salesOrder();
        $salesOrd->so_number = $request->so_number;
        $salesOrd->customer = $request->customer;
        $salesOrd->order_date = $request->order_date;
        $salesOrd->status = $request->status;
        $salesOrd->created_by = Auth::id();
        $salesOrd->updated_by = Auth::id();
        $salesOrd->save();
        return response()->json($salesOrd, 200);
    }
    public function getSalesOrderById($id)
    {
        return response()->json(salesOrder::find($id));
    }
    public function postSalesOrderById($id, Request $request)
    {
        $salesOrd = salesOrder::find($id);
        $salesOrd->so_number = $request->so_number;
        $salesOrd->customer = $request->customer;
        $salesOrd->order_date = $request->order_date;
        $salesOrd->status = $request->status;
        $salesOrd->updated_by = Auth::id();
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
    // Sales Delivery Receipt
    public function getSalesDeliveryReceipt()
    {
        return response()->json(salesDeliveryReceipt::with('customer')->with('createdby')->orderBy('created_at', 'DESC')->get());
    }
    public function postSalesDeliveryReceipt(Request $request)
    {
        $salesDelRec = new salesDeliveryReceipt();
        $salesDelRec->sdr_number = $request->sdr_number;
        $salesDelRec->customer = $request->customer;
        $salesDelRec->sdr_date = $request->sdr_date;
        $salesDelRec->toGL = $request->toGL;
        $salesDelRec->status = $request->status;
        $salesDelRec->created_by = Auth::id();
        $salesDelRec->updated_by = Auth::id();
        $salesDelRec->save();
        return response()->json($salesDelRec, 200);
    }
    public function getSalesDeliveryReceiptById($id)
    {
        return response()->json(salesDeliveryReceipt::find($id));
    }
    public function postSalesDeliveryReceiptById($id, Request $request)
    {
        $salesDelRec = salesDeliveryReceipt::find($id);
        $salesDelRec->sdr_number = $request->sdr_number;
        $salesDelRec->customer = $request->customer;
        $salesDelRec->sdr_date = $request->sdr_date;
        $salesDelRec->toGL = $request->toGL;
        $salesDelRec->status = $request->status;
        $salesDelRec->updated_by = Auth::id();
        $salesDelRec->save();
        return response()->json($salesDelRec, 200);
    }
    public function deleteSalesDeliveryReceiptById($id)
    {
        return response()->json(salesDeliveryReceipt::find($id)->delete());
    }
    public function countSalesDeliveryReceipt()
    {
        $ItemCount = DB::table('sales_delivery_receipts')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }

    // Item Sales
    public function getItemSales()
    {
        return response()->json(itemSales::with('item')->orderBy('created_at', 'DESC')->get());
    }
    public function postItemSales(Request $request)
    {
        $ItemSales = new itemSales();
        $ItemSales->item_code = $request->item_code;
        $ItemSales->qtyOrdered = $request->qtyOrdered;
        $ItemSales->qtyShipped = $request->qtyShipped;
        $ItemSales->unit = $request->unit;
        $ItemSales->price = $request->price;
        $ItemSales->remarks = $request->remarks;
        $ItemSales->created_by = Auth::id();
        $ItemSales->updated_by = Auth::id();
        $ItemSales->save();
        return response()->json($ItemSales, 200);
    }
    public function getItemSalesById($id)
    {
        return response()->json(itemSales::find($id));
    }
    public function postItemSalesById($id, Request $request)
    {
        $ItemSales = itemSales::find($id);
        $ItemSales->item_code = $request->item_code;
        $ItemSales->qtyOrdered = $request->qtyOrdered;
        $ItemSales->qtyShipped = $request->qtyShipped;
        $ItemSales->unit = $request->unit;
        $ItemSales->price = $request->price;
        $ItemSales->remarks = $request->remarks;
        $ItemSales->updated_by = Auth::id();
        $ItemSales->save();
        return response()->json($ItemSales, 200);
    }
    public function deleteItemSalesById($id)
    {
        return response()->json(itemSales::find($id)->delete());
    }
    public function countItemSales()
    {
        $ItemCount = DB::table('item_sales')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
}
