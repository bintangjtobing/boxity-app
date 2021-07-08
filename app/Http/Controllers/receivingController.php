<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;
use App\receivingConfirmation;
use App\itemsReceiving;
// Generate PDF
use LaravelDaily\Invoices\ReceiveConfirmation;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use Mail;


class receivingController extends Controller
{
    // GET COMPANY BASED
    public function getCompany()
    {
        if (Auth::user()->role == 'customer') {
            return Auth::user();
        } else {
            $arrayName = $this->getReceivingConfirmation();
            return $arrayName[0]->warehouse;
        }
    }
    // Receiving
    public function getReceivingConfirmation()
    {
        if (Auth::user()->role == 'customer') {
            return receivingConfirmation::where('created_by', Auth::id())->with('customers', 'createdBy', 'warehouse')->orderBy('created_at', 'DESC')->get();
        } else {
            return receivingConfirmation::with('customers', 'createdBy', 'warehouse')->orderBy('created_at', 'DESC')->get();
        }
    }
    public function postReceivingConfirmation(Request $request)
    {
        $receivingOrd = new receivingConfirmation();
        $receivingOrd->receiving_number = $request->receiving_number;
        if ($this->getCompany()->role == 'admin') {
            $receivingOrd->customer = $request->customer;
        }
        if ($this->getCompany()->role == 'customer') {
            $receivingOrd->customer = Auth::id();
        }
        $receivingOrd->receiving_date = $request->receiving_date;
        $receivingOrd->receiving_warehouse = $request->receiving_warehouse;
        $receivingOrd->drivers = $request->drivers;
        $receivingOrd->vehicle_no = $request->vehicle_no;
        $receivingOrd->status = $request->status;
        $receivingOrd->remarks = $request->remarks;
        $receivingOrd->created_by = Auth::id();
        $receivingOrd->updated_by = Auth::id();
        $receivingOrd->save();

        $itemGet = DB::table('items_receivings')
            ->where('receiving_status', '=', '1')
            // PO Status 2, means having a purchasing ID
            ->update(array('receivingId' => $receivingOrd->receiving_number, 'receiving_status' => '2'));
        return response()->json($receivingOrd, 200);
    }
    public function getReceivingConfirmationByReceivingNumber($receiving_number)
    {
        return response()->json(receivingConfirmation::where('receiving_number', $receiving_number)->with('customers', 'createdBy', 'warehouse')->first());
    }
    public function postReceivingConfirmationByReceivingNumber($receiving_number, Request $request)
    {
        if ($this->getCompany()->role == 'admin') {
            $purchasingUpdate = DB::table('receiving_confirmations')
                ->where('receiving_number', '=', $receiving_number)
                ->update(array(
                    'customer' => $request->customer,
                    'receiving_date' => $request->receiving_date,
                    'receiving_warehouse' => $request->receiving_warehouse,
                    'drivers' => $request->drivers,
                    'vehicle_no' => $request->vehicle_no,
                    'status' => $request->status,
                    'remarks' => $request->remarks,
                    'updated_by' => Auth::id(),
                ));
        } else {
            $purchasingUpdate = DB::table('receiving_confirmations')
                ->where('receiving_number', '=', $receiving_number)
                ->update(array(
                    'customer' => Auth::id(),
                    'receiving_date' => $request->receiving_date,
                    'receiving_warehouse' => $request->receiving_warehouse,
                    'drivers' => $request->drivers,
                    'vehicle_no' => $request->vehicle_no,
                    'status' => $request->status,
                    'remarks' => $request->remarks,
                    'updated_by' => Auth::id(),
                ));
        }
        return response()->json($purchasingUpdate, 200);
    }
    public function deleteReceivingConfirmationById($id)
    {
        $receivingOrd = receivingConfirmation::find($id);
        $itemReceiving = itemsReceiving::where('receivingId', $receivingOrd->receiving_number)->get();
        foreach ($itemReceiving as $itemReceivings) {
            $itemReceivings->delete();
        }
        $receivingOrd->delete();
        return response()->json(201);
    }
    public function countReceivingConfirmation()
    {
        $ItemCount = DB::table('receiving_confirmations')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
    public function reportPO($id)
    {
        $getPO = receivingConfirmation::where('id', $id)->with('customers', 'createdBy', 'warehouse')->first();
        $getItemOnRC = itemsReceiving::where('receivingId', $getPO->receiving_number)->with('item')->get();
        $client = new Party([
            'name'          => $getPO->customers->customerName,
            'address'         => $getPO->customers->customerAddress,
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
        foreach ($getItemOnRC as $getItemOnRC) {
            $items[] = (new InvoiceItem())->title($getItemOnRC->item->item_name)->pricePerUnit($getItemOnRC->item->price)->quantity($getItemOnRC->qtyShipped)->units($getItemOnRC->unit);
        }

        // NOTES FOR INVOICING
        if ($getPO->remarks) {
            $notes = $getPO->remarks;
        }
        // $notes = implode("<br>", $notes);

        $invoice = ReceiveConfirmation::make('Receiving Confirmation')
            ->series($getPO->receiving_number)
            ->seller($client)
            ->buyer($customer)
            ->date($getPO->created_at)
            ->dateFormat('m/d/Y')
            // ->payUntilDays(14)
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
        // return $getItemOnRC;
        // return response(receivingConfirmation::find($id)->with('supplier')->with('recipient')->with('createdby')->get());
    }

    // Item Receiving
    public function getItemReceiving()
    {
        return response()->json(itemsReceiving::with('item', 'receivingNote', 'createdBy')->orderBy('created_at', 'DESC')->where('receiving_status', 1)->where('created_by', Auth::id())->get());
    }
    public function postItemReceiving(Request $request)
    {
        $ItemsReceiving = new itemsReceiving();
        $ItemsReceiving->item_code = $request->itemid;
        $ItemsReceiving->qtyOrdered = '0';
        $ItemsReceiving->qtyShipped = $request->qtyShipped;
        $ItemsReceiving->unit = $request->unit;
        $ItemsReceiving->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $ItemsReceiving->receiving_status = '1';
        $ItemsReceiving->created_by = Auth::id();
        $ItemsReceiving->updated_by = Auth::id();
        $ItemsReceiving->save();
        return response()->json($ItemsReceiving, 200);
    }
    public function postItemReceivingByReceivingNumber($receiving_number, Request $request)
    {
        $ItemsReceiving = new itemsReceiving();
        $ItemsReceiving->item_code = $request->itemid;
        $ItemsReceiving->qtyOrdered = '0';
        $ItemsReceiving->qtyShipped = $request->qtyShipped;
        $ItemsReceiving->unit = $request->unit;
        $ItemsReceiving->remarks = $request->remarks;

        // po status 1 means stored at database but not with the purchase order id;
        $ItemsReceiving->receiving_status = '2';
        $ItemsReceiving->receivingId = $receiving_number;
        $ItemsReceiving->created_by = Auth::id();
        $ItemsReceiving->updated_by = Auth::id();
        $ItemsReceiving->save();
        return response()->json($ItemsReceiving, 200);
    }
    public function getItemReceivingByReceivingNumber($receiving_number)
    {
        return response()->json(itemsReceiving::where('receivingId', $receiving_number)->with('item', 'createdBy', 'receivingNote')->orderBy('created_at', 'DESC')->get());
    }
    public function getItemReceivingById($id)
    {
        return response()->json(itemsReceiving::where('id', $id)->with('item', 'createdBy', 'receivingNote')->first());
    }
    public function postItemReceivingById($id, Request $request)
    {
        $ItemsReceiving = itemsReceiving::find($id);
        $ItemsReceiving->item_code = $request->itemid;
        $ItemsReceiving->qtyOrdered = $request->qtyOrdered;
        $ItemsReceiving->qtyShipped = $request->qtyShipped;
        $ItemsReceiving->unit = $request->unit;
        $ItemsReceiving->remarks = $request->remarks;
        $ItemsReceiving->updated_by = Auth::id();
        $ItemsReceiving->save();
        return response()->json($ItemsReceiving, 200);
        // return $request->itemid;
    }
    public function deleteItemReceivingById($id)
    {
        return response()->json(itemsReceiving::find($id)->delete());
    }
    public function countItemReceiving()
    {
        $ItemCount = DB::table('items_receivings')
            ->get()
            ->count();
        return response()->json($ItemCount);
    }
}
