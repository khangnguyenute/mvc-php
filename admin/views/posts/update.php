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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <input name="title" type="text" class="form-control" value="<?= $post['title'] ?>" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="excerpt" class="form-label">Excerpt</label>
                            <textarea name="excerpt" class="form-control"><?= $post['excerpt'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="img_thumbnail" class="form-label">Image Thumbnail</label>
                            <input name="img_thumbnail" type="file" class="form-control" value="<?= $post['img_thumbnail'] ?>">
                            <img src="<?= BASE_URL . $post['img_thumbnail'] ?>" alt="" width="100px">
                        </div>
                        <div class="form-group">
                            <label for="img_cover" class="form-label">Image Cover</label>
                            <input name="img_cover" type="file" class="form-control" value="<?= $post['img_cover'] ?>">
                            <img src="<?= BASE_URL . $post['img_cover'] ?>" alt="" width="100px">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" class="form-control">
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['id'] ?>" <?= $post['category_id'] === $category['id'] ? 'selected' : null ?>><?= $category['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="author_id" class="form-label">Author</label>
                            <select name="author_id" class="form-control">
                                <?php foreach ($authors as $author) : ?>
                                    <option value="<?= $author['id'] ?>" <?= $post['author_id'] === $author['id'] ? 'selected' : null ?>><?= $author['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tags" class="form-label">Tags</label>
                            <select name="tags[]" class="form-control" multiple>
                                <?php foreach ($tags as $tag) : ?>
                                    <option value="<?= $tag['id'] ?>" <?= in_array($tag['id'], $tagIdsForPost) ? "selected" : null ?>><?= $tag['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="<?= STATUS_DRAFT ?>" <?= $post['status'] === STATUS_DRAFT ? 'selected' : null ?>><?= STATUS_DRAFT ?></option>
                                <option value="<?= STATUS_PUBLISHED ?>" <?= $post['status'] === STATUS_PUBLISHED ? 'selected' : null ?>><?= STATUS_PUBLISHED ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="is_trending" class="form-label">Is Trending</label>
                            <select name="is_trending" class="form-control">
                                <option value="0" <?= !$post['is_trending'] ? 'selected' : null ?>>No</option>
                                <option value="1" <?= !$post['is_trending'] ? 'selected' : null ?>>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="content" class="form-label">Content</label>
                            <textarea id="content" name="content" class="form-control"><?= $post['content'] ?></textarea>
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