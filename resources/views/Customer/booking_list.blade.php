@extends('layouts.customer')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
         @if (session('message'))
                  <p class="alert alert-success">{{ session('message') }}</p>
         @elseif(session('error'))
                 <p class="alert alert-danger">{{ session('error') }}</p>
        @endif
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3 class="mt-5">Your Booking List</h3>
<table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Id
      </th>
      <th class="th-sm">Provider-Name
      </th>
      <th class="th-sm">Square Fit
      </th>
      <th class="th-sm">Amount
      </th>
      <th class="th-sm">Booking for days
      </th>
      <th class="th-sm">Deliver Product
      </th>
      <th class="th-sm">Receive Product
      </th>
      <th class="th-sm">Provider Status
      </th>
      <th class="th-sm">Code
      </th>
    </tr>
  </thead>
  <tbody>
  	@if(count($bookings)>0)
  	 @foreach($bookings as $booking)
  	 <tr id="">
  	 	<td >{{$booking->id}}</td>
  	 	<td >{{$booking->post->service_provider->name}}</td>
  	 	<td >{{$booking->square_fit}}</td>
  	 	<td >{{$booking->amount}}</td>
  	 	<td >{{$booking->booking_for_days}}</td>
  	 	<td >{{$booking->provider_receive_product}}</td>
  	 	<td >{{$booking->provider_deliver_product}}</td>
  	 	<td >{{$booking->provider_status}}</td>
  	 	<td >{{$booking->booking_code->code}}</td>
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

@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
 $(document).ready(function () {

   $("#dtMaterialDesignExample").dataTable({
             "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [3] }],
             "bSort": true,
             dom: 'Blfrtip',
             "order": [[ 0, "desc" ]],
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