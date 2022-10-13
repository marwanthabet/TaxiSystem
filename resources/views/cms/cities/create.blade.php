@extends('cms.parent')

@section('title','Create City')

@section('styles')
@endsection

@section('page-large-title','Create City')
@section('page-small-title','Create City')
@section('page-root-title','Cities')



@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-10">
        
        <!-- Horizontal Form -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Create City</h3>
          </div>
          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5><i class="icon fas fa-ban"></i> Alert!</h5>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>
          @endif
          
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" method="POST" action="{{route('cities.store')}}">
            <div class="card-body">
              @csrf
              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                </div>
              </div>
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-info">Create</button>
              <button type="button" class="btn btn-default float-right">Cancel</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->

      </div>
      <!--/.col (left) -->
      
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
@endsection
