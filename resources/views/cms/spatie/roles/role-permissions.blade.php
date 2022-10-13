@extends('cms.parent')

@section('title','Roles')

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection

@section('page-large-title','Roles')
@section('page-small-title','All Roles')
@section('page-root-title','Home')

@section('content')
<section class="content">
      <div class="container-fluid">
        
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">({{$role->name}}) - Permissions</h3>

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
                      <th>Name</th>
                      <th>Guard</th>
                      <th>Assigned</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($permissions as $permission)
                        <tr>
                          <td>{{$permission->name}}</td>
                          <td>{{$permission->guard_name}}</td>
                          <td>
                            <div class="icheck-success d-inline">
                              <input type="checkbox" @if($permission->assigned) checked @endif id="permission_{{$permission->id}}"
                                onclick="performStore('{{$role->id}}', '{{$permission->id}}')">
                              <label for="permission_{{$permission->id}}">
                              </label>
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
  function performStore(roleId, permissionId){
    let data = {
      permission_id: permissionId
    };
    store('/cms/admin/role/'+roleId+'/permission', data);
  }
</script>
  
@endsection

