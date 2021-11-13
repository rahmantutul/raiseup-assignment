<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(){
       $jobs=Job::with('user')->get()->toArray();
    //    dd($jobs);
       return view('backend.pages.Jobs.index')->with(compact('jobs'));
    }
    public function single($id){
       $singleJob=Job::find($id);
    //    dd($singleJob);
       return view('backend.pages.Jobs.single')->with(compact('singleJob'));
    }
   public function add(Request $request){
       if($request->isMethod('post')){
           $data=$request->all();
        //    dd($data);
            $request->validate([
               'title'=>'required',
               'description'=>'required',
               'thumbnail'=>'image|mimes:jpeg,png|max:2024' //Max 2 mb
            ]);
            if($request->hasFile('thumbnail'))
            {
             $image=$request->file('thumbnail');
             $currentDate=Carbon::now()->toDateString();
             $imageName=$currentDate.'-'.uniqid().'-'.$image->getClientOriginalExtension();

             if(!Storage::disk('public')->exists('images/Job'))
             {
                Storage::disk('public')->makeDirectory('images/Job');
             }

             $JobsImage = Image::make($image)->resize(500,400)->stream();
             Storage::disk('public')->put('images/Job/'.$imageName,$JobsImage);
            }else{
                $imageName= 'default.png';
            }
           $jobs=New Job;
           $jobs->title=$data['title'];
           $jobs->description=$data['description'];
           $jobs->user_id=Auth::guard('admin')->user()->id;
           $jobs->thumbnail=$imageName;
           $jobs->status=1;
           $jobs->save();
           Toastr::success('Success!','New Job Added!');
           return redirect('admin/job/index');die;
       }
       return view('backend.pages.Jobs.add');
   }
   public function edit(Request $request, $id){
       $job=Job::find($id);
       if($request->isMethod('post')){
           $data=$request->all();
        //    dd($data);
            $request->validate([
               'title'=>'required',
               'description'=>'required',
               'thumbnail'=>'image|mimes:jpeg,png|max:2024' //Max 2 mb
            ]);
            if($request->hasFile('thumbnail'))
            {
             $image=$request->file('thumbnail');
             $currentDate=Carbon::now()->toDateString();
             $imageName=$currentDate.'-'.uniqid().'-'.$image->getClientOriginalExtension();

             if(!Storage::disk('public')->exists('images/Job'))
             {
                Storage::disk('public')->makeDirectory('images/Job');
             }
            if(Storage::disk('public')->exists('images/job/'.$job->image))
            {
            Storage::disk('public')->delete('images/job/'.$job->image);
            }
             $JobsImage = Image::make($image)->resize(500,400)->stream();
             Storage::disk('public')->put('images/Job/'.$imageName,$JobsImage);
            }else{
                $imageName= $job['thumbnail'];
            }
           $job->title=$data['title'];
           $job->description=$data['description'];
           $job->user_id=Auth::guard('admin')->user()->id;
           $job->thumbnail=$imageName;
           $job->status=1;
           $job->save();
           Toastr::success('Success!','Job updated!');
           return redirect('admin/job/index');die;
       }
       return view('backend.pages.Jobs.edit')->with(compact('job'));
   }
   public function delete($id){
       $data=Job::find($id);
        if(Storage::disk('public')->exists('images/job/'.$data->image))
        {
           Storage::disk('public')->delete('images/job/'.$data->image);
        }
      $data->delete();
      Toastr::success('Success!','Job Deleted!');
      return redirect('admin/job/index');die;
   }
     public function updateJobStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            Job::where('id',$data['job_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['job_id']]);
        }

    }
}
