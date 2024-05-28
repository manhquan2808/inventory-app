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
            <i><x-bi-house /></i><a href="{{ route('employee_prod') }}"> Trang chủ</a>
        </li>
        <li class="">
            <i class="fa-solid fa-box" style="color: dimgray"></i><i></i><a
                href="{{ route('employee_prod.productList') }}">Danh sách nhận hàng</a>
        </li>
        <li class="">
            <i class="fa-regular fa-comment" style="color: dimgray"></i><i></i><a
                href="{{ route('employee_prod.chat') }}">Nhắn tin</a>
        </li>
        <li></li>
    </ul>
    <div>
        <a style="display: flex; justify-content: center; text-decoration: none;" href="{{ route('logout') }}">
            <button type="button" class="btn btn-danger">Đăng xuất</button>
        </a>
    </div>


</aside>
