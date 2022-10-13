@extends('cms.parent')

@section('title','Change Password')

@section('styles')
@endsection

@section('page-large-title','Change Password')
@section('page-small-title','Change')
@section('page-root-title','Change')



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
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{-- action="{{route('car-types.store')}}" method="POST" enctype="multipart/form-data" --}}
              <form id="create-form">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" placeholder="Enter password">
                  </div>
                  <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="text" class="form-control" id="new_password" placeholder="Enter new password">
                  </div>
                  <div class="form-group">
                    <label for="new_password_confirmation">New Password Confirmation</label>
                    <input type="text" class="form-control" id="new_password_confirmation"
                     placeholder="Enter new password confirmation">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" onclick="updatePassword()" class="btn btn-primary">Store</button>
                </div>
              </form>
            </div>
 
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script>
  function updatePassword(){
    axios.put('/cms/admin/update-password', {
      password: document.getElementById('password').value,
      new_password: document.getElementById('new_password').value,
      new_password_confirmation: document.getElementById('new_password_confirmation').value,
    })
    .then(function(response){
      toastr.success(response.data.message);
      document.getElementById('create-form').reset();
    }).catch(function(error){
      console.log(error);
      toastr.error(error.response.data.message)
    });
  }

</script>
<!-- bs-custom-file-input -->
<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@endsection
