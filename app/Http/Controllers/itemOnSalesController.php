<?php

namespace App\Http\Controllers;

use App\documentsDelivery;
use App\itemsSales;
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
        return response()->json(itemsSales::where('so_status', 1)->where('created_by', Auth::id())->with('item', 'used', 'usedBy', 'requestedBy')->get(), 200);
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
        $itemsSales->warehouseId = $request->warehouseid;
        $itemsSales->item_code = $request->itemid;
        $itemsSales->qtyOrdered = $request->qtyOrdered;
        $itemsSales->qtyShipped = '0';
        $itemsSales->qtyReturns = '0';
        $itemsSales->unit = $request->unit;
        $itemsSales->price = $request->price;
        $itemsSales->purpose = $request->purpose;
        $itemsSales->requested_by = Auth::id();
        $itemsSales->used_by = $request->used_by;
        $itemsSales->remarks = $request->remarks;

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
    public function postItemSalesInvoiceSdr(Request $request) {
        $data = [];
        foreach ($request->all() as  $req ) {
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
        return response()->json('MASUK'.$result, 200);
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

        // po status 1 means stored at database but not with the purchase order id;
        $itemSalesing->si_status = '1';
        $itemSalesing->created_by = Auth::id();
        $itemSalesing->updated_by = Auth::id();
        $itemSalesing->save();
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
        $itemSalesing->qtyShipped = $request->qtyShipped;
        $itemSalesing->unit = $request->unit;
        $itemSalesing->price = $request->price;
        $itemSalesing->remarks = $request->remarks;

        $itemSalesing->si_status = '2';
        $itemSalesing->salesingId = $si_number;
        $itemSalesing->created_by = Auth::id();
        $itemSalesing->updated_by = Auth::id();
        $itemSalesing->save();

        $inputToHistory = new itemHistory();
        $inputToHistory->itemId = $itemSalesing->item_code;
        $inputToHistory->itemOutId = $si_number;
        $inputToHistory->type = 1;
        $inputToHistory->date = $itemSalesing->created_at;
        $inputToHistory->qtyIn = $itemSalesing->qtyShipped;
        $inputToHistory->remarks = $itemSalesing->remarks;
        $inputToHistory->save();
        return response()->json($itemSalesing, 200);
    }
    public function getItemSalesSIById($id)
    {
        return response()->json(itemsSales::where('id', $id)->with('item', 'requestedBy')->first());
    }
    public function getItemSalesBySiNumber($si_number)
    {
        return response()->json(itemsSales::where('salesingId', $si_number)->with('item', 'requestedBy')->orderBy('created_at', 'DESC')->get());
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
        $itemSalesing->updated_by = Auth::id();
        $itemSalesing->save();
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
