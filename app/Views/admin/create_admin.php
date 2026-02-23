<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
    <title>Admin Create </title>
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
<?= view('admin/header', data: ['title' => 'Admin Dashboard']) ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 login-box">
            <h2 class="text-center mb-2">Create Admin</h2>
                   <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

<form method="post" action="<?= site_url('admin/store') ?>" id="loginForm">
     <!-- User Type Dropdown -->
                <div class="mb-3">
                    <select name="role" id="role" class="form-control">
                        <option value="">Select User Type</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
   

          <div class="mb-3">
                   <input type="text" name="username" id="username" class="form-control mb-2" placeholder="Username">
          </div>
          <div class="mb-3">
                     <input type="password" name="password" id="password"  class="form-control mb-2" placeholder="Password">
           </div>

          <button class="btn btn-success">Create Admin</button>
          <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-secondary">Back</a>
      </form>
   </div>
  </div>
</div>
<?= view('admin/sharefooter') ?>
</body>
</html>