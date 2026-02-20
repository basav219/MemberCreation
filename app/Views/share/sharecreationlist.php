<!DOCTYPE html>
<html>
<head>
    <title>Share List</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .table th, .table td {
            vertical-align: middle;
            white-space: nowrap;
        }

        .action-btn a {
            text-decoration: none;
            padding: 4px 10px;
            background: #0d6efd;
            color: #fff;
            border-radius: 4px;
            font-size: 14px;
        }

        .action-btn a:hover {
            background: #084298;
        }

        .pagination-wrapper {
            text-align: center;
            margin-top: 20px;
        }

        .page-count {
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        .pagination {
            justify-content: center;
        }
    </style>
</head>

<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?= view('admin/header', ['title' => 'Share List']) ?>

<!-- MAIN CONTAINER -->
<div class="container-fluid px-4 mt-3">

    <div class="card shadow-sm">
        <div class="card-body">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Share Creation List</h5>

                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        Export
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="<?= site_url('share/export-csv') ?>">
                                Export CSV
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('share/export-pdf') ?>">
                                Export PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- SUCCESS MESSAGE -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- TABLE -->
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Share Type</th>
                            <th>Share Value</th>
                            <th>Number of shares</th>
                            <th>Account Number</th>
                            <th>Total Share Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($shares)): ?>
                        <?php foreach ($shares as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= esc($row['customer_id']) ?></td>
                                <td><?= esc($row['customer_name'] ?? '-') ?></td>
                                <td><?= esc($row['share_type']) ?></td>
                                <td><?= esc($row['share_value']) ?></td>
                                <td><?= esc($row['number_of_shares']) ?></td>
                                <td><?= esc($row['account_number']) ?></td>
                                <td><?= esc($row['total']) ?></td>
                                <td class="action-btn text-center">
                                    <a href="<?= site_url('share/viewpagesharecreation/'.$row['customer_id']) ?>">View</a>
                                   <a href="<?= site_url('share/share_edit/'.$row['customer_id']) ?>">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-danger">No records found</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <?php if (isset($pager)): ?>
            <div class="pagination-wrapper mt-3">
           <?= $pager->links() ?>
           </div>
           <?php endif; ?>

        </div>
    </div>
</div>

<?= view('admin/footer') ?>

</body>
</html>