<?php

namespace App\Http\Controllers;

use App\company_details;
use App\inventoryItem;
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

// Generate PDF
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use Mail;

class purchasingController extends Controller
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
    // Purchasing
    // Purchase Order
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
        return response()->json($purchasingUpdate, 200);
    }
    public function deletePurchaseOrderById($id)
    {
        $purchaseOrd = purchaseOrder::find($id);
        $itemPurchase = itemsPurchase::where('purchasingId', $purchaseOrd->po_number)->get();
        foreach ($itemPurchase as $itemPurchases) {
            $itemPurchases->delete();
        }
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
    public function reportPO($id)
    {
        $getPO = purchaseOrder::where('id', $id)->with('suppliers', 'warehouse')->first();
        $getItemOnPO = itemsPurchase::where('purchasingId', $getPO->po_number)->with('item')->get();
        $client = new Party([
            'name'          => $getPO->suppliers->customerName,
            'address'         => $getPO->suppliers->customerAddress,
        ]);

        $customer = new Party([
            'name'          => $this->getCompany()->warehouse_name,
            'address'       => $this->getCompany()->address,
        ]);

        // $items = [
        //     (new InvoiceItem())->title('Service 1')->pricePerUnit(47.79)->quantity(2)->discount(10),
        //     (new InvoiceItem())->title('Service 2')->pricePerUnit(71.96)->quantity(2),
        //     (new InvoiceItem())->title('Service 3')->pricePerUnit(4.56),
        //     (new InvoiceItem())->title('Service 4')->pricePerUnit(87.51)->quantity(7)->discount(4)->units('kg'),
        //     (new InvoiceItem())->title('Service 5')->pricePerUnit(71.09)->quantity(7)->discountByPercent(9),
        //     (new InvoiceItem())->title('Service 6')->pricePerUnit(76.32)->quantity(9),
        //     (new InvoiceItem())->title('Service 7')->pricePerUnit(58.18)->quantity(3)->discount(3),
        //     (new InvoiceItem())->title('Service 8')->pricePerUnit(42.99)->quantity(4)->discountByPercent(3)
        // ];
        foreach ($getItemOnPO as $getItemOnPO) {
            $items[] = (new InvoiceItem())->title($getItemOnPO->item->item_name)->pricePerUnit($getItemOnPO->item->price)->quantity($getItemOnPO->qtyOrdered)->units($getItemOnPO->unit);
        }

        // NOTES FOR INVOICING
        if ($getPO->remarks) {
            $notes = $getPO->remarks;
        }
        // $notes = implode("<br>", $notes);

        $invoice = Invoice::make('Purchase Order Invoice')
            ->series($getPO->po_number)
            ->seller($client)
            ->buyer($customer)
            ->date($getPO->created_at)
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('Rp')
            ->currencyCode('Rupiahs')
            ->currencyFormat('{SYMBOL}. {VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($client->name . ' ' . $customer->name)
            ->addItems($items)
            // ->notes($notes)
            ->logo(public_path('webpage/images/logo.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
        // return $getItemOnPO;
        // return response(purchaseOrder::find($id)->with('supplier')->with('recipient')->with('createdby')->get());
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
