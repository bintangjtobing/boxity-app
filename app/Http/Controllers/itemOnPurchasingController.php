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
    public function getItemPurchasePO()
    {
        return response()->json(itemsPurchase::with('item')->with('usedBy')->with('requestedBy')->orderBy('created_at', 'DESC')->where('po_status', 1)->where('created_by', Auth::id())->get());
    }
    public function postItemPurchasePO(Request $request)
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
    public function getItemPurchasePOById($id)
    {
        return response()->json(itemsPurchase::where('id', $id)->with('item', 'usedBy', 'requestedBy')->first());
    }
    public function getItemPurchaseByPoNumber($po_number)
    {
        return response()->json(itemsPurchase::where('purchasingId', $po_number)->with('item', 'usedBy', 'requestedBy')->orderBy('created_at', 'DESC')->get());
    }
    public function postItemPurchasePOById($id, Request $request)
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
    public function deleteItemPurchasePOById($id)
    {
        return response()->json(itemsPurchase::find($id)->delete());
    }
    public function countItemPurchasePO()
    {
        $ItemCount = DB::table('items_purchases')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }

    // ITEM ON PURCHASE INVOICES
    public function getItemPurchasePI()
    {
        return response()->json(itemsPurchase::with('item')->with('usedBy')->with('requestedBy')->orderBy('created_at', 'DESC')->where('pi_status', 1)->where('created_by', Auth::id())->get());
    }
    public function postItemPurchasePI(Request $request)
    {
        $itemPurchase = DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);

        $ItemPurchasing = new itemsPurchase();
        $ItemPurchasing->item_code = $request->itemid;
        $ItemPurchasing->qtyOrdered = $request->qtyOrdered;
        $ItemPurchasing->qtyShipped = $request->qtyShipped;
        $ItemPurchasing->unit = $request->unit;
        $ItemPurchasing->price = $request->price;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->requested_by = Auth::id();
        $ItemPurchasing->used_by = $request->used_by;
        $ItemPurchasing->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $ItemPurchasing->pi_status = '1';
        $ItemPurchasing->created_by = Auth::id();
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($ItemPurchasing, 200);
    }
    public function postItemPurchaseByPiNumber($pi_number, Request $request)
    {
        $itemPurchase = DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);

        $ItemPurchasing = new itemsPurchase();
        $ItemPurchasing->item_code = $request->itemid;
        $ItemPurchasing->qtyOrdered = $request->qtyOrdered;
        $ItemPurchasing->qtyShipped = $request->qtyShipped;
        $ItemPurchasing->unit = $request->unit;
        $ItemPurchasing->price = $request->price;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->requested_by = Auth::id();
        $ItemPurchasing->used_by = $request->used_by;
        $ItemPurchasing->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $ItemPurchasing->pi_status = '2';
        $ItemPurchasing->purchasingId = $pi_number;
        $ItemPurchasing->created_by = Auth::id();
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($ItemPurchasing, 200);
    }
    public function getItemPurchasePIById($id)
    {
        return response()->json(itemsPurchase::where('id', $id)->with('item', 'usedBy', 'requestedBy')->first());
    }
    public function getItemPurchaseByPiNumber($pi_number)
    {
        return response()->json(itemsPurchase::where('purchasingId', $pi_number)->with('item', 'usedBy', 'requestedBy')->orderBy('created_at', 'DESC')->get());
    }
    public function postItemPurchasePIById($id, Request $request)
    {
        $itemPurchase = DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);

        $ItemPurchasing = itemsPurchase::find($id);
        $ItemPurchasing->qtyOrdered = $request->qtyOrdered;
        $ItemPurchasing->qtyShipped = $request->qtyShipped;
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
    public function deleteItemPurchasePIById($id)
    {
        return response()->json(itemsPurchase::find($id)->delete());
    }
    public function countItemPurchasePI()
    {
        $ItemCount = DB::table('items_purchases')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }

    // ITEM ON PURCHASE REQUEST
    public function getItemPurchasePRE()
    {
        return response()->json(itemsPurchase::with('item')->with('usedBy')->with('requestedBy')->orderBy('created_at', 'DESC')->where('prequest_status', 1)->where('created_by', Auth::id())->get());
    }
    public function postItemPurchasePRE(Request $request)
    {
        $ItemPurchasing = new itemsPurchase();
        $ItemPurchasing->item_code = $request->itemid;
        $ItemPurchasing->qtyRequested = $request->qtyRequested;
        $ItemPurchasing->unit = $request->unit;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $ItemPurchasing->prequest_status = '1';
        $ItemPurchasing->created_by = Auth::id();
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($ItemPurchasing, 200);
    }
    public function postItemPurchaseByPreNumber($pre_number, Request $request)
    {
        $ItemPurchasing = new itemsPurchase();
        $ItemPurchasing->item_code = $request->itemid;
        $ItemPurchasing->qtyRequested = $request->qtyRequested;
        $ItemPurchasing->unit = $request->unit;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $ItemPurchasing->pi_status = '2';
        $ItemPurchasing->purchasingId = $pre_number;
        $ItemPurchasing->created_by = Auth::id();
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($ItemPurchasing, 200);
    }
    public function getItemPurchasePREById($id)
    {
        return response()->json(itemsPurchase::where('id', $id)->with('item', 'usedBy', 'requestedBy')->first());
    }
    public function getItemPurchaseByPreNumber($pre_number)
    {
        return response()->json(itemsPurchase::where('purchasingId', $pre_number)->with('item', 'usedBy', 'requestedBy')->orderBy('created_at', 'DESC')->get());
    }
    public function postItemPurchasePREById($id, Request $request)
    {
        $ItemPurchasing = itemsPurchase::find($id);
        $ItemPurchasing->qtyRequested = $request->qtyRequested;
        $ItemPurchasing->unit = $request->unit;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->remarks = $request->remarks;
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($ItemPurchasing, 200);
        // return $request->itemid;
    }
    public function deleteItemPurchasePREById($id)
    {
        return response()->json(itemsPurchase::find($id)->delete());
    }
    public function countItemPurchasePRE()
    {
        $ItemCount = DB::table('items_purchases')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
}
