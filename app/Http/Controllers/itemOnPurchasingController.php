<?php

namespace App\Http\Controllers;

use App\purchaseInvoice;
use App\purchaseOrder;
use App\purchaseRequest;
use App\purchaseReturn;
use App\itemsPurchase;
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
    public function getItemPurchasesPO()
    {
        return response()->json(itemsPurchase::with('item', 'requestedBy')->orderBy('created_at', 'DESC')->where('po_status', 1)->where('created_by', Auth::id())->get());
    }
    public function postItemPurchasePO(Request $request)
    {
        if (empty($request->itemid)) {
            DB::table('inventory_items')
                ->where('id', '=', $request->itemid)
                ->update(['inventory_items.price' => $request->currentPrice]);
        }

        $ItemPurchasing = new itemsPurchase();
        $ItemPurchasing->item_code = $request->itemid ?? null;
        $ItemPurchasing->qtyOrdered = $request->qtyOrdered;
        $ItemPurchasing->qtyShipped = '0';
        $ItemPurchasing->unit = $request->unit;
        $ItemPurchasing->price = $request->price;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->requested_by = Auth::id();
        $ItemPurchasing->used_by = $request->used_by;
        $ItemPurchasing->warehouseId = $request->warehouseid;
        $ItemPurchasing->customerId = $request->customerid;
        $ItemPurchasing->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $ItemPurchasing->po_status = '0';
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
        return response()->json(itemsPurchase::where('id', $id)->with('item', 'used', 'usedBy', 'requestedBy')->first());
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
        return response()->json(itemsPurchase::with('item', 'usedBy', 'requestedBy', 'warehouse', 'customer')->orderBy('created_at', 'DESC')->where('pi_status', 1)->where('created_by', Auth::id())->get());
    }
    public function postItemPurchasePI(Request $request)
    {
        DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update(['inventory_items.price' => $request->currentPrice]);

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
        $ItemPurchasing->warehouseId = $request->warehouseid;
        $ItemPurchasing->customerId = $request->customerid;
        $ItemPurchasing->driver_name = $request->driver_name;
        $ItemPurchasing->driver_nopol = $request->driver_nopol;
        $ItemPurchasing->weightIn = $request->weightIn;
        $ItemPurchasing->weightOut = $request->weightOut;
        $ItemPurchasing->purchase_related = $request->poRelated;


        // po status 1 means stored at database but not with the purchase order id;
        $ItemPurchasing->pi_status = '1';
        $ItemPurchasing->created_by = Auth::id();
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($ItemPurchasing, 200);
    }
    public function postItemPurchaseByPiNumber($pi_number, Request $request)
    {
        DB::table('inventory_items')
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
        $ItemPurchasing->warehouseId = $request->warehouseid;
        $ItemPurchasing->customerId = $request->customerid;
        $ItemPurchasing->driver_name = $request->driver_name;
        $ItemPurchasing->driver_nopol = $request->driver_nopol;
        $ItemPurchasing->weightIn = $request->weightIn;
        $ItemPurchasing->weightOut = $request->weightOut;
        $ItemPurchasing->purchase_related = $request->poRelated;


        $ItemPurchasing->pi_status = '2';
        $ItemPurchasing->purchasingId = $pi_number;
        $ItemPurchasing->created_by = Auth::id();
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();

        $inputToHistory = new itemHistory();
        $inputToHistory->itemId = $ItemPurchasing->item_code;
        $inputToHistory->itemInId = $pi_number;
        $inputToHistory->type = 1;
        $inputToHistory->date = $ItemPurchasing->created_at;
        $inputToHistory->qtyIn = $ItemPurchasing->qtyShipped;
        $inputToHistory->remarks = $ItemPurchasing->remarks;
        $inputToHistory->save();
        return response()->json($ItemPurchasing, 200);
    }
    public function getItemPurchasePIById($id)
    {
        return response()->json(itemsPurchase::where('id', $id)->with('item', 'requestedBy', 'warehouse', 'customer')->first());
    }
    public function getItemPurchaseByPiNumber($pi_number)
    {
        return response()->json(itemsPurchase::where('purchasingId', $pi_number)->with('item', 'usedBy', 'requestedBy')->orderBy('created_at', 'DESC')->get());
    }
    public function postItemPurchasePIById($id, Request $request)
    {
        try {
            $itemPurchase = DB::table('inventory_items')
                ->where('id', '=', $request->itemid)
                ->update([
                    'inventory_items.price' => $request->currentPrice,
                ]);

            $ItemPurchasing = itemsPurchase::find($id);
            $ItemPurchasing->item_code = $request->itemid;
            $ItemPurchasing->qtyOrdered = $request->qtyOrdered;
            $ItemPurchasing->qtyShipped = $request->qtyShipped;
            $ItemPurchasing->unit = $request->unit;
            $ItemPurchasing->price = $request->price;
            $ItemPurchasing->purpose = $request->purpose;
            $ItemPurchasing->requested_by = Auth::id();
            $ItemPurchasing->used_by = $request->used_by;
            $ItemPurchasing->remarks = $request->remarks;
            $ItemPurchasing->warehouseId = $request->warehouseid;
            $ItemPurchasing->customerId = $request->customerid;
            $ItemPurchasing->driver_name = $request->driver_name;
            $ItemPurchasing->driver_nopol = $request->driver_nopol;
            $ItemPurchasing->weightIn = $request->weightIn;
            $ItemPurchasing->weightOut = $request->weightOut;
            $ItemPurchasing->purchase_related = $request->poRelated;
            $ItemPurchasing->updated_by = Auth::id();
            $ItemPurchasing->save();

            $getItemOnPI = itemsPurchase::where('purchasingId', $ItemPurchasing->purchasingId)->get();
            if (count($getItemOnPI) > 0) {
                foreach ($getItemOnPI as $getItemOnPi) {
                    if ($getItemOnPi->qtyShipped) {
                        $inputToHistory = new itemHistory();
                        $inputToHistory->itemId = $getItemOnPi->item_code;
                        $inputToHistory->itemInId = $getItemOnPi->purchasingId;
                        $inputToHistory->type = 1;
                        $inputToHistory->date = $getItemOnPi->created_at;
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
                    // dd($getItemOnPI);
                }
            }
            // if jumlah qtyShipped = jumlah order qtyOrdered di PO {
            //     $ItemPurchasingGet->status = 2;
            //     }else{
            // $ItemPurchasingGet->status = 1;
            //     }
            return response()->json($itemPurchase, 200);
        } catch (Exception $e) {
            dd($e);
        }

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
        return response()->json(itemsPurchase::with('item', 'usedBy', 'requestedBy')->orderBy('created_at', 'DESC')->where('prequest_status', 1)->where('created_by', Auth::id())->get());
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

    // ITEM ON PURCHASE RETURN
    public function getItemPurchasePR()
    {
        return response()->json(itemsPurchase::with('item', 'usedBy', 'requestedBy')->orderBy('created_at', 'DESC')->where('preturn_status', 1)->where('created_by', Auth::id())->get());
    }
    public function postItemPurchasePR(Request $request)
    {
        $itemPurchase = DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);

        $ItemPurchasing = new itemsPurchase();
        $ItemPurchasing->item_code = $request->itemid;
        $ItemPurchasing->qtyReturns = $request->qtyReturns;
        $ItemPurchasing->unit = $request->unit;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $ItemPurchasing->preturn_status = '1';
        $ItemPurchasing->created_by = Auth::id();
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($ItemPurchasing, 200);
    }
    public function postItemPurchaseByPrNumber($pr_number, Request $request)
    {
        $itemPurchase = DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);

        $ItemPurchasing = new itemsPurchase();
        $ItemPurchasing->item_code = $request->itemid;
        $ItemPurchasing->qtyReturns = $request->qtyReturns;
        $ItemPurchasing->unit = $request->unit;
        $ItemPurchasing->price = $request->price;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $ItemPurchasing->preturn_status = '2';
        $ItemPurchasing->purchasingId = $pr_number;
        $ItemPurchasing->created_by = Auth::id();
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($ItemPurchasing, 200);
    }
    public function getItemPurchasePRById($id)
    {
        return response()->json(itemsPurchase::where('id', $id)->with('item', 'usedBy', 'requestedBy')->first());
    }
    public function getItemPurchaseByPrNumber($pr_number)
    {
        return response()->json(itemsPurchase::where('purchasingId', $pr_number)->with('item', 'usedBy', 'requestedBy')->orderBy('created_at', 'DESC')->get());
    }
    public function postItemPurchasePRById($id, Request $request)
    {
        $itemPurchase = DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);
        $ItemPurchasing = itemsPurchase::find($id);
        $ItemPurchasing->item_code = $request->itemid;
        $ItemPurchasing->qtyReturns = $request->qtyReturns;
        $ItemPurchasing->unit = $request->unit;
        $ItemPurchasing->price = $request->price;
        $ItemPurchasing->purpose = $request->purpose;
        $ItemPurchasing->remarks = $request->remarks;
        $ItemPurchasing->updated_by = Auth::id();
        $ItemPurchasing->save();
        return response()->json($ItemPurchasing, 200);
        // return $request->itemid;
    }
    public function deleteItemPurchasePRById($id)
    {
        return response()->json(itemsPurchase::find($id)->delete());
    }
    public function countItemPurchasePR()
    {
        $ItemCount = DB::table('items_purchases')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
}
