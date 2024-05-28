@extends('material-management.layouts.app')
@section('content')
    @include('material-management.slidebar.slide')
    <section id="wrapper">
        {{-- @include('material-management.header.index') --}}

        <div class="p-4">
            <div class="welcome">
                <div class="content rounded-3 p-3">
                    <h1 class="fs-3">Chào mừng đến với trang {{ $employee->role_name }}</h1>
                    <p class="mb-0">Xin chào <span class="main-color">{{ $employee->name }}</span>, chào mừng bạn đến
                        với Inventory-app!</p>
                </div>
            </div>

            <section class="statistics mt-4">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="box d-flex rounded-2 align-items-center mb-4 mb-lg-0 p-3">
                            <span class="rounded-circle bg-primary p-3" style="height: 60px;">
                                <i class="fa-solid fa-microchip fs-2 text-white"></i>
                            </span>
                            <div class="ms-3">
                                <div class="d-flex align-items-center">
                                    <h3 class="mb-0">{{ $count_material }}</h3> <span class="d-block ms-2">Nguyên
                                        liệu</span>
                                </div>
                                <p class="fs-normal mb-0">Số lượng nguyên liệu trong kho</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box d-flex rounded-2 align-items-center mb-4 mb-lg-0 p-3">
                            <i class="bi bi-file-earmark fs-2 text-center bg-danger rounded-circle"></i>
                            <div class="ms-3">
                                <div class="d-flex align-items-center">
                                    <h3 class="mb-0">{{ $count_require }}</h3> <span class="d-block ms-2">Yêu cầu</span>
                                </div>
                                <p class="fs-normal mb-0">Số lượng yêu cầu hiện tại</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box d-flex rounded-2 align-items-center p-3">
                            <i class="bi bi-people fs-2 text-center bg-success rounded-circle"></i>
                            <div class="ms-3">
                                <div class="d-flex align-items-center">
                                    <h3 class="mb-0">{{ $count_employee }}</h3> <span class="d-block ms-2">Nhân
                                        viên</span>
                                </div>
                                <p class="fs-normal mb-0">Số lượng nhân viên trong kho</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="charts mt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="chart-container rounded-2 p-3">
                            <h3 class="fs-6 mb-3">Biểu đồ phần trăm nguyên liệu</h3>
                            <div id="pie_chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="chart-container rounded-2 p-3">
                            <h3 class="fs-6 mb-3">Biểu đồ thể hiện giá nhập nguyên liệu theo thời gian</h3>
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="charts mt-4">
                <div class="chart-container p-3">
                    <h3 class="fs-6 mb-3">Biểu đồ thể hiện số lượng nhập xuất nguyên liệu</h3>
                    <div style="height: 300px">
                        <div id="chart"></div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection
@push('dashboard')
    <script src="{{ asset('js/dashboard.js') }}"></script>
    {{-- chart1 --}}
    <script>
        // Assuming you have received the data from your backend
        var materialInputQuantity = {!! json_encode($data->pluck('material_input_quantity')) !!};
        var productOrderQuantity = {!! json_encode($data->pluck('product_order_quantity')) !!};
        var inputDate = {!! json_encode($data->pluck('material_input_date')) !!};

        var options = {
            chart: {
                type: 'line',
                height: 300,
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                        selection: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: true,
                    },
                    autoSelected: 'zoom'
                }
            },
            series: [{
                name: 'Nhập',
                data: materialInputQuantity
            }, {
                name: 'Xuất',
                data: productOrderQuantity
            }],
            xaxis: {
                categories: inputDate,
                labels: {
                    style: {
                        colors: '#9ca3af' // Set x-axis label color
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Số lượng',
                    style: {
                        color: '#9ca3af' // Set y-axis title color
                    },

                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'left',
                labels: {
                    colors: '#9ca3af' // Set legend text color
                }
            },
            grid: {
                show: true,
                borderColor: '#f0f0f0',
                strokeDashArray: 5,
            },
            fill: {
                opacity: 0.5
            },
            colors: ['#77B6EA', '#0d6efd'],
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val;
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
    {{-- chart3 --}}
    <script>
        var data_pie = {!! json_encode($data_pie) !!};

        var options = {
            chart: {
                type: 'pie',
                height: 400,
                foreColor: '#9ca3af', // Customize text color
                fontFamily: 'Arial, sans-serif' // Customize font family
            },
            series: data_pie.map(material => material.percentage),
            labels: {!! json_encode($data_pie->pluck('material_name')) !!},
            legend: {
                position: 'bottom'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var chart = new ApexCharts(document.querySelector("#pie_chart"), options);
        chart.render();
    </script>
    {{-- chart2 --}}
    <script>
        var options = {
            series: [{
                name: 'Price',
                data: [
                    @foreach ($data_line as $result)
                        [new Date('{{ $result->date }}').getTime(), {{ $result->price }}],
                    @endforeach
                ]
            }],
            chart: {
                height: 350,
                type: 'line',
                foreColor: '#9ca3af',
            },
            stroke: {
                width: 5,
                curve: 'smooth'
            },
            xaxis: {
                type: 'datetime',
                labels: {
                    formatter: function(value, timestamp, opts) {
                        return opts.dateFormatter(new Date(timestamp), 'dd MMM yyyy')
                    }
                }
            },
            title: {
                // text: 'Price Chart',
                align: 'left',
                style: {
                    fontSize: "16px",
                    color: '#666'
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    gradientToColors: ['#FDD835'],
                    shadeIntensity: 1,
                    type: 'horizontal',
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100, 100, 100]
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();
    </script>
@endpush

{{-- <section .bg-transparent>
                    <div class="container py-5">
                        <div class="row">
                            <div class="col">
                                <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">User</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center bg-transparent text-white">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                            alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                        <h5 class="my-3">John Smith</h5>
                                        <p class="text-muted mb-1">Full Stack Developer</p>
                                        <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                                        <div class="d-flex justify-content-center mb-2">
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-primary">Follow</button>
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-outline-primary ms-1">Message</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4 mb-lg-0">
                                    <div class="card-body p-0">
                                        <ul class="list-group list-group-flush rounded-3">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="fas fa-globe fa-lg text-warning"></i>
                                                <p class="mb-0">https://mdbootstrap.com</p>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                                                <p class="mb-0">mdbootstrap</p>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                                <p class="mb-0">@mdbootstrap</p>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                                <p class="mb-0">mdbootstrap</p>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                                <p class="mb-0">mdbootstrap</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Full Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">Johnatan Smith</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">example@example.com</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Phone</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">(097) 234-5678</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Mobile</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">(098) 765-4321</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Address</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-4 mb-md-0">
                                            <div class="card-body">
                                                <p class="mb-4"><span
                                                        class="text-primary font-italic me-1">assigment</span> Project
                                                    Status
                                                </p>
                                                <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 80%"
                                                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 72%"
                                                        aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 89%"
                                                        aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 55%"
                                                        aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                <div class="progress rounded mb-2" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 66%"
                                                        aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-4 mb-md-0">
                                            <div class="card-body">
                                                <p class="mb-4"><span
                                                        class="text-primary font-italic me-1">assigment</span> Project
                                                    Status
                                                </p>
                                                <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 80%"
                                                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 72%"
                                                        aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 89%"
                                                        aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 55%"
                                                        aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                <div class="progress rounded mb-2" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 66%"
                                                        aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}
