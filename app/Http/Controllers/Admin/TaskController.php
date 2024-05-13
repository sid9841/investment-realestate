<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Contract;
use App\Models\Priority;
use App\Models\Status;
use App\Models\Tags;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

class TaskController extends Controller
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
        $customers = Admin::get();
        $priority = Priority::get();
        $tags = Tags::get();
        $status = Status::get();
        $tasks = Task::orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.tasks.list', compact('tasks','customers','priority','tags','status'));
    }
    public function store(Request $request)
    {
        $reqData = Purify::clean($request->except('_token', '_method'));
        Task::create(
            [
                'subject'=>$reqData['subject'],
                'hourly_rate'=>$reqData['hourly_rate'],
                'start_date'=>$reqData['issue_date'],
                'due_date'=>$reqData['open_till_date'],
                'assigned_users'=>$reqData['assigned_to'],
                'tags'=>$reqData['tags'],
                'priority'=>$reqData['priority'],
                'filepath'=>$reqData['filepath'],
                'task_description'=>$reqData['description'],
                'status'=>0,
            ]

        );
        return back()->with('success', 'Task created successfully!');

    }
    public function getTaskInfo(Request $request){
        $task = Task::with('statusD','priorityD','assigned')->find($request->dataid);
        return $task;

    }
    public function update(Request $request,$id)
    {
        $task = Task::find($id);
        $reqData = Purify::clean($request->except('_token', '_method'));
        $task->update(
            [
                'subject'=>$reqData['subject'],
                'hourly_rate'=>$reqData['hourly_rate'],
                'start_date'=>$reqData['issue_date'],
                'due_date'=>$reqData['open_till_date'],
                'assigned_users'=>$reqData['assigned_to'],
                'tags'=>$reqData['tags'],
                'priority'=>$reqData['priority'],
                'filepath'=>$reqData['filepath'],
                'task_description'=>$reqData['description'],
                'status'=>$reqData['status'],
            ]

        );
        return back()->with('success', 'Task updated successfully!');

    }
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return back()->with('success', __('Task has been deleted'));
    }
}
