@extends('layouts.provider')

@section('content')
<div class="container">
	    <div class="row">

        @if($posts->count()>0)
          @foreach($posts as $post)
            <div class="col-md-6" id="post{{$post->id}}">
              <div class="panel panel-default">
                  <a href="{{route('view_details',['id'=>$post->id])}}" style="color: black;">
              <div class="row" style="margin-left: -5px;margin-top: 12px;" >
                <div class="col-md-4" >
                  <img style="width: 100%;" src="{{url('storage/post_image/a'.$post->id.'.jpg')}}">
                </div>
                <div class="col-md-8">
                  <h4>{{$storage_name}}</h4>
                  <p>{{$post->address}}</p>
                  <p>Tk : {{$post->rent}} &nbsp;&nbsp;
                  @if($post->approve == 0) <span style="color: #33d40d">Pending..</span>
                  @elseif($post->approve == 1)<span style="color: #3629e2e3">Approved</span>
                  @else <span style="color: #ef1414e0">Rejected</span> @endif</p>
                  <a href="{{route('edit_post',['id'=>$post->id])}}" style="color: green"><i class="fa fa-edit"></i></a> <a onclick="confirm_delete({{$post->id}})" role="button" style="color: red;margin-left: 30%;"><i class="fa fa-trash"></i></a>
                </div>
              </div>
              </a>
           </div>
            </div>
         @endforeach
         @endif

        </div> 
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
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
                 success: function (msg) {  console.log(msg)
                      if(msg == '111'){
                      document.getElementById("post"+id).style.display='none';
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