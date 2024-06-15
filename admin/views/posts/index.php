<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">
        <?= $title ?>
        <a href="<?= BASE_URL_ADMIN ?>?act=post-create" class="btn btn-primary">Create</a>
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                DataTables
            </h6>
        </div>
        <div class="card-body">
            <?php if (isset($_SESSION['success'])) :  ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success'] ?>
                </div>
                <?php unset($_SESSION['success']) ?>
            <?php endif ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Excerpt</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Thumbnail</th>
                            <th>Cover</th>
                            <th>Status</th>
                            <th>Is Trending</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post) : ?>
                            <tr>
                                <td><?= $post['id'] ?></td>
                                <td><?= $post['title'] ?></td>
                                <td><?= $post['excerpt'] ?></td>
                                <td><?= $post['category_name'] ?></td>
                                <td><?= $post['author_name'] ?></td>
                                <td>
                                    <img src="<?= BASE_URL . $post['img_thumbnail'] ?>" alt="" width="100px">
                                </td>
                                <td>
                                    <img src="<?= BASE_URL . $post['img_cover'] ?>" alt="" width="100px">
                                </td>
                                <td><?= $post['status'] ?></td>
                                <td>
                                    <?= $post['is_trending']
                                        ? '<span class="badge badge-success">Yes</span>'
                                        : '<span class="badge badge-warning">No</span>' ?>
                                </td>
                                <td><?= $post['created_at'] ?></td>
                                <td><?= $post['updated_at'] ?></td>
                                <td>
                                    <a href="<?= BASE_URL_ADMIN ?>?act=post-detail&id=<?= $post['id'] ?>" class="btn btn-info">Show</a>
                                    <a href="<?= BASE_URL_ADMIN ?>?act=post-update&id=<?= $post['id'] ?>" class="btn btn-success">Update</a>
                                    <a href="<?= BASE_URL_ADMIN ?>?act=post-delete&id=<?= $post['id'] ?>" onclick="return confirm('Bạn có chắc chắn xóa không?')" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>