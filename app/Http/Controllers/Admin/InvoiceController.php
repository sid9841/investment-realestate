<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Estimate;
use App\Models\EstimateItem;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Items;
use App\Models\Leads;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        $invoices = Invoice::orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.invoices.list', compact('invoices'));
    }
    public function create()
    {
        $leads = Leads::get();
        $customers = User::get();
        $admins = Admin::get();
        $items = Items::get();
        return view('admin.invoices.create')->with(compact('leads','customers','admins','items'));
    }
    public function edit($id)
    {
        $invoice = Invoice::find($id);
        $leads = Leads::get();
        $customers = User::get();
        $admins = Admin::get();
        $items = Items::get();

        return view('admin.invoices.create')->with(compact('leads','customers','admins','invoice','items'));
    }
    public function detail($id)
    {
        $invoice = Invoice::find($id);
        $leads = Leads::get();
        $customers = User::get();
        $admins = Admin::get();
        $items = Items::get();

        return view('admin.invoices.view')->with(compact('leads','customers','admins','invoice','items'));
    }
    public function store(Request $request)
    {
        $reqData = Purify::clean($request->except('_token', '_method'));


        $proposal = Invoice::create([
            'customer_id' => $reqData['customer_id'],
            'invoice_no' => $reqData['invoice_no'],
            'agent_id' => $reqData['sales_agent'],
            'date' => $reqData['issue_date'],
            'due_date' => $reqData['open_till_date'],
            'currency_id' => $reqData['currency_id'],
            'discount_type' => $reqData['discount_type'],
            'tags' => $reqData['tags'],
            'status' => $reqData['status'],
            'admin_note' => $reqData['admin_note'],
//            'reference' => $reqData['reference'],
            'client_note' => $reqData['client_note'],
            'terms_conditions' => $reqData['terms_conditions'],
            'subtotal' =>  $reqData['subtotal'],
            'discount' => $reqData['discount_percent'],

        ]);
        $items = json_decode($reqData['invoiceItems']);
        foreach($items as $item){
            InvoiceItem::create([
                'item_name' => $item->item_name,
                'item_description' => $item->item_description,
                'qty' => $item->qty,
                'amount' => $item->rate,
                'tax_type' => $item->tax,
                'invoice_id' => $proposal->id,
            ]);
        }

        return back()->with('success', 'Invoice created successfully!');
    }
    public function update(Request $request, $id){
        $reqData = Purify::clean($request->except('_token', '_method'));
        $estimate = Invoice::find($id);


        $estimate->update([
            'customer_id' => $reqData['customer_id'],
            'invoice_no' => $reqData['invoice_no'],
            'agent_id' => $reqData['sales_agent'],
            'date' => $reqData['issue_date'],
            'due_date' => $reqData['open_till_date'],
            'currency_id' => $reqData['currency_id'],
            'discount_type' => $reqData['discount_type'],
            'tags' => $reqData['tags'],
            'status' => $reqData['status'],
            'admin_note' => $reqData['admin_note'],
//            'reference' => $reqData['reference'],
            'client_note' => $reqData['client_note'],
            'terms_conditions' => $reqData['terms_conditions'],
            'subtotal' =>  $reqData['subtotal'],
            'discount' => $reqData['discount_percent'],

        ]);
        $items = json_decode($reqData['invoiceItems']);


        // Get original item IDs from the database
        $originalItemIds = $estimate->items->pluck('id')->toArray();

        // Extract updated item IDs
        $updatedItemIds = collect($items)->pluck('id')->filter()->toArray();

        // Identify deleted item IDs
        $deletedItemIds = array_diff($originalItemIds, $updatedItemIds);

        // Delete items marked for deletion
        InvoiceItem::destroy($deletedItemIds);
        foreach ($items as $item) {

            if (!isset($item->id)) {
                EstimateItem::create([
                    'item_name' => $item->item_name,
                    'item_description' => $item->item_description,
                    'qty' => $item->qty,
                    'amount' => $item->rate,
                    'tax_type' => $item->tax,
                    'invoice_id' => $estimate->id,
                ]);
            }
        }
        return back()->with('success', 'Invoice  updated successfully!');

    }
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $items = $invoice->items->pluck('id')->toArray();
        InvoiceItem::destroy($items);
        $invoice->delete();
        return back()->with('success', __('Invoice has been deleted'));
    }
}
