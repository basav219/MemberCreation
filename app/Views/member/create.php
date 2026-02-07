<!DOCTYPE html>
<html>
<head>
    <title>Member Creation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f4f4f4; }
        .form-control, .form-select { font-size:14px; }
        .box {
            border:1px solid #ccc;
            background:#fff;
            padding:10px;
            min-height:150px;
        }
        .img-box {
            width:100%;
            height:180px;
            border:1px solid #999;
            background:#e9e9e9;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .footer-btns button {
            margin-right:5px;
            min-width:90px;
        }
    </style>
</head>
<body>
<div class="container-fluid mt-2">
    <div class="bg-secondary text-white text-center p-2 fw-bold">
        MEMBER CREATION
    </div>

    <form method="post" enctype="multipart/form-data" action="<?= base_url('member/store') ?>">

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
                    <input type="date" class="form-control" name="dob">
                </div>
                <div class="col-2">Age</div>
                <div class="col-2">
                    <input class="form-control" name="age">
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
         
        <div class="col-md-3 text-center">
            <div class="img-box mb-2">Image</div>
            <input type="file" name="photo" class="form-control mb-3">

            <div class="img-box mb-2">Signature</div>
            <input type="file" name="signature" class="form-control">
        </div> -->

    <!-- </div>

    <!-- FOOTER BUTTONS -->
    <div class="footer-btns text-center mt-3 bg-dark p-2">
        <!-- <button type="button" class="btn btn-light">New</button> -->
        <button type="submit" class="btn btn-success">Save</button>
        <!-- <a href="<?= base_url('member/list') ?>" class="btn btn-light">View</a>
        <button type="button" class="btn btn-light">Modify</button>
        <button type="reset" class="btn btn-light">Clear</button>
        <button type="button" class="btn btn-light">Print</button>
        <button type="button" class="btn btn-light">Exit</button> -->
    </div>

    </form>
</div>
</body>
</html>