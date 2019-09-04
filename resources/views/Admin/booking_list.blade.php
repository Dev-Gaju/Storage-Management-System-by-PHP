@extends('layouts.admin') 

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3 class="mt-5">Local Admin</h3>
<table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
  <thead>
    <tr>
        <th class="th-sm">Post Id
      </th>
      <th class="th-sm">Provider Name
      </th>
      <th class="th-sm">Cold-Storage-Name
      </th>
      <th class="th-sm">Provider Email
      </th>
       <th class="th-sm">Customer Name
      </th>
      <th class="th-sm">Customer Email
      </th>
      <th class="th-sm">booking DateTime
      </th>
      <th class="th-sm">Action
      </th>
    </tr>
  </thead>
  <tbody>
  	@if(count($bookings)>0)
  	 @foreach($bookings as $booking)
  	 <tr id="local_admin{{$booking->id}}">
  	     <td>{{$booking->post_id}}</td> @php $a=$booking->post->service_provider;$b=$booking->user; @endphp
  	 	<td style="width: 20%;"><img style="width: 15%;height: 45px;border-radius: 50%" src="{{ $a->image ?'':url('img/default_img.svg') }}" >{{$a->name}}</td>
  	 	<td>{{$a->cold_storage_name}}</td>
  	 	<td>{{$a->email}}</td>
  	 	<td style="width: 20%;"><img style="width: 15%;height: 45px;border-radius: 50%" src="{{ $b->image ?'':url('img/default_img.svg') }}" >{{$b->name}}</td>
  	 	<td>{{$b->email}}</td>
  	 	<td>{{$booking->created_at}}</td>
  	 	<td><button class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal" data-info="{{$booking}}">More</button></td>
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


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table">
           <tr>
               <td>Amount : </td>
               <td id="amount">Amount : </td>
           </tr> <tr>
               <td>Square fit : </td>
               <td id="square_fit">Amount : </td>
           </tr>           </tr> <tr>
               <td>Booking for days : </td>
               <td id="booking_for_days">Amount : </td>
           </tr>
           <tr>
               <td>Provider Status: </td>
               <td id="provider_status">Amount : </td>
           </tr>
           <tr>
               <td>Provider Recive Product : </td>
               <td id="provider_recive_product">Amount : </td>
           </tr>
           <tr>
               <td>Provider Deliver Product  : </td>
               <td id="provider_deliver_product">Amount : </td>
           </tr>
       </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">

$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var info = button.data('info') // Extract info from data-* attributes
  var modal = $(this)
  modal.find('#amount').text(info['amount'])
  modal.find('#square_fit').text(info['square_fit'])
  modal.find('#square_fit').text(info['square_fit'])
  modal.find('#booking_for_days').text(info['booking_for_days'])
  modal.find('#provider_status').text(info['provider_status'])
  modal.find('#provider_recive_product').text(info['provider_receive_product'])
  modal.find('#provider_deliver_product').text(info['provider_deliver_product'])
 console.log(info)
})

 $(document).ready(function () {

   $("#dtMaterialDesignExample").dataTable({
             "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [3] }],
             "bSort": true,
             dom: 'Blfrtip',
             lengthMenu: [
                 [10, 25, 50, -1],
                 ['10 rows', '25 rows', '50 rows', 'Show all']
             ],
             buttons: [
                 'excelHtml5'
             ]
         });

});


</script>
@endpush
