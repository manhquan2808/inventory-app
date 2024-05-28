<aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left" id="show-side-navigation1">
    <i class="uil-bars close-aside d-md-none d-lg-none" data-close="show-side-navigation1"></i>
    <div class="sidebar-header d-flex justify-content-center align-items-center px-3 py-4">
        <div class="ms-2">
            <h5 class="fs-6 mb-0">
                <a class="text-decoration-none" href="#">Jone Doe</a>
            </h5>
            <p class="mt-1 mb-0">Lorem ipsum dolor sit amet consectetur.</p>
        </div>
    </div>



    <ul class="categories list-unstyled">
        <li>
            <i><x-bi-house /></i><a href="{{ route('supp.dashboard') }}"> Trang chủ</a>
        </li>
        <li>
            <i class="bi bi-file-earmark-text"></i><a href="{{ route('supp.require') }}">Quản lý yêu cầu</a>
        </li>
        <li>
            <i class="bi bi-file-earmark-text"></i><a href="{{ route('supp.accepted') }}">Nguyên liệu đã gửi</a>
        </li>
        <li>
            <i class="fa-solid fa-rotate-left" style="color: #6B7280"></i><i></i><a
                href="{{ route('supp.require') }}">Xử lý hàng trả</a>
        </li>
    </ul>
    <div>
        <a style="display: flex; justify-content: center; text-decoration: none;" href="{{ route('logout') }}">
            <button type="button" class="btn btn-danger">Đăng xuất</button>
        </a>
    </div>


</aside>
