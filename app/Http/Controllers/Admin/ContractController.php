<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Contract;
use App\Models\Leads;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

class ContractController extends Controller
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
        $contracts = Contract::orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.contracts.list', compact('contracts'));
    }
    public function create()
    {
        $leads = Leads::get();
        $customers = User::get();
        $admins = Admin::get();
        return view('admin.contracts.create')->with(compact('leads','customers','admins'));
    }
    public function store(Request $request)
    {
        $reqData = Purify::clean($request->except('_token', '_method'));

        Contract::create(
           [
               'customer_id'=> $reqData['customer_id'],
               'subject'=>$reqData['subject'],
               'contract_value'=>$reqData['contract_value'],
               'type'=>$reqData['contract_type'],
               'start_date'=>$reqData['issue_date'],
               'end_date'=>$reqData['open_till_date'],
               'description'=>$reqData['description'],
               'status'=>0,
               ]

        );
        return back()->with('success', 'Contract created successfully!');

    }
    public function edit($id){
        $leads = Leads::get();
        $customers = User::get();
        $admins = Admin::get();
        $contract = Contract::find($id);
        return view('admin.contracts.create')->with(compact('leads','customers','admins','contract'));
    }
    public function update(Request $request, $id){
        $contract = Contract::find($id);
        $reqData = Purify::clean($request->except('_token', '_method'));

        $contract->update(
            [
                'customer_id'=> $reqData['customer_id'],
                'subject'=>$reqData['subject'],
                'contract_value'=>$reqData['contract_value'],
                'type'=>$reqData['contract_type'],
                'start_date'=>$reqData['issue_date'],
                'end_date'=>$reqData['open_till_date'],
                'description'=>$reqData['description'],
                'status'=>0,
            ]

        );
        return back()->with('success', 'Contract updated successfully!');
    }
    public function destroy($id)
    {
        $contract = Contract::findOrFail($id);
        $contract->delete();
        return back()->with('success', __('Contract has been deleted'));
    }
}
