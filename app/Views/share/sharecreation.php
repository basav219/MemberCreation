<!DOCTYPE html>
<html>
<head>
<title>Share Creation</title>


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
<?= view('admin/header', data: ['title' => 'Member Creation']) ?>

<div class="container mt-4 bg-white p-4 rounded shadow-sm">

<h4 class="text-center mb-3">MEMBER/SHARE CREATION</h4>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success">
<?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>


<?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger">
    <?= session()->getFlashdata('error') ?>
</div>
<?php endif; ?>

<form method="post" action="<?= site_url('share/store') ?>">
<?= csrf_field() ?>

<div class="section-title mb-3">Customer Details</div>

<input type="text" id="search_customer" class="form-control mb-2" placeholder="Search Customer Id">

<div class="row mb-2">
<div class="col-md-3">Customer ID</div>
<div class="col-md-9">
<input type="text" name="customer_id" id="customer_id" class="form-control" readonly>
</div>
</div>

<div class="row mb-2">
<div class="col-md-3">Name</div>
<div class="col-md-9">
<input type="text" id="name" class="form-control" readonly>
</div>
</div>

<div class="row mb-2">
<div class="col-md-3">Father/Husband</div>
<div class="col-md-9">
<input type="text" id="father" class="form-control" readonly>
</div>
</div>

<div class="row mb-2">
<div class="col-md-3">Address</div>
<div class="col-md-9">
<textarea id="address" class="form-control" readonly></textarea>
</div>
</div>

<div class="row mb-4">
<div class="col-md-3">Mobile</div>
<div class="col-md-9">
<input type="text" id="mobile" class="form-control" readonly>
</div>
</div>

<div class="section-title mb-3">Share Specifications</div>

<div class="row mb-2">
<div class="col-md-3">Share Type *</div>
<div class="col-md-3">
<select name="share_type" class="form-select" required>
<option value="">SELECT SHARE SCHEME</option>
<option value="Regular Share">Regular Share</option>
<option value="Special Share">Special Share</option>
</select>
</div>

<div class="col-md-3">Membership Date *</div>
<div class="col-md-3">
<input type="date" name="membership_date" class="form-control" required>
</div>
</div>

<div class="row mb-2">
<div class="col-md-3">LF Number</div>
<div class="col-md-3">
<input type="text" name="lf_number" class="form-control">
</div>

<div class="col-md-3">Account Number *</div>
<div class="col-md-3">
<input type="text" name="account_number" class="form-control" required>
</div>
</div>

<div class="row mb-3">
<div class="col-md-3">Resolution Date</div>
<div class="col-md-3">
<input type="date" name="resolution_date" class="form-control">
</div>

<div class="col-md-3">Other Details</div>
<div class="col-md-3">
<textarea name="other_details" class="form-control"></textarea>
</div>
</div>
<input type="hidden" id="edit_index" value="">
<div class="section-title mb-3">Nominee Details</div>

<div class="row mb-2">
    <div class="col-md-6">
        <label>Nominee Name</label>
        <input type="text" id="nominee_name" class="form-control">
    </div>

    <div class="col-md-6">
        <label>Father / Husband Name</label>
        <input type="text" id="father_name" class="form-control">
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
        <input type="radio" name="gender" value="Male"> Male
        <input type="radio" name="gender" value="Female"> Female
        <input type="radio" name="gender" value="Other"> Other
    </div>

    <div class="col-md-3">
        <label>Mobile No</label>
        <input type="text" id="nominee_mobile" class="form-control" maxlength="10">
    </div>

    <div class="col-md-3">
        <label>Age</label>
        <input type="number" id="age" class="form-control">
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
    <tbody></tbody>
</table>

<b>Total Percentage: <span id="totalPercentage">0</span> %</b>

<hr>
<div class="section-title mb-3">Share Details</div>

<div class="row mb-2">
<div class="col-md-3">Share Value *</div>
<div class="col-md-3">
<input type="text" id="share_value" name="share_value" class="form-control"  value="0" step="0.01">
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Number Of Shares *</div>
<div class="col-md-3">
<input type="text" id="number_of_shares" name="number_of_shares" class="form-control"  value="0">
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Share Amount</div>
<div class="col-md-3">
<input type="text" id="share_amount" name="share_amount" class="form-control" >
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Share Fees</div>
<div class="col-md-3">
<input type="text" id="share_fees" name="share_fees" class="form-control" value="0">
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Entry Fees</div>
<div class="col-md-3">
<input type="text" id="entry_fees" name="entry_fees" class="form-control" value="0">
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Other Income</div>
<div class="col-md-3">
<input type="text" id="other_income" name="other_income" class="form-control" >
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Building Fund</div>
<div class="col-md-3">
<input type="text" id="building_fund" name="building_fund" class="form-control" >
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Total Income</div>
<div class="col-md-3">
<input type="text" id="total_income" name="total_income" class="form-control" >
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Total Expense</div>
<div class="col-md-3">
<input type="text" id="total_expense" name="total_expense" class="form-control" >
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Total</div>
<div class="col-md-3">
<input type="text" id="total" name="total" class="form-control">
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Receipt No</div>
<div class="col-md-3">
<input type="text" id="receipt_no" name="receipt_no" class="form-control">
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Certificate Number</div>
<div class="col-md-3">
<input type="text" id="certificate_number" name="certificate_number" class="form-control">
</div>
</div>
<hr>
<div class="row mb-2">
<div class="col-md-3">Receipt Mode<</div>
<div class="col-md-3">
<select name="receipt_mode">
        <option value="">SELECT PAYMENT MODE</option>
        <option value="cash">Cash</option>
        <option value="cheque">Cheque</option>
    </select>
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Payment Status</div>
<div class="col-md-3">
<select name="payment_status">
        <option value="">SELECT PAYMENT STATUS</option>
        <option value="paid">Paid</option>
        <option value="pending">Pending</option>
    </select>
</div>
</div>
<div class="row mb-2">
<div class="col-md-3">Transaction Detail</div>
<div class="col-md-3">
<input type="text" id="transaction_detail" name="transaction_detail" class="form-control">
</div>
</div>

<div class="section-title mb-3 text-center">       

<button class="btn btn-primary px-4">Create Share</button>


</div>

</form>
</div>
<?= view('admin/sharefooter') ?>


<script>
let total = 0;

$(document).ready(function () {

    $("#search_customer").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "<?= site_url('customer/search') ?>",
                dataType: "json",
                data: { term: request.term },
                success: response
            });
        },
        minLength: 1,

        select: function (event, ui) {

            let customerId = ui.item.value; // ✅ SAFE

            $("#customer_id").val(customerId);

            // ======================
            // CUSTOMER DETAILS
            // ======================
            $.getJSON(
                "<?= site_url('customer/details') ?>/" + customerId,
                function (data) {
                    $("#name").val(data.name);
                    $("#father").val(data.father);
                    $("#address").val(data.residential_address);
                    $("#mobile").val(data.mobile);
                }
            );

            // ======================
            // RESET NOMINEE TABLE
            // ======================
            total = 0;
            $("#nomineeTable tbody").html('');
            $("#totalPercentage").text(0);

            // ======================
            // LOAD EXISTING NOMINEES
            // ======================
            $.getJSON(
                "<?= site_url('share/getNominees') ?>/" + customerId,
                function (nominees) {
                    loadExistingNominees(nominees);
                }
            );

            // ======================
            // CHECK SHARE EXISTS
            // ======================
            $.getJSON(
                "<?= site_url('share/check-exists') ?>/" + customerId,
                function (res) {
                    if (res.exists) {
                        alert('Share already exists. Redirecting to edit page.');
                        window.location.href =
                            "<?= site_url('share/share_edit') ?>/" + customerId;
                    }
                }
            );
        }
    });

});
</script>
<script>
function loadExistingNominees(nominees) {

    total = 0;
    $('#nomineeTable tbody').html('');

    nominees.forEach(function(n) {

        let percent = parseInt(n.nominee_percentage) || 0;
        total += percent;

        $('#nomineeTable tbody').append(`
            <tr>
                <td class="td-name">${n.nominee_name}</td>
                <td class="td-father">${n.nominee_father}</td>
                <td class="td-relation">${n.nominee_relation}</td>
                <td class="td-percent">${percent}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm editRow">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm deleteRow">X</button>
                </td>

                <input type="hidden" name="nominee_name[]" value="${n.nominee_name}">
                <input type="hidden" name="nominee_father[]" value="${n.nominee_father}">
                <input type="hidden" name="nominee_relation[]" value="${n.nominee_relation}">
                <input type="hidden" name="nominee_percentage[]" value="${percent}">
            </tr>
        `);
    });

    $('#totalPercentage').text(total);
}
$(document).on('click', '.editRow', function () {

    let row = $(this).closest('tr');
    let index = row.index();

    $('#nominee_name').val(row.find('.td-name').text());
    $('#father_name').val(row.find('.td-father').text());
    $('#relation').val(row.find('.td-relation').text());

    // ✅ ALWAYS NUMBER
    $('#nominee_percentage').val(
        row.find('.td-percent').text().replace('%','').trim()
    );

    $('#edit_index').val(index);
});

function addNominee() {

    let name     = $('#nominee_name').val().trim();
    let father   = $('#father_name').val().trim();
    let relation = $('#relation').val();
    let percent  = parseInt($('#nominee_percentage').val());
    let mobile  = parseInt($('#nominee_mobile').val());

    let editIdx  = $('#edit_index').val();

    if (!name || !relation || !percent ){
        alert('Fill required nominee fields');
        return;
    }
   
    if (percent <= 0 || percent > 100) {
        alert('Invalid percentage');
        return;
    }

    // ================= UPDATE =================
   if (editIdx !== "") {

    let row = $('#nomineeTable tbody tr').eq(editIdx);

    let oldPercent = parseInt(row.find('.td-percent').text());

    if ((total - oldPercent + percent) > 100) {
        alert('Total percentage cannot exceed 100');
        return;
    }

    total = total - oldPercent + percent;

    // update table
    row.find('.td-name').text(name);
    row.find('.td-father').text(father);
    row.find('.td-relation').text(relation);
    row.find('.td-percent').text(percent);

    // update hidden inputs
    row.find('input[name="nominee_name[]"]').val(name);
    row.find('input[name="nominee_father[]"]').val(father);
    row.find('input[name="nominee_relation[]"]').val(relation);
    row.find('input[name="nominee_percentage[]"]').val(percent);

    $('#edit_index').val("");
}
    // ================= ADD =================
    else {

        if ((total + percent) > 100) {
            alert('Total percentage cannot exceed 100');
            return;
        }

        total += percent;

        $('#nomineeTable tbody').append(`
            <tr>
                <td class="td-name">${name}</td>
                <td class="td-father">${father}</td>
                <td class="td-relation">${relation}</td>
                <td class="td-percent">${percent}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm editRow">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm deleteRow">X</button>
                </td>

                <input type="hidden" name="nominee_name[]" value="${name}">
                <input type="hidden" name="nominee_father[]" value="${father}">
                <input type="hidden" name="nominee_relation[]" value="${relation}">
                <input type="hidden" name="nominee_percentage[]" value="${percent}">
            </tr>
        `);
    }

    $('#totalPercentage').text(total);
    clearNomineeInputs();
}

$(document).on('click', '.deleteRow', function () {

    let row = $(this).closest('tr');
    let percent = parseInt(row.find('.td-percent').text());

    total -= percent;
    $('#totalPercentage').text(total);
    row.remove();
});
function clearNomineeInputs() {
    $('#nominee_name').val('');
    $('#father_name').val('');
    $('#relation').val('');
    $('#nominee_percentage').val('');
    $('#edit_index').val('');
}

$('form').on('submit', function (e) {

    if (total !== 100) {
        alert('Total nominee percentage must be exactly 100%');
        e.preventDefault();
    }
});
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
//validate the nominee number restrict the alphabets
$('#nominee_mobile').on('input', function () {
    // remove non-digits
    this.value = this.value.replace(/\D/g, '');

    // limit to 10 digits
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
    }
});
</script>

</body>
</html>