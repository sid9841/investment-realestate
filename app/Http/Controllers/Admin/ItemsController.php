<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;

class ItemsController extends Controller
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
        $items = Items::orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.items.list', compact('items'));
    }
    public function create(Request $request){

        $reqData = Purify::clean($request->except('_token', '_method'));
        Items::create([
            'title'=>$reqData['description'],
            'long_description'=>$reqData['long_description'],
            'rate'=>$reqData['rate'],
            'unit'=>$reqData['unit'],
            'item_group'=>$reqData['item_group'],
        ]);

        return back()->with('success', 'Item created successfully!');


    }
    public function getItemInfo(Request $request)
    {
        $item = Items::find($request->dataid);
        return response()->json($item);
    }
    public function update(Request $request,$id){
        $item=Items::find($id);
        $reqData = Purify::clean($request->except('_token', '_method'));
        $item->update([
            'title'=>$reqData['description'],
            'long_description'=>$reqData['long_description'],
            'rate'=>$reqData['rate'],
            'unit'=>$reqData['unit'],
            'item_group'=>$reqData['item_group'],
        ]);

        return back()->with('success', 'Item updated successfully!');
    }
    public function destroy($id)
    {
        $item = Items::findOrFail($id);
        $item->delete();
        return back()->with('success', __('Item has been deleted'));
    }
}
