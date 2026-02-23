<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>

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
<?= view('admin/header', ['title' => 'Member List']) ?>
<?php if (empty($members)): ?>
    <button class="btn btn-secondary btn-sm" disabled>Export</button>
<?php endif; ?>

<!-- MAIN CONTAINER -->
<div class="container-fluid px-4 mt-3">

    <!-- CARD -->
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Customer List</h5>
                
                <div class="dropdown">
                                    <!-- 🔙 Back to Dashboard -->
                    <?php if (session()->get('role') === 'superadmin'): ?>
                       <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-primary btn-sm">
                           ← Back to Dashboard
                       </a>
                   <?php endif; ?>
                   <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                   Export
                   </button>

                  <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                   <a class="dropdown-item"
                   href="<?= site_url('member/export-csv') ?>">
                     Export CSV
                   </a>
                  </li>
                  <li>
                <a class="dropdown-item"
                   href="<?= site_url('member/export-pdf') ?>">
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

            <!-- SEARCH BAR -->
            <?= view('member/_search_bar') ?>

            <!-- TABLE -->
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>Father/Husband</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>DOB</th>
                            <th>Residential Address</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($members)) : ?>
                        <?php foreach ($members as $row) : ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= esc($row['customer_id']) ?></td>
                                <td><?= esc($row['name']) ?></td>
                                <td><?= esc($row['father']) ?></td>
                                <td><?= esc($row['mobile']) ?></td>
                                <td><?= esc($row['email']) ?></td>
                                <td><?= esc($row['dob']) ?></td>
                                <td><?= esc($row['residential_address']) ?></td>
                                <td><?= esc($row['created_by'] ?? '—') ?></td>
                                <td class="action-btn text-center">
                                    <a href="<?= site_url(relativePath: 'member/viewcustomer/'.$row['id']) ?>">View</a>
                                    <a href="<?= site_url('member/edit/'.$row['id']) ?>">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="9" class="text-center text-danger">No records found</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        
            <!-- PAGINATION -->
            <?php if ($pager): ?>
                <div class="pagination-wrapper">
                    <div class="page-count">
                        Page <?= $pager->getCurrentPage() ?> of <?= $pager->getPageCount() ?>
                    </div>
                    <?= $pager->links() ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?= view('admin/footer') ?>

</body>
</html>