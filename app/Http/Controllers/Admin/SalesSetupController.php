<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Priority;
use App\Models\Status;
use App\Models\Tags;
use Illuminate\Http\Request;

class SalesSetupController extends Controller
{
    public function index()
    {
        $status = Status::get();
        $tags = Tags::get();
        $priorities = Priority::get();
        return view('admin.sales-setup.index')->with(compact('status','tags','priorities'));
    }
    public function storeStatus(Request $request)
    {
        $status = new Status();
        $status->name = $request->status;
        $status->save();
        return redirect()->back()->with(['success','Status Created Successfully']);
    }
    public function destroyStatus($id)
    {
        Status::find($id)->delete();
        return redirect()->back()->with(['success','Status Deleted Successfully']);

    }
    public function storeTags(Request $request)
    {
        $status = new Tags();
        $status->name = $request->status;
        $status->save();
        return redirect()->back()->with(['success','Tags Created Successfully']);
    }
    public function destroyTags($id)
    {
        Tags::find($id)->delete();
        return redirect()->back()->with(['success','Tags Deleted Successfully']);

    }
    public function storePriority(Request $request)
    {
        $status = new Priority();
        $status->name = $request->status;
        $status->save();
        return redirect()->back()->with(['success','Priority Created Successfully']);
    }
    public function destroyPriority($id)
    {
        Priority::find($id)->delete();
        return redirect()->back()->with(['success','Priority Deleted Successfully']);

    }
}
