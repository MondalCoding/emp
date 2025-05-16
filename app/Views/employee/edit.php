<?php include(APPPATH . 'Views/layout/header.php'); ?>
<h2>Edit Employee</h2>
<form method="post" action="<?= site_url('employee/update/'.$employee['id']) ?>" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="<?= $employee['name'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Address</label>
        <textarea name="address" class="form-control" required><?= $employee['address'] ?></textarea>
    </div>
    <div class="mb-3">
        <label>Designation</label>
        <input type="text" name="designation" value="<?= $employee['designation'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Salary</label>
        <input type="number" step="0.01" name="salary" value="<?= $employee['salary'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Picture</label>
        <input type="file" name="picture" class="form-control">
        <?php if ($employee['picture']): ?>
            <img src="/public/uploads/<?= $employee['picture'] ?>" width="100" class="mt-2">
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Update Employee</button>
</form>
<?php include(APPPATH . 'Views/layout/footer.php'); ?>
