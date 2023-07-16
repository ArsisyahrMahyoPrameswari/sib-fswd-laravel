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

    .login-container {
      max-width: 400px;
      margin: 100px auto;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      background-color: #fff;
    }

    .login-title {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 30px;
    }

    .login-form input[type="text"],
    .login-form input[type="password"] {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      width: 100%;
      margin-bottom: 20px;
    }

    .login-form button {
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

    .login-form button:hover {
      background-color: #0056b3;
    }

    .login-form p {
      text-align: center;
      margin-top: 15px;
    }

    .login-form p a {
      color: #007bff;
      font-weight: bold;
      text-decoration: none;
    }

    .login-form p a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- Login Form -->
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
        <div class="login-container">
          <h1 class="login-title">Login</h1>
          <form class="login-form" method="post" action="{{ route('login.authenticate') }}">
            @csrf
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input type="password" id="pass" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
          <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
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
