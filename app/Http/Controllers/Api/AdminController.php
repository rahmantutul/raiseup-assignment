<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
     public function index($id){
         if(empty($id)){
         $users= Admin::get();
         return response()->json(["users"=>$users],200);
         }else{
         $users= Admin::find($id);
         return response()->json(["users"=>$users],200);
         }
       
     }
      public function add(Request $request){
        if($request->isMethod('post')){
            $data=$request->input();
             $rules=[
                'name'=>'required',
                'email'=>'required|email|unique:admins',
                'phone'=>'required|max:11',
                'password'=>'required|min:8',
                'type'=>'required',
                'image'=>'image'
            ];
             $validator= Validator::make($data, $rules);
            if($validator->fails()){
                 return response()->json($validator->errors(),422);
            }
             if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $fileName = $image->getClientOriginalName();
                $destinationPath = base_path() . '/public/images/admin/' . $fileName;
                $image->move($destinationPath, $fileName);                  
            }else{
                $fileName= 'default.png';
            }
            $adminInfo=new Admin;
            $adminInfo->name=$data['name'];
            $adminInfo->email=$data['email'];
            $adminInfo->phone=$data['phone'];
            $adminInfo->type=$data['type'];
            $adminInfo->password=bcrypt($data['password']);
            $adminInfo->image=$fileName;
            $adminInfo->status=1;
            $adminInfo->save();
            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])){
                $user= Admin::where('email',$data['email'])->first();
                // Generate passport token
                $accessToken= $user->createToken($data['email'])->accessToken;
                Admin::where('email',$data['email'])->update(['access_token'=>$accessToken]);
                return response()->json(['status'=>false,'massage'=>'Registered successfully!','access_token'=>$accessToken],201);
            }else{
                 return response()->json(['status'=>false,'massage'=>'Something is wrong!'],422);
            }
            return response()->json(["massage"=>"New user added"],201);
        }
    }
    public function edit(Request $request, $id){
        if($request->isMethod('post')){
            $adminInfo= Admin::find('id',$id);
            $data=$request->all();
            $request->validate([
              'phone'=>'required|max:11|min:11',
              'name'=>'required',
            ]);
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $fileName = $image->getClientOriginalName();
                $destinationPath = base_path() . '/public/images/admin/' . $fileName;
                $image->move($destinationPath, $fileName);                  
            }else{
                $fileName= $adminInfo['image'];
            }
            $adminInfo->image=$fileName;
            $adminInfo->name=$data['name'];
            $adminInfo->phone=$data['phone'];
            $adminInfo->save();
            return response()->json(['massage'=>'Info updated!'],201);
        }
    }
    public function login(Request $request){
        if($request->isMethod('post')){
        $data=$request->input();
            $rules=[
            'email'=>'required|email|exists:admins',
            'password'=>'required',
            ];
        $customMassage=[
            'email.required'=>"Fill email box is must",
            'email.email'=>"Enter valid email",
            'email.exists'=>"Email does not exist",
            'password.required'=>"Give a password",
        ];
        $validator=Validator::make($data, $rules, $customMassage);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])){
            $user= Admin::where('email',$data['email'])->first();
            $accessToken= $user->createToken($data['email'])->accessToken;
            Admin::where('email',$data['email'])->update(['access_token'=>$accessToken]);
            return response()->json(['massage'=>'login successfully!','access_token'=>$accessToken],201);
        }else{
                return response()->json(['massage'=>'Incorrect email and password!'],422);
        }
        }
    }
}
