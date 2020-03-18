<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ToDo;
use App\Models\Timespend;
use App\Models\Files;
use App\Models\Comment;
use App\Models\Formula;
use App\Models\Client;
use App\User;
use Auth;
use Carbon\Carbon;

use App\Models\ToDoTracker;
use DB;
class TodoController extends Controller
{

    public function index()
    {
        $todos = ToDo::paginate(20);
        $tracker = DB::table("to_do_trackers")
                  ->select('to_do_trackers.*','users.first_name','users.last_name','to_dos.name')
                  ->join('users','users.id','=','to_do_trackers.user_id')
                  ->join('to_dos','to_dos.id','=','to_do_trackers.todo_id')
                  ->paginate(10);
        //echo "<pre>";print_r($tracker);die;
        return view('todo.index', compact('todos','tracker'));
    }

    public function create()
    {
        $users    = new User;
        $users    = $users->getAllUsers();
        $formulas = Formula::all();
        $clients  = Client::all();
        return view('todo.create',compact('users', 'formulas', 'clients'));
    }

    public function store(Request $request)
    {
        $rules = ['name' => 'required', 'user' => 'required', 'client' => 'required', 'formula' => 'required'];
        $request->validate($rules);

        $data = [
          'name'        => $request->name,
          'description' => $request->description,
          'user_id'     => $request->user,
          'formula_id'  => $request->formula,
          'client_id'   => $request->client,
        ];

        $todo = ToDo::create($data);
        return redirect()->route('todo.index')->with(['success' => 'Todo added SuccessFully']);

    }

    public function show($id)
    {
        $users      = new User;
        $users      = $users->getAllUsers();
        $timespends = Timespend::get();
        $todo       = ToDo::findOrFail($id);
        $formulas   = Formula::all();
        $clients    = Client::all();

        $data = [
          'todo'       => $todo,
          'users'      => $users,
          'timespends' => $timespends,
          'clients'    => $clients,
          'formulas'   => $formulas,
        ];

        return view('todo.show', $data);
    }

    public function edit(ToDo $todo)
    {
      $users    = new User;
      $users    = $users->getAllUsers();
      $formulas = Formula::all();
      $clients  = Client::all();
      return view('todo.edit', compact('todo', 'users', 'formulas', 'clients'));
    }

    public function update(Request $request, ToDo $todo)
    {
        $rules = ['name' => 'required', 'user' => 'required', 'client' => 'required', 'formula' => 'required'];
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
          return redirect()->back()->with(['form_error' => 'myModal'])->withErrors($validator->errors());
        }

        $data = [
          'name'        => $request->name,
          'description' => $request->description,
          'user_id'     => $request->user,
          'formula_id'  => $request->formula,
          'client_id'   => $request->client ,
        ];

        $todo->update($data);
        return redirect()->back()->with(['success' => 'Todo Updated SuccessFully']);
    }

    public function destroy($id)
    {
        $todo = ToDo::findOrFail($id);
        $todo->delete();
        return response(['success' => 'Todo Deleted successfully']);
    }

    public function fileupload(Request $request, $id)
    {
        $rules = ['files' => 'required'];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
          return redirect()->back()->with(['form_error' => 'fileUploadModal' ])->withErrors($validator->errors())->withInput();
        }

        foreach ($request->file('files') as $key => $file) {
          $path = $this->storeFile($file);
          $uploadfile = Files::create(['path' => $path, 'type' => 'todos', 'refrence_id' => $id]);
        }

        return redirect()->back()->with(['success' => 'File Added SuccessFully']);
    }

    public function timespend(Request $request, $id)
    {
      $rules = [
        'start_date'         => 'required',
        'start_time'         => 'required',
        'end_time'           => 'required',
        'timespend_hour'     => 'required',
        'timespend_minuts'   => 'required',
      ];

      $validator = Validator::make($request->all(),$rules);

      if($validator->fails()) {
        return redirect()->back()->with(['form_error' => 'timeSpendModal'])->withErrors($validator->errors())->withInput();
      }

      $data = [
        'user_id'      => $request->user,
        'todo_id'      => $id,
        'start_date'   => $request->start_date,
        'start_time'   => $request->start_time,
        'end_time'     => $request->end_time,
        'hours'        => $request->timespend_hour,
        'minuts'       => $request->timespend_minuts,
        'description'  => $request->description,
      ];
      if($request->has('billable'))
      {
        $data['billable'] = 1;
      }
        Timespend::create($data);
        return redirect()->back()->with(['success' => 'Time Added SuccessFully']);
    }

    public function comment(Request $request, $id)
    {
        $user  = Auth::user();
        $rules = [
          'content' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
          return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $data = [
          'content'      => $request->content,
          'user_id'      => $user->id,
          'type_id'      => $id,
          'type'         => 'todo',
        ];
          Comment::create($data);
          return redirect()->back();
      }

      public function toDoTrackerStartProject(Request $request)
      {
         $data=$request->all(); 
         //echo "<pre>";print_r($data);die;       
         if($data['toDoId']!='')
         {
            $date =date('Y:m:d');           
            $todos = ToDo::where('id',$data['toDoId'])->first();
              
            $dataTimeSpend = [
                          'user_id'      => $todos->user_id,
                          'todo_id'      => $data['toDoId'],
                          'start_date'   => $date,
                          'start_time'   => $data['timeStart'],
                          
                        ];
            Timespend::create($dataTimeSpend);
            
            echo "1";die;          
         } 
      }

      public function toDoTrackerEndProject(Request $request)
      {
         $data=$request->all();
         //echo "<pre>";print_r($data);        
         if($data['toDoId']!='')
         {
                $date =date('Y:m:d');           
                $todos = ToDo::where('id',$data['toDoId'])->first();
                $time=explode(":",$data['gValue']);
                $hour=$time[0];
                $min =$time[1];
                $sec =$time[2];
                 
                $Timespend=Timespend::where('todo_id',$data['toDoId'])->orderBy('id','desc')->first();
                $Timespend->end_time =$data['timeEnd'];
                $Timespend->hours    =$hour;
                $Timespend->minuts   =$min;
                $Timespend->sec      =$sec;
                $Timespend->id       =$Timespend->id;
                $Timespend->save(); 

                if($request->ajax())
                {
                  $track = DB::table("timespends")
                            ->select('timespends.*','users.first_name','users.last_name','to_dos.name')
                            ->join('users','users.id','=','timespends.user_id')
                            ->join('to_dos','to_dos.id','=','timespends.todo_id')
                            ->get();
                  //echo "<pre>";print_r($track);die;    
                  return view('todo.toDoTimeSpend',compact('track'))->render();
                }               

            
                        
         } 
      }
}
