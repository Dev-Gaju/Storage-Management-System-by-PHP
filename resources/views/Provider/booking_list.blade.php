@extends('layouts.provider')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3 class="mt-5">Your Booking List</h3>
      <div id="error" ></div>
<table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Post Id
      </th>
      <th class="th-sm">Customer-Name
      </th>
      <th class="th-sm">Square Fit
      </th>
      <th class="th-sm">Amount
      </th>
      <th class="th-sm">Booking for days
      </th>
      <th class="th-sm">Receive Product
      </th>
      <th class="th-sm">Deliver Product
      </th>
      <th class="th-sm">Status
      </th>
      <th class="th-sm">Code
      </th>
      <th class="th-sm">Action
      </th>
    </tr>
  </thead>
  <tbody>
  	@if(count($bookings)>0)
  	 @foreach($bookings as $booking)
  	 <tr id="">
  	 	<td >{{$booking->post_id}}</td>
  	 	<td >{{$booking->user->name}}</td>
  	 	<td >{{$booking->square_fit}}</td>
  	 	<td >{{$booking->amount}}</td>
  	 	<td >{{$booking->booking_for_days}}</td>
  	 	<td >{{$booking->provider_receive_product}}</td>
  	 	<td >{{$booking->provider_deliver_product}}</td>
  	 	<td >{{$booking->provider_status}}</td>
  	 	<td >{{$booking->booking_code->code}}</td>
  	 	<td ><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-booking_id="{{$booking->id}}" data-booking_days="{{$booking->booking_for_days}}" data-recive_product="{{$booking->provider_receive_product}}" data-delivery_product="{{$booking->provider_deliver_product}}" data-status="{{$booking->provider_status}}">More</button></td>
  	 </tr>
  	 @endforeach
  	@endif
  </tbody>
  <tfoot>
  </tfoot>
</table>

    </div>
  </div>
</div>


{{--Modal start....................................--}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">More Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_info">
            <input type="hidden" id="booking_id" name="booking_id" >
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Booking days:</label>
            <input type="text" class="form-control" id="booking_days" name="booking_days">
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Receive Product:</label>
            <select class="form-control" id="receive_product" name="receive_product">
                <option value="Pending">Pending</option>
                <option value="Yes">Yes</option>
            </select>
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Deliver Product :</label>
            <select class="form-control" id="deliver_product" name="deliver_product">
                <option value="Pending">Pending</option>
                <option value="Yes">Yes</option>
            </select>
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Status:</label>
            <select class="form-control" id="status" name="status">
                <option value="Pending">Pending</option>
                <option value="Accepted">Accepted</option>
                <option value="Rejected">Rejected</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="update_info()">Update</button>
      </div>
    </div>
  </div>
</div>
{{--Modal end....................................--}}
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var booking_id = button.data('booking_id') 
  var booking_days = button.data('booking_days') 
  var recive_product = button.data('recive_product') 
  var delivery_product = button.data('delivery_product') 
  var status = button.data('status') 
  var modal = $(this)
  modal.find('#booking_id').val(booking_id)
  modal.find('#booking_days').val(booking_days)
  if(recive_product !='Pending'){
      modal.find('#receive_product').empty().append('<option value="'+recive_product+'">'+recive_product+'</option><option value="Pending">Pending</option>');
  }
  else{
       modal.find('#receive_product').empty().append('<option value="Pending">Pending</option><option value="Yes">Yes</option>');
  }
   if(delivery_product !='Pending'){
      modal.find('#deliver_product').empty().append('<option value="'+delivery_product+'">'+delivery_product+'</option><option value="Pending">Pending</option>');
  }
  else{
       modal.find('#deliver_product').empty().append('<option value="Pending">Pending</option><option value="Yes">Yes</option>');
  }
 
 
   if(status =='Accepted'){
      modal.find('#status').empty().append('<option value="Accepted">Accepted</option><option value="Rejected">Rejected</option><option value="Pending">Pending</option>');
  }
  else if(status =='Rejected'){
       modal.find('#status').empty().append('<option value="Rejected">Rejected</option><option value="Accepted">Accepted</option><option value="Pending">Pending</option>');
  }
  else{
      modal.find('#status').empty().append('<option value="Pending">Pending</option></option><option value="Accepted">Accepted</option><option value="Rejected">Rejected</option>');
  }
  
  

})
function update_info(){
        var value = $('#update_info').serializeArray();
    $.ajax({
               type: 'POST',
                url: 'update_booking_info',
                cache: false,
                data: {
                      "_token" : $('meta[name=_token]').attr('content'),  
                      value:value 
                    },   
                 success: function (msg) { 
                      if(msg == '111'){
                          window.location.reload(true);
                      }
                      else{
                          document.getElementById('error').innerHTML='<p class="alert alert-danger">There have error please try again</p>';
                      }
                    }
         });
   
  }
</script>
@endpush