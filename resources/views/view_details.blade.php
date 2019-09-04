@extends('layouts.app')

@section('content')
<style type="text/css">#view{padding: 10px;}
</style>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6Lqq7Bmw0TcsWSAmrc7-TAc-I75b7_Q0&callback=initMap"
    async defer></script>
  <script src="{{url('js/gmaps.min.js')}}"></script>
   <style type="text/css">
    #map {
    	margin-top: 50px;
    	margin-bottom: 50px;
    	padding: 10px;
      width: 100%;
      height: 500px;
    }
  </style>
  
 <div class="container" >
 	<div class="row">
 		<div class="col-md-12 ">
 			<div class="row"><div class="col-md-12">Home->{{$data->service_provider->cold_storage_name}}</div></div>
 			<div class="row" id="view" style="background-color: white;margin-top: 10px;">
 				<div class="col-md-12"><h1>{{$data->service_provider->cold_storage_name}}</h1><p>{{$data->address}}</p></div>
 				<div class="col-md-9">
 					<div class="row">
 			{{--slider start......--}}
 			 		<div class="col-md-12" style="height: 470px;">

            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="{{url('storage/post_image/a'.$data->id.'.jpg')}}" alt="First slide" height="470px">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{url('storage/post_image/b'.$data->id.'.jpg')}}" alt="Second slide" height="470px">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{url('storage/post_image/c'.$data->id.'.jpg')}}" alt="Third slide" height="470px">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{url('storage/post_image/d'.$data->id.'.jpg')}}" alt="Fourth slide" height="470px">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

							</div>
                  {{--slider end......--}}
                  	
                  		<div class="col-md-10" style="margin-top: 20px;">
                  			 <img src="{{url('storage/post_image/a'.$data->id.'.jpg')}}" alt="..." style="width: 80px;height: 80px;">
                  			 <img src="{{url('storage/post_image/b'.$data->id.'.jpg')}}" alt="..." style="width: 50px;height: 50px;">
                         <img src="{{url('storage/post_image/c'.$data->id.'.jpg')}}" alt="..." style="width: 50px;height: 50px;">
                  			 <img src="{{url('storage/post_image/d'.$data->id.'.jpg')}}" alt="..." style="width: 50px;height: 50px;">
                  		</div>
                      <div class="col-md-2">
                        <a class="btn btn-primary" style="margin-top: 20px;" href="{{route('booking',$data->id)}}">Booking</a>
                      </div>

                  		<div class="col-md-12">
                  			<div class="row">
                  				 <div class="col-md-12">
                  				 	<img src="{{url('img/tk.png')}}" style="margin-top: 15px;position: relative;"><span style="position: absolute;margin-left: -105px;margin-top: 22px;color: black">TK {{$data->rent}}</span>
                  				 </div>	
                  				<div class="col-md-12">
                  					<h2>Details</h2><hr>
                  					{!!$data->details!!}

                  					<hr>
                  				</div>

                  				<div class="col-md-12">
                  					<h2>Conditions</h2><hr>
                             {!!$data->condition!!}<hr>
                  				</div>


                  				<div class="col-md-12">
                  					<p><b>Number of Room :</b> {{$data->room}} &nbsp;&nbsp;<b>Room Size:</b> {{$data->room_size}}</p>
                  				</div>

                  				<div class="col-md-12">
                  					<h3>Contact</h3><hr>
                                     <i class="fa fa-phone" aria-hidden="true" style="font-size: 22px;"></i><span style="margin-left: 10px;">Phone : {{$data->service_provider->phone_no}},&nbsp;&nbsp; Email : {{$data->service_provider->email}}</span>
                  				</div>
	@if($data->latitude !=NULL && $data->longitude !=NULL)
		<div class="col-md-12">
           <div id="map"></div>
    <script>
 $(function () {

   var map = new GMaps({
        div: '#map',
        lat: {{$data->latitude}},
        lng: {{$data->longitude}},
        zoom:12,
      });

      map.addMarker({
        lat: {{$data->latitude}},
        lng: {{$data->longitude}},
        title: '{{$data->address}}',
        
      });


});
    </script>
</div>
@endif 
                  			</div>	
                  		</div>


 					</div>
 				</div>
 				<div class="col-md-3">
 				    <div style="position:fixed;width: 20%" id="block-menu">
 					<hr>
 					<h4 style="margin-left: 10px;">Contact</h4>
 					<div class="card" style="border:2px solid #2BAF6C;">
  <div class="card-body">
    <p class="card-text"></p>
        <div class="row">
            <div class="col-md-3">
        @if($data->photo !=Null)
        <img src=""  style="width:50px;height:50px;border-radius:50%">
        @else
        <img src="{{url('img/Unknown.png')}}"  style="width:50px;height:50px;border-radius:50%">
        @endif 
            </div>
            <div class="col-md-9">
                  <p>{{$data->service_provider->name}}</p> <p style="word-break: break-all;">{{$data->service_provider->email}}</p> 
       <p>{{$data->service_provider->phone_no}}</p>
            </div>
        </div>
      
      
  </div>
</div>
 			</div>	</div>
 			</div>
 		</div>
 	</div>
 </div>
 <script>
     $(document).scroll(function() {
    var y = $(document).scrollTop(),
        header = $("#block-menu");
    if(y >= 1900)  {
        header.css("position", "relative");
        
    } else {
        header.css({position: "fixed"});
    }
});
 </script>
@endsection
