<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login -Perpustakaan</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
</head>

<body>
    
    <div id="auth">  
        <div class="row d-flex justify-content-center">
            <div id="auth-center" class="card w-25 mt-5">
                <div class="card-body">
                    <div class="auth-logo mb-5">
                        <h3>Perpustakaan</h3>
                    </div>
                        <form action="{{route('auth')}}" method="post">
                            @csrf
                            <div class="form-group position-relative has-icon-center mb-4">
                                <input type="text" name="email" class="form-control form-control-xl" placeholder="Username">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-center mb-4">
                                <input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                           
                            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Log in</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
