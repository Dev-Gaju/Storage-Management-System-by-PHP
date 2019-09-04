@extends('layouts.customer')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
         <form id="myForm" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{route('submit_booking')}}">
                     @csrf
                     <input type="hidden" name="post_id" value="{{$post->id}}">
                     

                     @if(session('error'))
                     <p class="alert alert-danger">{{ session('error') }}</p>
                    @endif
              
                      <div class="form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12" >How much square fit you want to book <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p id="error" style="color:red">@php $string = $post->room_size;
                                                            $a= preg_replace("/[^0-9.]/", '', $string);
                                                             $ab =floatval($a)*floatval($post->room);
                                                             $a=$ab.' '.substr(strstr($post->room_size," "), 1);@endphp  Required and not more then {{$a}}</p>
                          <input type="number" id="square_fit" onkeyup="calculet()" name="square_fit" required="required" class="form-control col-md-7 col-xs-12" >
                        </div>
                      </div>
                      
                        <div class="form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12" >Rent <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" readonly="true" id="rent"  name="rent" required="required" class="form-control col-md-7 col-xs-12" >
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12" >How much Days?(if Unknown then keep blank)
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="days" class="form-control col-md-7 col-xs-12" value="Unknown">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12" >Payment Method
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12">
                              <option>Cach On Delivery</option>
                          </select>
                        </div>
                      </div>
                      
                      
                       <div class="form-group">
                           <label class="control-label col-md-6 col-sm-6 col-xs-12" for="first-name">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="button" onclick="check()" class="btn btn-primary" value="Submit">
                        </div>
                      </div>
                      
                      
         </form>
    </div>
</div>

<script>
    function check(){
        var square_fit = document.getElementById('square_fit').value;
        if(square_fit == 0 || square_fit > {{$ab}}){
           
        }
        else{
            document.getElementById("myForm").submit();
        }
    }
    function calculet(){
         var square_fit = document.getElementById('square_fit').value;
         document.getElementById('rent').value = ({{$post->rent}}/1000)*square_fit;
    }
</script>
@endsection