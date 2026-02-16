<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
        body {
            background-color: #f8f9fa;
        }
        .login-box {
            margin-top: 100px;
            /* padding: 30px;
            /* background: #f4ecec; */
            /* border-radius: 8px; */ 
            /* box-shadow: 0 4px 10px rgba(0,0,0,0.1); */
        }
        .login-box h2 {
            font-weight: 700;
        }
        .btn-primary {
            background-color: #0f0b3d;
            border-color: #030214;
        }
    </style>
</head>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 login-box">
            <h2 class="text-center mb-2">Admin Login</h2>
                   <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

<form method="post" action="<?= base_url('admin/authenticate') ?>" id="loginForm">
          <div class="mb-3">
    <input type="text" name="username" id="username"
         class="form-control mb-2"
           placeholder="Username">
       </div>
     <div class="mb-3">
    <input type="password" name="password" id="password"
           class="form-control mb-2"
           placeholder="Password">
</div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
</form>
</div>
</div>
</div>
<!-- 🟢 CLIENT-SIDE VALIDATION -->
<script>
document.getElementById('loginForm').addEventListener('submit', function (e) {
    let errors = [];

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    if (username === '') {
        errors.push("Username is required");
    }

    if (password === '') {
        errors.push("Password is required");
    } else if (password.length < 6) {
        errors.push("Password must be at least 6 characters");
    }

    if (errors.length > 0) {
        e.preventDefault();
        alert(errors.join("\n"));
    }
});
</script>

</body>
</html>