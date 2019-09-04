<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service_provider;
use App\Post;
use Auth;
use App\Admin;
use App\User;
use App\Booking;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
   public function __construct()
    {
    	$this->middleware('auth:admin');
    }
   protected function home(){
       $Service_provider = Service_provider::count();
       $customer = User::count();
       $post = Post::count();
       $booking = Booking::count();
    	return view('Admin.home',compact('Service_provider','customer','post','booking'));
    }
  protected function delete_customer(Request $request){
  	 $local_admin = User::find($request->id);
  	 if ($local_admin->delete()) {
  	 	return '111';
  	 }
  	 return '000';
  }
   protected function local_admin_list(){
   	$local_admins  = Service_provider::all();
   	return view('Admin.local_admin_list',compact('local_admins'));
   }
   
   protected function customer_list(){
       	$customers  = User::all();
   	return view('Admin.customer_list',compact('customers')); 
   }
   protected function update_local_admin($id){
   	 	$local_admin  = Service_provider::find($id);
   	 	return view('Admin.update_local_admin',compact('local_admin'));
   } 
   protected function update_customer($id){
   	 	$customer  = User::find($id);
   	 	return view('Admin.update_customer',compact('customer'));
   }
   protected function update_local_admin_info(Request $request){
   	 $data = $request->all();
   	 $local_admin = Service_provider::find($data['id']);
   	 $local_admin->name = $data['name'];
   	 $local_admin->email = $data['email'];
   	 $local_admin->phone_no = $data['phone_no'];
   	 $local_admin->cold_storage_name = $data['cold_storage_name'];
   	 $local_admin->block = $data['block'];
   	 if(!empty($data['password']))
   	 $local_admin->password = Hash::make($data['password']);

   	if ($local_admin->save()) {
   	  return redirect('admin/local_admin_list');
   	}
   	return redirect()->back()->with('error', 'There have error !! Try Again !!');
   } 
   protected function update_customer_info(Request $request){
   	 $data = $request->all();
   	 $customer = User::find($data['id']);
   	 $customer->name = $data['name'];
   	 $customer->email = $data['email'];
   	 $customer->phone_no = $data['phone_no'];
   	 $customer->block = $data['block'];
   	 if(!empty($data['password']))
   	 $customer->password = Hash::make($data['password']);

   	if ($customer->save()) {
   	  return redirect('admin/customer_list');
   	}
   	return redirect()->back()->with('error', 'There have error !! Try Again !!');
   }
   protected function new_local_admin(){
    return view('Admin.new_local_admin');
   }
   protected function booking_list(){
       $bookings = Booking::all();
    return view('Admin.booking_list',compact('bookings'));
   }
   protected function add_new_customer(){
    return view('Admin.add_new_customer');
   }
   protected function new_local_admin_info(Request $request){
   	$data = $request->all();
   	$local_admin = new Service_provider;
   	 $local_admin->name = $data['name'];
   	 $local_admin->email = $data['email'];
   	 $local_admin->phone_no = $data['phone_no'];
   	 $local_admin->cold_storage_name = $data['cold_storage_name'];
   	 $local_admin->block = $data['block'];
   	 $local_admin->password = Hash::make($data['password']);
   	if ($local_admin->save()) {
   	  return redirect('admin/local_admin_list');
   	}
   	return redirect()->back()->with('error', 'There have error !! Try Again !!');
   } 
   protected function new_customer_info(Request $request){
   	$data = $request->all();
   	$customer = new User;
   	 $customer->name = $data['name'];
   	 $customer->email = $data['email'];
   	 $customer->phone_no = $data['phone_no'];
   	 $customer->block = $data['block'];
   	 $customer->password = Hash::make($data['password']);
   	if ($customer->save()) {
   	  return redirect('admin/customer_list');
   	}
   	return redirect()->back()->with('error', 'There have error !! Try Again !!');
   }
  protected function delete_local_admin(Request $request){
  	 $local_admin = Service_provider::find($request->id);
  	 if ($local_admin->delete()) {
  	 	return '111';
  	 }
  	 return '000';
  }

  protected function post_list(){
    $posts = Post::all();
    return view('Common.post_list',compact('posts'));
  }
  protected function update_post(Request $request){
    $value = $request->value;
    $post = Post::find($value[0]['value']);
    $post->rent = $value[1]['value'];
    $post->approve = $value[2]['value'];
    if ($post->save()) {
      $data=array();
      if($value[2]['value'] == 0){ $data[0]='<span style="color: #33d40d">Pending..</span>';}
      elseif($value[2]['value'] == 1){$data[0]='<span style="color: #3629e2e3">Approved</span>';}
      else {$data[0]='<span style="color: #ef1414e0">Rejected</span>';}
        $data[1] = $value[1]['value'];
      return $data;
    }
    $data[0] = '000';
    return $data;
  }

  protected function delete_post(Request $request){
    $id = $request->id;
     $check=Post::where('id',$id)->count();
      if($check==1){
        unlink('storage/post_image','a'.$request->id.'.jpg');
        unlink('storage/post_image','b'.$request->id.'.jpg');
        unlink('storage/post_image','c'.$request->id.'.jpg');
        unlink('storage/post_image','d'.$request->id.'.jpg');
        Post::find($id)->delete();
        return '111';
      }
      return '000';
  }
  
  protected function profile(){
      $admin = Admin::find(Auth::user()->id);
      return view('Admin.profile',compact('admin'));
  }
  
  protected function admin_profile(Request $request){
      $data = $request->all();
       $admin = Admin::find($data['id']);
       $admin->name = $data['name'];
       $admin->email = $data['email'];
       $image = $request->file('photo');
          
          if($image !=NULL){
               if($admin->image){
               unlink($admin->image);  
             }
              $img = time().$data['email'].'.'.$image->getClientOriginalExtension();
               $destinationPath = public_path('/img/admin');
             $image->move($destinationPath, $img);
            $admin->image = 'img/admin/'.$img; 
         }
         //$data['photo']->storeAs('img/tutor', $image );
         if ($admin->save()) {
             return redirect()->back()->with('message','Profile Update successful !!');
         }
         else{
           return redirect()->back()->with('error','There have error!! please try again.');
         }
  }
  
  protected function change_password(){
      return view('Admin.change_password');
  }
  protected function submit_password(Request $request){
               $data = $request->all();
        $current_password = Auth::User()->password;
        if(Hash::check($data['old_password'], $current_password))
      {           
        $user_id = Auth::User()->id;                       
        $obj_user = Admin::find($user_id);
        $obj_user->password = Hash::make($data['new_password']);;
        $obj_user->save(); 
         return redirect()->back()->with('message','Password Update successful !!');
      }
      else
      {   
           return redirect()->back()->with('error','Please enter correct current password !!');
      }
  }
}
