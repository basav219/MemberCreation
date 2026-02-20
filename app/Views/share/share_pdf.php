<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Share Creation List</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h3 {
            text-align: center;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h3>Share Creation List</h3>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer ID</th>
            <th>Share Type</th>
            <th>Membership Date</th>
            <th>LF Number</th>
            <th>Account Number</th>
            <th>Resolution Date</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($shares)): ?>
            <?php foreach ($shares as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= esc($row['customer_id']) ?></td>
                    <td><?= esc($row['share_type']) ?></td>
                    <td><?= esc($row['membership_date']) ?></td>
                    <td><?= esc($row['lf_number']) ?></td>
                    <td><?= esc($row['account_number']) ?></td>
                    <td><?= esc($row['resolution_date']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align:center;">No records found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>