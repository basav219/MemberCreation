<!DOCTYPE html>
<html>
<head>
    <title>Member Creation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('CSS/app.css') ?>">
</head>
<body>
<div class="container-fluid mt-2">
    <div class="bg-secondary text-white text-center p-2 fw-bold">
        MEMBER CREATION
    </div>
    <?php if (isset($validation)) : ?>
    <div style="color:red">
        <?= $validation->listErrors(); ?>
    </div>
<?php endif; ?>
    <form action="<?= site_url('member/store') ?>" 
      method="post" 
      enctype="multipart/form-data" 
      onsubmit="return validateForm();">
    <div class="row mt-2">

        <!-- LEFT FORM -->
        <div class="col-md-5">
            <div class="row mb-2">
                <div class="col-4">Customer Id</div>
                <div class="col-8">
                    <div class="input-group">
                        <input class="form-control" name="customer_id">
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Member Code</div>
                <div class="col-8">
                    <input class="form-control" name="member_code">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Name</div>
                <div class="col-3">
                    <select class="form-select" name="title">
                        <option>Mr</option>
                        <option>Mrs</option>
                    </select>
                </div>
                <div class="col-5">
                    <input class="form-control" name="name">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Residential Address</div>
                <div class="col-8">
                    <textarea class="form-control" name="res_address"></textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">city</div>
                <div class="col-8">
                    <input class="form-control" name="city"></textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">pincode</div>
                <div class="col-8">
                    <input class="form-control" name="pincode">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">Mobile Number</div>
                <div class="col-8">
                    <input class="form-control" name="mobile">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Email</div>
                <div class="col-8">
                    <input class="form-control" name="email">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Permanent Address</div>
                <div class="col-8">
                    <textarea class="form-control" name="per_address"></textarea>
                </div>
            </div>
        </div>

        <!-- CENTER FORM -->
        <div class="col-md-4">
            <div class="row mb-2">
                <div class="col-4">D.O.B</div>
                <div class="col-4">
                    <input type="date" class="form-control" name="dob" onchange="calculateAge()">
                </div>
                <div class="col-2">Age</div>
                <div class="col-2">
                    <input class="form-control" name="age" id="age" readonly>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Gender</div>
                <div class="col-8">
                    <select class="form-select" name="gender">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Occupation</div>
                <div class="col-8">
                    <input class="form-control" name="occupation">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Religion</div>
                <div class="col-8">
                    <input class="form-control" name="religion">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">Caste</div>
                <div class="col-8">
                    <input class="form-control" name="caste">
                </div>
            </div>

        </div>

        <!-- RIGHT IMAGE -->
         
         <!-- IMAGE PREVIEW -->
        <div class="col-md-3 text-center">
          <div class="preview-box">
          <img id="photoPreview" src="" alt="Image">
          </div>
          <input type="file" name="photo" id="photo" accept="image/*">

         <!-- SIGNATURE PREVIEW -->
           <div class="preview-box">
           <img id="signPreview" src="" alt="Signature">
           </div>
           <input type="file" name="signature" id="signature" accept="image/*">
        </div>

    <!-- FOOTER BUTTONS -->
    <div class="footer-btns text-center mt-3 bg-dark p-2">
        <!-- <button type="button" class="btn btn-light">New</button> -->
        <button type="submit" class="btn btn-success">Save</button>
        <a href="<?= site_url('member') ?>" class="btn btn-light">View</a>
        <!-- <button type="button" class="btn btn-light">Modify</button> -->
        <button type="reset" class="btn btn-light">Clear</button>
        <!-- <button type="button" class="btn btn-light">Print</button>
        <button type="button" class="btn btn-light">Exit</button> -->
    </div>

    </form>
</div>
<script src="<?= base_url('JS/app.js') ?>"></script>
</body>
</html>