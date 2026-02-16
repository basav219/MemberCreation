<!DOCTYPE html>
<html>
<head>
    <style>
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #000; padding:6px; font-size:11px; }
        th { background:#eee; }
    </style>
</head>
<body>

<h3 align="center">Member List</h3>

<table>
<tr>
    <th>ID</th>
    <th>Customer ID</th>
    <th>Name</th>
    <th>Father</th>
    <th>Mobile</th>
    <th>Email</th>
    <th>DOB</th>
    <th>Address</th>
</tr>

<?php foreach ($members as $row): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['customer_id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['father'] ?></td>
    <td><?= $row['mobile'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['dob'] ?></td>
    <td><?= $row['residential_address'] ?></td>
</tr>
<?php endforeach; ?>

</table>
</body>
</html>