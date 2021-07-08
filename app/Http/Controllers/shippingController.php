<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Generate PDF
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;


class shippingController extends Controller
{
    public function getShippingConfirmation()
    {
        if (Auth::user()->role == 'customer') {
            return response()->json(purchaseOrder::where('created_by', Auth::id())->with('supplier')->with('recipient')->with('createdby')->orderBy('created_at', 'DESC')->get());
        } else {
            return response()->json(purchaseOrder::with('supplier')->with('recipient')->with('createdby')->orderBy('created_at', 'DESC')->get());
        }
    }
    public function postShippingConfirmation(Request $request)
    {
        $purchasingOrd = new purchaseOrder();
        $purchasingOrd->po_number = $request->po_number;
        $purchasingOrd->supplier = $request->supplier;
        $purchasingOrd->order_date = $request->order_date;
        $purchasingOrd->deliver_to = $request->deliver_to;
        $purchasingOrd->created_by = Auth::id();
        $purchasingOrd->updated_by = Auth::id();
        $purchasingOrd->save();

        $itemGet = DB::table('items_purchases')
            ->where('po_status', '=', '1')
            ->update(array('po_status' => $purchasingOrd->po_number));
        return response()->json($purchasingOrd, 200);
    }
    public function getShippingConfirmationById($id)
    {
        return response()->json(purchaseOrder::find($id));
    }
    public function postShippingConfirmationById($id, Request $request)
    {
        $purchasingOrd = purchaseOrder::find($id);
        $purchasingOrd->po_number = $request->po_number;
        $purchasingOrd->supplier = $request->supplier;
        $purchasingOrd->order_date = $request->order_date;
        $purchasingOrd->deliver_to = $request->deliver_to;
        $purchasingOrd->status = $request->status;
        $purchasingOrd->updated_by = Auth::id();
        $purchasingOrd->save();
        return response()->json($purchasingOrd, 200);
    }
    public function deleteShippingConfirmationById($id)
    {
        return response()->json(purchaseOrder::find($id)->delete());
    }
    public function countShippingConfirmation()
    {
        $ItemCount = DB::table('purchase_orders')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
}
