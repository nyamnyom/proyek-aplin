<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f5f5f5;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .auth-box {
      background-color: #8B1E20;
      color: white;
      padding: 2rem;
      border-radius: 10px;
      max-width: 400px;
      width: 100%;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .auth-box .form-control {
      border-radius: 6px;
    }

    .auth-box .btn-black {
      background-color: black;
      color: white;
      border: none;
    }

    .auth-box .btn-google {
      background-color: white;
      color: black;
      border: 1px solid #ddd;
    }

    .auth-box .divider {
      text-align: center;
      margin: 1rem 0;
    }

    .auth-box .divider::before,
    .auth-box .divider::after {
      content: '';
      display: inline-block;
      width: 40%;
      height: 1px;
      background-color: #fff;
      vertical-align: middle;
      margin: 0 10px;
    }
    
    .auth-box .divider {
      display: flex;
      align-items: center;
      text-align: center;
      color: white;
      margin: 1.5rem 0;
    }

    .auth-box .divider::before,
    .auth-box .divider::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid rgba(255, 255, 255, 0.4);
    }

    .auth-box .divider span {
      margin: 0 1rem;
      font-size: 0.9rem;
      color: white;
    }

    .auth-box small a {
      color: #ffc107;
      text-decoration: underline;
    }

    .logo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        margin-right: 10px;
        border: 4px solid white;
    }
  </style>
</head>
<body>

  <div class="auth-box text-center">
    <div class="p-3 d-flex align-items-center ms-3">
        <div class="logo">WH</div>
        <h5 class="fw-bold mt-2">Wei Hong Restaurant</h5>
    </div>
    <p>User Login</p>
    
    <input type="text" id="username" class="form-control mb-2" placeholder="Username" />
    
    <div class="input-group mb-2">
      <input type="password" id="password" class="form-control" placeholder="Password" />
    </div>

    <button class="btn btn-black w-100 mb-3" onclick="login()">Login</button>
    
    <div class="divider">or continue with</div>
    
    <button class="btn btn-google w-100 mb-3 d-flex align-items-center justify-content-center">
      <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg" alt="Google" width="20" class="me-2" />
      Google
    </button>

    <small>
        Haven’t create an account yet? <a href="register">Register account</a>
    </small>
  </div>

  <script>
    const users = [
      {
        username: 'admin',
        password: 'admin',
        location: 'dashboard'
      },
      {
        username: 'kasir',
        password: 'kasir',
        location: 'kasir-main'
      },
      {
        username: 'customer',
        password: 'customer',
        location: 'home'
      }
    ];

    function login() {
      const username = document.getElementById('username').value.trim();
      const password = document.getElementById('password').value.trim();

      const user = users.find(u => u.username === username && u.password === password);

      if (user) {
        window.location.href = user.location;
      } else {
        alert("Username atau password salah!");
      }
    }
  </script>
</body>
</html>

