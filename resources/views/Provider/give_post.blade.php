@extends('layouts.provider')

@section('content')
<script src="{{url('js/ckeditor.js')}}"></script>
<div class="container">
  <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create New Post </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if(session()->has('error'))
                      <div class="alert alert-danger">
                          {{ session()->get('error') }}
                      </div>
                  @endif
                    <br />

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{route('submit_post')}}" enctype='multipart/form-data'>
                     @csrf
                      {{--<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" id="first-name" name="title" required="required" class="form-control col-md-12 col-xs-12" >
                        </div>
                      </div>--}}

                      <div class="form-group" style="display: none">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Details <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea name="details" class="form-control" id="editor" >{!!$provider->details!!}</textarea>
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Address <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text"  name="address" required="required" class="form-control col-md-12 col-xs-12" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Latitude <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text"  name="latitude" required="required" class="form-control col-md-12 col-xs-12" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Longitude <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text"  name="longitude" required="required" class="form-control col-md-12 col-xs-12" >
                        </div>
                      </div>

                      <div class="form-group" style="display: none">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Conditions <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea name="condition" class="form-control" id="editor2"  >{!!$provider->conditions!!}</textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-6 col-xs-12" >Number of Room <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <input type="number"  name="room" required="required" class="form-control col-md-12 col-xs-12" >
                        </div>
                         <label class="control-label col-md-2 col-sm-6 col-xs-12" >Room Size<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <input type="text"  name="room_size" required="required" class="form-control col-md-12 col-xs-12" placeholder="1000 square fit">
                        </div>
                          <label class="control-label col-md-1 col-sm-6 col-xs-12" >Rent<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <input type="number"  name="rent" required="required" class="form-control col-md-12 col-xs-12">
                        </div>
                      </div>
                  

                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-left: 56px;">
					@for($i=0;$i<4;$i++)
					<div style="width:190px;height: 190px; background-color: #95959a;float: left;margin-left: 10px;position: relative; overflow: hidden;" class="image_up">
						<img src="{{url('img/image-upload.jpg')}}" id="image{{$i}}" style="width: 100%;height: 100%">
					<input type="file" name="image[]"  style="font-size: 162px;opacity: 0;margin-top: -219px;" required="true" onchange="setImage(this,{{$i}})">
					</div>
					@endfor
				</div>
                      </div>
                    
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{url('provider/post_list') }}" class="btn btn-primary" >Cancel</a>
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
           
</div>
@endsection

@push('scripts')

<script type="text/javascript">
	function setImage(input,div_id){
		 if (input.files && input.files[0]) {
           var reader = new FileReader();
           reader.onload = function(e) {
          $('#image'+div_id).attr('src', e.target.result);
          }
         reader.readAsDataURL(input.files[0]);
        }
       }
</script>
<script>
ClassicEditor.create( document.querySelector( '#editor' ) )
        .then( editor => {
               // console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
ClassicEditor.create( document.querySelector( '#editor2' ) )
        .then( editor => {
               // console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );

</script>
@endpush
