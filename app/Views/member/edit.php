<!DOCTYPE html>
<html>
<head>
    <title>Edit Member</title>

    <link rel="stylesheet" href="<?= base_url('css/member.css') ?>">

    <style>
        .form-group {
            margin-bottom: 10px;
        }
        label {
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 6px;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn-update {
            background: #198754;
            color: #fff;
        }
        .btn-back {
            background: #6c757d;
            color: #fff;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 4px;
        }
        .img-box {
            width: 200px;
            height: 150px;
            border: 1px solid #ccc;
            margin-bottom: 5px;
            text-align: center;
            line-height: 150px;
        }
        .img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>

<h2>Edit Member</h2>

<form action="<?= site_url('member/update/'.$member['id']) ?>" 
      method="post" 
      enctype="multipart/form-data">

<?= csrf_field() ?>

<div class="form-group">
    <label>Customer ID</label>
    <input type="text" name="customer_id" value="<?= esc($member['customer_id']) ?>">
</div>

<div class="form-group">
    <label>Member Code</label>
    <input type="text" name="member_code" value="<?= esc($member['member_code']) ?>">
</div>

<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" value="<?= esc($member['name']) ?>">
</div>

<div class="form-group">
    <label>Mobile</label>
    <input type="text" name="mobile" value="<?= esc($member['mobile']) ?>">
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" value="<?= esc($member['email']) ?>">
</div>

<div class="form-group">
    <label>Photo</label>
    <div class="img-box">
        <?php if (!empty($member['photo'])): ?>
            <img src="<?= base_url('uploads/photos/'.$member['photo']) ?>">
        <?php else: ?>
            No Image
        <?php endif; ?>
    </div>
    <input type="file" name="photo">
</div>

<div class="form-group">
    <label>Signature</label>
    <div class="img-box">
        <?php if (!empty($member['signature'])): ?>
            <img src="<?= base_url('uploads/signatures/'.$member['signature']) ?>">
        <?php else: ?>
            No Signature
        <?php endif; ?>
    </div>
    <input type="file" name="signature">
</div>

<br>

<button type="submit" class="btn btn-update">Update</button>
<a href="<?= site_url('member') ?>" class="btn-back">Back</a>

</form>

</body>
</html>