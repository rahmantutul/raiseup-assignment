<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function index(){
        return view('backend.pages.index'); die;
    }

    public function adminList(){
        $admins= Admin::all()->toArray();
        return view('backend.pages.admin.index')->with(compact('admins'));
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            //  dd($data);
            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status'=>1])){
                Toastr::success('Login successfully !','Success');
                return redirect('admin/dashboard');die;
            }else{
                Toastr::error('Invalid!', 'Password and email do not match!');
                return redirect()->back(); die;
            }
            
        }
        return view('backend.pages.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        Toastr::success('You are logged out!','Success');
        return redirect('/admin');die;
    }

   public function add(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $request->validate([
              'phone'=>'required|max:11',
              'password'=>'required|min:8',
              'email'=>'required|email',
              'name'=>'required',
              'type'=>'required',
            ]);
             if($request->hasFile('image'))
            {
             $image=$request->file('image');
             $currentDate=Carbon::now()->toDateString();
             $imageName=$currentDate.'-'.uniqid().'-'.$image->getClientOriginalExtension();

             if(!Storage::disk('public')->exists('images/admin'))
             {
                Storage::disk('public')->makeDirectory('images/admin');
             }

             $profileImage = Image::make($image)->resize(400,400)->stream();
             Storage::disk('public')->put('images/admin/'.$imageName,$profileImage);
            }else{
                $imageName= 'default.png';
            }
            $adminInfo=new Admin;
            $adminInfo->image=$imageName;
            $adminInfo->phone=$data['phone'];
            $adminInfo->name=$data['name'];
            $adminInfo->email=$data['email'];
            $adminInfo->type=$data['type'];
            $adminInfo->password=bcrypt($data['password']);
            $adminInfo->status=1;
            $adminInfo->save();
            Toastr::success('New admin added!','Success');
            return redirect('admin/index'); die;
        }
        return view('backend.pages.admin.add_admin');
    }

    public function edit(Request $request, $id){
        $adminInfo= Admin::find('id',$id);
        if($request->isMethod('post')){
            $data=$request->all();
            $request->validate([
              'phone'=>'required|max:11|min:11',
              'name'=>'required',
            ]);
             if($request->hasFile('image'))
            {
             $image=$request->file('image');
             $currentDate=Carbon::now()->toDateString();
             $imageName=$currentDate.'-'.uniqid().'-'.$image->getClientOriginalExtension();

             if(!Storage::disk('public')->exists('images/admin'))
             {
                Storage::disk('public')->makeDirectory('images/admin');
             }

             $profileImage = Image::make($image)->resize(400,400)->stream();
             Storage::disk('public')->put('images/admin/'.$imageName,$profileImage);
            }else{
                $imageName= $adminInfo['image'];
            }
            $adminInfo->image=$imageName;
            $adminInfo->phone=$data['phone'];
            $adminInfo->name=$data['name'];
            $adminInfo->save();
            Toastr::success('Information updated!','Success');
            return redirect()->back(); die;
        }
          return view('backend.pages.setting')->with(compact('adminInfo'));
    }
    
    public function delete($id){
         $data= Admin::find($id);
         if(Storage::disk('public')->exists('images/admin/'.$data->image))
        {
           Storage::disk('public')->delete('images/admin/'.$data->image);
        }
         $data->delete();
         Toastr::success('Success!','User deleted successfully!');
         return redirect()->back();
    }
    public function updatePassword(Request $request){
        $adminInfo= Admin::where('id',Auth::guard('admin')->user()->id)->first();
        if($request->isMethod('post')){
            $request->validate([
           'current'=>'required',
           'new'=>'required',
           'confirm'=>'required'
            ]);
            $data= $request->all();
            if(Hash::check($data['current'], Auth::guard('admin')->user()->password)){
                if($data['new']==$data['confirm']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new'])]);
                    Toastr::success('Success!', 'Password Updated Successfully!');
                    return back();die;
                }
            }else{
                Toastr::error('Invalid!', 'Passwords do match!');
                return redirect()->back(); die;
            }
        }
        return view('backend.pages.updatePassword')->with(compact('adminInfo'));
    }

    public function updateAdminStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            Admin::where('id',$data['admin_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['admin_id']]);
        }
    }

}
