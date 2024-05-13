<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Items;
use App\Models\Leads;
use App\Models\Proposal;
use App\Models\ProposalItem;
use App\Models\Status;
use App\Models\Tags;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;

class ProposalController extends Controller
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
        $proposals = Proposal::orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.proposals.list', compact('proposals'));
    }
    public function create()
    {
        $leads = Leads::get();
        $customers = User::get();
        $admins = Admin::get();
        $items = Items::get();
        $status = Status::get();
        $tags = Tags::get();
        return view('admin.proposals.create')->with(compact('tags','status','leads','customers','admins','items'));
    }
    public function store(Request $request)
    {
        $reqData = Purify::clean($request->except('_token', '_method'));
        if ($reqData['related_to'] == 1){
            $related_id = $reqData['lead_id'];
        }else{
            $related_id = $reqData['customer_id'];

        }
        $proposal = Proposal::create([
            'subject' => $reqData['subject'],
            'related_to' => $reqData['related_to'],
            'related_id' => $related_id,
            'date' => $reqData['issue_date'],
            'open_till' => $reqData['open_till_date'],
            'currency_id' => $reqData['currency_id'],
            'discount_type' => $reqData['discount_type'],
            'tags' => $reqData['tags'],
            'status' => $reqData['status'],
            'assigned_to' => $reqData['assigned_to'],
            'proposal_to' => $reqData['to_name'],
            'address' => $reqData['address'],
            'city' => $reqData['city'],
            'state' => $reqData['state'],
            'zip_code' => $reqData['zip_code'],

            'country' => $reqData['country'],
            'email' => $reqData['email_address'],
            'phone' => $reqData['phone'],
            'subtotal' => $reqData['subtotal'],
            'discount' => $reqData['discount_percent'],

        ]);

        $items = json_decode($reqData['proposalItems']);
        foreach($items as $item){
            ProposalItem::create([
                'item_name' => $item->item_name,
                'item_description' => $item->item_description,
                'qty' => $item->qty,
                'amount' => $item->rate,
                'tax_type' => $item->tax,
                'proposal_id' => $proposal->id,
            ]);
        }

        return back()->with('success', 'Proposal created successfully!');
    }
    public function edit(Request $request,$id)
    {
        $proposal = Proposal::find($id);
        $leads = Leads::get();
        $customers = User::get();
        $items = Items::get();

        $admins = Admin::get();
        return view('admin.proposals.create')->with(compact('leads','customers','admins','proposal','items'));
    }
    public function detail(Request $request,$id)
    {
        $proposal = Proposal::find($id);
        $leads = Leads::get();
        $customers = User::get();
        $items = Items::get();

        $admins = Admin::get();
        return view('admin.proposals.view')->with(compact('leads','customers','admins','proposal','items'));
    }
    public function update(Request $request, $id)
    {
        $reqData = Purify::clean($request->except('_token', '_method'));
        $proposal = Proposal::find($id);
        if ($reqData['related_to'] == 1){
            $related_id = $reqData['lead_id'];
        }else{
            $related_id = $reqData['customer_id'];

        }

        $proposal->update([
            'subject' => $reqData['subject'],
            'related_to' => $reqData['related_to'],
            'related_id' => $related_id,
            'date' => $reqData['issue_date'],
            'open_till' => $reqData['open_till_date'],
            'currency_id' => $reqData['currency_id'],
            'discount_type' => $reqData['discount_type'],
            'tags' => $reqData['tags'],
            'status' => $reqData['status'],
            'assigned_to' => $reqData['assigned_to'],
            'proposal_to' => $reqData['to_name'],
            'address' => $reqData['address'],
            'city' => $reqData['city'],
            'state' => $reqData['state'],
            'zip_code' => $reqData['zip_code'],
            'country' => $reqData['country'],
            'email' => $reqData['email_address'],
            'phone' => $reqData['phone'],
            'subtotal' => $reqData['subtotal'],
            'discount' => $reqData['discount_percent'],
        ]);
        $items = json_decode($reqData['proposalItems']);


        // Get original item IDs from the database
        $originalItemIds = $proposal->items->pluck('id')->toArray();

        // Extract updated item IDs
        $updatedItemIds = collect($items)->pluck('id')->filter()->toArray();

        // Identify deleted item IDs
        $deletedItemIds = array_diff($originalItemIds, $updatedItemIds);

        // Delete items marked for deletion
        ProposalItem::destroy($deletedItemIds);
        foreach ($items as $item) {

            if (!isset($item->id)) {
                ProposalItem::create([
                    'item_name' => $item->item_name,
                    'item_description' => $item->item_description,
                    'qty' => $item->qty,
                    'amount' => $item->rate,
                    'tax_type' => $item->tax,
                    'proposal_id' => $proposal->id,
                ]);
            }
        }
        return back()->with('success', 'Proposal updated successfully!');

    }
    public function destroy($id)
    {
        $proposal = Proposal::findOrFail($id);
        $items = $proposal->items->pluck('id')->toArray();
        ProposalItem::destroy($items);
        $proposal->delete();
        return back()->with('success', __('Proposal has been deleted'));
    }
}
