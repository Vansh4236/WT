<?php include 'db_connect.php'; ?>
<?php $result = $conn->query("SELECT * FROM students"); ?>
<?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
            </tr>
        <?php endwhile; ?>
