<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Service_provider;
class ViewDetailsController extends Controller
{
	protected function index(){
		 $service_providers = Service_provider::where('block',0)->get();
		$provider_id =array();
		foreach ($service_providers as $service_provider) {
		 	$provider_id[]=$service_provider->id;
		 } 
	    $posts = Post::where('approve',1)->whereIn('service_provider_id',$provider_id)->paginate(9);
		return view('welcome',compact('posts'));
	}
    protected function view_details($id){
    	$data = Post::find($id);
    	return view('view_details',compact('data'));
    }
    
    protected function search(Request $request){
        $address = $request->input('address');
        $range = $request->input('range');
        $range = explode(";",$range);
        
        $service_providers = Service_provider::where('block',0)->get();
		$provider_id =array();
		foreach ($service_providers as $service_provider) {
		 	$provider_id[]=$service_provider->id;
		 } 
		 if($address == NULL){
		     $posts = Post::where('approve',1)->whereIn('service_provider_id',$provider_id)->where('rent','<=', $range[1])->paginate(9);
		 }
		 else{
		     $posts = Post::where('approve',1)->whereIn('service_provider_id',$provider_id)->where('rent','<=', $range[1])->where('address','like','%'.$address.'%')->paginate(9);
		 }
	    
		return view('welcome',compact('posts'));
        
    }
    
    protected function about_us(){
        return view('about_us');
    }
}
