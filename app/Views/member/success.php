<!DOCTYPE html>
<html>
<head>
    <title>Customer Created Successfully</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow text-center">
                <div class="card-body">

                    <h3 class="text-success mb-3">✅ Customer Created Successfully</h3>

                    <p class="mb-2">
                        <strong>Customer Name:</strong><br>
                        <?= session()->getFlashdata('name') ?>
                    </p>

                    <p class="mb-4">
                        <strong>Customer ID:</strong><br>
                        <?= session()->getFlashdata('customer_id') ?>
                    </p>

                    <a href="<?= base_url('dashboard') ?>" class="btn btn-primary">
                        ⬅ Back to Home
                    </a>

                    <a href="<?= base_url('member/create') ?>" class="btn btn-outline-secondary ms-2">
                        ➕ Add Another Customer
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>