<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
use DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Task::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        if($row['status'] == 1){
                            return '<span class="badge badge-primary">TODO</span>';
                        }else if($row['status'] == 2){
                            return '<span class="badge badge-success">IN PROCESS</span>';
                        }else{
                            return '<span class="badge badge-info">COMPLETED</span>';
                         }
                    })
                    ->addColumn('is_urgent', function($row){
                        if($row['is_urgent'] == 1){
                            return '<span class="badge badge-warning">On priority</span>';
                        }else{
                            return '<span class="badge badge-success">Non-priority</span>';
                        }
                    })
                    ->addColumn('action', function($data) {
 
                        $btn = '<div class="btn-group" role="group" >';
                        $btn .='<a href="' . route('edit.task', [$data->id]) . '" class="btn-sm edit btn-info"><i class="fa-solid fa-pen-to-square"></i> Edit</a>&nbsp;';
                        $btn .='<a href="' . route('delete.task', [$data->id]) . '" class="btn-sm records btn-danger delete"><i class="fa-solid fa-trash"></i> Delete</a>&nbsp;';
                        if($data->status == 3){
                            $btn.='<a href="' . route('completed.task', [$data->id]) . '" class="btn-sm records btn-secondary completed disabled"><i class="fa-solid fa-check"></i> Mark as completed</a>';
                        } else {
                            $btn .='<a href="' . route('completed.task', [$data->id]) . '" class="btn-sm records btn-success completed"><i class="fa-solid fa-check"></i> Mark as completed</a>';
                        }
                        $btn .= '</div>';
                    
                        return $btn;
                    })
                    ->filter(function ($instance) use ($request) {
                        if ($request->get('status') != 0) {
                            $instance->where('status', $request->get('status'));
                        }
                        if($request->get('priority') == 1){
                            $instance->where('is_urgent', 1);
                        }
                        if($request->get('priority') == 2){
                            $instance->where('is_urgent', 0 );
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('title', 'LIKE', "%$search%")
                                ->orWhere('description', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->rawColumns(['status', 'is_urgent', 'action'])
                    ->make(true);
        }
        $today = Carbon::now()->toDateString();
        $nextDay = Carbon::now()->addDays(1)->toDateString();
        $imptasks = Task::whereBetween('due_date', [$today, $nextDay])
                ->where('status', '!=', 3)
                ->get();
        return view('home', compact('imptasks'));
    }
}
