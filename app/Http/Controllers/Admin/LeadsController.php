<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leads;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Purify\Facades\Purify;

class LeadsController extends Controller
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
        $users = Leads::orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.leads.list', compact('users'));
    }

    public function create(Request $request)
    {
        $reqData = Purify::clean($request->except('_token', '_method'));

        Leads::create([
            'name' => $reqData['name'],
            'address' => $reqData['address'],
            'position' => $reqData['position'],
            'city' => $reqData['city'],
            'email' => $reqData['email_address'],
            'state' => $reqData['state'],
            'website' => $reqData['website'],
            'country' => $reqData['country'],
            'phone' => $reqData['phone'],
            'zip_code' => $reqData['zip_code'],
            'lead_value' => $reqData['lead_value'],
            'language' => $reqData['language'],
            'company' => $reqData['company'],
            'description' => $reqData['description'],
            'lead_status' => $reqData['status'],
            'assigned_user_id' => $reqData['assigned_user'],
            'lead_source' => $reqData['source'],
            'tags' => $reqData['tags'],
            'contact_date' => Carbon::now(),

        ]);

        return back()->with('success', 'Lead created successfully!');
    }
    public function getLeadInfo(Request $request){
        $lead = Leads::find($request->dataid);
        return $lead;
    }
    public function update(Request $request,$id)
    {
        $lead = Leads::find($id);
        $reqData = Purify::clean($request->except('_token', '_method'));

        $lead->update([
            'name' => $reqData['name'],
            'address' => $reqData['address'],
            'position' => $reqData['position'],
            'city' => $reqData['city'],
            'email' => $reqData['email_address'],
            'state' => $reqData['state'],
            'website' => $reqData['website'],
            'country' => $reqData['country'],
            'phone' => $reqData['phone'],
            'zip_code' => $reqData['zip_code'],
            'lead_value' => $reqData['lead_value'],
            'language' => $reqData['language'],
            'company' => $reqData['company'],
            'description' => $reqData['description'],
            'lead_status' => $reqData['status'],
            'assigned_user_id' => $reqData['assigned_user'],
            'lead_source' => $reqData['source'],
            'tags' => $reqData['tags'],
            'contact_date' => Carbon::now(),

        ]);

        return back()->with('success', 'Lead updated successfully!');
    }
    public function destroy($id)
    {
        $lead = Leads::findOrFail($id);
        $lead->delete();
        return back()->with('success', __('Lead has been deleted'));
    }
}
