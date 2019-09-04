@extends('layouts.provider')

@section('content')

       
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Change Your Password</h3>

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

                 <div id="edit_content">
                 	<form id="edit_info" method="post" action="{{route('change_provider_password')}}" >
                 		@csrf
                 	
                  <div class="row" >
              	<div class="col-md-6 col-md-offset-3">
              		  <div class="form-group">
                        <label class="control-label col-md-10 col-sm-10 col-xs-12" for="first-name"> Enter Old Password <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input type="password" class="form-control" name="old_password" pattern=".{6,}"   required="true" >
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-10 col-sm-10 col-xs-12" for="first-name"> Enter New Password <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input type="password" class="form-control" name="new_password" pattern=".{6,}"  required="true" >
                        </div>
                      </div>

              	</div>
              	<div class="col-md-3"></div>

              	<div class="col-md-2 col-md-offset-8">
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
