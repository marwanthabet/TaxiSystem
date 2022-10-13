@extends('cms.parent')

@section('title','Cities')

@section('page-large-title','Cities')
@section('page-small-title','All Cities')
@section('page-root-title','Home')

@section('content')
<section class="content">
      <div class="container-fluid">
        
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Cities</h3>

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
                      <th>ID</th>
                      <th>Name</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($cities as $city)
                        <tr>
                          <td>{{$city->id}}</td>
                          <td>{{$city->name}}</td>
                          <td>{{$city->created_at}}</td>
                          <td>{{$city->updated_at}}</td>
                          <td>
                            <div class="btn-group">
                              <a href="{{route('cities.edit', $city->id)}}" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="#" onclick="confirmDestroy('{{$city->id}}',this)" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                              </a>

                              {{-- <form method="POST" action="{{route('cities.destroy', $city->id)}}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                  <i class="fas fa-trash"></i>
                                </button>
                              </form> --}}
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
  function confirmDestroy(id, reference){
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
      if (result.isConfirmed) {
        performDelete(id, reference);
      }
    })
  }

  function performDelete(id, reference){
    axios.delete('/cms/admin/cities/'+id)
    .then(function (response) {
      // handle success
      console.log(response);
      showMessage(response.data);
      reference.closest('tr').remove();
    })
    .catch(function (error) {
      // handle error
      console.log(error);
      showMessage(error.response.data);
    });
  }

  function showMessage(data){
    Swal.fire({
      icon: data.icon,
      title: data.title,
      showConfirmButton: false,
      timer: 1500
    })
  }
</script>
@endsection

