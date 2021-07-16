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
    // PURCHASE ORDER
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

    // PURCHASE INVOICE
    public function getPurchaseInvoice()
    {
        if (Auth::user()->role == 'customer') {
            return purchaseInvoice::where('created_by', Auth::id())->with('suppliers')->with('warehouse')->with('createdby')->orderBy('created_at', 'DESC')->get();
        } else {
            return purchaseInvoice::with('suppliers')->with('warehouse')->with('createdby')->orderBy('created_at', 'DESC')->get();
        }
    }
    public function postPurchaseInvoice(Request $request)
    {
        $purchasingOrd = new purchaseInvoice();
        $purchasingOrd->pi_number = $request->pi_number;
        $purchasingOrd->supplier = $request->supplier;
        $purchasingOrd->invoice_date = $request->order_date;
        $purchasingOrd->drivers = $request->drivers;
        $purchasingOrd->vehicle_no = $request->vehicle_no;
        $purchasingOrd->deliver_to = $request->deliver_to;
        $purchasingOrd->remarks = $request->remarks;
        $purchasingOrd->created_by = Auth::id();
        $purchasingOrd->updated_by = Auth::id();
        $purchasingOrd->save();

        $itemGet = DB::table('items_purchases')
            ->where('pi_status', '=', '1')
            // PO Status 2, means having a purchasing ID
            ->update(array('purchasingId' => $purchasingOrd->pi_number, 'pi_status' => '2'));
        return response()->json($purchasingOrd, 200);
    }
    public function getPurchaseInvoiceByPiNumber($pi_number)
    {
        return response()->json(purchaseInvoice::where('pi_number', $pi_number)->with('suppliers', 'warehouse')->first());
    }
    public function postPurchaseInvoiceByPiNumber($pi_number, Request $request)
    {
        $purchasingUpdate = DB::table('purchase_invoices')
            ->where('pi_number', '=', $pi_number)
            ->update(array(
                'supplier' => $request->supplier,
                'invoice_date' => $request->invoice_date,
                'deliver_to' => $request->deliver_to,
                'drivers' => $request->drivers,
                'vehicle_no' => $request->vehicle_no,
                'remarks' => $request->remarks,
                'updated_by' => Auth::id(),
            ));
        return response()->json($purchasingUpdate, 200);
    }
    public function deletePurchaseInvoiceById($id)
    {
        $purchaseOrd = purchaseInvoice::find($id);
        $itemPurchase = itemsPurchase::where('purchasingId', $purchaseOrd->pi_number)->get();
        foreach ($itemPurchase as $itemPurchases) {
            $itemPurchases->delete();
        }
        $purchaseOrd->delete();
        return response()->json(201);
    }
    public function countPurchaseInvoice()
    {
        $ItemCount = DB::table('purchase_invoices')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    public function reportPI($id)
    {
        $getPI = purchaseInvoice::where('id', $id)->with('suppliers', 'warehouse')->first();
        $getItemOnPI = itemsPurchase::where('purchasingId', $getPI->pi_number)->with('item')->get();
        $client = new Party([
            'name'          => $getPI->suppliers->customerName,
            'address'         => $getPI->suppliers->customerAddress,
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
        foreach ($getItemOnPI as $getItemOnPI) {
            $items[] = (new InvoiceItem())->title($getItemOnPI->item->item_name)->pricePerUnit('0')->quantity($getItemOnPI->qtyShipped)->units($getItemOnPI->unit);
        }

        // NOTES FOR INVOICING
        if ($getPI->remarks) {
            $notes = $getPI->remarks;
        }
        // $notes = implode("<br>", $notes);

        $invoice = Invoice::make('Purchase Invoice')
            ->series($getPI->pi_number)
            ->seller($client)
            ->buyer($customer)
            ->date($getPI->created_at)
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
}
