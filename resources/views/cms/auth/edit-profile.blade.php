@extends('cms.parent')

@section('title','Edit Profile')

@section('styles')
@endsection

@section('page-large-title','Edit Profile')
@section('page-small-title','Edit')
@section('page-root-title','Edit')



@section('content')
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{-- action="{{route('car-types.store')}}" method="POST" enctype="multipart/form-data" --}}
              <form id="create-form">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" value="{{$user->name}}" class="form-control" id="name" placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" value="{{$user->email}}" class="form-control" id="email" placeholder="Enter email">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" onclick="updateProfile()" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
 
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script>
  function updateProfile(){
    axios.put('/cms/admin/update-profile', {
      email: document.getElementById('email').value,
      name: document.getElementById('name').value,
    })
    .then(function(response){
      toastr.success(response.data.message);
      //document.getElementById('create-form').reset();
    }).catch(function(error){
      console.log(error);
      toastr.error(error.response.data.message)
    });
  }

</script>
<!-- bs-custom-file-input -->
<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@endsection
