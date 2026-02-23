<!DOCTYPE html>
<html>
<head>
    <title>Member View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .label { font-weight: 600; }
        .value { border-bottom: 1px dotted #999; padding-bottom: 2px; }
        .section-title {
            background: #6c757d;
            color: #fff;
            padding: 6px 10px;
            font-weight: bold;
            margin-top: 20px;
        }
        .img-box {
            border: 1px solid #ccc;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

<?= view('admin/header', ['title' => 'Member View']) ?>

<div class="container-fluid mt-3 px-5">

<div class="card shadow-sm">
<div class="card-body">

<!-- ================= MEMBER DETAILS ================= -->
<div class="section-title">MEMBER DETAILS</div>

<div class="row mt-3">
    <div class="col-md-6">
        <p><span class="label">Customer ID:</span> <span class="value"><?= esc($member['customer_id']) ?></span></p>
        <p><span class="label">Member Code:</span> <span class="value"><?= esc($member['member_code']) ?></span></p>
        <p><span class="label">Name:</span> <span class="value"><?= esc($member['title'].' '.$member['name']) ?></span></p>
        <p><span class="label">Father/Husband:</span> <span class="value"><?= esc($member['father']) ?></span></p>
        <p><span class="label">Mobile:</span> <span class="value"><?= esc($member['mobile']) ?></span></p>
        <p><span class="label">Email:</span> <span class="value"><?= esc($member['email']) ?></span></p>
        <p><span class="label">DOB:</span> <span class="value"><?= esc($member['dob']) ?></span></p>
        <p><span class="label">Age:</span> <span class="value"><?= esc($member['age']) ?></span></p>
    </div>

    <div class="col-md-6">
        <p><span class="label">Gender:</span> <span class="value"><?= esc($member['gender']) ?></span></p>
        <p><span class="label">Occupation:</span> <span class="value"><?= esc($member['occupation']) ?></span></p>
        <p><span class="label">Religion:</span> <span class="value"><?= esc($member['religion']) ?></span></p>
        <p><span class="label">Caste:</span> <span class="value"><?= esc($member['caste']) ?></span></p>
        <p><span class="label">Aadhar:</span> <span class="value"><?= esc($member['adhar']) ?></span></p>
        <p><span class="label">PAN:</span> <span class="value"><?= esc($member['pan']) ?></span></p>
        <p><span class="label">Marital Status:</span> <span class="value"><?= esc($member['marital_status']) ?></span></p>
    </div>
</div>

<!-- ================= ADDRESS ================= -->
<div class="section-title">ADDRESS DETAILS</div>

<div class="row mt-3">
    <div class="col-md-6">
        <p><span class="label">Residential Address:</span><br><?= esc($member['residential_address']) ?></p>
        <p><span class="label">Permanent Address:</span><br><?= esc($member['permanent_address']) ?></p>
    </div>
    <div class="col-md-6">
        <p><span class="label">Pincode:</span> <?= esc($member['pincode']) ?></p>
        <p><span class="label">Area:</span> <?= esc($member['area']) ?></p>
        <p><span class="label">Taluk:</span> <?= esc($member['taluk']) ?></p>
        <p><span class="label">District:</span> <?= esc($member['district']) ?></p>
        <p><span class="label">State:</span> <?= esc($member['state']) ?></p>
    </div>
</div>

<!-- ================= NOMINEE ================= -->
<div class="section-title">NOMINEE DETAILS</div>

<div class="row mt-3">
    <div class="col-md-6">
        <p><span class="label">Name:</span> <?= esc($nominee['nominee_name'] ?? '-') ?></p>
        <p><span class="label">Relation:</span> <?= esc($nominee['nominee_relation'] ?? '-') ?></p>
        <p><span class="label">Gender:</span> <?= esc($nominee['nominee_gender'] ?? '-') ?></p>
        <p><span class="label">Age:</span> <?= esc($nominee['nominee_age'] ?? '-') ?></p>
    </div>
    <div class="col-md-6">
        <p><span class="label">Mobile:</span> <?= esc($nominee['nominee_mobile'] ?? '-') ?></p>
        <p><span class="label">Aadhar:</span> <?= esc($nominee['nominee_adhar'] ?? '-') ?></p>
        <p><span class="label">Address:</span><br><?= esc($nominee['nominee_address'] ?? '-') ?></p>
    </div>
</div>

<!-- ================= INTRODUCER ================= -->
<div class="section-title">INTRODUCER DETAILS</div>

<div class="row mt-3">
    <div class="col-md-6">
        <p><span class="label">Customer ID:</span> <?= $member['introducer_customer_id'] ?? '-' ?></p>
        <p><span class="label">Name:</span><?= $member['introducer_name'] ?? '-' ?></p>
    </div>
    <div class="col-md-6">
        <p><span class="label">Father:</span> <?= $member['introducer_father'] ?? '-' ?></p>
        <p><span class="label">Mobile:</span> <?= $member['introducer_mobile'] ?? '-' ?></p>
    </div>
</div>

<!-- ================= KYC ================= -->
<div class="section-title">KYC DETAILS</div>
<div class="row mt-3">
    <div class="col-md-6">
    
    <?php if (!empty($member['photo'])): ?>
        <img src="<?= base_url('uploads/photos/' . $member['photo']) ?>"
             width="120" height="140"
             style="border:1px solid #000">
    <?php else: ?>
        <span>No Photo</span>
    <?php endif; ?>


   
    <?php if (!empty($member['signature'])): ?>
        <img src="<?= base_url('uploads/signatures/' . $member['signature']) ?>"
             width="120" height="140"
             style="border:1px solid #000">
    <?php else: ?>
        <span>No Signature</span>
    <?php endif; ?>
</div>
</div>
<!-- ================= BUTTONS ================= -->
<div class="text-center mt-4 no-print">
    <button onclick="window.print()" class="btn btn-primary">Print</button>
    <a href="<?= site_url('member/list') ?>" class="btn btn-secondary">Back</a>
</div>

</div>
</div>
</div>

<?= view('admin/footer') ?>

</body>
</html>