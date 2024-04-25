<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Estimate;
use App\Models\EstimateItem;
use App\Models\Items;
use App\Models\Leads;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;

class EstimateController extends Controller
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
        $estimates = Estimate::orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.estimates.list', compact('estimates'));
    }
    public function create()
    {
        $leads = Leads::get();
        $customers = User::get();
        $admins = Admin::get();
        $items = Items::get();

        return view('admin.estimates.create')->with(compact('leads','customers','admins','items'));
    }
    public function store(Request $request)
    {
        $reqData = Purify::clean($request->except('_token', '_method'));


        $estimate = Estimate::create([
            'customer_id' => $reqData['customer_id'],
            'estimate_no' => $reqData['est_no'],
            'agent_id' => $reqData['sales_agent'],
            'date' => $reqData['issue_date'],
            'expiry_date' => $reqData['open_till_date'],
            'currency_id' => $reqData['currency_id'],
            'discount_type' => $reqData['discount_type'],
            'tags' => $reqData['tags'],
            'status' => $reqData['status'],
            'admin_note' => $reqData['admin_note'],
            'reference' => $reqData['reference'],
            'client_note' => $reqData['client_note'],
            'terms_conditions' => $reqData['terms_conditions'],
            'subtotal' => $reqData['subtotal'],
            'discount' => $reqData['discount_percent'],

        ]);
        $items = json_decode($reqData['estimateItems']);
        foreach($items as $item){
            EstimateItem::create([
                'item_name' => $item->item_name,
                'item_description' => $item->item_description,
                'qty' => $item->qty,
                'amount' => $item->rate,
                'tax_type' => $item->tax,
                'estimate_id' => $estimate->id,
            ]);
        }

        return back()->with('success', 'Estimate created successfully!');
    }
    public function edit($id)
    {
        $estimate = Estimate::find($id);
        $leads = Leads::get();
        $customers = User::get();
        $admins = Admin::get();
        $items = Items::get();

        return view('admin.estimates.create')->with(compact('leads','customers','admins','estimate','items'));
    }
    public function update(Request $request, $id){
        $reqData = Purify::clean($request->except('_token', '_method'));
        $estimate = Estimate::find($id);

        $estimate->update([
            'customer_id' => $reqData['customer_id'],
            'estimate_no' => $reqData['est_no'],
            'agent_id' => $reqData['sales_agent'],
            'date' => $reqData['issue_date'],
            'expiry_date' => $reqData['open_till_date'],
            'currency_id' => $reqData['currency_id'],
            'discount_type' => $reqData['discount_type'],
            'tags' => $reqData['tags'],
            'status' => $reqData['status'],
            'admin_note' => $reqData['admin_note'],
            'reference' => $reqData['reference'],
            'client_note' => $reqData['client_note'],
            'terms_conditions' => $reqData['terms_conditions'],
            'subtotal' => $reqData['subtotal'],
            'discount' => $reqData['discount_percent'],
        ]);
        $items = json_decode($reqData['estimateItems']);


        // Get original item IDs from the database
        $originalItemIds = $estimate->items->pluck('id')->toArray();

        // Extract updated item IDs
        $updatedItemIds = collect($items)->pluck('id')->filter()->toArray();

        // Identify deleted item IDs
        $deletedItemIds = array_diff($originalItemIds, $updatedItemIds);

        // Delete items marked for deletion
        EstimateItem::destroy($deletedItemIds);
        foreach ($items as $item) {

            if (!isset($item->id)) {
                EstimateItem::create([
                    'item_name' => $item->item_name,
                    'item_description' => $item->item_description,
                    'qty' => $item->qty,
                    'amount' => $item->rate,
                    'tax_type' => $item->tax,
                    'estimate_id' => $estimate->id,
                ]);
            }
        }
        return back()->with('success', 'Estimate updated successfully!');

    }
    public function destroy($id)
    {
        $estimate = Estimate::findOrFail($id);
        $items = $estimate->items->pluck('id')->toArray();
        EstimateItem::destroy($items);
        $estimate->delete();
        return back()->with('success', __('Estimate has been deleted'));
    }

}
