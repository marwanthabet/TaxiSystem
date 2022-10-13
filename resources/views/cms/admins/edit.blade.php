@extends('cms.parent')

@section('title','Edit Admin')

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('page-large-title','Edit Admin')
@section('page-small-title','Edit Admin')
@section('page-root-title','Admins')

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
                <h3 class="card-title">Edit Admin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{-- action="{{route('car-types.store')}}" method="POST" enctype="multipart/form-data" --}}
              <form id="create-form">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" id="role" style="width: 100%;">
                      @foreach ($roles as $role)
                        <option value="{{$role->id}}" @if($adminRole->id == $role->id) selected @endif>{{$role->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" value="{{$admin->name}}" placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="{{$admin->email}}" placeholder="Enter email">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" onclick="performUpdate('{{$admin->id}}')" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
 
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  $('#role').select2({
      theme: 'bootstrap4'
    })
  function performUpdate(id){
    axios.put('/cms/admin/admins/'+id, {
      'name': document.getElementById('name').value,
      'email': document.getElementById('email').value,
      'role': document.getElementById('role').value,
    })
    .then(function(response){
      toastr.success(response.data.message);
      // window.location.href = '/cms/admin/admins';
    }).catch(function(error){
      toastr.error(error.response.data.message)
    });
  }

</script>
<!-- bs-custom-file-input -->
<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@endsection
