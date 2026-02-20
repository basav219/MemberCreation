<!DOCTYPE html>
<html>
<head>
<title>Share Details</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.section-title{
    background:#f1f1f1;
    padding:8px;
    font-weight:600;
    border-left:4px solid #0d6efd;
}
.table-view th {
    width: 200px;
}
</style>
</head>

<body class="bg-light">
<?= view('admin/header', ['title' => 'Member/Share Details']) ?>
<style>
@media print {
    body {
        margin: 0;
        padding: 0;
    }

    /* Hide everything except the print area */
    body * {
        visibility: hidden;
    }
    #printArea, #printArea * {
        visibility: visible;
    }

    #printArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        font-size: 12px; /* reduce font size to fit */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        page-break-inside: avoid; /* avoid breaking table rows across pages */
    }

    th, td {
        border: 1px solid #000;
        padding: 4px;
        text-align: left;
        word-wrap: break-word;
    }

    /* Landscape orientation for wide tables */
    @page {
        size: A4 landscape;
        margin: 10mm;
    }
}
</style>
<div class="container mt-4 bg-white p-4 rounded shadow-sm">
<div class="text-end mb-3">
    <a href="<?= site_url('share/sharecreationlist') ?>" class="btn btn-secondary">← Back to List</a>
    <a href="<?= site_url('share/share_edit/'.$member['customer_id']) ?>" class="btn btn-secondary">Edit</a>
    <button onclick="printDiv('printArea')" class="btn btn-dark">Print</button>
</div>


<div id="printArea">
<h4 class="text-center mb-3">MEMBER / SHARE DETAILS</h4>

 <!-- Customer Details -->
    <div class="section-title">Customer Details</div>
    <table class="table table-bordered">
        <tr>
            <th>Customer ID</th>
            <td><?= esc($member['customer_id']) ?></td>
            <th>Name</th>
            <td><?= esc($member['name']) ?></td>
        </tr>
        <tr>
            <th>Father/Husband</th>
            <td><?= esc($member['father']) ?></td>
            <th>Email</th>
            <td><?= esc($member['email'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?= esc($member['residential_address']) ?></td>
            <th>Mobile</th>
            <td><?= esc($member['mobile']) ?></td>
        </tr>
    </table>


<!-- Share Specifications -->
<div class="section-title mb-2">Share Specifications</div>
<table class="table table-bordered">
    <tr>
        <th>Share Type</th>
        <td><?= esc($share['share_type'] ?? '') ?></td>
        <th>Membership Date</th>
        <td><?= esc($share['membership_date'] ?? '') ?></td>
    </tr>
    <tr>
        <th>LF Number</th>
        <td><?= esc($share['lf_number'] ?? '') ?></td>
        <th>Account Number</th>
        <td><?= esc($share['account_number'] ?? '') ?></td>
    </tr>
    <tr>
        <th>Resolution Date</th>
        <td><?= esc($share['resolution_date'] ?? '') ?></td>
        <th>Other Details</th>
        <td><?= esc($share['other_details'] ?? '') ?></td>
    </tr>
</table>

<!-- Nominee Details -->
<div class="section-title mb-2">Nominee Details</div>
<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>Nominee Name</th>
            <th>Father/Husband</th>
            <th>Relation</th>
            <th>Gender</th>
            <th>Mobile</th>
            <th>Age</th>
            <th>Address</th>
            <th>Percentage</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($nominees)): ?>
            <?php foreach($nominees as $n): ?>
            <tr>
                <td><?= esc($n['nominee_name']) ?></td>
                <td><?= esc($n['nominee_father']) ?></td>
                <td><?= esc($n['nominee_relation']) ?></td>
                <td><?= esc($n['nominee_gender']) ?></td>
                <td><?= esc($n['nominee_mobile']) ?></td>
                <td><?= esc($n['nominee_age']) ?></td>
                <td><?= esc($n['nominee_address']) ?></td>
                <td><?= esc($n['nominee_percentage']) ?>%</td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="8" class="text-center">No nominee details</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Share Details -->
<div class="section-title mb-2">Share Details</div>
<table class="table table-bordered">
    <tr>
        <th>Share Value</th>
        <td><?= esc($share['share_value'] ?? 0) ?></td>
        <th>Number of Shares</th>
        <td><?= esc($share['number_of_shares'] ?? 0) ?></td>
    </tr>
    <tr>
        <th>Share Amount</th>
        <td><?= esc($share['share_amount'] ?? 0) ?></td>
        <th>Share Fees</th>
        <td><?= esc($share['share_fees'] ?? 0) ?></td>
    </tr>
    <tr>
        <th>Entry Fees</th>
        <td><?= esc($share['entry_fees'] ?? 0) ?></td>
        <th>Other Income</th>
        <td><?= esc($share['other_income'] ?? 0) ?></td>
    </tr>
    <tr>
        <th>Building Fund</th>
        <td><?= esc($share['building_fund'] ?? 0) ?></td>
        <th>Total Income</th>
        <td><?= esc($share['total_income'] ?? 0) ?></td>
    </tr>
    <tr>
        <th>Total Expense</th>
        <td><?= esc($share['total_expense'] ?? 0) ?></td>
        <th>Total</th>
        <td><?= esc($share['total'] ?? 0) ?></td>
    </tr>
    <tr>
        <th>Receipt No</th>
        <td><?= esc($share['receipt_no'] ?? '') ?></td>
        <th>Certificate Number</th>
        <td><?= esc($share['certificate_number'] ?? '') ?></td>
    </tr>
    <tr>
        <th>Receipt Mode</th>
        <td><?= esc($share['receipt_mode'] ?? '') ?></td>
        <th>Payment Status</th>
        <td><?= esc($share['payment_status'] ?? '') ?></td>
    </tr>
    <tr>
        <th>Transaction Detail</th>
        <td colspan="3"><?= esc($share['transaction_detail'] ?? '') ?></td>
    </tr>
</table>
</div>
</div>
<script>
function printDiv(divId) {
    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
    location.reload(); // reload page to restore JS events
}
</script>
<?= view('admin/sharefooter') ?>
</body>
</html>