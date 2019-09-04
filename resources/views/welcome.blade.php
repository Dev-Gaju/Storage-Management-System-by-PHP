@extends('layouts.app') 

@section('content')
   
   <link rel="stylesheet" href="{{url('css/main.css')}}">
   
<!--Plugin CSS file with desired skin-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    

    <!--Plugin JavaScript file-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>



 <!-- start banner Area -->
    <section class="home-banner-area relative" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row fullscreen align-items-end justify-content-center">
                <div class="banner-content col-lg-12 col-md-12 col-sm-12">
                    <div class="search-field">
                        <form class="search-form" method="get" action="{{route('search_property')}}">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 d-flex align-items-center justify-content-center toggle-wrap">
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="search-title" style="color:white">Search Storage For</h4>
                                        </div>
                                        <div class="col">
                                
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-xs-6">
                                    <p></p>
                                    <input type="text" style="margin-top: 19%" class="form-control" name="address" placeholder="Enter Address">
                                </div>
                            
                                <div class="col-lg-4 range-wrap">
                                    <p style="color:white">Price Range(TK):</p>
                                    <input type="text" id="range" class="js-range-slider" name="range" />
                                </div>
                            
                                <div class="col-lg-2 d-flex justify-content-center">
                                    <button class="primary-btn">Search<span class="lnr lnr-arrow-right"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="container">
            <div class="row">
            @if(count($posts)>0)
              @foreach($posts as $post)
                <div class="col-lg-4 col-md-6 col-sm-12" style="margin-top:30px;height:420px;">
                    <a href="{{route('view_details',$post->id)}}" style="color: black;">
                    <div class="single-property" style="height:420px;">
                        <div class="images" style="height:200px">
                            <img class="img-fluid mx-auto d-block" src="{{url('storage/post_image/a'.$post->id.'.jpg')}}" alt="image">
                        </div>

                        <div class="desc">
                            <div class="top d-flex justify-content-between">
                                   <div class="col-lg-8">
                                       <h6><a href="#">{{$post->service_provider->cold_storage_name}}</a></h6>
                                   </div>
                                   <div class="col-lg-4">
                                       <h5>Tk : {{$post->rent}}</h5>
                                   </div>
                            </div>
                    
                            <div class="bottom d-flex justify-content-start">
                                {{$post->address}}
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                 @endforeach
                @endif
             

</div>
<p style="margin-top: 10px;"></p>
{{ $posts->links() }}
    </section>
     <script>
  $(".js-range-slider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 100000,
        from: 2000,
        to: 20000,
        grid: true
    });

     </script>
@endsection

