@extends('cms.parent')

@section('title','Permissions')

@section('page-large-title','Permissions')
@section('page-small-title','All Permissions')
@section('page-root-title','Home')

@section('content')
<section class="content">
      <div class="container-fluid">
        
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Permissions</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input permission="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button permission="submit" class="btn btn-default">
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
                      <th>Guard</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($permissions as $permission)
                        <tr>
                          <td>{{$permission->id}}</td>
                          <td>{{$permission->name}}</td>
                          <td>{{$permission->guard_name}}</td>
                          <td>{{$permission->created_at}}</td>
                          <td>{{$permission->updated_at}}</td>
                          <td>
                            <div class="btn-group">
                              <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="#" onclick="performDestroy('{{$permission->id}}', this)" class="btn btn-danger">
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
    confirmDestroy('/cms/admin/permissions', id, reference);
  }
</script>
  
@endsection

