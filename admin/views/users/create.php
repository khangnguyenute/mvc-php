<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Create
            </h6>
        </div>
        <div class="card-body">
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
                            <input name="name" type="text" class="form-control" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['name'] : null ?>" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" aria-describedby="emailHelp" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['email'] : null ?>" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['password'] : null ?>" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" class="form-control">
                                <option value="1" <?= isset($_SESSION['data']) && $_SESSION['data']['type'] ? 'selected' : null ?>>Admin</option>
                                <option value="0" <?= isset($_SESSION['data']) && !$_SESSION['data']['type'] ? 'selected' : null ?>>Member</option>
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

<?php if (isset($_SESSION['data'])) {
    unset($_SESSION['data']);
}  ?>