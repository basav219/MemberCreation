<!DOCTYPE html>
<html>
<head>
<title>Update Share</title>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.section-title{
    background:#f1f1f1;
    padding:8px;
    font-weight:600;
    border-left:4px solid #0d6efd;
}
</style>
</head>

<body class="bg-light">
<?= view('admin/header', ['title' => 'Update Share']) ?>

<div class="container mt-4 bg-white p-4 rounded shadow-sm">

<h4 class="text-center mb-3">UPDATE MEMBER/SHARE</h4>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<form method="post" action="<?= site_url('share/update/'.$share['customer_id']) ?>">
<?= csrf_field() ?>

<!-- CUSTOMER DETAILS -->
<div class="section-title mb-3">Customer Details</div>

<input type="text" id="search_customer" class="form-control mb-2" placeholder="Search Customer Id" value="<?= esc($customer['customer_id']) ?>">

<div class="row mb-2">
<div class="col-md-3">Customer ID</div>
<div class="col-md-9">
<input type="text" name="customer_id" id="customer_id_field" class="form-control" readonly value="<?= esc($customer['customer_id']) ?>">
</div>
</div>

<div class="row mb-2">
<div class="col-md-3">Name</div>
<div class="col-md-9">
<input type="text" id="customer_name" class="form-control" readonly value="<?= esc($customer['name']) ?>">
</div>
</div>

<div class="row mb-2">
<div class="col-md-3">Father/Husband</div>
<div class="col-md-9">
<input type="text" id="customer_father" class="form-control" readonly value="<?= esc($customer['father']) ?>">
</div>
</div>

<div class="row mb-2">
<div class="col-md-3">Address</div>
<div class="col-md-9">
<textarea id="customer_address" class="form-control" readonly><?= esc($customer['residential_address']) ?></textarea>
</div>
</div>

<div class="row mb-4">
<div class="col-md-3">Mobile</div>
<div class="col-md-9">
<input type="text" id="customer_mobile" class="form-control" readonly value="<?= esc($customer['mobile']) ?>">
</div>
</div>

<!-- SHARE SPECIFICATIONS -->
<div class="section-title mb-3">Share Specifications</div>

<div class="row mb-2">
<div class="col-md-3">Share Type *</div>
<div class="col-md-3">
<select name="share_type" class="form-select" required>
<option value="">SELECT SHARE SCHEME</option>
<option value="Regular Share" <?= $share['share_type']=='Regular Share'?'selected':'' ?>>Regular Share</option>
<option value="Special Share" <?= $share['share_type']=='Special Share'?'selected':'' ?>>Special Share</option>
</select>
</div>

<div class="col-md-3">Membership Date *</div>
<div class="col-md-3">
<input type="date" name="membership_date" class="form-control" required value="<?= $share['membership_date'] ?>">
</div>
</div>

<div class="row mb-2">
<div class="col-md-3">LF Number</div>
<div class="col-md-3">
<input type="text" name="lf_number" class="form-control" value="<?= $share['lf_number'] ?>">
</div>

<div class="col-md-3">Account Number *</div>
<div class="col-md-3">
<input type="text" name="account_number" class="form-control" required value="<?= $share['account_number'] ?>">
</div>
</div>

<div class="row mb-3">
<div class="col-md-3">Resolution Date</div>
<div class="col-md-3">
<input type="date" name="resolution_date" class="form-control" value="<?= $share['resolution_date'] ?>">
</div>

<div class="col-md-3">Other Details</div>
<div class="col-md-3">
<textarea name="other_details" class="form-control"><?= esc($share['other_details']) ?></textarea>
</div>
</div>

<!-- NOMINEE DETAILS -->
<div class="section-title mb-3">Nominee Details</div>

<div class="row mb-2">
    <div class="col-md-6">
        <label>Nominee Name</label>
        <input type="text" id="nominee_name" class="form-control">
    </div>

    <div class="col-md-6">
        <label>Father / Husband Name</label>
        <input type="text" id="nominee_father" class="form-control">
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-3">
        <label>Relation</label>
        <select id="relation" class="form-control">
            <option value="">Select</option>
            <option>Father</option>
            <option>Mother</option>
            <option>Husband</option>
            <option>Wife</option>
            <option>Son</option>
            <option>Daughter</option>
            <option>Brother</option>
            <option>Sister</option>
        </select>
    </div>

    <div class="col-md-3">
        <label>Gender</label><br>
        <label><input type="radio" name="nominee_gender_temp" value="Male"> Male</label>
        <label><input type="radio" name="nominee_gender_temp" value="Female"> Female</label>
        <label><input type="radio" name="nominee_gender_temp" value="Other"> Other</label>
    </div>

    <div class="col-md-3">
        <label>Mobile</label>
        <input type="text" id="nominee_mobile" class="form-control">
    </div>

    <div class="col-md-3">
        <label>Age</label>
        <input type="number" id="nominee_age" class="form-control">
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-6">
        <label>Address</label>
        <textarea id="nominee_address" class="form-control"></textarea>
    </div>

    <div class="col-md-6">
        <label>Other Details</label>
        <textarea id="nominee_other_details" class="form-control"></textarea>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <label>Percentage</label>
        <input type="number" id="nominee_percentage" class="form-control">
    </div>
</div>

<button type="button" class="btn btn-primary" onclick="addNominee()">Add Nominee</button>
<hr>
<h5 class="text-center">NOMINEE TABLE</h5>

<table class="table table-bordered" id="nomineeTable">
    <thead>
        <tr>
            <th>Nominee Name</th>
            <th>Father/Husband</th>
            <th>Relation</th>
            <th>Percentage</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

<?php
$totalPercent = 0;
if (!empty($nominees)):
foreach ($nominees as $nom):
$totalPercent += (int)$nom['nominee_percentage'];
?>
<tr>
    <td>
        <?= esc($nom['nominee_name']) ?>
        <input type="hidden" name="nominee_name[]" value="<?= esc($nom['nominee_name']) ?>">
    </td>

    <td>
        <?= esc($nom['nominee_father']) ?>
        <input type="hidden" name="nominee_father[]" value="<?= esc($nom['nominee_father']) ?>">
    </td>

    <td>
        <?= esc($nom['nominee_relation']) ?>
        <input type="hidden" name="nominee_relation[]" value="<?= esc($nom['nominee_relation']) ?>">
    </td>

    <td>
        <?= esc($nom['nominee_percentage']) ?>%
        <input type="hidden" name="nominee_percentage[]" value="<?= esc($nom['nominee_percentage']) ?>">
    </td>

    <td>
        <button type="button" class="btn btn-warning btn-sm"
    onclick="editRow(this)">Edit</button>

        <button type="button" class="btn btn-danger btn-sm"
            onclick="removeRow(this, <?= (int)$nom['nominee_percentage'] ?>)">X</button>
    </td>

    <!-- extra hidden fields -->
    <input type="hidden" name="nominee_gender[]" value="<?= esc($nom['nominee_gender']) ?>">
    <input type="hidden" name="nominee_mobile[]" value="<?= esc($nom['nominee_mobile']) ?>">
    <input type="hidden" name="nominee_age[]" value="<?= esc($nom['nominee_age']) ?>">
    <input type="hidden" name="nominee_address[]" value="<?= esc($nom['nominee_address']) ?>">
    <input type="hidden" name="nominee_other_details[]" value="<?= esc($nom['nominee_other_details']) ?>">
</tr>
<?php endforeach; endif; ?>

    </tbody>
</table>

<b>Total Percentage:
    <span id="totalPercentage"><?= $totalPercent ?></span> %
</b>

<!-- SHARE DETAILS -->
<div class="section-title mb-3">Share Details</div>

<div class="row mb-2">
<div class="col-md-3">Share Value *</div>
<div class="col-md-3">
<input type="text" id="share_value" name="share_value" class="form-control"  value="<?= $share['share_value'] ?>" step="0.01">
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Number Of Shares *</div>
<div class="col-md-3">
<input type="text" id="number_of_shares" name="number_of_shares" class="form-control"  value="<?= $share['number_of_shares'] ?>">
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Share Amount</div>
<div class="col-md-3">
<input type="text" id="share_amount" name="share_amount" class="form-control" value="<?= $share['share_amount'] ?>" readonly>
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Share Fees</div>
<div class="col-md-3">
<input type="text" id="share_fees" name="share_fees" class="form-control" value="<?= $share['share_fees'] ?>">
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Entry Fees</div>
<div class="col-md-3">
<input type="text" id="entry_fees" name="entry_fees" class="form-control" value="<?= $share['entry_fees'] ?>">
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Other Income</div>
<div class="col-md-3">
<input type="text" id="other_income" name="other_income" class="form-control" value="<?= $share['other_income'] ?>">
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Building Fund</div>
<div class="col-md-3">
<input type="text" id="building_fund" name="building_fund" class="form-control" value="<?= $share['building_fund'] ?>">
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Total Income</div>
<div class="col-md-3">
<input type="text" id="total_income" name="total_income" class="form-control" value="<?= $share['total_income'] ?>" readonly>
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Total Expense</div>
<div class="col-md-3">
<input type="text" id="total_expense" name="total_expense" class="form-control" value="<?= $share['total_expense'] ?>" readonly>
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Total</div>
<div class="col-md-3">
<input type="text" id="total" name="total" class="form-control" value="<?= $share['total'] ?>" readonly>
</div>
</div>
<div class="row mb-2">
    <div class="col-md-3">Receipt No</div>
    <div class="col-md-3">
        <input type="text"
               id="receipt_no"
               name="receipt_no"
               class="form-control"
               value="<?= esc($share['receipt_no'] ?? '') ?>">
    </div>
</div>
<div class="row mb-2">
    <div class="col-md-3">Certificate Number</div>
    <div class="col-md-3">
        <input type="text"
               id="certificate_number"
               name="certificate_number"
               class="form-control"
               value="<?= esc($share['certificate_number'] ?? '') ?>">
    </div>
</div>
<hr>
<div class="row mb-2">
    <div class="col-md-3">Receipt Mode</div>
    <div class="col-md-3">
        <select name="receipt_mode" class="form-select">
            <option value="">SELECT PAYMENT MODE</option>
            <option value="cash"
                <?= ($share['receipt_mode'] ?? '') === 'cash' ? 'selected' : '' ?>>
                Cash
            </option>
            <option value="cheque"
                <?= ($share['receipt_mode'] ?? '') === 'cheque' ? 'selected' : '' ?>>
                Cheque
            </option>
        </select>
    </div>
</div>
<div class="row mb-2">
    <div class="col-md-3">Payment Status</div>
    <div class="col-md-3">
        <select name="payment_status" class="form-select">
            <option value="">SELECT PAYMENT STATUS</option>
            <option value="paid"
                <?= ($share['payment_status'] ?? '') === 'paid' ? 'selected' : '' ?>>
                Paid
            </option>
            <option value="pending"
                <?= ($share['payment_status'] ?? '') === 'pending' ? 'selected' : '' ?>>
                Pending
            </option>
        </select>
    </div>
</div>
<div class="row mb-2">
    <div class="col-md-3">Transaction Detail</div>
    <div class="col-md-3">
        <input type="text"
               id="transaction_detail"
               name="transaction_detail"
               class="form-control"
               value="<?= esc($share['transaction_detail'] ?? '') ?>">
    </div>
</div>

<div class="footer-btns text-center mt-3 bg-dark p-2">
    <button type="submit" class="btn btn-light">Update</button>
    <a href="<?= site_url('share/sharecreationlist') ?>" class="btn btn-light">Back</a>
    </div>
</div>
</form>
</div>


<script>

let editingRow = null;
let editingOldPercent = 0;
/* =============================
   INITIAL TOTAL (PHP → JS)
============================= */
let total = <?= (int) ($totalPercent ?? 0) ?>;
$('#totalPercentage').text(total);

/* =============================
   LOCK CUSTOMER IN UPDATE
============================= */
$(document).ready(function () {
    $("#search_customer").prop("readonly", true);
});

/* =============================
   MOBILE VALIDATION (10 DIGITS)
============================= */
$('#nominee_mobile').on('input', function () {
    this.value = this.value.replace(/\D/g, '');
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
    }
});

function editRow(btn) {
    editingRow = $(btn).closest('tr');

    // Read values from hidden inputs
    $('#nominee_name').val(editingRow.find('input[name="nominee_name[]"]').val());
    $('#nominee_father').val(editingRow.find('input[name="nominee_father[]"]').val());
    $('#relation').val(editingRow.find('input[name="nominee_relation[]"]').val());

    let gender = editingRow.find('input[name="nominee_gender[]"]').val();
    $('input[name="nominee_gender_temp"][value="' + gender + '"]').prop('checked', true);

    $('#nominee_mobile').val(editingRow.find('input[name="nominee_mobile[]"]').val());
    $('#nominee_age').val(editingRow.find('input[name="nominee_age[]"]').val());
    $('#nominee_address').val(editingRow.find('input[name="nominee_address[]"]').val());
    $('#nominee_other_details').val(editingRow.find('input[name="nominee_other_details[]"]').val());

    editingOldPercent = parseInt(
        editingRow.find('input[name="nominee_percentage[]"]').val()
    );

    $('#nominee_percentage').val(editingOldPercent);
}

/* =============================
   ADD NOMINEE
============================= */
function addNominee() {

    let name     = $('#nominee_name').val().trim();
    let father   = $('#nominee_father').val().trim();
    let relation = $('#relation').val();
    let gender   = $('input[name="nominee_gender_temp"]:checked').val();
    let mobile   = $('#nominee_mobile').val().trim();
    let age      = $('#nominee_age').val();
    let address  = $('#nominee_address').val().trim();
    let other    = $('#nominee_other_details').val().trim();
    let percent  = parseInt($('#nominee_percentage').val());

    if (!name || !relation || !gender || !percent) {
        alert('Please fill all required nominee fields');
        return;
    }

    if (!/^\d{10}$/.test(mobile)) {
        alert('Mobile number must be exactly 10 digits');
        return;
    }

    if (percent <= 0 || percent > 100) {
        alert('Invalid percentage');
        return;
    }

    /* ==========================
       EDIT EXISTING NOMINEE
    ========================== */
    if (editingRow) {

        let newTotal = total - editingOldPercent + percent;

        if (newTotal > 100) {
            alert('Total nominee percentage cannot exceed 100');
            return;
        }

        total = newTotal;

        editingRow.html(`
            <td>${name}</td>
            <td>${father}</td>
            <td>${relation}</td>
            <td>${percent}%</td>
            <td>
                <button type="button" class="btn btn-warning btn-sm"
                    onclick="editRow(this)">Edit</button>
                <button type="button" class="btn btn-danger btn-sm"
                    onclick="removeRow(this, ${percent})">X</button>
            </td>

            <input type="hidden" name="nominee_name[]" value="${name}">
            <input type="hidden" name="nominee_father[]" value="${father}">
            <input type="hidden" name="nominee_gender[]" value="${gender}">
            <input type="hidden" name="nominee_relation[]" value="${relation}">
            <input type="hidden" name="nominee_mobile[]" value="${mobile}">
            <input type="hidden" name="nominee_age[]" value="${age}">
            <input type="hidden" name="nominee_address[]" value="${address}">
            <input type="hidden" name="nominee_other_details[]" value="${other}">
            <input type="hidden" name="nominee_percentage[]" value="${percent}">
        `);

        editingRow = null;
        editingOldPercent = 0;

    } 
    /* ==========================
       ADD NEW NOMINEE
    ========================== */
    else {

        if ((total + percent) > 100) {
            alert('Total nominee percentage cannot exceed 100');
            return;
        }

        total += percent;

        $('#nomineeTable tbody').append(`
            <tr>
                <td>${name}</td>
                <td>${father}</td>
                <td>${relation}</td>
                <td>${percent}%</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm"
                        onclick="editRow(this)">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm"
                        onclick="removeRow(this, ${percent})">X</button>
                </td>

                <input type="hidden" name="nominee_name[]" value="${name}">
                <input type="hidden" name="nominee_father[]" value="${father}">
                <input type="hidden" name="nominee_gender[]" value="${gender}">
                <input type="hidden" name="nominee_relation[]" value="${relation}">
                <input type="hidden" name="nominee_mobile[]" value="${mobile}">
                <input type="hidden" name="nominee_age[]" value="${age}">
                <input type="hidden" name="nominee_address[]" value="${address}">
                <input type="hidden" name="nominee_other_details[]" value="${other}">
                <input type="hidden" name="nominee_percentage[]" value="${percent}">
            </tr>
        `);
    }

    $('#totalPercentage').text(total);
    resetNomineeForm();
}
function resetNomineeForm() {
    $('#nominee_name').val('');
    $('#nominee_father').val('');
    $('#relation').val('');
    $('input[name="nominee_gender_temp"]').prop('checked', false);
    $('#nominee_mobile').val('');
    $('#nominee_age').val('');
    $('#nominee_address').val('');
    $('#nominee_other_details').val('');
    $('#nominee_percentage').val('');

    editingRow = null;
    editingOldPercent = 0;
}


/* =============================
   REMOVE NOMINEE
============================= */
function removeRow(btn, percent) {
    total -= percent;
    $('#totalPercentage').text(total);
    $(btn).closest('tr').remove();
}


// Share calculations
function updateShareAmount() {
    let value = parseFloat($('#share_value').val()) || 0;
    let qty   = parseInt($('#number_of_shares').val()) || 0;
    let amount = value * qty;
    $('#share_amount').val(amount.toFixed(2));
    updateTotals();
}
//total share calculations
function updateTotals() {
    let share_amount = parseFloat($('#share_amount').val()) || 0;
    let share_fees   = parseFloat($('#share_fees').val()) || 0;
    let entry_fees   = parseFloat($('#entry_fees').val()) || 0;
    let other_income = parseFloat($('#other_income').val()) || 0;
    let building_fund= parseFloat($('#building_fund').val()) || 0;

    let total_income = share_amount + share_fees + entry_fees + other_income + building_fund;
    $('#total_income').val(total_income.toFixed(2));

    let total_expense = 0; // add expense fields if needed
    $('#total_expense').val(total_expense.toFixed(2));

    let total = total_income - total_expense;
    $('#total').val(total.toFixed(2));
}

$('#share_value, #number_of_shares').on('input', updateShareAmount);
$('#share_fees, #entry_fees, #other_income, #building_fund').on('input', updateTotals);


// requires fields to fill the form 
document.querySelector('form').addEventListener('submit', function (e) {

    let errors = [];

    const shareValue = document.getElementById('share_value').value.trim();
    const shares = document.getElementById('number_of_shares').value.trim();
    const receiptMode = document.querySelector('[name="receipt_mode"]').value;
    const paymentStatus = document.querySelector('[name="payment_status"]').value;

    if (shareValue === '' || isNaN(shareValue) || shareValue <= 0) {
        errors.push("Share Value must be a positive number");
    }

    if (shares === '' || isNaN(shares) || shares <= 0) {
        errors.push("Number of Shares must be greater than 0");
    }

    if (receiptMode === '') {
        errors.push("Receipt Mode is required");
    }

    if (paymentStatus === '') {
        errors.push("Payment Status is required");
    }

    if (errors.length > 0) {
        e.preventDefault();
        alert(errors.join("\n"));
    }
});

</script>
</body>
</html>