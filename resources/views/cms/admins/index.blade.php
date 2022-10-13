@extends('cms.parent')

@section('title','Admins')

@section('page-large-title','Admins')
@section('page-small-title','All Admins')
@section('page-root-title','Home')

@section('content')
<section class="content">
      <div class="container-fluid">
        
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Admins</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input admin="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button admin="submit" class="btn btn-default">
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
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($admins as $admin)
                        <tr>
                          <td>{{$admin->id}}</td>
                          <td>{{$admin->name}}</td>
                          <td>{{$admin->email}}</td>
                          <td>{{$admin->created_at}}</td>
                          <td>{{$admin->updated_at}}</td>
                          <td>
                            <div class="btn-group">
                              <a href="{{route('admins.edit', $admin->id)}}" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="#" onclick="performDestroy('{{$admin->id}}', this)" class="btn btn-danger">
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
    confirmDestroy('/cms/admin/admins', id, reference);
  }
</script>
  
@endsection

