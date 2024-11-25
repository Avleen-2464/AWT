<!DOCTYPE html>
<html>
<head>
    <title>Dean Dashboard</title>
</head>
<body>
    <h1>Dean Dashboard</h1>

    <table >
        <thead>
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Department</th>
                <th>HOD Remarks</th>
                <th>DL Remarks</th>
                <th>Registrar Remarks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td><?php echo $record['roll_no']; ?></td>
                    <td><?php echo $record['name']; ?></td>
                    <td><?php echo $record['department']; ?></td>
                    <td><?php echo $record['remarks_hod']; ?></td>
                    <td><?php echo $record['remarks_dl']; ?></td>
                    <td><?php echo $record['remarks_registrar']; ?></td>
                    <td>
                        <form method="POST" action="/dean/approve">
                            <input type="hidden" name="record_id" value="<?php echo $record['id']; ?>">
                            <button type="submit">Approve</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
