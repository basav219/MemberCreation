<!DOCTYPE html>
<html>
<head>
    <title>Customer Correction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>
    <?= view('admin/header', ['title' => 'Member Edit']) ?>
   <div class="container-fluid mt-2 px-5">
    <div class="card shadow-sm">
        <div class="card-body">


<div class="container-fluid mt-2">
    <div class="bg-secondary text-white text-center p-2 fw-bold">
        CUSTOMER CORRECTION
    </div>
    <!-- //Alart message for not updating the member data -->
    <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<!-- List Of Error in the page by using server validation  -->
    <?php if (isset($validation)) : ?>
    <div style="color:red">
        <?= $validation->listErrors(); ?>
    </div>
<?php endif; ?>
  <form action="<?= site_url('member/update/'.$member['id']) ?>" 
      method="post" 
      enctype="multipart/form-data" >

<?= csrf_field() ?>

    <div class="row mt-2">
         <!-- LEFT FORM -->
        <div class="col-md-6">
            <div class="row mb-2">
                <div class="col-4">Customer Id</div>
                <div class="col-8">
                    <div class="input-group">
                        <input class="form-control" name="customer_id" placeholder="Customer_ID" style="width: 100px; height: 25px;" value="<?= esc($member['customer_id']) ?>">
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Member Code</div>
                <div class="col-8">
                    <input class="form-control" name="member_code" placeholder="member_code" value="<?= esc($member['member_code']) ?>">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Name</div>
               <div class="col-2">
               <select class="form-control" name="title">
                    <option value="Mr" <?= isset($member['title']) && $member['title'] === 'Mr' ? 'selected' : '' ?>>Mr</option>
                    <option value="Mrs" <?= isset($member['title']) && $member['title'] === 'Mrs' ? 'selected' : '' ?>>Mrs</option>
                </select>
                </div>
                <div class="col-6">
                   <input type="text" id="name" name="name" class="form-control" placeholder="FULL NAME" oninput="validateName()" value="<?= esc($member['name']) ?>">
                   <small id="nameError" style="color:red"></small>
                </div>
            </div>
                <div class="row mb-2">
                <div class="col-4">Father/Husband Name </div>
                <div class="col-8">
                    <input class="form-control" name="father" placeholder="FATHER/HUSBAND NAME" value="<?= esc($member['father']) ?>">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">Residential Address</div>
                <div class="col-8">
                    <textarea class="form-control" name="residential_address" placeholder="RESIDENTIAL FULL ADDRESS "><?= esc($member['residential_address'])?></textarea>
                </div>
            </div>
           
            
            <div class="row mb-2">
                <div class="col-4">Mobile Number</div>
                <div class="col-8">
                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder="10 DIGIT MOBAIL NUMBER" maxlength="10" oninput="validateMobile()" value="<?= esc($member['mobile']) ?>">
                    <small id="mobileError" style="color:red"></small>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Email</div>
                <div class="col-8">
                   <input type="email" id="email" name="email" class="form-control" placeholder="email@example.com" oninput="validateEmail()" value="<?= esc($member['email']) ?>">
                   <small id="emailError" style="color:red"></small>
                </div> 
            </div>

            <div class="row mb-2">
                <div class="col-4">Permanent Address</div>
                <div class="col-8">
                    <textarea class="form-control" name="permanent_address" placeholder="PERMANENT FULL ADDRESS"><?= esc($member['permanent_address'])?></textarea>
                </div>
            </div>
           <div class="row mb-2">
                                <div class="col-4">Ration Card Type</div>
                                <div class="col-2">
                                    <select name="ration_card_type" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="APL" <?= $member['ration_card_type']=='APL'?'selected':'' ?>>APL</option>
                                        <option value="BPL" <?= $member['ration_card_type']=='BPL'?'selected':'' ?>>BPL</option>
                                    </select>
                                </div>
                                <div class="col-3">Ration Card Number</div>
                                <div class="col-3">
                                    <input class="form-control" name="rationcard_number" value="<?= esc($member['rationcard_number']) ?>">
                                </div>
                            </div>
                             <hr class="my-4 border-gray-300"> 
                                <div class="row mb-2">
                                <div class="col-4">Pincode</div>
                                <div class="col-8">
                                    <input type="text" id="pincode" name="pincode" class="form-control" value="<?= esc($member['pincode']) ?>" maxlength="6">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4">Area</div>
                                <div class="col-8">
                                    <select id="area" name="area" class="form-select">
                                        <option value="<?= esc($member['area']) ?>" selected><?= esc($member['area']) ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4">City</div>
                                <div class="col-8">
                                    <input type="text" name="city" class="form-control" value="<?= esc($member['city']) ?>">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4">Taluk</div>
                                <div class="col-8">
                                    <input type="text" id="taluk" class="form-control" value="<?= esc($member['taluk']) ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4">District</div>
                                <div class="col-8">
                                    <input type="text" id="district" class="form-control" value="<?= esc($member['district']) ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4">State</div>
                                <div class="col-8">
                                    <input type="text" id="state" class="form-control" value="<?= esc($member['state']) ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4">Country</div>
                                <div class="col-8">
                                    <input type="text" name="country" class="form-control" value="<?= esc($member['country']) ?>">
                                </div>
                            </div>
                        </div>

        <!-- CENTER FORM -->
        <div class="col-md-6">
            <div class="row mb-2">
                <div class="col-4">D.O.B</div>
                <div class="col-4">
                    <input type="date" id="dob" name="dob" class="form-control" value="<?= esc($member['dob']) ?>" onchange="calculateAge()" max="<?= date('Y-m-d') ?>" >
                    <small id="dobError" style="color:red"></small>
                </div>
                <div class="col-2">Age</div>
                <div class="col-2">
                    <input type="text" id="age" name="age" class="form-control" value="<?= esc($member['age']) ?>" readonly>
                </div>
            </div>

            <div class="row mb-2">
    <div class="col-4">Gender</div>
    <div class="col-8">
        <select class="form-control" name="gender">
            <option value="Male" <?= isset($member['gender']) && $member['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= isset($member['gender']) && $member['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
        </select>
    </div>
</div>

            <div class="row mb-2">
                <div class="col-4">Occupation</div>
                <div class="col-8">
                    <input class="form-control" name="occupation" placeholder="OCCUPATION" value="<?= esc($member['occupation']) ?>">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Religion</div>
                <div class="col-8">
                    <input class="form-control" name="religion" placeholder="RELIGION" value="<?= esc($member['religion']) ?>">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Caste</div>
                <div class="col-8">
                    <input class="form-control" name="caste" placeholder="CASTE" value="<?= esc($member['caste']) ?>">
                </div>
            </div>
            
            <div class="row mb-2">
                <div class="col-4">Adhar Number</div>
                <div class="col-8">
                    <input class="form-control" name="adhar" id="adhar" placeholder="12 DIGIT ADHAR NUMBER" oninput="validateAdhar()" value="<?= esc($member['adhar']) ?>">
                    <small id="adharError" style="color:red"></small>
                </div>
            </div>

              <div class="row mb-2">
                <div class="col-4">PAN</div>
                <div class="col-8">
                    <input class="form-control" name="pan" id="pan" placeholder="AAAAA1111A" oninput="validatePan()" value="<?= esc($member['pan']) ?>">
                    <small id="panError" style="color:red"></small>
                </div>
            </div>
          
            <div class="row mb-2">
                <div class="col-4">Voter-ID </div>
                <div class="col-8">
                    <input class="form-control" name="voter" placeholder="10 digit VOTER ID NUMBER" value="<?= esc($member['voter']) ?>">
                </div>
            </div>
           <div class="row mb-2">
    <div class="col-4">Marital Status</div> 
    <div class="col-8">
        <select name="marital_status" class="form-select form-select-sm">
            <option value="">-- Select --</option>
            <option value="Single" <?= isset($member['marital_status']) && $member['marital_status'] === 'Single' ? 'selected' : '' ?>>Single</option>
            <option value="Married" <?= isset($member['marital_status']) && $member['marital_status'] === 'Married' ? 'selected' : '' ?>>Married</option>
            <option value="Divorced" <?= isset($member['marital_status']) && $member['marital_status'] === 'Divorced' ? 'selected' : '' ?>>Divorced</option>
            <option value="Widowed" <?= isset($member['marital_status']) && $member['marital_status'] === 'Widowed' ? 'selected' : '' ?>>Widowed</option>
        </select>
    </div>
</div>
            <div class="row mb-2">
                <div class="col-4">DL No</div>
                <div class="col-8">
                    <input class="form-control" name="dl_no" placeholder="10 DIGIT DL NUMBER" value="<?= esc($member['dl_no']) ?>">
                </div>
            </div>
             <hr class="my-4 border-gray-300">
            <div class="row mb-2">
                <div class="col-4">GST No</div>
                <div class="col-8">
                    <input class="form-control" name="gst_no" placeholder="15 DIGIT GST NUMBER" value="<?= esc($member['gst_no']) ?>">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Passport No</div>
                <div class="col-8">
                    <input class="form-control" name="passport_no" placeholder="8 DIGIT PASSPORT NUMBER" value="<?= esc($member['passport_no']) ?>">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Gas Consumer No</div>
                <div class="col-8">
                    <input class="form-control" name="gas_consumer_no" placeholder="10 DIGIT GAS CONSUMER NUMBER" value="<?= esc($member['gas_consumer_no']) ?>">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Gas Company</div>
                <div class="col-8">
                    <input class="form-control" name="gas_company" placeholder="HP/BHARAT/.." value="<?= esc($member['gas_company']) ?>">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">Customer Property Details</div>
                <div class="col-8">
                    <textarea class="form-control" name="property_details" placeholder="PROPERTY DETAILS"><?= esc($member['property_details'])?></textarea>
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
                <input type="text" name="nominee_name" class="form-control" placeholder="NOMINEE FULL NAME" value="<?= esc($member['nominee_name']) ?>">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-4">Father/Husband Name</div>
            <div class="col-8">
                <input type="text" name="nominee_father" class="form-control" placeholder="NOMINEE FATHER/HUSBAND NAME" value="<?= esc($member['nominee_father']) ?>">
            </div>
        </div>

<div class="row mb-2">
    <div class="col-4">Gender</div>
    <div class="col-8">
        <select name="nominee_gender" class="form-select">
            <option value="">-- Select --</option>
            <option value="Male" <?= isset($member['nominee_gender']) && $member['nominee_gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= isset($member['nominee_gender']) && $member['nominee_gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
            <option value="Other" <?= isset($member['nominee_gender']) && $member['nominee_gender'] === 'Other' ? 'selected' : '' ?>>Other</option>
        </select>
    </div>
</div>
       
<div class="row mb-2">
    <div class="col-4">Relation</div>
    <div class="col-8">
        <select name="nominee_relation" class="form-select">
            <option value="">-- Select Relation --</option>
            <option value="Father" <?= isset($member['nominee_relation']) && $member['nominee_relation'] === 'Father' ? 'selected' : '' ?>>Father</option>
            <option value="Mother" <?= isset($member['nominee_relation']) && $member['nominee_relation'] === 'Mother' ? 'selected' : '' ?>>Mother</option>
            <option value="Wife" <?= isset($member['nominee_relation']) && $member['nominee_relation'] === 'Wife' ? 'selected' : '' ?>>Wife</option>
            <option value="Husband" <?= isset($member['nominee_relation']) && $member['nominee_relation'] === 'Husband' ? 'selected' : '' ?>>Husband</option>
            <option value="Son" <?= isset($member['nominee_relation']) && $member['nominee_relation'] === 'Son' ? 'selected' : '' ?>>Son</option>
            <option value="Daughter" <?= isset($member['nominee_relation']) && $member['nominee_relation'] === 'Daughter' ? 'selected' : '' ?>>Daughter</option>
            <option value="Brother" <?= isset($member['nominee_relation']) && $member['nominee_relation'] === 'Brother' ? 'selected' : '' ?>>Brother</option>
            <option value="Sister" <?= isset($member['nominee_relation']) && $member['nominee_relation'] === 'Sister' ? 'selected' : '' ?>>Sister</option>
            <option value="Other" <?= isset($member['nominee_relation']) && $member['nominee_relation'] === 'Other' ? 'selected' : '' ?>>Other</option>
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
                       oninput="this.value=this.value.replace(/[^0-9]/g,'')" value="<?= esc($member['nominee_adhar']) ?>">
            </div>
        </div>
      
    </div>

    <!-- RIGHT SIDE -->
    <div class="col-md-6">

        <div class="row mb-2">
            <div class="col-4">Nominee Address</div>
            <div class="col-8">
                <textarea name="nominee_address" class="form-control" placeholder="NOMINEE FULL ADDRESS"><?= esc($member['nominee_address'])?></textarea>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-4">Other Details</div>
            <div class="col-8">
                <textarea name="nominee_other_details" class="form-control" placeholder="NOMINEE OTHER DETAILS LIKE PROPERTY.."><?= esc($member['nominee_other_details'])?></textarea>
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
                       max="120" value="<?= esc($member['nominee_age']) ?>">
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
                       oninput="this.value=this.value.replace(/[^0-9]/g,'')"  value="<?= esc($member['nominee_mobile']) ?>">
            </div>
        </div>

    </div>

</div>

 <!-- Introducer Section -->
                    <div class="bg-secondary text-white text-left p-2 fw-bold">Introducer Details</div>
                    <div class="card mt-3">
                        <div class="card-body position-relative">
                            <div class="col-md-4">
                                <label for="introducer_search" class="form-label">Introducer Search (Customer ID / Name)</label>
                                <input type="text" id="introducer_search" class="form-control" placeholder="Type Customer ID or Name" value="<?= esc($member['introducer_customer_id']) ?>">
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6 mb-2">
                                    <label>Introducer Customer Id:</label>
                                    <input type="text" name="introducer_customer_id" id="introducer_customer_id" class="form-control" value="<?= esc($member['introducer_customer_id']) ?>" readonly>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Introducer Name:</label>
                                    <input type="text" name="introducer_name" id="introducer_name" class="form-control" value="<?= esc($member['introducer_name']) ?>" readonly>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Father/Husband Name:</label>
                                    <input type="text" name="introducer_father" id="introducer_father" class="form-control" value="<?= esc($member['introducer_father']) ?>" readonly>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Mobile:</label>
                                   
                                    <input type="text" id="introducer_mobile" class="form-control" value="<?= esc($member['introducer_mobile']) ?>" readonly>
                                </div>
                                 <input type="hidden" name="introducer_mobile" id="introducer_mobile" value="<?= esc($member['introducer_mobile']) ?>">
                                <div id="introducer_results" class="list-group position-absolute w-100" style="top: 75px;z-index: 1000;display: none;max-height: 220px;overflow-y: auto;"></div>
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
            <option value="DCC" <?= isset($member['dcc_adb_bankname']) && $member['dcc_adb_bankname'] === 'DCC' ? 'selected' : '' ?>>DCC</option>
            <option value="ADB" <?= isset($member['dcc_adb_bankname']) && $member['dcc_adb_bankname'] === 'ADB' ? 'selected' : '' ?>>ADB</option>
        </select>
    </div>
</div>
     <div class="row mb-2">
            <div class="col-4">DCC/ADB Account No : </div>
            <div class="col-8">
                <input type="text" name="dcc_adb_accountnumber" class="form-control" value="<?= esc($member['dcc_adb_accountnumber']) ?>">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-4">DCC/ADB IFSC Code :</div>
            <div class="col-8">
                <input type="text" name="dcc_adb_ifsccode" class="form-control" value="<?= esc($member['dcc_adb_ifsccode']) ?>">
            </div>
        </div>
        </div>
    <!-- Right Side -->
    <div class="col-md-6">

        <div class="row mb-2">
            <div class="col-4">DCC/ADB Branch Name : </div>
            <div class="col-8">
                <input type="text" name="dcc_adb_branchname" class="form-control" value="<?= esc($member['dcc_adb_branchname']) ?>">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-4">DCC/ADB Rupay Card No : </div>
            <div class="col-8">
                <input type="text" name="dcc_adb_rupaycard" class="form-control" value="<?= esc($member['dcc_adb_rupaycard']) ?>">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-4">DCC/ADB Cheque No :  </div>
            <div class="col-8">
                <input type="text" name="dcc_adb_cheque" class="form-control" value="<?= esc($member['dcc_adb_cheque']) ?>">
            </div>
        </div>

    </div>
</div>
          <hr class ="my-4 border-gray-300">  <!-- Select Other Bank details-->
 <div class="row mt-3">
        <!-- LEFT SIDE -->
      <div class="col-md-6">
        <div class="row mb-2">
    <div class="col-4">Select Other Bank Name :</div>
    <div class="col-8">
        <select name="other_bankname" class="form-select">
            <option value="">Select Other Bank name</option>
            <option value="SBI" <?= isset($member['other_bankname']) && $member['other_bankname'] === 'SBI' ? 'selected' : '' ?>>State Bank of India</option>
            <option value="HDFC" <?= isset($member['other_bankname']) && $member['other_bankname'] === 'HDFC' ? 'selected' : '' ?>>HDFC Bank</option>
            <option value="ICICI" <?= isset($member['other_bankname']) && $member['other_bankname'] === 'ICICI' ? 'selected' : '' ?>>ICICI Bank</option>
            <option value="AXIS" <?= isset($member['other_bankname']) && $member['other_bankname'] === 'AXIS' ? 'selected' : '' ?>>Axis Bank</option>
            <option value="KOTAK" <?= isset($member['other_bankname']) && $member['other_bankname'] === 'KOTAK' ? 'selected' : '' ?>>Kotak Mahindra Bank</option>
            <option value="CANARA" <?= isset($member['other_bankname']) && $member['other_bankname'] === 'CANARA' ? 'selected' : '' ?>>Canara Bank</option>
            <option value="UNION" <?= isset($member['other_bankname']) && $member['other_bankname'] === 'UNION' ? 'selected' : '' ?>>Union Bank of India</option>
            <option value="BOB" <?= isset($member['other_bankname']) && $member['other_bankname'] === 'BOB' ? 'selected' : '' ?>>Bank of Baroda</option>
            <option value="PNB" <?= isset($member['other_bankname']) && $member['other_bankname'] === 'PNB' ? 'selected' : '' ?>>Punjab National Bank</option>
        </select>
    </div>
</div>
     <div class="row mb-2">
            <div class="col-4">Other Account No</div>
            <div class="col-8">
                <input type="text" name="other_accountnumber" class="form-control" value="<?= esc($member['other_accountnumber']) ?>">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-4">Other IFSC Code :</div>
            <div class="col-8">
                <input type="text" name="other_ifsccode" class="form-control" value="<?= esc($member['other_ifsccode']) ?>">
            </div>
        </div>
        </div>
    <!-- Right Side -->
    <div class="col-md-6">

        <div class="row mb-2">
            <div class="col-4">Other Branch Name : </div>
            <div class="col-8">
                <input type="text" name="other_branchname" class="form-control" value="<?= esc($member['other_branchname']) ?>">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-4">Other Rupay Card No : </div>
            <div class="col-8">
                <input type="text" name="other_rupaycard" class="form-control" value="<?= esc($member['other_rupaycard']) ?>">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-4">Other Cheque No :  </div>
            <div class="col-8">
                <input type="text" name="other_cheque" class="form-control" value="<?= esc($member['other_cheque']) ?>">
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
             <img id="photoPreview"
                src="<?= !empty($member['photo']) 
                ? base_url('uploads/photos/'.$member['photo']) : '' ?>">
        </div>
                 <input type="file" name="photo" id="photo" class="form-control" accept="image/*" onchange="previewPhoto(this)">
    </div>  
       <!-- SIGNATURE PREVIEW -->
        <div class="col-md-2 text-center">
        <div class="preview-box signature-box mb-2">   
             <img id="signPreview"
            src="<?= !empty($member['signature']) 
            ? base_url('uploads/signatures/'.$member['signature']) 
            : '' ?>">
        </div>  
             <input type="file" name="signature" id="signature" class="form-control" accept="image/*" onchange="previewSignature(this)">
    </div>
    </div>
</div>

<!-- FOOTER BUTTONS -->
    <div class="footer-btns text-center mt-3 bg-dark p-2">
    <button type="submit" class="btn btn-light">Update</button>
    <a href="<?= site_url('member/list') ?>" class="btn btn-light">Back</a>
    </div>

    </form>
</div>
        </div>
    </div>
   </div>
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
// Step 1: Pincode → Areas
document.getElementById('pincode').addEventListener('keyup', function () {
    const pincode = this.value.trim();
    if (pincode.length !== 6) return;

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

// Step 2: Area → Taluk/District/State
document.getElementById('area').addEventListener('change', function () {
    const area = this.value;
    const pincode = document.getElementById('pincode').value;

    if (!area) return;

    fetch('<?= base_url("member/fetch-location-by-area") ?>?pincode=' + pincode + '&area=' + encodeURIComponent(area))
        .then(res => res.json())
        .then(data => {
            if(!data) return;
            document.getElementById('taluk').value    = data.taluk ?? '';
            document.getElementById('district').value = data.district ?? '';
            document.getElementById('state').value    = data.state ?? '';
        });
});
</script>
<?= view('admin/footer') ?>
</body>
</html>