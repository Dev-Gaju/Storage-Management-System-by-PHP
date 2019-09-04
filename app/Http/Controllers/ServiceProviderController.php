<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Image;
use App\Booking;
use App\Service_provider;
use Auth;
use Illuminate\Support\Facades\Hash;
class ServiceProviderController extends Controller
{
	 public function __construct()
    {
    	$this->middleware('auth:service_provider');
    }
    protected function profile(){
         $provider = Service_provider::find(Auth::user()->id);
      return view('Provider.profile',compact('provider'));
    }
    protected function change_password(){
        return view('Provider.change_password');
    }
    protected function submit_password(Request $request){
               $data = $request->all();
        $current_password = Auth::User()->password;
        if(Hash::check($data['old_password'], $current_password))
      {           
        $user_id = Auth::User()->id;                       
        $obj_user = Service_provider::find($user_id);
        $obj_user->password = Hash::make($data['new_password']);;
        $obj_user->save(); 
         return redirect()->back()->with('message','Password Update successful !!');
      }
      else
      {   
           return redirect()->back()->with('error','Please enter correct current password !!');
      }
  }
    protected function change_profile(Request $request){
             $data = $request->all();
       $provider = Service_provider::find(Auth::user()->id);
       $provider->name = $data['name'];
       $provider->email = $data['email'];
       $provider->cold_storage_name = $data['cold_storage_name'];
       $provider->phone_no = $data['phone_no'];
       $provider->address = $data['address'];
       
        $provider->details = $data['details'];
         $provider->conditions = $data['condition'];
         
       $image = $request->file('photo');
         
          if($image !=NULL){
                if($provider->image){
                   unlink($provider->image);  
                 }
              $img = time().$data['email'].'.'.$image->getClientOriginalExtension();
               $destinationPath = public_path('/img/provider');
             $image->move($destinationPath, $img);
            $provider->image = 'img/provider/'.$img; 
         }
         //$data['photo']->storeAs('img/tutor', $image );
         if ($provider->save()) {
             return redirect()->back()->with('message','Profile Update successful !!');
         }
         else{
           return redirect()->back()->with('error','There have error!! please try again.');
         }
    }
    protected function home(){
    	return view('Provider.home');
    }
  protected function post_list(){
    $posts = Post::where('service_provider_id',Auth::user()->id)->get();
    $storage_name = Auth::user()->cold_storage_name;
    return view('Provider.post_list',compact('posts','storage_name'));
 }
    protected function give_post(){
     $provider = Service_provider::find(Auth::user()->id);
      return view('Provider.give_post',compact('provider'));
    }
    protected function submit_post(Request $request){
        $data=$request->all();
        $post =new Post; $i=0;
        $post->service_provider_id=Auth::user()->id;
        $post->save();$post_id=$post->id;

        $data['image'][0]->storeAs('public/post_image','a'.$post_id.'.jpg');
        $data['image'][1]->storeAs('public/post_image','b'.$post_id.'.jpg');
        $data['image'][2]->storeAs('public/post_image','c'.$post_id.'.jpg');
        $data['image'][3]->storeAs('public/post_image','d'.$post_id.'.jpg');

        $image_up=Image::insert([
                ['post_id' => $post_id,'image_name'=>'a'.$post_id.'.jpg'],
                ['post_id' => $post_id,'image_name'=>'b'.$post_id.'.jpg'],
                ['post_id' => $post_id,'image_name'=>'c'.$post_id.'.jpg'],
                ['post_id' => $post_id,'image_name'=>'d'.$post_id.'.jpg'],
                ]);

        $post=Post::find($post_id);
        foreach ($data as $key => $value) {
            if ($i>0) {
                if ($key !='image') {
                     $post->$key=$value;
                }
               
            }
            $i++;
        }
        if ($post->save()) {
            return redirect('provider/post_list');
        }
        else{
            return redirect()->back()->with('error', 'There have error !! Try Again !!');
        }
    }

    public function edit_post($id){
      $data = Post::find($id);
      return view('Provider.edit_post',compact('data'));
    }
    public function update_post(Request $request){
       $data=$request->all();
        $i=0;
        $image0= $request->file('image0');
        $image1= $request->file('image1');
        $image2= $request->file('image2');
        $image3= $request->file('image3');
        if($image0)
        $image0->storeAs('public/post_image','a'.$data['post_id'].'.jpg');
        if($image1)
        $image1->storeAs('public/post_image','b'.$data['post_id'].'.jpg');
       if($image2)
        $image2->storeAs('public/post_image','c'.$data['post_id'].'.jpg');
        if($image3)
        $image3->storeAs('public/post_image','d'.$data['post_id'].'.jpg');

        $post=Post::find($data['post_id']);
        foreach ($data as $key => $value) {
            if ($i>1) {
                if ($key !='image0' && $key !='image1' && $key !='image2' && $key !='image3') {
                     $post->$key=$value;
                }
               
            }
            $i++;
        }
        if ($post->save()) {
            return redirect('home');
        }
        else{
            return redirect()->back();
        }
    }

    public function delete_post(Request $request){
       $id = $request->id;
     $check=Post::where('id',$id)->count();
      if($check==1){
       /* unlink('storage/post_image','a'.$request->id.'.jpg');
        unlink('storage/post_image','b'.$request->id.'.jpg');
        unlink('storage/post_image','c'.$request->id.'.jpg');
        unlink('storage/post_image','d'.$request->id.'.jpg');*/
        Post::find($id)->delete();
        return '111';
      }
      return '000';
    }
    
    public function booking_list(){
        $posts = Post::where('service_provider_id',Auth::user()->id)->get();
        $post_id=array();
        foreach($posts as $post){
            $post_id[]=$post->id;
        }
        $bookings = Booking::whereIn('post_id',$post_id)->get(); 
        return view('Provider.booking_list',compact('bookings'));
    }
    
    public function update_booking_info(Request $request){
         $value = $request->value;
        $booking = Booking::find($value[0]['value']);
        if($value[1]['value'] != 'Unknown' && $value[1]['value'] != NULL){
            $booking->booking_for_days=$value[1]['value'];
        }
        $booking->provider_receive_product=$value[2]['value'];
        $booking->provider_deliver_product=$value[3]['value'];
        $booking->provider_status=$value[4]['value'];
        if($booking->save()){
            return '111';
        }
        else{
            return '000';
        }
    }
}
