<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Taxi</b>System</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Email is not verified, resend verfication from below</p>

      <form>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="button" onclick="resendVerificationEmail()" class="btn btn-info btn-block">Resend</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('js/axios.js')}}"></script>
<script src="{{asset('js/sweet_alert.js')}}"></script>
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('js/crud.js')}}"></script>
<script>
  function resendVerificationEmail(){
    axios.post('/email/verification-notification')
    .then(function(response){
      toastr.success(response.data.message)
    }).catch(function(error){
        console.log(error);
        toastr.error(error.response.data.message)
    });
  }
</script>
</body>
</html>
