<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="css/styles-login.css" type="text/css">

    <title>FaceBook Lite</title>
    </head>
    <body>
        <main>
        <div class="card">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                            <label for="validationCustom01">E-mail</label>
                            <input type="text" class="form-control" id="validationCustom01" placeholder="E-mail" value="E-mail" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                            <label for="validationCustom03">Password</label>
                            <input type="password" class="form-control" id="validationCustom03" placeholder="Password" required>
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-row">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Register
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                            <label for="validationCustom01">First name</label>
                            <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="First Name" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            </div>
                            <div class="col-md-4 mb-3">
                            <label for="validationCustom02">Last name</label>
                            <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Last name" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            </div>
                            <div class="col-md-4 mb-3">
                            <label for="validationCustomUsername">Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                </div>
                                <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                Please choose a username.
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                            <label for="validationCustom03">City</label>
                            <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                            </div>
                            <div class="col-md-3 mb-3">
                            <label for="validationCustom04">Address</label>
                            <input type="text" class="form-control" id="validationCustom04" placeholder="Address" required>
                            <div class="invalid-feedback">
                                Please provide a valid address.
                            </div>
                            </div>
                            <div class="col-md-3 mb-3">
                            <label for="validationCustom05">Zip</label>
                            <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
                            <div class="invalid-feedback">
                                Please provide a valid zip.
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Register</button>
                    </form>
                </div>
            </div>
        </main>
        
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
                });
            }, false);
            })();
        </script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>