<?php include(APPPATH . 'Views/layout/header.php'); ?>
<h2>Employee List</h2>
<a href="<?= base_url('employee/create') ?>" class="btn btn-success mb-3">Add Employee</a>
<a href="<?= base_url('logout') ?>" class="btn btn-danger mb-3 float-end">Logout</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th><th>Address</th><th>Designation</th><th>Salary</th><th>Picture</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $emp): ?>
        <tr>
            <td><?= $emp['name'] ?></td>
            <td><?= $emp['address'] ?></td>
            <td><?= $emp['designation'] ?></td>
            <td><?= $emp['salary'] ?></td>
            <td>
                <?php if ($emp['picture']): ?>
        <img src="/public/uploads/<?= esc($emp['picture']) ?>" width="50"><br>
        <small><?= esc($emp['picture']) ?></small><br>
        <a href="<?= base_url('public/uploads/' . $emp['picture']) ?>" target="_blank">View Image</a>
    <?php endif; ?>
            </td>
            <td>
                <a href="<?= site_url('employee/edit/' . $emp['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                <form method="post" action="<?= site_url('employee/delete/' . $emp['id']) ?>" style="display:inline-block" onsubmit="return confirm('Delete this employee?');">
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include(APPPATH . 'Views/layout/footer.php'); ?>
