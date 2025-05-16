<?php include(APPPATH . 'Views/layout/header.php'); ?>
<h2>Add New Employee</h2>
<form method='post' action="<?= base_url('employee/store') ?>" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Address</label>
        <textarea name="address" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label>Designation</label>
        <input type="text" name="designation" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Salary</label>
        <input type="number" step="0.01" name="salary" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Picture</label>
        <input type="file" name="picture" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Add Employee</button>
</form>
<?php include(APPPATH . 'Views/layout/footer.php'); ?>
