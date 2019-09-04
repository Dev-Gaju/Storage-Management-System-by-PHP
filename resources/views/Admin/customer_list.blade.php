@extends('layouts.admin') 

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3 class="mt-5">Customer List</h3>
<table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Name
      </th>
      <th class="th-sm">Email
      </th>
      <th class="th-sm">phone-No
      </th>
      <th class="th-sm" style="display:none">Authorized
      </th>
      <th class="th-sm">Action
      </th>
    </tr>
  </thead>
  <tbody>
  	@if(count($customers)>0)
  	 @foreach($customers as $customer)
  	 <tr id="local_admin{{$customer->id}}">
  	 	<td style="width: 25%;"><img style="width: 15%;height: 45px;border-radius: 50%" src="{{ $customer->image ?url($customer->image):url('img/default_img.svg') }}" >{{$customer->name}}</td>
  	 	<td>{{$customer->email}}</td>
  	 	<td>{{$customer->phone_no}}</td>
  	 	<td style="display:none">{!!$customer->block == 1 ?'<span style="color:red">Unauthorized<span>':'<span style="color:green">Authorized<span>'!!}</td>
  	 	<td><a href="{{route('update_customer',$customer->id)}}" class="btn btn-primary">Update</a><a role="button" class="btn btn-danger" onclick="confirm_delete({{$customer->id}})">Delete</a></td>
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
             lengthMenu: [
                 [10, 25, 50, -1],
                 ['10 rows', '25 rows', '50 rows', 'Show all']
             ],
             buttons: [
                 'excelHtml5'
             ]
         });

});

function confirm_delete(id){
    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
    $.ajax({
               type: 'POST',
                url: 'delete_customer',
                cache: false,
                data: {
                      "_token" : $('meta[name=_token]').attr('content'),  
                      id:id 
                    },   
                 success: function (msg) { 
                      if(msg == '111'){
                      document.getElementById("local_admin"+id).style.display='none';
                      	 Swal.fire(
					      'Deleted!',
					      'Your file has been deleted.',
					      'success'
					    )
                      }
                    }
         });
   
  }
})
} 
</script>
@endpush
