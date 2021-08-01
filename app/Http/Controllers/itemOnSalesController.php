<?php

namespace App\Http\Controllers;

use App\itemsSales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
}
