@extends('cms.parent')

@section('title','Drivers')

@section('page-large-title','Drivers')
@section('page-small-title','All Drivers')
@section('page-root-title','Home')

@section('content')
<section class="content">
      <div class="container-fluid">
        
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Drivers</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input driver="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button driver="submit" class="btn btn-default">
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
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Permissions</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($drivers as $driver)
                        <tr>
                          <td>{{$driver->id}}</td>
                          <td>{{$driver->name}}</td>
                          <td>{{$driver->email}}</td>
                          <td><a href="{{route('driver-permissions.show', $driver->id)}}"
                                class="btn btn-block bg-gradient-info">({{$driver->permissions_count}}) Permission/s
                              </a>
                          </td>
                          <td>{{$driver->created_at}}</td>
                          <td>{{$driver->updated_at}}</td>
                          <td>
                            <div class="btn-group">
                              <a href="{{route('drivers.edit', $driver->id)}}" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="#" onclick="performDestroy('{{$driver->id}}', this)" class="btn btn-danger">
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
    confirmDestroy('/cms/admin/drivers', id, reference);
  }
</script>
  
@endsection

