<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Booking_code;
use App\Booking;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;

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
    public function index()
    {
        return view('Customer.home');
    }
    //..............................
     protected function profile(){
         $user = User::find(Auth::user()->id);
      return view('Customer.profile',compact('user'));
    }
    protected function change_password(){
        return view('Customer.change_password');
    }
    protected function submit_password(Request $request){
               $data = $request->all();
        $current_password = Auth::User()->password;
        if(Hash::check($data['old_password'], $current_password))
      {           
        $user_id = Auth::User()->id;                       
        $obj_user = User::find($user_id);
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
       $provider = User::find(Auth::user()->id);
       $provider->name = $data['name'];
       $provider->email = $data['email'];
       $provider->phone_no = $data['phone_no'];
       $provider->address = $data['address'];
       $image = $request->file('photo');
         
          if($image !=NULL){
                if($provider->image){
                   unlink($provider->image);  
                 }
              $img = time().$data['email'].'.'.$image->getClientOriginalExtension();
               $destinationPath = public_path('/img/customer');
             $image->move($destinationPath, $img);
            $provider->image = 'img/customer/'.$img; 
         }
         //$data['photo']->storeAs('img/tutor', $image );
         if ($provider->save()) {
             return redirect()->back()->with('message','Profile Update successful !!');
         }
         else{
           return redirect()->back()->with('error','There have error!! please try again.');
         }
    }
    //......................................
    public function booking($id){
        $post = Post::find($id);
        return view('Customer.booking',compact('post'));
    }
    
    public function submit_booking(Request $request){
         $data= $request->all();
        $booking = new Booking;
        $booking->post_id=$data['post_id'];
        $booking->user_id=Auth::user()->id;
        $booking->square_fit=$data['square_fit'];
        $booking->amount=$data['rent'];
        if($data['days'] !=null){
        $booking->booking_for_days=$data['days'];
        }
        if($booking->save()){
                    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
                    srand((double)microtime()*1000000); 
                    $i = 0; 
                    $pass = '' ; 
                
                    while ($i <= 7) { 
                        $num = rand() % 33; 
                        $tmp = substr($chars, $num, 1); 
                        $pass = $pass . $tmp; 
                        $i++; 
                    }
            $booking_code = new Booking_code;
            $booking_code->booking_id = $booking->id;
            $booking_code->code = $pass;
            $booking_code->save();

            $msg = 'Your booking is successfull and your booking code is '.$pass;
            return redirect('booking_list')->with('message',$msg);
        }
        else{
            return redirect()->back()->with('error','There have error ,,Please try again !!');
        }
        
    }
    
    public function booking_list(){
        $bookings = Booking::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get(); 
        return view('Customer.booking_list',compact('bookings'));
    }
}
