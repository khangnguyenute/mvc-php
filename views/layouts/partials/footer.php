<footer id="footer" class="footer">

    <div class="footer-content">
        <div class="container">

            <div class="row g-5">
                <div class="col-lg-4">
                    <h3 class="footer-heading">About <?= $GLOBALS['settings']['name']  ?? null ?></h3>
                    <p><?= $GLOBALS['settings']['overview']  ?? null ?>?</p>
                    <p><a href="about.html" class="footer-link-more">Learn More</a></p>
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Navigation</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="<?= BASE_URL ?>"><i class="bi bi-chevron-right"></i> Home</a></li>
                        <li><a href="about.html"><i class="bi bi-chevron-right"></i> About us</a></li>
                        <li><a href="contact.html"><i class="bi bi-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Categories</h3>
                    <ul class="footer-links list-unstyled">
                        <?php foreach ($categories as $category) : ?>
                            <li><a href="<?= BASE_URL ?>?act=category&id=<?= $category['id'] ?>"><i class="bi bi-chevron-right"></i><?= $category['name'] ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h3 class="footer-heading">Recent Posts</h3>

                    <ul class="footer-links footer-blog-entry list-unstyled">
                        <li>
                            <a href="single-post.html" class="d-flex align-items-center">
                                <img src="<?= BASE_URL ?>assets/client/assets/img/post-sq-1.jpg" alt="" class="img-fluid me-3">
                                <div>
                                    <div class="post-meta d-block"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <span>5 Great Startup Tips for Female Founders</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="single-post.html" class="d-flex align-items-center">
                                <img src="<?= BASE_URL ?>assets/client/assets/img/post-sq-2.jpg" alt="" class="img-fluid me-3">
                                <div>
                                    <div class="post-meta d-block"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <span>What is the son of Football Coach John Gruden, Deuce Gruden doing Now?</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="single-post.html" class="d-flex align-items-center">
                                <img src="<?= BASE_URL ?>assets/client/assets/img/post-sq-3.jpg" alt="" class="img-fluid me-3">
                                <div>
                                    <div class="post-meta d-block"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <span>Life Insurance And Pregnancy: A Working Mom’s Guide</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="single-post.html" class="d-flex align-items-center">
                                <img src="<?= BASE_URL ?>assets/client/assets/img/post-sq-4.jpg" alt="" class="img-fluid me-3">
                                <div>
                                    <div class="post-meta d-block"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <span>How to Avoid Distraction and Stay Focused During Video Calls?</span>
                                </div>
                            </a>
                        </li>

                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div class="footer-legal">
        <div class="container">

            <div class="row justify-content-between">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="copyright">
                        © Copyright <strong><span><?= $GLOBALS['settings']['name'] ?? null ?></span></strong>. All Rights Reserved
                    </div>

                    <div class="credits">
                        <!-- All the links in the footer should remain intact. -->
                        <!-- You can delete the links only if you purchased the pro version. -->
                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
                        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
                        <a href="<?= $GLOBALS['settings']['link_twitter'] ?? null ?>" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="<?= $GLOBALS['settings']['link_facebook'] ?? null ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="<?= $GLOBALS['settings']['link_instagram'] ?? null ?>" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="<?= $GLOBALS['settings']['link_skype'] ?? null ?>" class="google-plus"><i class="bi bi-skype"></i></a>
                        <a href="<?= $GLOBALS['settings']['link_linkedin'] ?? null ?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>

                </div>

            </div>

        </div>
    </div>

</footer>