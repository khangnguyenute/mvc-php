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
            <?php if (isset($_SESSION['errors'])) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($_SESSION['errors'] as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <?php unset($_SESSION['errors']) ?>
            <?php endif ?>
            <?php if (isset($_SESSION['success'])) :  ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success'] ?>
                </div>
                <?php unset($_SESSION['success']) ?>
            <?php endif ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input name="name" type="text" class="form-control" value="<?= $author['name'] ?>" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="avatar" class="form-label">Avatar</label>
                    <input name="avatar" type="file" class="form-control">
                    <img src="<?= BASE_URL . $author['avatar'] ?>" alt="" width="100px">
                </div>

                <a href="<?= BASE_URL_ADMIN ?>?act=authors" class="btn btn-danger">Back</a>

                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </form>
        </div>
    </div>
</div>