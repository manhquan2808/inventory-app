@extends('product-management.layouts.app')
@section('content')
    @include('product-management.slidebar.slide')
    <section id="wrapper">
        @include('product-management.header.index')

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
                                <i class="fa-solid fa-laptop-code fs-2 text-white"></i>
                            </span>

                            <div class="ms-3">
                                <div class="d-flex align-items-center">
                                    <h3 class="mb-0">{{ $count_product }}</h3> <span class="d-block ms-2">Sản
                                        phẩm</span>
                                </div>
                                <p class="fs-normal mb-0">Số lượng sản phẩm trong kho</p>
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
                                <p class="fs-normal mb-0">Số lượng yêu cầu sản xuất</p>
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
                            <h3 class="fs-6 mb-3">Biểu đồ phần trăm sản phẩm</h3>
                            <div id="treemap_chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="chart-container rounded-2 p-3">
                            <h3 class="fs-6 mb-3">Biểu đồ thể hiện phần trăm sản phẩm nhận được so với yêu cầu</h3>
                            <div id="pie_chart2"></div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="charts mt-4">
                <div class="chart-container p-3">
                    <h3 class="fs-6 mb-3">Biểu đồ thể hiện số lượng nhận và từ chối sản phẩm</h3>
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
        var count_accept = {!! json_encode($count_accept) !!};
        var count_reject = {!! json_encode($count_reject) !!};

        var options = {
            chart: {
                type: 'bar',
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
                name: 'Số lượng',
                data: [count_accept, count_reject]
            }],
            xaxis: {
                categories: ['Nhận', 'Từ chối'],
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
        // Assuming `data_pie` is correctly passed from the backend to the front end
        var data_pie = {!! json_encode($data_pie) !!};
    
        var options = {
            chart: {
                height: 350,
                type: "treemap",
            },
            series: [
                {
                    data: data_pie.map(product => ({
                        x: product.x,
                        y: product.y
                    }))
                }
            ],
            // title: {
            //     text: 'Inventory Products Treemap',
            //     align: 'center',
            //     style: {
            //         fontSize: '24px'
            //     }
            // },
            legend: {
                show: true,
                position: 'bottom'
            }
        };
    
        var chart = new ApexCharts(document.querySelector("#treemap_chart"), options);
        chart.render();
    </script>
    

    {{-- chart2 --}}
    <script>
        // Assuming `data_pie2` is correctly passed from the backend to the front end
        var data_pie2 = {!! json_encode($data_pie2) !!};
    
        var options = {
            chart: {
                type: 'pie',
                height: 400,
                foreColor: '#9ca3af', // Customize text color
                fontFamily: 'Arial, sans-serif' // Customize font family
            },
            series: data_pie2.map(product => product.percentage), // Use "percentage" field for series
            labels: data_pie2.map(product => product.product_name), // Use "product_name" field for labels
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
    
        var chart2 = new ApexCharts(document.querySelector("#pie_chart2"), options);
        chart2.render();
    </script>
    

@endpush
