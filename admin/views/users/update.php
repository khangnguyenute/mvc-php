<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Update
            </h6>
        </div>
        <div class="card-body">
            <?php if (isset($_SESSION['success'])) :  ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success'] ?>
                </div>
                <?php unset($_SESSION['success']) ?>
            <?php endif ?>
            <?php if (isset($_SESSION['errors'])) :  ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($_SESSION['errors'] as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach  ?>
                    </ul>
                </div>
                <?php unset($_SESSION['errors']) ?>
            <?php endif ?>
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" id="name" type="text" class="form-control" value="<?= $user['name'] ?>" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" id="email" type="email" class="form-control" value="<?= $user['email'] ?>" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" id="password" type="password" class="form-control" value="<?= $user['password'] ?>" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="1" <?= $user['type'] ? 'selected' : null ?>>Admin</option>
                                <option value="0" <?= !$user['type'] ? 'selected' : null ?>>Member</option>
                            </select>
                        </div>
                    </div>
                </div>

                <a href="<?= BASE_URL_ADMIN ?>?act=users" class="btn btn-danger">Back</a>

                <button type="submit" class="btn btn-primary">
                    Submit
                </button>

            </form>
        </div>
    </div>
</div>