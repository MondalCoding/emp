<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h3>Register</h3>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ((array)session()->getFlashdata('error') as $err): ?>
                            <li><?= esc($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('registerSave') ?>" method="post">
                <div class="mb-3">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="user_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required minlength="6">
                </div>
                <button class="btn btn-success w-100" type="submit">Register</button>
            </form>
            <p class="mt-3 text-center">
                Already have an account? <a href="<?= base_url('login') ?>">Login here</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
