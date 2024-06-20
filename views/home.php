<!-- ======= Hero Slider Section ======= -->
<!-- End Hero Slider Section -->

<!-- ======= Post Grid Section ======= -->
<section id="posts" class="posts">
    <div class="container" data-aos="fade-up">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="post-entry-1 lg">
                    <a href="<?= BASE_URL ?>?act=post&id=<?= $postTopView['id'] ?>"><img src="<?= BASE_URL . $postTopView['img_thumbnail'] ?>" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date"><?= ucwords($postTopView['category_name']) ?></span> <span class="mx-1">&bullet;</span> <span><?= $postTopView['updated_at'] ?></span></div>
                    <h2><a href="<?= BASE_URL ?>?act=post&id=<?= $postTopView['id'] ?>"><?= $postTopView['title'] ?></a></h2>
                    <p class="mb-4 d-block"><?= $postTopView['excerpt'] ?></p>

                    <div class="d-flex align-items-center author">
                        <div class="photo"><img src="<?= BASE_URL . $postTopView['author_avatar'] ?>" alt="" class="img-fluid"></div>
                        <div class="name">
                            <h3 class="m-0 p-0"><?= $postTopView['author_name'] ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row g-5">
                    <?php foreach ($postTop6Latest as $postColumn) : ?>
                        <div class="col-lg-4 border-start custom-border">
                            <?php foreach ($postColumn as $post) : ?>
                                <div class="post-entry-1">
                                    <a href="<?= BASE_URL ?>?act=post&id=<?= $post['id'] ?>"><img src="<?= BASE_URL . $post['img_thumbnail'] ?>" alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date"><?= ucwords($post['category_name']) ?></span> <span class="mx-1">&bullet;</span> <span><?= $post['updated_at'] ?></span></div>
                                    <h2><a href="<?= BASE_URL ?>?act=post&id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h2>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endforeach ?>

                    <!-- Trending Section -->
                    <div class="col-lg-4">
                        <div class="trending">
                            <h3>Trending</h3>
                            <ul class="trending-post">
                                <?php foreach ($postTop5Trending as $key => $post) : ?>
                                    <li>
                                        <a href="<?= BASE_URL ?>?act=post&id=<?= $post['id'] ?>">
                                            <span class="number"><?= ++$key ?></span>
                                            <h3><?= $post['title'] ?></h3>
                                            <span class="author"><?= $post['author_name'] ?></span>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div> <!-- End Trending Section -->
                </div>
            </div>

        </div> <!-- End .row -->
    </div>
</section>
<!-- End Post Grid Section -->