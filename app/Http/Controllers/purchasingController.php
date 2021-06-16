<?php

namespace App\Http\Controllers;

use App\itemsPurchase;
use App\purchaseInvoice;
use App\purchaseOrder;
use App\purchaseRequest;
use App\purchaseReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;
use Mail;

class purchasingController extends Controller
{
    // Purchasing
    // Purchase Order
    public function getPurchaseOrder()
    {
        return response()->json(purchaseOrder::with('supplier')->with('recipient')->with('createdby')->orderBy('created_at', 'DESC')->get());
    }
    public function postPurchaseOrder(Request $request)
    {
        $purchasingOrd = new purchaseOrder();
        $purchasingOrd->po_number = $request->po_number;
        $purchasingOrd->supplier = $request->supplier;
        $purchasingOrd->order_date = $request->order_date;
        $purchasingOrd->deliver_to = $request->deliver_to;
        $purchasingOrd->status = $request->status;
        $purchasingOrd->created_by = Auth::id();
        $purchasingOrd->updated_by = Auth::id();
        $purchasingOrd->save();
        return response()->json($purchasingOrd, 200);
    }
    public function getPurchaseOrderById($id)
    {
        return response()->json(purchaseOrder::find($id));
    }
    public function postPurchaseOrderById($id, Request $request)
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
    public function deletePurchaseOrderById($id)
    {
        return response()->json(purchaseOrder::find($id)->delete());
    }
    public function countPurchaseOrder()
    {
        $ItemCount = DB::table('purchase_orders')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    // Purchase Invoices
    public function getPurchaseInvoice()
    {
        return response()->json(purchaseInvoice::with('supplier')->with('createdby')->orderBy('created_at', 'DESC')->get());
    }
    public function postPurchaseInvoice(Request $request)
    {
        $purchasingInv = new purchaseInvoice();
        $purchasingInv->purchase_invoices = $request->purchase_invoices;
        $purchasingInv->supplier = $request->supplier;
        $purchasingInv->invoice_date = $request->invoice_date;
        $purchasingInv->reference_no = $request->reference_no;
        $purchasingInv->status = $request->status;
        $purchasingInv->created_by = Auth::id();
        $purchasingInv->updated_by = Auth::id();
        $purchasingInv->save();
        return response()->json($purchasingInv, 200);
    }
    public function getPurchaseInvoiceById($id)
    {
        return response()->json(purchaseInvoice::find($id));
    }
    public function postPurchaseInvoiceById($id, Request $request)
    {
        $purchasingInv = purchaseInvoice::find($id);
        $purchasingInv->purchase_invoices = $request->purchase_invoices;
        $purchasingInv->supplier = $request->supplier;
        $purchasingInv->invoice_date = $request->invoice_date;
        $purchasingInv->reference_no = $request->reference_no;
        $purchasingInv->status = $request->status;
        $purchasingInv->updated_by = Auth::id();
        $purchasingInv->save();
        return response()->json($purchasingInv, 200);
    }
    public function deletePurchaseInvoiceById($id)
    {
        return response()->json(purchaseInvoice::find($id)->delete());
    }
    public function countPurchaseInvoice()
    {
        $ItemCount = DB::table('purchase_invoices')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    // Purchase Return
    public function getPurchaseReturn()
    {
        return response()->json(purchaseReturn::with('supplier')->with('createdby')->orderBy('created_at', 'DESC')->get());
    }
    public function postPurchaseReturn(Request $request)
    {
        $purchasingRet = new purchaseReturn();
        $purchasingRet->return_number = $request->return_number;
        $purchasingRet->supplier = $request->supplier;
        $purchasingRet->return_date = $request->return_date;
        $purchasingRet->ref_no = $request->ref_no;
        $purchasingRet->status = $request->status;
        $purchasingRet->created_by = Auth::id();
        $purchasingRet->updated_by = Auth::id();
        $purchasingRet->save();
        return response()->json($purchasingRet, 200);
    }
    public function getPurchaseReturnById($id)
    {
        return response()->json(purchaseReturn::find($id));
    }
    public function postPurchaseReturnById($id, Request $request)
    {
        $purchasingRet = purchaseReturn::find($id);
        $purchasingRet->return_number = $request->return_number;
        $purchasingRet->supplier = $request->supplier;
        $purchasingRet->return_date = $request->return_date;
        $purchasingRet->ref_no = $request->ref_no;
        $purchasingRet->status = $request->status;
        $purchasingRet->updated_by = Auth::id();
        $purchasingRet->save();
        return response()->json($purchasingRet, 200);
    }
    public function deletePurchaseReturnById($id)
    {
        return response()->json(purchaseReturn::find($id)->delete());
    }
    public function countPurchaseReturn()
    {
        $ItemCount = DB::table('purchase_returns')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    // Purchase Request
    public function getPurchaseRequest()
    {
        return response()->json(purchaseRequest::with('supplier')->with('createdby')->orderBy('created_at', 'DESC')->get());
    }
    public function postPurchaseRequest(Request $request)
    {
        $purchasingReq = new purchaseRequest();
        $purchasingReq->pr_no = $request->pr_no;
        $purchasingReq->priority = $request->priority;
        $purchasingReq->pr_date = $request->pr_date;
        $purchasingReq->to = $request->to;
        $purchasingReq->status = $request->status;
        $purchasingReq->created_by = Auth::id();
        $purchasingReq->updated_by = Auth::id();
        $purchasingReq->save();
        return response()->json($purchasingReq, 200);
    }
    public function getPurchaseRequestById($id)
    {
        return response()->json(purchaseRequest::find($id));
    }
    public function postPurchaseRequestById($id, Request $request)
    {
        $purchasingReq = purchaseRequest::find($id);
        $purchasingReq->pr_no = $request->pr_no;
        $purchasingReq->priority = $request->priority;
        $purchasingReq->pr_date = $request->pr_date;
        $purchasingReq->to = $request->to;
        $purchasingReq->status = $request->status;
        $purchasingReq->updated_by = Auth::id();
        $purchasingReq->save();
        return response()->json($purchasingReq, 200);
    }
    public function deletePurchaseRequestById($id)
    {
        return response()->json(purchaseRequest::find($id)->delete());
    }
    public function countPurchaseRequest()
    {
        $ItemCount = DB::table('purchase_requests')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }

    // Item Purchase
    public function getItemPurchase()
    {
        return response()->json(itemsPurchase::with('item')->with('requestedBy')->orderBy('created_at', 'DESC')->get());
    }
    public function postItemPurchase(Request $request)
    {
        $ItemPurchasing = new itemsPurchase();
        $ItemPurchasing->item_code = $request->item_code;
        $ItemPurchasing->qty = $request->qty;
        $ItemPurchasing->unit = $request->unit;
        $ItemPurchasing->price = $request->price;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->requested_by = $request->requested_by;
        $ItemPurchasing->used_by = $request->used_by;
        $ItemPurchasing->remarks = $request->remarks;
        $ItemPurchasing->created_by = Auth::id();
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($ItemPurchasing, 200);
    }
    public function getItemPurchaseById($id)
    {
        return response()->json(itemsPurchase::find($id));
    }
    public function postItemPurchaseById($id, Request $request)
    {
        $ItemPurchasing = itemsPurchase::find($id);
        $ItemPurchasing->item_code = $request->item_code;
        $ItemPurchasing->qty = $request->qty;
        $ItemPurchasing->unit = $request->unit;
        $ItemPurchasing->price = $request->price;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->requested_by = $request->requested_by;
        $ItemPurchasing->used_by = $request->used_by;
        $ItemPurchasing->remarks = $request->remarks;
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($ItemPurchasing, 200);
    }
    public function deleteItemPurchaseById($id)
    {
        return response()->json(itemsPurchase::find($id)->delete());
    }
    public function countItemPurchase()
    {
        $ItemCount = DB::table('items_purchases')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
}
