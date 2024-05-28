<aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left" id="show-side-navigation1">
    <i class="uil-bars close-aside d-md-none d-lg-none" data-close="show-side-navigation1"></i>
    <div class="sidebar-header d-flex justify-content-center align-items-center px-3 py-4">
        <div class="ms-2">
            <h5 class="fs-6 mb-0">
            </h5>
        </div>
    </div>



    <ul class="categories list-unstyled">

        <li class="">
            <i><x-bi-house /></i><a href="{{ route('admin.dashboard') }}"> Trang chủ</a>
        </li>
        <li class="">
            <i><x-bi-people /></i><a href="{{ route('admin.employee') }}">Quản lý tài
                khoản</a>
        </li>
        <li class="">
            <i><x-bi-diagram-2 /></i><a href="{{ route('admin.role') }}">Quản lý chức vụ</a>
        </li>
        <li class="">
            <i class="fa-solid fa-warehouse" style="color: dimgray"></i><i></i><a href="{{ route('admin.inventory') }}">Quản lý kho</a>
        </li>
        <li class="">
            <i class="fa-regular fa-comment" style="color: dimgray"></i><i></i><a
                href="{{ route('admin.chat') }}">Nhắn tin</a>
        </li>
        <li class="">
            <i class="fa-regular fa-address-card" style="color: dimgray"></i><i></i><a
                href="{{ route('admin.profile') }}">Thông tin cá nhân</a>
        </li>
    </ul>
    <div>
        <a style="display: flex; justify-content: center; text-decoration: none;" href="{{ route('logout') }}">
            <button type="button" class="btn btn-danger">Đăng xuất</button>
        </a>
    </div>


</aside>
{{-- <li class="has-dropdown">
            <i class="bi bi-bar-chart-line"></i><a href="#"> Charts</a>
            <ul class="sidebar-dropdown list-unstyled">
                <li><a href="#">Lorem ipsum</a></li>
                <li><a href="#">ipsum dolor</a></li>
                <li><a href="#">dolor ipsum</a></li>
                <li><a href="#">amet consectetur</a></li>
                <li><a href="#">ipsum dolor sit</a></li>
            </ul>
        </li>
        <li class="">
            <i class="bi bi-geo-alt"></i><a href="#"> Maps</a>
        </li> --}}
