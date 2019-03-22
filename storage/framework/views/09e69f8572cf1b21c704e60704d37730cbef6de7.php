<?php /* D:\xampp\htdocs\batdongsan\resources\views/admin/layouts/menu.blade.php */ ?>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Bất Động Sản</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Chức năng</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Cập nhật
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Danh Mục</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Danh sách:</h6>
            <a class="collapse-item" href="<?php echo e(URL::to('admin/danhmuc/loaitin')); ?>">Loại Tin</a>
            <a class="collapse-item" href="<?php echo e(URL::to('admin/danhmuc/loaibds')); ?>">Loại Bất Động Sản</a>
            <a class="collapse-item" href="<?php echo e(URL::to('admin/danhmuc/loainha')); ?>">Loại Nhà</a>
            <a class="collapse-item" href="<?php echo e(URL::to('admin/danhmuc/loaidat')); ?>">Loại Đất</a>
            <a class="collapse-item" href="<?php echo e(URL::to('admin/danhmuc/loaivp')); ?>">Loại Văn Phòng</a>
            <a class="collapse-item" href="<?php echo e(URL::to('admin/danhmuc/loaigiayto')); ?>">Loại Giấy tờ</a>
             <a class="collapse-item" href="<?php echo e(URL::to('admin/danhmuc/huong')); ?>">Hướng</a>
             <a class="collapse-item" href="<?php echo e(URL::to('admin/danhmuc/dacdiemnhadat')); ?>">Đặc điểm nhà đất</a>
             <a class="collapse-item" href="<?php echo e(URL::to('admin/danhmuc/loaicanho')); ?>">Loại căn hộ</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Quản lý người dùng</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Danh sách:</h6>
            <a class="collapse-item" href="utilities-color.html">Thêm mới</a>
            <a class="collapse-item" href="utilities-border.html">Cập nhật thông tin</a>
            <a class="collapse-item" href="utilities-border.html">Đổi mật khẩu</a>
            <a class="collapse-item" href="utilities-animation.html">Xóa người dùng</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        QUẢN LÝ TIN ĐĂNG
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Duyệt tin</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>

    

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        TÀI KHOẢN
      </div>

          <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Đổi mật khẩu</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Đăng xuất</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>