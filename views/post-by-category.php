<section id="search-result" class="search-result">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <h3 class="category-title">Search Results</h3>
        <?php foreach ($posts as $post) : ?>
          <div class="d-md-flex post-entry-2 small-img">
            <a href="<?= BASE_URL ?>?act=post&id=<?= $post['id'] ?>" class="me-4 thumbnail">
              <img src="<?= BASE_URL . $post['img_thumbnail'] ?>" alt="" class="img-fluid" />
            </a>
            <div>
              <div class="post-meta">
                <span class="date"><?= $post['category_name'] ?></span>
                <span class="mx-1">&bullet;</span> <span><?= $post['updated_at'] ?></span>
              </div>
              <h3>
                <a href="<?= BASE_URL ?>?act=post&id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
              </h3>
              <p><?= $post['excerpt'] ?></p>
              <div class="d-flex align-items-center author">
                <div class="photo">
                  <img src="<?= BASE_URL . $post['author_avatar'] ?>" alt="" class="img-fluid" />
                </div>
                <div class="name">
                  <h3 class="m-0 p-0"><?= $post['author_name'] ?></h3>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach ?>

        <!-- Paging -->
        <div class="text-start py-4">
          <div class="custom-pagination">
            <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
              <a href="<?= BASE_URL ?>?act=category&id=<?= $post['category_id'] ?>&page=<?= $i ?>" class=" <?= $page == $i ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor  ?>
          </div>
        </div>
        <!-- End Paging -->
      </div>

      <div class="col-md-3">
        <!-- ======= Sidebar ======= -->
        <div class="aside-block">
          <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-trending-tab" data-bs-toggle="pill" data-bs-target="#pills-trending" type="button" role="tab" aria-controls="pills-trending" aria-selected="true">
                Trending
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest" aria-selected="false">
                Latest
              </button>
            </li>
          </ul>

          <div class="tab-content" id="pills-tabContent">
            <!-- Trending -->
            <div class="tab-pane fade show active" id="pills-trending" role="tabpanel" aria-labelledby="pills-trending-tab">
              <?php foreach ($postTop6Latest as $post) :  ?>
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta">
                    <span class="date"><?= $post['category_name'] ?></span>
                    <span class="mx-1">&bullet;</span>
                    <span><?= $post['updated_at'] ?></span>
                  </div>
                  <h2 class="mb-2">
                    <a href="#"><?= $post['title'] ?></a>
                  </h2>
                  <span class="author mb-3 d-block"><?= $post['author_name'] ?></span>
                </div>
              <?php endforeach ?>
            </div>
            <!-- End Trending -->

            <!-- Latest -->
            <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
              <?php foreach ($postTop5Trending as $post) :  ?>
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta">
                    <span class="date"><?= $post['category_name'] ?></span>
                    <span class="mx-1">&bullet;</span>
                    <span><?= $post['updated_at'] ?></span>
                  </div>
                  <h2 class="mb-2">
                    <a href="#"><?= $post['title'] ?></a>
                  </h2>
                  <span class="author mb-3 d-block"><?= $post['author_name'] ?></span>
                </div>
              <?php endforeach ?>
            </div>
            <!-- End Latest -->
          </div>
        </div>

        <div class="aside-block">
          <h3 class="aside-title">Categories</h3>
          <ul class="aside-links list-unstyled">
            <?php foreach ($categories as $category) : ?>
              <li>
                <a href="<?= BASE_URL ?>?act=category&id=<?= $category['id'] ?>"><i class="bi bi-chevron-right"></i><?= $category['name'] ?></a>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
        <!-- End Categories -->
      </div>
    </div>
  </div>
</section>