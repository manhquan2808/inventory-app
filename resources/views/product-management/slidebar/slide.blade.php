<aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left" id="show-side-navigation1">
    <i class="uil-bars close-aside d-md-none d-lg-none" data-close="show-side-navigation1"></i>
    <div class="sidebar-header d-flex justify-content-center align-items-center px-3 py-4">
        <div class="ms-2">
            <h5 class="fs-6 mb-0">
            </h5>
        </div>
    </div>



    <ul class="categories list-unstyled">

        <li>
            <i><x-bi-house /></i><a href="{{ route('product-management.dashboard') }}"> Trang chủ</a>
        </li>
        <li>
            <i class="fa-solid fa-laptop-code" style="color: dimgray"></i><i></i><a
                href="{{ route('product-management.products') }}">Quản lý sản phẩm</a>
        </li>
        <li>
            <i class="bi bi-file-earmark-text"></i><a href="{{ route('product-management.require') }}"> Yêu cầu sản
                xuất</a>
        </li>
        <li>
            <i class="fa-solid fa-warehouse" style="color: #6B7280"></i><i></i><a
                href="{{ route('product-management.inventory') }}"> Quản lý kho</a>
        </li>
        <li class="">
            <i class="fa-regular fa-comment" style="color: dimgray"></i><i></i><a
                href="{{ route('product-management.chat') }}">Nhắn tin</a>
        </li>
        <li class="">
            <i class="fa-regular fa-address-card" style="color: dimgray"></i><i></i><a
                href="{{ route('product-management.profile') }}">Thông tin cá nhân</a>
        </li>
        <li></li>

    </ul>
    <div>
        <a style="display: flex; justify-content: center; text-decoration: none;" href="{{ route('logout') }}">
            <button type="button" class="btn btn-danger">Đăng xuất</button>
        </a>
    </div>


</aside>
