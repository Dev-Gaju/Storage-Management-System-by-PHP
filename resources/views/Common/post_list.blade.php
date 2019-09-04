@extends('layouts.admin') 

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3 class="mt-5">All Post</h3>
<table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Sl
      </th>
      <th class="th-sm">Cold-Storage-Name
      </th>
      <th class="th-sm">Number of Room
      </th>
      <th class="th-sm">Room size
      </th>
      <th class="th-sm">Rent
      </th>
      <th class="th-sm">Status
      </th>
      <th class="th-sm">Action
      </th>
    </tr>
  </thead>
  <tbody> @php $i=1; @endphp
  	@if(count($posts)>0)
  	 @foreach($posts as $post)
  	 <tr id="post{{$post->id}}">
  	 	<td style="width: 25%;">{{$i++}}</td>
  	 	<td><a style="text-decoration: underline;color: blue" href="{{url('view_details',$post->id)}}">{{$post->service_provider->cold_storage_name}}</a></td>
  	 	<td>{{$post->room}}</td>
  	 	<td>{{$post->room_size}}</td>
  	 	<td id="rent{{$post->id}}">{{$post->rent}}</td>
  	 	<td id="approve{{$post->id}}">@if($post->approve == 0) <span style="color: #33d40d">Pending..</span>
	      @elseif($post->approve == 1)<span style="color: #3629e2e3">Approved</span>
	      @else <span style="color: #ef1414e0">Rejected</span> @endif</p></td>
  	 	<td><a class="btn btn-primary" role="button" data-toggle="modal" data-target="#edit_modal" data-post_id="{{$post->id}}" >Edit</a><a role="button" class="btn btn-danger" onclick="confirm_delete({{$post->id}})">Delete</a></td>
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

{{--Modal start--}}
<div class="modal fade bd-example-modal-lg " id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body" style="padding: 3rem">
        <h3 id="moda_title"></h3>
        <form id="edit_form">
        	<input type="hidden" name="post_id" id="post_id_input">
        	<div class="row">

        	   <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12 text-right" >Rent <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="rent_input"  name="rent" required="required" class="form-control col-md-12 col-xs-12" >
                </div>
              </div><br><br><br>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12 text-right" >Approve <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control" name="approve">
                  	<option value="0">Pending</option>
                  	<option value="1">Approved</option>
                  	<option value="2">Rejected</option>
                  </select>
                </div>
              </div><br><br><br>

               <div class="form-group">
               	<div class="col-md-5 col-md-offset-3 col-sm-9 col-xs-12">
               <button data-dismiss="modal" class="btn btn-danger">Cancle</button>
               <button data-dismiss="modal" class="btn btn-primary" type="button" onclick="update(document.getElementById('post_id_input').value)">Update</button>
             </div>
              </div>

        	</div>
        </form>
    </div>
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

   $('#edit_modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var post_id = button.data('post_id') 
  var rent = document.getElementById('rent'+post_id).innerHTML
  var modal = $(this)
  modal.find('#post_id_input').val(post_id)
  modal.find('#rent_input').val(rent)
})

});

function update(id){
	var value = $('#edit_form').serializeArray();
   $.ajax({
           type: 'POST',
            url: 'update_post',
            cache: false,
            data: {
                  "_token" : $('meta[name=_token]').attr('content'),  
                  value:value 
                },   
             success: function (msg) { 
                  if(msg[0] != '000'){
                  document.getElementById("approve"+id).innerHTML=msg[0];
                  document.getElementById("rent"+id).innerHTML=msg[1];
                  	 Swal.fire(
				      'Updated!',
				      'Your file has been Updated.',
				      'success'
				    )
                  }
                  else{
                       Swal.fire(
              'Updated!',
              'Fetch Error..Try Again.',
              'error'
            )
                  }
               
                }
     });
}
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
                url: 'delete_post',
                cache: false,
                data: {
                      "_token" : $('meta[name=_token]').attr('content'),  
                      id:id 
                    },   
                 success: function (msg) { 
                      if(msg == '111'){
                      document.getElementById("post"+id).style.display='none';
                      	 Swal.fire(
					      'Deleted!',
					      'Your file has been deleted.',
					      'success'
					    )
                      }
                    else{
                         Swal.fire(
                'Deleted!',
                'Fetch Error..Try Again.',
                'error'
              )
                    }
                    }
         });
   
  }
})
} 
</script>
@endpush
