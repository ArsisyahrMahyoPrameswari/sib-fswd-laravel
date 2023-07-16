<!DOCTYPE html>
<html>
<head>
  <!-- Add your head content here (meta tags, title, etc.) -->
  <!-- Add Bootstrap CSS link here -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f9f9f9;
    }

    .registration-container {
      max-width: 400px;
      margin: 50px auto;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      background-color: #fff;
    }

    .registration-title {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 30px;
    }

    .registration-form input[type="text"],
    .registration-form input[type="password"] {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      width: 100%;
      margin-bottom: 20px;
    }

    .registration-form button {
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      color: #fff;
      padding: 12px 20px;
      font-size: 16px;
      font-weight: bold;
      width: 100%;
      cursor: pointer;
    }

    .registration-form button:hover {
      background-color: #0056b3;
    }

    .registration-form p {
      text-align: center;
      margin-top: 15px;
    }

    .registration-form p a {
      color: #007bff;
      font-weight: bold;
      text-decoration: none;
    }

    .registration-form p a:hover {
      text-decoration: underline;
    }

    .password-icon-lg {
      margin-right: 10px;
    }

    .password-strength-icons {
      text-align: center;
    }
  </style>
</head>
<body>

  <!-- Registration Form -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        @if(Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your account has been created successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Oops!</strong> Email or password is incorrect.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <div class="registration-container">
          <h1 class="registration-title">Register</h1>
          <form class="registration-form" method="post" action="{{ route('register.store') }}">
            @csrf
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" id="phone" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <div class="input-group">
                <input type="password" id="pass" name="password" class="form-control" required>
                <div class="input-group-append">
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </form>
          <p class="text-center mt-3">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Add your JavaScript and Bootstrap script references here -->
  <!-- Add Bootstrap JS script link here -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
