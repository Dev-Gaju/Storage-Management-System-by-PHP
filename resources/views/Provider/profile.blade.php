@extends('layouts.provider')

@section('content')

       <script src="{{url('js/ckeditor.js')}}"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">My Profile</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
           <div class="card">
            <div class="card-header">
                @if (session('message'))
                  <p class="alert alert-success">{{ session('message') }}</p>
                 @elseif(session('error'))
                 <p class="alert alert-danger">{{ session('error') }}</p>
              @endif

              @if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
                        
              </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="main_content">
              <div class="row">
              	<div class="col-md-6">
              		@if($provider->image)
              		<img src="{{url($provider->image)}}" width="100%" height="400px" class="rounded mx-auto d-block ">
              		@else
              		<img src="{{url('img/unknown_profile.png')}}" width="100%" height="400px" class="rounded mx-auto d-block ">
              		@endif
              	</div>
              	<div class="col-md-4">
              		<p>Name : {{$provider->name}}</p>
              		<p>Email : {{$provider->email}}</p>
              		<p>Cold Storage Name : {{$provider->cold_storage_name}}</p>
              		<p>Phone No : {{$provider->phone_no}}</p>
              		<p>Address : {{$provider->address}}</p>
              	</div>
              	<div class="col-md-2">
              		<button type="button" class="btn btn-primary" onclick="edit()">Edit Profile</button>
              	</div>
              	
              	
              	
              	<div class="col-md-12"> <br><br>
              	    <h4>Details</h4><hr>
              	    {!!$provider->details!!}
              	</div><br>
              	
              	<div class="col-md-12">
              	    <h4>Conditions</h4><hr>
              	    {!!$provider->conditions!!}
              	</div>

              </div>
              </div>

                 <div id="edit_content" style="display: none">
                 	<form id="edit_info" method="post" action="{{route('provider_profile')}}" enctype="multipart/form-data">
                 		@csrf
                  <div class="row" >
              	<div class="col-md-6 col-md-offset-4">
              		@if($provider->image)
              		<img src="{{url($provider->image)}}" width="100%" height="400px" class="rounded mx-auto d-block " id="image">
              		@else
              		<img src="{{url('img/unknown_profile.png')}}" width="100%" height="400px" class="rounded mx-auto d-block " id="image">
              		@endif
              		<br><input type="file" name="photo" onchange="setImage(this)">
              	</div>
                   <div class="col-md-6 col-md-offset-3">
              		  <div class="form-group">
                        <label class="control-label col-md-10 col-sm-10 col-xs-12" for="first-name"> Name <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input type="text" class="form-control" name="name" value="{{$provider->name}}" required="true" placeholder="enter your name">
                        </div>
                      </div>

                        <div class="form-group">
                        <label class="control-label col-md-10 col-sm-10 col-xs-12" for="first-name"> Email(LogIn Email) <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input type="email" class="form-control" name="email" value="{{$provider->email}}" required="true" placeholder="Enter email">
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label class="control-label col-md-10 col-sm-10 col-xs-12" for="first-name"> Cold Storage Name <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input type="text" class="form-control" name="cold_storage_name" value="{{$provider->cold_storage_name}}" required="true" placeholder="Enter Cold Storage Name">
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="control-label col-md-10 col-sm-10 col-xs-12" for="first-name"> Phone No  <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input type="text" class="form-control" name="phone_no" value="{{$provider->phone_no}}" required="true" placeholder="Enter Phone No">
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="control-label col-md-10 col-sm-10 col-xs-12" for="first-name"> Address <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input type="text" class="form-control" name="address" value="{{$provider->address}}" required="true" placeholder="Enter Address">
                        </div>
                      </div>
                      
                      

              	</div>
              	
              	<div class="col-md-12"> <br>
              	        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Details <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea name="details" class="form-control" id="editor" > {!!$provider->details!!}</textarea>
                        </div>
                      </div>
              	</div>
              	
              	<div class="col-md-12"> <br>
              	      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Conditions <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea name="condition" class="form-control" id="editor2"  > {!!$provider->conditions!!}</textarea>
                        </div>
                      </div>
              	</div>

              	<div class="col-md-2 col-md-offset-10">
              		<button class="btn btn-danger" type="button" onclick="cancle()">Cancle</button>
              		<button class="btn btn-primary" type="submit">Update</button>
              	</div>
              </div>
           </form>
                 </div>

            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
  </div>
  <!-- /.content-wrapper -->
@endsection
@push('scripts')

<script type="text/javascript">
function setImage(input){
	 if (input.files && input.files[0]) {
	       var reader = new FileReader();
	       reader.onload = function(e) {
	      $('#image').attr('src', e.target.result);
	      }
	     reader.readAsDataURL(input.files[0]);
	    }
   }

   function edit(){
	    document.getElementById('main_content').style.display='none';
	    document.getElementById('edit_content').style.display='block';
   }
    function cancle(){
	    document.getElementById('main_content').style.display='block';
	    document.getElementById('edit_content').style.display='none';
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