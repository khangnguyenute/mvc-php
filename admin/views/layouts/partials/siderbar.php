<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= BASE_URL_ADMIN ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
            <i class="fas fa-fw fa-user"></i>
            <span>Quản lý User</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= BASE_URL_ADMIN ?>?act=users">Danh sách</a>
                <a class="collapse-item" href="<?= BASE_URL_ADMIN ?>?act=user-create">Thêm mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePost" aria-expanded="true" aria-controls="collapsePost">
            <i class="fas fa-fw fa-user"></i>
            <span>Quản lý Post</span>
        </a>
        <div id="collapsePost" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= BASE_URL_ADMIN ?>?act=posts">Danh sách</a>
                <a class="collapse-item" href="<?= BASE_URL_ADMIN ?>?act=post-create">Thêm mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
            <i class="fas fa-fw fa-user"></i>
            <span>Quản lý Category</span>
        </a>
        <div id="collapseCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= BASE_URL_ADMIN ?>?act=categories">Danh sách</a>
                <a class="collapse-item" href="<?= BASE_URL_ADMIN ?>?act=category-create">Thêm mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTag" aria-expanded="true" aria-controls="collapseTag">
            <i class="fas fa-fw fa-user"></i>
            <span>Quản lý Tag</span>
        </a>
        <div id="collapseTag" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= BASE_URL_ADMIN ?>?act=tags">Danh sách</a>
                <a class="collapse-item" href="<?= BASE_URL_ADMIN ?>?act=tag-create">Thêm mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuthor" aria-expanded="true" aria-controls="collapseAuthor">
            <i class="fas fa-fw fa-user"></i>
            <span>Quản lý Author</span>
        </a>
        <div id="collapseAuthor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= BASE_URL_ADMIN ?>?act=authors">Danh sách</a>
                <a class="collapse-item" href="<?= BASE_URL_ADMIN ?>?act=author-create">Thêm mới</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">
</ul>