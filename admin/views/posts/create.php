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
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <input name="title" type="text" class="form-control" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['title'] : null ?>" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="excerpt" class="form-label">Excerpt</label>
                            <textarea name="excerpt" class="form-control"><?= isset($_SESSION['data']) ? $_SESSION['data']['excerpt'] : null ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="img_thumbnail" class="form-label">Image Thumbnail</label>
                            <input name="img_thumbnail" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="img_cover" class="form-label">Image Cover</label>
                            <input name="img_cover" type="file" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" class="form-control">
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="author_id" class="form-label">Author</label>
                            <select name="author_id" class="form-control">
                                <?php foreach ($authors as $author) : ?>
                                    <option value="<?= $author['id'] ?>"><?= $author['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tags" class="form-label">Tags</label>
                            <select name="tags[]" class="form-control" multiple>
                                <?php foreach ($tags as $tag) : ?>
                                    <option value="<?= $tag['id'] ?>"><?= $tag['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="<?= STATUS_DRAFT ?>"><?= STATUS_DRAFT ?></option>
                                <option value="<?= STATUS_PUBLISHED ?>"><?= STATUS_PUBLISHED ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="is_trending" class="form-label">Is Trending</label>
                            <select name="is_trending" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="content" class="form-label">Content</label>
                            <textarea id="content" name="content" class="form-control"><?= isset($_SESSION['data']) ? $_SESSION['data']['content'] : null ?></textarea>
                        </div>
                    </div>
                </div>

                <a href="<?= BASE_URL_ADMIN ?>?act=posts" class="btn btn-danger">Back</a>

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