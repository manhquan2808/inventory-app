<aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left" id="show-side-navigation1">
    <i class="uil-bars close-aside d-md-none d-lg-none" data-close="show-side-navigation1"></i>
    <div class="sidebar-header d-flex justify-content-center align-items-center px-3 py-4">
        <div class="ms-2">
            <h5 class="fs-6 mb-0">
                    {{-- <a class="text-decoration-none" href="#">{{ $employee->employee_id}}</a> --}}
            </h5>
        </div>
    </div>



    <ul class="categories list-unstyled">

        <li class="">
            <i><x-bi-house /></i><a href="{{ route('employee') }}"> Trang chủ</a>
        </li>
        <li class="">
            <i class="fa-solid fa-list-check" style="color: dimgray"></i><i></i><a href="{{ route('employee.materialList') }}">Danh sách nguyên liệu</a>
        </li>
        <li class="">
            <i class="fa-regular fa-comment" style="color: dimgray"></i><i></i><a
                href="{{ route('employee.chat') }}">Nhắn tin</a>
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
