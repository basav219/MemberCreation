
<!DOCTYPE html>
<html>
<head>
    <title>Customer Creation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('CSS/app.css') ?>">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
        <?= view('admin/header', ['title' => 'Member Creation']) ?>
<div class="container-fluid mt-2 px-5">
    <div class="card shadow-sm">
        <div class="card-body">
   
<div class="container-fluid mt-2">
    <div class="bg-secondary text-white text-center p-2 fw-bold">
        MEMBER CREATION
      </div>
         <form action="<?= base_url('member/edit-by-customer') ?>" method="post" class="mb-2">
    <?= csrf_field() ?>
    <?php if (isset($validation)): ?>
<div class="alert alert-danger">
    <?= $validation->listErrors() ?>
</div>
<?php endif; ?>
    <div class="row align-items-center">
        <div class="col-md-2 fw-bold">Edit Existing Customer</div>
        <div class="col-md-2">
            <input type="text"
                   name="customer_id"
                   class="form-control"
                   placeholder="Enter Customer ID">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-warning">
                Edit
            </button>
        </div>
    </div>
</form>  
       <form action="<?= site_url('member/store') ?>" name="memberForm" method="post" enctype="multipart/form-data" 
      onsubmit="return validateForm();">
     <?= csrf_field() ?>
    <div class="row mt-2">

        <!-- LEFT FORM -->
        <div class="col-md-6">
            <div class="row mb-2">
                <div class="col-4">Customer Id</div>
                <div class="col-8">
                    <div class="input-group">
                        <input class="form-control" name="customer_id" placeholder="Customer_ID" style="width: 100px; height: 25px;">
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Member Code</div>
                <div class="col-8">
                    <input class="form-control" name="member_code" placeholder="member_code">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Name</div>
                <div class="col-2">
                    <select class="form-control" name="title">
                        <option>Mr</option>
                        <option>Mrs</option>
                    </select>
                </div>
                <div class="col-6">
                   <input type="text" id="name" name="name" class="form-control" placeholder="FULL NAME" onkeydown="return onlyAlpabets(event)"
                    onpaste="return false" ondrop="return false"  oninput="validateName()">
                   <small id="nameError" style="color:red"></small>
                </div>
            </div>
                <div class="row mb-2">
                <div class="col-4">Father/Husband Name </div>
                <div class="col-8">
                    <input class="form-control" name="father" placeholder="FATHER/HUSBAND NAME" onkeydown="return onlyAlpabets(event)"
                    onpaste="return false" ondrop="return false" >
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">Residential Address</div>
                <div class="col-8">
                    <textarea class="form-control" name="residential_address" placeholder="RESIDENTIAL FULL ADDRESS "></textarea>
                </div>
            </div>
           
            
            <div class="row mb-2">
                <div class="col-4">Mobile Number</div>
                <div class="col-8">
                    <input type="text" id="mobile" name="mobile" inputmode="numeric" class="form-control" placeholder="10 DIGIT MOBAIL NUMBER" maxlength="10" onkeydown="return onlyNumbers(event)"
                    onpaste="return false" ondrop="return false"  oninput=" validateMobile()">
                    <small id="mobileError" style="color:red"></small>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Email</div>
                <div class="col-8">
                   <input type="email" id="email" name="email" class="form-control" placeholder="email@example.com" oninput="validateEmail()">
                   <small id="emailError" style="color:red"></small>
                </div> 
            </div>

            <div class="row mb-2">
                <div class="col-4">Permanent Address</div>
                <div class="col-8">
                    <textarea class="form-control" name="permanent_address" placeholder="PERMANENT FULL ADDRESS"></textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">Ration Card Type</div>
                <div class="col-2">
                    <select name="ration_card_type" class="form-select">
                      <option value="">-- Select Ration Card Type --</option>
                      <option value="APL">APL</option>
                      <option value="BPL">BPL</option>
                    </select>
                </div>
                <div class="col-3">Ration Card Number</div>
                <div class="col-3">
                 <input class="form-control"  name="rationcard_number" placeholder="RATION CARD NUMBER">
                 </div>
            </div>
            <hr class="my-4 border-gray-300"> 
            <div class="row mb-2">
                <div class="col-4">Pincode</div>
                <div class="col-8">
                    <input type="text" id="pincode" name="pincode" inputmode="numeric" class="form-control" placeholder="6 DIGIT PINCODE" maxlength="6" onkeydown="return onlyNumbers(event)"
       onpaste="return false"
       ondrop="return false"
       oninput="validatePincode()">
                    <small id="pincodeError" style="color:red"></small>
                </div>
            </div>
           <div class="row mb-2">
              <div class="col-4">Area</div>
                 <div class="col-8">
                   <select id="area" name="area" class="form-select">
                    <option value="">-- Select Area --</option>
                   </select>
               </div>
             </div>
            <div class="row mb-2">
                <div class="col-4">city</div>
                <div class="col-8">
                    <input class="form-control" name="city" placeholder="CITY" >
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">Taluk</div>
                <div class="col-8">
                    <input type="text" id="taluk" class="form-control" readonly>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">District</div>
                <div class="col-8">
                    <input type="text" id="district" class="form-control" readonly>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">State</div>
                <div class="col-8">
                    <input type="text" id="state" class="form-control" readonly>
                </div>
            </div>
             <div class="row mb-2">
                <div class="col-4">Country</div>
                <div class="col-8">
                    <input type="text" name="country" value="India" >
                </div>
            </div>
        </div>

        <!-- CENTER FORM -->
        <div class="col-md-6">
            <div class="row mb-2">
                <div class="col-4">D.O.B</div>
                <div class="col-4">
                    <input type="date" id="dob" name="dob" class="form-control" onchange="calculateAge()" max="<?= date('Y-m-d') ?>">
                    <small id="dobError" style="color:red"></small>
                </div>
                <div class="col-2">Age</div>
                <div class="col-2">
                    <input type="text" id="age" name="age" class="form-control" readonly>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Gender</div>
                <div class="col-8">
                    <select class="form-control" name="gender">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Occupation</div>
                <div class="col-8">
                    <input class="form-control" name="occupation" placeholder="OCCUPATION">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Religion</div>
                <div class="col-8">
                    <input class="form-control" name="religion" placeholder="RELIGION">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Caste</div>
                <div class="col-8">
                    <input class="form-control" name="caste" placeholder="CASTE">
                </div>
            </div>
            
            <div class="row mb-2">
                <div class="col-4">Adhar Number</div>
                <div class="col-8">
                    <input class="form-control" name="adhar" id="adhar" inputmode="numeric" placeholder="12 DIGIT ADHAR NUMBER" onkeydown="return onlyNumbers(event)"
                    onpaste="return false" ondrop="return false" oninput="validateAdhar()">
                    <small id="adharError" style="color:red"></small>
                </div>
            </div>

              <div class="row mb-2">
                <div class="col-4">PAN</div>
                <div class="col-8">
                    <input class="form-control" name="pan" id="pan" placeholder="ABCDE1234F" oninput="validatePan()">
                    <small id="panError" style="color:red"></small>
                </div>
            </div>
          
            <div class="row mb-2">
                <div class="col-4">Voter-ID </div>
                <div class="col-8">
                    <input class="form-control" name="voter" placeholder="10 DIGIT VOTER ID NUMBER">
                </div>
            </div>
            <div class="row mb-2">
                 <div class="col-4">Marital Status</div>
                 <div class="col-8">
                 <select name="marital_status" class="form-select form-select-sm">
                      <option value="">-- Select --</option>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                      <option value="Divorced">Divorced</option>
                      <option value="Widowed">Widowed</option>
                </select>
                </div>
                </div>
            <div class="row mb-2">
                <div class="col-4">DL No</div>
                <div class="col-8">
                    <input class="form-control" name="dl_no" placeholder="10 DIGIT DL NUMBER">
                </div>
            </div>
             <hr class="my-4 border-gray-300">
            <div class="row mb-2">
                <div class="col-4">GST No</div>
                <div class="col-8">
                    <input class="form-control" name="gst_no" placeholder="15 DIGIT GST NUMBER">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Passport No</div>
                <div class="col-8">
                    <input class="form-control" name="passport_no" placeholder="8 DIGIT PASSPORT NUMBER">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Gas Consumer No</div>
                <div class="col-8">
                    <input class="form-control" name="gas_consumer_no" placeholder="10 DIGIT GAS CONSUMER NUMBER">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Gas Company</div>
                <div class="col-8">
                    <input class="form-control" name="gas_company" placeholder="HP/BHARAT/..">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">Customer Property Details</div>
                <div class="col-8">
                    <textarea class="form-control" name="property_details" placeholder="PROPERTY DETAILS"></textarea>
                </div>
            </div>
        </div>
     
            
         <!-- Nominee Details form -->
<div class="bg-secondary text-white p-2 fw-bold d-flex justify-content-between align-items-center">
    <span>NOMINEE DETAILS</span>
 </div>

<div class="row mt-3" id="nomineeSection">
    <!-- LEFT SIDE -->
    <div class="col-md-6">

        <div class="row mb-2">
            <div class="col-4">Nominee Name</div>
            <div class="col-8">
                <input type="text" name="nominee_name" class="form-control" placeholder="NOMINEE FULL NAME">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-4">Father/Husband Name</div>
            <div class="col-8">
                <input type="text" name="nominee_father" class="form-control" placeholder="NOMINEE FATHER/HUSBAND NAME">
            </div>
        </div>

        <!-- ✅ NEW: GENDER -->
        <div class="row mb-2">
            <div class="col-4">Gender</div>
            <div class="col-8">
                <select name="nominee_gender" class="form-select">
                    <option value="">-- Select --</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>
        
        <div class="row mb-2">
            <div class="col-4">Relation</div>
            <div class="col-8">
                <select name="nominee_relation" class="form-select">
                    <option value="">-- Select Relation --</option>
                    <option>Father</option>
                    <option>Mother</option>
                    <option>Wife</option>
                    <option>Husband</option>
                    <option>Son</option>
                    <option>Daughter</option>
                    <option>Brother</option>
                    <option>Sister</option>
                    <option>Other</option>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-4">Nominee Adhar No</div>
            <div class="col-8">
                <input type="text"
                       name="nominee_adhar"
                       class="form-control"
                       maxlength="12"
                       placeholder="NOMINEE 12 DIGIT ADHAR NUMBER"
                       oninput="this.value=this.value.replace(/[^0-9]/g,'')">
            </div>
        </div>
      
    </div>

    <!-- RIGHT SIDE -->
    <div class="col-md-6">

        <div class="row mb-2">
            <div class="col-4">Nominee Address</div>
            <div class="col-8">
                <textarea name="nominee_address" class="form-control" placeholder="NOMINEE FULL ADDRESS"></textarea>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-4">Other Details</div>
            <div class="col-8">
                <textarea name="nominee_other_details" class="form-control" placeholder="NOMINEE OTHER DETAILS LIKE PROPERTY.."></textarea>
            </div>
        </div>

        <!-- ✅ NEW: AGE -->
        <div class="row mb-2">
            <div class="col-4">Age</div>
            <div class="col-8">
                <input type="number"
                       name="nominee_age"
                       class="form-control"
                       min="0"
                       placeholder="NOMINEE AGE "
                       max="120">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-4">Mobile No</div>
            <div class="col-8">
                <input type="text"
                       name="nominee_mobile"
                       class="form-control"
                       maxlength="10"
                       placeholder="NOMINEE 10 DIGIT MOBILE NUMBER"
                       oninput="this.value=this.value.replace(/[^0-9]/g,'')">
            </div>
        </div>

    </div>

</div>

<!-- Introducer Section -->

 <div class="bg-secondary text-white text-left p-2 fw-bold" >
        Introducer Details
    </div>
    
    <div class="card mt-3">
    <div class="card-body position-relative">
   <div class="col-md-4" >
    <label for="introducer_search" class="form-label">
      Introducer Search (Customer ID / Name)
    </label>
    <input
      type="text"
      id="introducer_search"
      class="form-control"
      placeholder="Type Customer ID or Name">
  </div>
        <div class="row mt-2">
            <div class="col-md-6 mb-2">
                <label>Introducer Customer Id:</label> 
                 <input type="text" name="introducer_customer_id" id="introducer_customer_id" class="form-control" placeholder="Introducer Customer ID" readonly>
            </div>
            <div class="col-md-6 mb-2">
                <label>Introducer Name:</label>
                <input type="text" name="introducer_name" id="introducer_name" class="form-control" placeholder="Introducer Name" readonly>

            </div>
            <div class="col-md-6 mb-2">
                <label>Father/Husband Name:</label>
                <input type="text" name="introducer_father" id="introducer_father" class="form-control" placeholder="Father/Husband Name" readonly>

            </div>
            <div class="col-md-6 mb-2">
                <label>Mobail:</label>
                <input type="text" name="introducer_mobile" id="introducer_mobile" class="form-control" placeholder="Mobail Number" readonly>
            </div>

            <input type="hidden" id="introducer_mobile"name="introducer_mobile">

  <!-- DROPDOWN RESULTS -->
  <div id="introducer_results" class="list-group position-absolute w-100" style="top: 75px;z-index: 1000;display: none;max-height: 220px;overflow-y: auto;">
  </div>
  </div>
    </div>
</div>




 <div class="bg-secondary text-white text-left p-2 fw-bold">
    DCC/ADB/ OTHER BANK DETAILS
</div>
<div class="row mt-3">
    <!-- LEFT SIDE -->
      <div class="col-md-6">
        <div class="row mb-2">
            <div class="col-4">Select DCC/ADB Bank Name</div>
            <div class="col-8">
                <select name="dcc_adb_bankname" class="form-select">
                    <option value="">-- Select --</option>
                    <option value="DCC">DCC</option>
                    <option value="ADB">ADB</option>
                </select>
            </div>
        </div>
     <div class="row mb-2">
            <div class="col-4">DCC/ADB Account No : </div>
            <div class="col-8">
                <input type="text" name="dcc_adb_accountnumber" class="form-control">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-4">DCC/ADB IFSC Code :</div>
            <div class="col-8">
                <input type="text" name="dcc_adb_ifsccode" class="form-control">
            </div>
        </div>
        </div>
    <!-- Right Side -->
    <div class="col-md-6">

        <div class="row mb-2">
            <div class="col-4">DCC/ADB Branch Name : </div>
            <div class="col-8">
                <input type="text" name="dcc_adb_branchname" class="form-control">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-4">DCC/ADB Rupay Card No : </div>
            <div class="col-8">
                <input type="text" name="dcc_adb_rupaycard" class="form-control">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-4">DCC/ADB Cheque No :  </div>
            <div class="col-8">
                <input type="text" name="dcc_adb_cheque" class="form-control">
            </div>
        </div>

    </div>
</div>
          <hr class ="my-4 border-gray-300">  <!-- Select Other Bank details-->
 <div class="row mt-3">
        <!-- LEFT SIDE -->
      <div class="col-md-6">
        <div class="row mb-2">
            <div class="col-4">Select Other Bank Name : </div>
            <div class="col-8">
                <select name="other_bankname" class="form-select">
                    <option value="">Select Other Bank name</option>
                    <option value="SBI">State Bank of India</option>
                    <option value="HDFC">HDFC Bank</option>
                    <option value="ICICI">ICICI Bank</option>
                    <option value="AXIS">Axis Bank</option>
                    <option value="KOTAK">Kotak Mahindra Bank</option>
                    <option value="CANARA">Canara Bank</option>
                    <option value="UNION">Union Bank of India</option>
                    <option value="BOB">Bank of Baroda</option>
                    <option value="PNB">Punjab National Bank</option>
                </select>
            </div>
        </div>
     <div class="row mb-2">
            <div class="col-4">Other Account No</div>
            <div class="col-8">
                <input type="text" name="other_accountnumber" class="form-control">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-4">Other IFSC Code :</div>
            <div class="col-8">
                <input type="text" name="other_ifsccode" class="form-control">
            </div>
        </div>
        </div>
    <!-- Right Side -->
    <div class="col-md-6">

        <div class="row mb-2">
            <div class="col-4">Other Branch Name : </div>
            <div class="col-8">
                <input type="text" name="other_branchname" class="form-control">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-4">Other Rupay Card No : </div>
            <div class="col-8">
                <input type="text" name="other_rupaycard" class="form-control">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-4">Other Cheque No :  </div>
            <div class="col-8">
                <input type="text" name="other_cheque" class="form-control">
            </div>
        </div>

    </div> 
 </div>
<div class="bg-secondary text-white text-left p-2 fw-bold">
    OTHER KYC DETAILS
</div>
<div class="row mt-3">

    <!-- PHOTO -->
    <div class="col-md-2 text-center">
        <div class="preview-box mb-2">
            <img id="photoPreview" alt="Photo">
            <span id="photoText">No Photo</span>
        </div>
        <input type="file"
               name="photo"
               id="photo"
               class="form-control form-control-sm"
               accept="image/*">
    </div>

    <!-- SIGNATURE -->
    <div class="col-md-2 text-center">
        <div class="preview-box signature-box mb-2">
            <img id="signPreview" alt="Signature">
            <span id="signText">No Signature</span>
        </div>
        <input type="file"
               name="signature"
               id="signature"
               class="form-control form-control-sm"
               accept="image/*">
    </div>

</div>

</div>
    <!-- FOOTER BUTTONS -->
        <div class="footer-btns text-center mt-3 bg-dark p-2">
        <!-- <button type="button" class="btn btn-light">New</button> -->
        <button type="submit" class="btn btn-success">Save</button>
        <!-- <button type="button" class="btn btn-light">Modify</button> -->
        <button type="reset" class="btn btn-light">Clear</button>
        <!-- <button type="button" class="btn btn-light">Print</button>
        <button type="button" class="btn btn-light">Exit</button> -->
        </div>

        </form>
</div>
   </div>
    </div>
</div>
<?= view('admin/footer') ?>

<script>
document.addEventListener('DOMContentLoaded', function () {

  const input = document.getElementById('introducer_search');
  const box   = document.getElementById('introducer_results');

  if (!input || !box) return;

  input.addEventListener('keyup', function () {
    const q = this.value.trim();

    if (q.length < 2) {
      box.innerHTML = '';
      box.style.display = 'none';
      return;
    }

    fetch("<?= base_url('member/searchIntroducer') ?>?q=" + encodeURIComponent(q))
      .then(res => res.json())
      .then(data => {

        if (!data.length) {
          box.innerHTML = '<div class="list-group-item">No results</div>';
          box.style.display = 'block';
          return;
        }

        box.innerHTML = data.map(row => `
          <div class="list-group-item list-group-item-action"
               style="cursor:pointer"
               onclick="selectIntroducer(
                 '${row.customer_id}',
                 '${row.name}',
                 '${row.father}',
                 '${row.mobile}'
               )">
            <strong>${row.customer_id}</strong> – ${row.name}
          </div>
        `).join('');

        box.style.display = 'block';
      });
  });

});

function selectIntroducer(id, name, father, mobile) {
  document.getElementById('introducer_search').value = id;
  document.getElementById('introducer_customer_id').value = id;
  document.getElementById('introducer_name').value = name;
  document.getElementById('introducer_father').value = father;
  document.getElementById('introducer_mobile').value = mobile;
  document.getElementById('introducer_results').style.display = 'none';
}
</script>

<script>
// Step 1: Pincode → Load Areas
document.getElementById('pincode').addEventListener('keyup', function () {
    const pincode = this.value.trim();
    if (pincode.length !== 6) return; // Only trigger when full 6-digit

    fetch('<?= base_url("member/fetch-areas") ?>?pincode=' + pincode)
        .then(res => res.json())
        .then(rows => {
            const areaSelect = document.getElementById('area');
            areaSelect.innerHTML = '<option value="">-- Select Area --</option>';
            rows.forEach(row => {
                const opt = document.createElement('option');
                opt.value = row.area;
                opt.textContent = row.area;
                areaSelect.appendChild(opt);
            });
        });
});


// Step 2: Area → Auto-fill location
document.getElementById('area').addEventListener('change', function () {

    const area = this.value;
    const pincode = document.getElementById('pincode').value;

    if (!area) return;

    fetch('<?= base_url("member/fetch-location-by-area") ?>?pincode=' + pincode + '&area=' + encodeURIComponent(area))
        .then(res => res.json())
        .then(data => {

            if (!data) return;

            document.getElementById('taluk').value    = data.taluk;
            document.getElementById('district').value = data.district;
            document.getElementById('state').value    = data.state;
        });
});
</script>

</body>
</html>