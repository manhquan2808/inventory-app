@extends('admin.layouts.app')
@section('content')
    @extends('admin.slidebar.slide')
    <section id="wrapper">
        @include('admin.header.index')
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
                            <span class="rounded-circle bg-primary p-3" style="height: 65px;">
                                <i class="fa-solid fa-warehouse fs-2 text-white"></i>
                            </span>
                            <div class="ms-3">
                                <div class="d-flex align-items-center">
                                    <h3 class="mb-0">{{ $count_inventory }}</h3> <span class="d-block ms-2">Kho</span>
                                </div>
                                <p class="fs-normal mb-0">Số lượng kho</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box d-flex rounded-2 align-items-center mb-4 mb-lg-0 p-3">
                            <span class="rounded-circle bg-danger p-3" style="height: 65px;">
                                <i class="fa-regular fa-file fs-2 text-white"></i>
                            </span>
                            <div class="ms-3">
                                <div class="d-flex align-items-center">
                                    <h3 class="mb-0">{{ $count_role }}</h3> <span class="d-block ms-2">Chức vụ</span>
                                </div>
                                <p class="fs-normal mb-0">Số lượng chức vụ </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box d-flex rounded-2 align-items-center p-3">
                            <span class="rounded-circle bg-success p-3" style="height: 65px;">
                                <i class="fa-solid fa-users fs-2 text-white"></i>
                            </span>
                            <div class="ms-3">
                                <div class="d-flex align-items-center">
                                    <h3 class="mb-0">{{ $count_employee }}</h3> <span class="d-block ms-2">Tài
                                        khoản</span>
                                </div>
                                <p class="fs-normal mb-0">Số lượng tài khoản trong hệ thống</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- <section class="charts mt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="chart-container rounded-2 p-3">
                            <h3 class="fs-6 mb-3">Biểu đồ thể hiện số lượng nhân viên trong hệ thống</h3>
                            <div id="chart1"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="chart-container rounded-2 p-3">
                            <h3 class="fs-6 mb-3">Biểu đồ thể hiện giá nhập nguyên liệu theo thời gian</h3>
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
            </section> --}}

            <section class="charts mt-4">
                <div class="chart-container p-3">
                    <h3 class="fs-6 mb-3">Biểu đồ thể hiện số lượng nhập xuất nguyên liệu</h3>
                    <div style="height: 300px">
                        <div id="chart1"></div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection
@push('script')
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script>
        var options = {
            chart: {
                type: 'bar',
                height: 300,
                foreColor: '#9ca3af', // Customize text color
                fontFamily: 'Arial, sans-serif', // Customize font family
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
                name: 'Số lượng',
                data: {!! json_encode($data->pluck('count')) !!}
            }],
            xaxis: {
                categories: {!! json_encode($data->pluck('role_name')) !!}
            },
            fill: {
                opacity: 1
            },
            colors: ['#77B6EA', '#545454'],
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " người"
                    }
                }
            }
        }



        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();
        console.log({!! json_encode($data->pluck('count')) !!});
        console.log({!! json_encode($data->pluck('role_name')) !!});
    </script>
@endpush
