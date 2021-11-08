<?php

namespace App\Http\Controllers;

use App\documentsDelivery;
use App\itemsSales;
use App\itemHistory;
use App\salesInvoice;
use App\salesOrder;
use App\itemOndocumentsDelivery;

use App\Http\Controllers\Controller;
use App\Mail\updateReceiptNumber;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class itemOnSalesController extends Controller
{
    public function getItemSales()
    {
        return response()->json(itemsSales::where('so_status', 1)->where('created_by', Auth::id())->with('item', 'used', 'usedBy', 'requestedBy', 'customer', 'warehouse')->get(), 200);
    }

    public function getItemSalesById($id)
    {
        return response()->json(itemsSales::where('id', $id)->with('item', 'used', 'usedBy', 'requestedBy', 'warehouse')->first());
    }

    public function getItemSalesBySoNumber($so_number)
    {
        return response()->json(itemsSales::where('salesingId', $so_number)->with('item', 'used', 'usedBy', 'requestedBy', 'warehouse')->get());
    }

    public function postItemSales(Request $request)
    {
        DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);

        $itemsSales = new itemsSales();
        $itemsSales->item_code = $request->itemid;
        $itemsSales->qtyOrdered = $request->qtyOrdered;
        $itemsSales->qtyShipped = '0';
        $itemsSales->qtyReturns = '0';
        $itemsSales->unit = $request->unit;
        $itemsSales->price = $request->price;
        $itemsSales->purpose = $request->purpose;
        $itemsSales->requested_by = Auth::id();
        $itemsSales->used_by = $request->used_by;
        $itemsSales->warehouseid = $request->warehouseid;
        $itemsSales->remarks = $request->remarks;
        $itemsSales->weightIn = $request->weightIn;
        $itemsSales->weightOut = $request->weightOut;
        $itemsSales->customerId = $request->customerid;
        

        $itemsSales->salesingId = $request->so_number ?? '0';
        $itemsSales->so_status = $request->so_status ?? '1';
        $itemsSales->created_by = Auth::id();
        $itemsSales->updated_by = Auth::id();
        $itemsSales->save();
        return response()->json($itemsSales, 200);
    }

    public function postItemSalesById($id, Request $request)
    {
        DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);

        $itemSales = itemsSales::find($id);
        $itemSales->qtyOrdered = $request->qtyOrdered;
        $itemSales->price = $request->price;
        $itemSales->purpose = $request->purpose;
        $itemSales->requested_by = Auth::id();
        $itemSales->used_by = $request->used_by;
        $itemSales->remarks = $request->remarks;
        $itemSales->updated_by = Auth::id();
        $itemSales->save();
        return response()->json($itemSales, 200);
    }

    public function deleteItemSalesById($id)
    {
        return response()->json(itemsSales::find($id)->delete());
    }

    // ITEM ON Delivery Receipt
    public function getItemSalesSdr()
    {
        return response()->json(itemsSales::with('item')->with('usedBy')->with('requestedBy')->orderBy('created_at', 'DESC')->where('created_by', Auth::id())->get());
    }
    public function postItemSalesInvoiceSdr(Request $request)
    {
        $data = [];
        foreach ($request->all() as  $req) {
            foreach ($req['items'] as $elm) {
                $temp = [
                    'item_code' => $elm['item']['id'],
                    "qtyShipped" => $elm['qtyShipped'],
                    "unit" => $elm['unit'],
                    "requested_by" => Auth::id(),
                    "remarks" => $elm['remarks'],
                    "sdr_status" => '1',
                    "created_by" => Auth::id(),
                    "updated_by" => Auth::id(),
                    "si_number" => $req['si_number']
                ];
                array_push($data, $temp);
            }
        }
        $result = itemsSales::insert($data);
        return response()->json('MASUK' . $result, 200);
    }
    public function postItemPurchaseSdr(Request $request)
    {
        $itemsDelivering = new itemsSales();
        $itemsDelivering->item_code = $request->itemid;
        $itemsDelivering->qtyShipped = $request->qtyShipped;
        $itemsDelivering->unit = $request->unit;
        $itemsDelivering->requested_by = Auth::id();
        $itemsDelivering->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $itemsDelivering->sdr_status = '1';
        $itemsDelivering->created_by = Auth::id();
        $itemsDelivering->updated_by = Auth::id();
        $itemsDelivering->save();
        return response()->json($itemsDelivering, 200);
    }
    public function postItemSalesBySdrNumber($sdr_number, Request $request)
    {
        $itemsDelivering = new itemsSales();
        $itemsDelivering->item_code = $request->itemid;
        $itemsDelivering->qtyShipped = $request->qtyShipped;
        $itemsDelivering->unit = $request->unit;
        $itemsDelivering->requested_by = Auth::id();
        $itemsDelivering->remarks = $request->remarks;

        $itemsDelivering->sdr_status = '2';
        $itemsDelivering->salesingId = $sdr_number;
        $itemsDelivering->created_by = Auth::id();
        $itemsDelivering->updated_by = Auth::id();
        $itemsDelivering->save();
        return response()->json($itemsDelivering, 200);
    }
    public function getItemSalesBySdrNumber($sdr_number)
    {
        return response()->json(itemsSales::where('salesingId', $sdr_number)->with('item', 'usedBy', 'requestedBy')->orderBy('created_at', 'DESC')->get());
    }
    public function getItemSalesSdrById($id)
    {
        return response()->json(itemsSales::where('id', $id)->with('item', 'usedBy', 'requestedBy')->first());
    }
    public function postItemSalesSdrById($id, Request $request)
    {
        $itemsDelivering = itemsSales::find($id);
        $itemsDelivering->qtyShipped = $request->qtyShipped;
        $itemsDelivering->unit = $request->unit;
        $itemsDelivering->requested_by = Auth::id();
        $itemsDelivering->remarks = $request->remarks;
        $itemsDelivering->updated_by = Auth::id();
        $itemsDelivering->save();
        return response()->json($itemsDelivering, 200);
        // return $request->itemid;
    }
    public function deleteItemSalesSdrById($id)
    {
        return response()->json(itemsSales::find($id)->delete());
    }
    public function countItemSalesSdr()
    {
        $ItemCount = DB::table('items_sales')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }

    // ITEM ON SALES INVOICES
    public function getItemSalesSI()
    {
        return response()->json(itemsSales::with('item')->orderBy('created_at', 'DESC')->where('si_status', 1)->where('created_by', Auth::id())->get());
    }
    public function postItemSalesSI(Request $request)
    {
        $itemPurchase = DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);

        $itemSalesing = new itemsSales();
        $itemSalesing->item_code = $request->itemid;
        $itemSalesing->qtyShipped = $request->qtyShipped;
        $itemSalesing->unit = $request->unit;
        $itemSalesing->price = $request->price;
        $itemSalesing->remarks = $request->remarks;
        $itemSalesing->customerId = $request->customerid;
        $itemSalesing->warehouseId = $request->warehouseid;
        $itemSalesing->driver_name = $request->driver_name;
        $itemSalesing->driver_nopol = $request->driver_nopol;
        $itemSalesing->sales_related = $request->so_number;
        $itemSalesing->weightIn = $request->weightIn;
        $itemSalesing->weightOut = $request->weightOut;
        
        // po status 1 means stored at database but not with the purchase order id;
        $itemSalesing->si_status = '1';
        $itemSalesing->created_by = Auth::id();
        $itemSalesing->updated_by = Auth::id();
        $itemSalesing->save();

        salesOrder::where('so_number', $request->so_number)->update(['status' => '1']);
        
        return response()->json($itemSalesing, 200);
    }
    public function postItemSalesBySiNumber($si_number, Request $request)
    {
        $itemPurchase = DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);

        $itemSalesing = new itemsSales();
        $itemSalesing->item_code = $request->itemid;
        $itemSalesing->qtyShipped = $request->qtyShipped ?? 0;
        $itemSalesing->unit = $request->unit;
        $itemSalesing->price = $request->price;
        $itemSalesing->remarks = $request->remarks;
        $itemSalesing->driver_name = $request->driver_name;
        $itemSalesing->driver_nopol = $request->driver_nopol;

        $itemSalesing->salesingId = $si_number;
        $itemSalesing->created_by = Auth::id();
        $itemSalesing->updated_by = Auth::id();
        $itemSalesing->save();
        
        salesInvoice::where('si_number', $request->salesingId)->update(['status' => '1']);
        salesOrder::where('so_number', $request->sales_related)->update(['status' => '1']);
        
        if ($request->qtyShipped>0) {
            $inputToHistory = new itemHistory();
            $inputToHistory->itemId = $itemSalesing->item_code;
            $inputToHistory->itemOutId = $si_number;
            $inputToHistory->type = 2;
            $inputToHistory->date = $itemSalesing->created_at;
            $inputToHistory->qtyOut = $request->qtyShipped;
            $inputToHistory->remarks = $itemSalesing->remarks;
            $inputToHistory->save();
            
            $itemSalesing = itemsSales::find($id);
            $itemSalesing->si_status = '2';
            $itemSalesing->save();

            $salesOrder = itemsSales::where('salesingId', $request->sales_related)->where('item_code', $request->item_code)->where('warehouseId', $request->warehouseId)
            ->update(['qtyShipped' => $request->qtyShipped]);
            if ($salesOrder->qtyShipped == $salesOrder->qtyOrdered) {
                salesOrder::where('so_number', $request->sales_related)
                ->update(['status' => '2']);
            }
            
            $inventory = inventoryItem::where('id', $request->itemId)->first();
            $itemPurchase = DB::table('inventory_items')->where('id', $request->itemId)
            ->update(['qty' => $inventory->qty - $request->qtyShipped]);
            
            salesInvoice::where('si_number', $request->salesingId)->update(['status' => '2']);
        }
        return response()->json($itemSalesing, 200);
    }
    public function getItemSalesSIById($id)
    {
        return response()->json(itemsSales::where('id', $id)->with('item', 'warehouse', 'customer', 'requestedBy')->first());
    }
    public function getItemSalesBySiNumber($si_number)
    {
        return response()->json(itemsSales::where('salesingId', $si_number)->with('item', 'customer', 'requestedBy')->orderBy('created_at', 'DESC')->get());
    }
    public function postItemSalesSIById($id, Request $request)
    {
        $itemPurchase = DB::table('inventory_items')
            ->where('id', '=', $request->itemid)
            ->update([
                'inventory_items.price' => $request->currentPrice,
            ]);

        $itemSalesing = itemsSales::find($id);
        $itemSalesing->qtyShipped = $request->qtyShipped;
        $itemSalesing->price = $request->price;
        $itemSalesing->remarks = $request->remarks;
        $itemSalesing->driver_name = $request->driver_name;
        $itemSalesing->driver_nopol = $request->driver_nopol;
        $itemSalesing->weightIn = $request->weightIn;
        $itemSalesing->weightOut = $request->weightOut;

        $itemSalesing->updated_by = Auth::id();
        $itemSalesing->save();
        
        $so = itemsSales::where('salesingId', $request->sales_related)->where('item_code', $request->itemid)->where('warehouseId', $request->warehouseId)->first();
        
        itemsSales::where('salesingId', $request->sales_related)->where('item_code', $so->item_code)->where('warehouseId', $request->warehouseId)
        ->update(['qtyShipped' => (($so->qtyShipped??0) + ($request->qtyShipped??0))]);
        
        $salesOrder = itemsSales::where('id', $so->id)->first();
        
        salesInvoice::where('si_number', $request->salesingId)->update(['status' => '1']);
        salesOrder::where('so_number', $request->sales_related)->update(['status' => '1']);
        
        if ($request->qtyShipped>0) {
            $inputToHistory = new itemHistory();
            $inputToHistory->itemId = $so->itemid;
            $inputToHistory->itemOutId = $request->salesingId;
            $inputToHistory->type = 2;
            $inputToHistory->date = $itemSalesing->created_at;
            $inputToHistory->qtyOut = $request->qtyShipped;
            $inputToHistory->remarks = $itemSalesing->remarks;
            $inputToHistory->save();
            
            $itemSalesing = itemsSales::find($id);
            $itemSalesing->si_status = '2';
            $itemSalesing->save();

            if ($salesOrder->qtyShipped == $salesOrder->qtyOrdered) {
                salesOrder::where('so_number', $request->sales_related)
                ->update(['status' => '2']);
            }
            
            $inventory = DB::table('inventory_items')->where('id', $request->itemid)->first();
            $itemPurchase = DB::table('inventory_items')->where('id', $request->itemid)
            ->update(['qty' => $inventory->qty - $request->qtyShipped]);
            
            salesInvoice::where('si_number', $request->salesingId)->update(['status' => '2']);
            
        }
        
        return response()->json($itemPurchase, 200);
        // return $request->itemid;
    }
    public function deleteItemSalesSIById($id)
    {
        return response()->json(itemsSales::find($id)->delete());
    }
    public function countItemSalesSI()
    {
        $ItemCount = DB::table('items_sales')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }

    // ITEM ON DOCUMENTS DELIVERY
    public function getItemDocumentDeliveryDDR()
    {
        return response()->json(itemOndocumentsDelivery::with('documentDelivery')->orderBy('created_at', 'DESC')->where('status', 1)->where('created_by', Auth::id())->get());
    }
    public function postItemDocumentDeliveryDDR(Request $request)
    {
        $ItemDelivering = new itemOndocumentsDelivery();
        $ItemDelivering->type = $request->type;
        $ItemDelivering->receiptNumber = $request->receiptNumber;
        $ItemDelivering->destination = $request->destination;
        $ItemDelivering->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $ItemDelivering->status = 1;
        $ItemDelivering->created_by = Auth::id();
        $ItemDelivering->save();
        return response()->json($ItemDelivering, 200);
    }
    public function postItemDocumentDeliveryByDdrNumber($ddr_number, Request $request)
    {
        $ItemDelivering = new itemOndocumentsDelivery();
        $ItemDelivering->type = $request->type;
        $ItemDelivering->receiptNumber = $request->receiptNumber;
        $ItemDelivering->destination = $request->destination;
        $ItemDelivering->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $ItemDelivering->status = 2;
        $ItemDelivering->created_by = Auth::id();
        $ItemDelivering->ddrId = $ddr_number;
        $ItemDelivering->save();
        return response()->json($ItemDelivering, 200);
    }
    public function getItemDocumentDeliveryDDRById($id)
    {
        return response()->json(itemOndocumentsDelivery::where('id', $id)->with('documentDelivery', 'createdBy')->first());
    }
    public function getItemDocumentDeliveryByDdrNumber($ddr_number)
    {
        return response()->json(itemOndocumentsDelivery::where('ddrId', $ddr_number)->with('documentDelivery')->orderBy('created_at', 'DESC')->get());
    }
    public function postItemDocumentDeliveryDDRById($id, Request $request)
    {
        $ItemDelivering = itemOndocumentsDelivery::find($id);
        $ItemDelivering->type = $request->type;
        $ItemDelivering->receiptNumber = $request->receiptNumber;
        $ItemDelivering->destination = $request->destination;
        $ItemDelivering->remarks = $request->remarks;
        $ItemDelivering->save();

        if ($ItemDelivering->receiptNumber) {
            $documentRelated = documentsDelivery::where('ddr_number', $ItemDelivering->ddrId)->with('sender')->first();
            Mail::to($documentRelated->sender->email)->send(new updateReceiptNumber($ItemDelivering, $documentRelated));
        }
        return response()->json($ItemDelivering, 200);
        // return $documentRelated->sender->email;
    }
    public function deleteItemDocumentDeliveryDDRById($id)
    {
        return response()->json(itemOndocumentsDelivery::find($id)->delete());
    }
    public function countItemDocumentDeliveryDDR()
    {
        $ItemCount = DB::table('item_documents_deliveries')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
}
