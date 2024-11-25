<!DOCTYPE html>
<html>
<head>
    <title>Registrar Dashboard</title>
</head>
<body>
    <h1>Registrar Dashboard</h1>

    <table>
        <thead>
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Department</th>
                <th>HOD Remarks</th>
                <th>DL Remarks</th>
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
                    <td>
                        <form method="POST" action="/registrar/remarks">
                            <input type="hidden" name="record_id" value="<?php echo $record['id']; ?>">
                            <textarea name="remarks_registrar" placeholder="Enter Registrar remarks" required></textarea>
                            <button type="submit">Submit</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
