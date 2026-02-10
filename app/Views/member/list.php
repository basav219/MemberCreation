<!DOCTYPE html>
<html>
<head>
    <title>Member List</title>

    <link rel="stylesheet" href="<?= base_url('css/member.css') ?>">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f5f5f5;
        }
        .action-btn a {
            text-decoration: none;
            padding: 4px 8px;
            background: #0d6efd;
            color: #fff;
            border-radius: 4px;
        }
        .action-btn a:hover {
            background: #084298;
        }
        .pagination {
            margin-top: 15px;
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

.pagination-center {
    display: flex;
    justify-content: center;
}
    </style>
</head>
<body>

<h2>Member List</h2>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color:green;">
        <?= session()->getFlashdata('success') ?>
    </p>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer ID</th>
            <th>Member Code</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>DOB</th>
            <th>Residential Address</th>
           
            <th>↓ Edit</th>
        </tr>
    </thead>
    <tbody>

    <?php if (!empty($members)) : ?>
        <?php foreach ($members as $row) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= esc($row['customer_id']) ?></td>
                <td><?= esc($row['member_code']) ?></td>
                <td><?= esc($row['name']) ?></td>
                <td><?= esc($row['mobile']) ?></td>
                <td><?= esc($row['email']) ?></td>
                <td><?= esc($row['dob']) ?></td>
                <td><?= esc($row['residential_address']) ?></td>
                
                <td class="action-btn">
                    <a href="<?= site_url('member/edit/'.$row['id']) ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="7">No records found</td>
        </tr>
    <?php endif; ?>

    </tbody>
</table>

<!-- Pagination Links -->
<?php if ($pager): ?>
    <div class="pagination-wrapper">

        <!-- Page count text -->
        <div class="page-count">
            Page <?= $pager->getCurrentPage() ?> of <?= $pager->getPageCount() ?>
        </div>

        <!-- Pagination links -->
        <div class="pagination-center">
            <?= $pager->links() ?>
        </div>

    </div>
<?php endif; ?>
</body>
</html>