@extends('cms.parent')

@section('title','Create Type')

@section('styles')
@endsection

@section('page-large-title','Create Type')
@section('page-small-title','Create')
@section('page-root-title','Types')



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
                <h3 class="card-title">Create</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{-- action="{{route('car-types.store')}}" method="POST" enctype="multipart/form-data" --}}
              <form id="create-form">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label for="type_image">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="type_image" id="type_image">
                        <label class="custom-file-label" for="type_image">Choose file</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
                </div>
              </form>
            </div>
 
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script>
  function performStore(){
    var formData = new FormData();
    formData.append('name', document.getElementById('name').value);
    formData.append('type_image', document.getElementById('type_image').files[0]);
    axios.post('/cms/admin/car-types', formData)
    .then(function(response){
      console.log(response);
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
