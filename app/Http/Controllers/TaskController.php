<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Auth, Validator;
use Carbon\Carbon;


class TaskController extends Controller
{
    public function addTask(){
        return view('Task.add');
    }
    public function insertTask(Request $request){
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'due_date' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();;
        }
        $insert = new Task;
        $insert->user_id = Auth::user()->id;
        $insert->title = $request->title;
        $insert->description = $request->description;
        $insert->due_date = $request->due_date;
        $insert->status = $request->status;
        $insert->is_urgent = $request->is_urgent?$request->is_urgent : 0 ;
        $insert->save();

        return redirect()->route('home')->with('message','Task added successfully');
    }
    public function editTask($id){
        $find = Task::find($id);
        return view('Task.edit', compact('find'));
    }

    public function updateTask(Request $request){
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'due_date' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();;
        }

        $update = Task::where('id', $request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'is_urgent' => $request->is_urgent?$request->is_urgent : 0
        ]);
        if($update){
            return redirect()->route('home')->with('message','Task updated successfully');
        }
    }
    public function deleteTask ($id)
    {
        $find = Task::find($id);
        $find->delete();
        return redirect()->route('home')->with('message','Task deleted successfully');
    }
    public function completedTask($id)
    {
        $find = Task::find($id);
        $find->status = 3;
        $find->save();
        return redirect()->route('home')->with('message','Task deleted successfully');
    }

    public function test(Type $var = null)
    {
        $today = Carbon::now()->toDateString();
        $nextDay = Carbon::now()->addDays(1)->toDateString();

        $all = Task::with('userDetails')
                ->whereBetween('due_date', [$today, $nextDay])
                ->where('status', '!=', 3)
                ->get();
    }
}
