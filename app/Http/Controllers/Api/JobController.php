<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
     public function index($id=null){
         if(empty($id)){
         $jobs= Job::get();
         return response()->json(["job"=>$jobs],200);
         }else{
         $job= Job::find($id);
         return response()->json(["job"=>$job],200);
         }
       
     }
     public function add(Request $request){
        if($request->isMethod('post')){
            $data=$request->input();
            //    dd($data);
            $rules=[
                'title'=>'required',
                'description'=>'required',
                'thumbnail'=>'image|mimes:jpeg,png|max:2024', //Max 2 mb
                'user_id'=>'required'
            ];
            $validator= Validator::make($data, $rules);
            if($validator->fails()){
                 return response()->json($validator->errors(),422);
            }
            if($request->hasFile('thumbnail'))
            {
                $filenameWithExt = $request->file('thumbnail')->getClientOriginalName ();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just Extension
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                // Filename To store
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                $request->file('thumbnail')->storeAs('public/images/job/', $fileNameToStore);
            }else{
                $fileNameToStore= 'default.png';
            }
           $jobs=New Job;
           $jobs->title=$data['title'];
           $jobs->description=$data['description'];
           $jobs->user_id=$data['user_id'];
           $jobs->thumbnail=$fileNameToStore;
           $jobs->status=1;
           $jobs->save();
           return response()->json(["massage"=>"New job added"],201);
        }
     }

       public function edit(Request $request, $id){
       if($request->isMethod('put')){
           $job=Job::find($id)->toArray();
           $data=$request->all();
            $rules=[
                'title'=>'required',
                'description'=>'required',
            ];
            $validator = Validator::make($data, $rules);
            if($validator->fails()){
                 return response()->json($validator->errors(),422);
            }
            if($request->hasFile('thumbnail'))
            {
             $filenameWithExt = $request->file('thumbnail')->getClientOriginalName ();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just Extension
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                // Filename To store
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                $request->file('thumbnail')->storeAs('public/images/job/', $fileNameToStore);
            }else{
                $fileNameToStore= $job['thumbnail'];
            }
           Job::where('id',$id)->update(['title'=>$data['title'],'description'=>$data['description'],'thumbnail'=>$fileNameToStore]);
           return response()->json(["massage"=>"Job updated"],202);
       }
    }
    public function delete($id){
        $data=Job::find($id); 
        $data->delete();
        return response()->json(["massage"=>"Job deleted"],202);
    }
    public function updateStatus(Request $request,$id){
        if($request->isMethod('post')){
            $data=$request->input();
            Job::where('id',$id)->update(['status'=>$data['status']]);
            if($data['status']==1){
               return response()->json(["massage"=>"Job enabled"],201);
            }else{
                 return response()->json(["massage"=>"Job disabled"],201);
            }
            
            
        }
    }
}
