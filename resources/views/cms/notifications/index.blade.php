@extends('cms.parent')

@section('title','Notifications')

@section('page-large-title','Notifications')
@section('page-small-title','All Notifications')
@section('page-root-title','Home')

@section('content')
<section class="content">
      <div class="container-fluid">
        
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Notifications</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input notification="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button notification="submit" class="btn btn-default">
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
                      <th>Title</th>
                      <th>Sent At</th>
                      <th>Read</th>
                      <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach (auth()->user()->notifications as $notification)
                        <tr>
                          <td>{{$notification->data['title']}}</td>
                          <td>{{$notification->created_at}}</td>
                          <td><span class="tag @if(is_null($notification->read_at)) tag_danger @else tag_success @endif">
                          @if(is_null($notification->read_at)) NEW @else READ @endif</span></td>
                          <td>
                            <div class="btn-group">
                              <a href="{{route('cms.notifications.read', $notification->id)}}" class="btn btn-info">
                                <i class="fas fa-check-double"></i>
                              </a>
                              <a href="#" onclick="performDestroy('{{$notification->id}}', this)" class="btn btn-danger">
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
    confirmDestroy('/cms/admin/notifications', id, reference);
  }
</script>
  
@endsection

