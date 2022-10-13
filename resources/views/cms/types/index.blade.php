@extends('cms.parent')

@section('title','Car Types')

@section('page-large-title','Car Types')
@section('page-small-title','All Types')
@section('page-root-title','Home')

@section('content')
<section class="content">
      <div class="container-fluid">
        
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Types</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($types as $type)
                        <tr>
                          <td>
                            <img class="img-circle img-bordered-sm" width="60"
                              src="{{Storage::url($type->image)}}" alt="User Image">
                          </td>
                          <td>{{$type->id}}</td>
                          <td>{{$type->name}}</td>
                          <td>{{$type->created_at}}</td>
                          <td>{{$type->updated_at}}</td>
                          <td>
                            <div class="btn-group">
                              <a href="{{route('car-types.edit', $type->id)}}" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="#" onclick="performDestroy('{{$type->id}}', this)" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')
<script>
  function performDestroy(id, reference){
    confirmDestroy('/cms/admin/car-types', id, reference);
  }
</script>
  
@endsection

