<?php

namespace App\Http\Controllers;

use App\purchaseInvoice;
use App\purchaseOrder;
use App\purchaseRequest;
use App\purchaseReturn;
use App\itemsPurchase;

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

class itemOnPurchasingController extends Controller
{
    // GET COMPANY BASED
    public function getCompany()
    {
        if (Auth::user()->role == 'customer') {
            return Auth::user();
        } else {
            $arrayName = $this->getPurchaseOrder();
            return $arrayName[0]->warehouse;
        }
    }

    // ITEM ON PURCHASE ORDER
    public function getItemPurchase()
    {
        return response()->json(itemsPurchase::with('item')->with('usedBy')->with('requestedBy')->orderBy('created_at', 'DESC')->where('po_status', 1)->where('created_by', Auth::id())->get());
    }
    public function postItemPurchase(Request $request)
    {
        $itemPurchase = DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);

        $ItemPurchasing = new itemsPurchase();
        $ItemPurchasing->item_code = $request->itemid;
        $ItemPurchasing->qtyOrdered = $request->qtyOrdered;
        $ItemPurchasing->qtyShipped = '0';
        $ItemPurchasing->unit = $request->unit;
        $ItemPurchasing->price = $request->price;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->requested_by = Auth::id();
        $ItemPurchasing->used_by = $request->used_by;
        $ItemPurchasing->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $ItemPurchasing->po_status = '1';
        $ItemPurchasing->created_by = Auth::id();
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($ItemPurchasing, 200);
    }
    public function postItemPurchaseByPoNumber($po_number, Request $request)
    {
        $itemPurchase = DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);

        $ItemPurchasing = new itemsPurchase();
        $ItemPurchasing->item_code = $request->itemid;
        $ItemPurchasing->qtyOrdered = $request->qtyOrdered;
        $ItemPurchasing->qtyShipped = '0';
        $ItemPurchasing->unit = $request->unit;
        $ItemPurchasing->price = $request->price;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->requested_by = Auth::id();
        $ItemPurchasing->used_by = $request->used_by;
        $ItemPurchasing->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $ItemPurchasing->po_status = '2';
        $ItemPurchasing->purchasingId = $po_number;
        $ItemPurchasing->created_by = Auth::id();
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($ItemPurchasing, 200);
    }
    public function getItemPurchaseById($id)
    {
        return response()->json(itemsPurchase::where('id', $id)->with('item', 'usedBy', 'requestedBy')->first());
    }
    public function getItemPurchaseByPoNumber($po_number)
    {
        return response()->json(itemsPurchase::where('purchasingId', $po_number)->with('item', 'usedBy', 'requestedBy')->orderBy('created_at', 'DESC')->get());
    }
    public function postItemPurchaseById($id, Request $request)
    {
        $itemPurchase = DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);

        $ItemPurchasing = itemsPurchase::find($id);
        $ItemPurchasing->qtyOrdered = $request->qtyOrdered;
        $ItemPurchasing->qtyShipped = '0';
        $ItemPurchasing->price = $request->price;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->requested_by = Auth::id();
        $ItemPurchasing->used_by = $request->used_by;
        $ItemPurchasing->remarks = $request->remarks;
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($itemPurchase, 200);
        // return $request->itemid;
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
