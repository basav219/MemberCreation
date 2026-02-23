<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Change Password - <?= esc($admin['username']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .change-password-box {
            margin-top: 100px;
            padding: 30px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .change-password-box h2 {
            font-weight: 700;
        }

        .btn-primary {
            background-color: #0f0b3d;
            border-color: #030214;
        }
    </style>
</head>
<body>

<?= view('admin/header', ['title' => 'Admin Dashboard']) ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 change-password-box">
            <h2 class="text-center mb-4">Change Password for <strong><?= esc($admin['username']) ?></strong></h2>

            <!-- Flash messages -->
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <!-- Change Password Form -->
            <form action="<?= site_url('admin/update_password/' . $admin['id']) ?>" method="post">
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter new password" required>
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm new password" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Update Password</button>
                    <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= view('admin/sharefooter') ?>
</body>
</html>