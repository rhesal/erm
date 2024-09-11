<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ asset('adminlte') }}/index2.html" class="h1"><b>Admin</b>LTE</a>
            </div>
            <form action="/login" method="post" id="formLogin">
                @csrf
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" id="username"
                            name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback" id="invalidusername"></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password"
                            name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback" id="invalidpassword"></div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary btn-block" id="btnLogin">
                        <i class="fa fa-sign-in-alt mr-2"></i> Login
                    </button>
                </div>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte') }}/js/adminlte.min.js"></script>

    <script>
        $('#formLogin').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'JSON',
                beforeSend: function() {
                    $('#btnLogin').prop('disabled', true);
                    $('#btnLogin').html(`<i class="fa fa-spin fa-spinner mr-2"></i> Login`);

                    $(".invalid-feedback").html("");
                    $('.is-invalid').removeClass('is-invalid');
                },
                complete: function() {
                    $('#btnLogin').prop('disabled', false);
                    $('#btnLogin').html(`<i class="fa fa-sign-in-alt mr-2"></i> Login`);
                },
                success: function(res) {
                    window.location = res.url;
                },
                error: function(xhr, textStatus, thrownError) {
                    if (xhr.status === 500) {
                        /* swalWithBootstrapButtons.fire(
                            "Terjadi Kesalahan",
                            "Silahkan Hubungi Tim IT",
                            "error"
                        ); */
                        console.log('ERROR ' + xhr.status);
                    } else {
                        let err = JSON.parse(xhr.responseText);
                        if (err.error['username']) {
                            $('#username').addClass('is-invalid');
                            $('#invalidusername').html(err.error['username']);
                        }
                        if (err.error['password']) {
                            $('#password').addClass('is-invalid');
                            $('#invalidpassword').html(err.error['password']);
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
