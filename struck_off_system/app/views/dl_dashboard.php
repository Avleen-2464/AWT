<!DOCTYPE html>
<html>
<head>
    <title>DL Dashboard</title>
</head>
<body>
    <h1>DL Dashboard</h1>

    <table >
        <thead>
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Department</th>
                <th>HOD Remarks</th>
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
                    <td>
                        <form method="POST" action="/dl/remarks">
                            <input type="hidden" name="record_id" value="<?php echo $record['id']; ?>">
                            <textarea name="remarks_dl" placeholder="Enter DL remarks" required></textarea>
                            <button type="submit">Submit</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
