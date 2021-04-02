<?php

namespace App\Http\Controllers;


use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use function GuzzleHttp\Promise\all;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $tasks = Task::all();

        return view('home',['tasks'=>$tasks]);
    }

    public function upload(Request $request)
    {
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images',$filename,'public');
            $this->deleteOldImg();
            Auth()->user()->update(['image'=>$filename]);

            Alert::toast('Uploaded!', 'success');
            return redirect()->back();

        }else{
            Alert::toast('Upload Failed!','error');
            return redirect()->back();
        }

    }

    protected function deleteOldImg(){
        if(auth()->user()->image){
            Storage::delete('/public/images/'. auth()->user()->image);
        }
    }

    public function addTask(Request $request){
        Task::updateOrCreate([
            "title" =>$request->title,
            "body"=>$request->body,
        ]);

        Alert::toast('Task saved!','success');
        return redirect()->back();
    }

    public function editTask(Request $request, $id){
        Task::where('id',$id)->update([
            "title" => $request->uTitle,
            "body" => $request->uBody
        ]);

        Alert::toast('Task Updated!','success');
        return redirect()->back();
    }

    public function deleteTask($id){
        $task = Task::find($id);
        $task->delete();

        Alert::toast('Task deleted!','warning');
        return redirect()->back();
    }

}
