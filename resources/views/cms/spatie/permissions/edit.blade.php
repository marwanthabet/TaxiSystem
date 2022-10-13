@extends('cms.parent')

@section('title','Edit Permissions')

@section('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('page-large-title','Edit Permissions')
@section('page-small-title','Edit')
@section('page-root-title','Permissions')



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
                <h3 class="card-title">Edit Permission</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{-- action="{{route('car-types.store')}}" method="POST" enctype="multipart/form-data" --}}
              <form id="create-form">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Guard</label>
                    <select class="form-control guards" id="guard_name" data-placeholder="Select a guard" style="width: 100%;">
                      <option value="admin">Admin</option>
                      <option value="driver">Driver</option>
                      <option value="admin-api">Admin-API</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" value="{{$permission->name}}" placeholder="Enter name">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" onclick="performUpdate('{{$permission->id}}')" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
 
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<!-- Select2 -->
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  $('#guard_name').select2({
      theme: 'bootstrap4'
    })
  function performUpdate(id){
    axios.put('/cms/admin/permissions/'+id, {
      'guard_name': document.getElementById('guard_name').value,
      'name': document.getElementById('name').value
    })
    .then(function(response){
      toastr.success(response.data.message);
      //document.getElementById('create-form').reset();
    }).catch(function(error){
      toastr.error(error.response.data.message)
    });
  }

</script>
<!-- bs-custom-file-input -->
<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@endsection
