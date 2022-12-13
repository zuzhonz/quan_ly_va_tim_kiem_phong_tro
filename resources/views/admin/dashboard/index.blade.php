@extends('layouts.admin.main')

@section('title_page', 'Thống kê')

@section('content')
    <div class="row">
        @if (\Illuminate\Support\Facades\Auth::user()->is_admin)
            <div class="col-xl-12 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Tổng số người dùng</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $AdminCountUser }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Tổng số khách ghé thăm</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="fa-solid fa-hotel"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $views }}</h1>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h1 class="card-title">Tổng gói dịch vụ</h1>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="fa-solid fa-wallet"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $AdminCountPlan }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="bg-white p-4 my-4">
                <div class="row">
                    <div class="col-7">
                        <div class="row">
                            <canvas id="myChart10" width="400" height="150"></canvas>
                        </div>
                        <div class="row">
                            <canvas id="myChart11" width="400" height="150"></canvas>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="row">
                            <div class="col-6">
                                <canvas id="myChart12" width="400" height="400"></canvas>
                            </div>
                            <div class="col-6">
                                <canvas id="myChart13" width="400" height="400"></canvas>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <canvas id="myChart14" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-xl-12 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Tổng số người dùng</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $AdminCountUser }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Tổng phòng trọ</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="fa-solid fa-hotel"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $OwnMotelCountMotel }}</h1>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Tổng gói dịch vụ đã mua</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="fa-solid fa-wallet"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $OwnMoteCountPlanBuyed }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row  bg-white shadow-lg  rounded-3 p-2">
                <div class="row">
                    <div class="col-7">
                        <canvas id="myChart2" width="400" height="250"></canvas>
                    </div>
                    <div class="col-5">
                        <div class="row">
                            <div class="col-6">
                                <canvas id="myChart" width="400" height="400"></canvas>
                            </div>
                            <div class="col-6">
                                <canvas id="myChart3" width="400" height="400"></canvas>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <canvas id="myChart4" width="400" height="400"></canvas>
                            </div>
                            <div class="col-6">
                                <canvas id="myChart5" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>

                </div>

                {{--                </div>--}}

            </div>
        @endif

        <script>
            window.history.pushState("", "", 'http://phong.ngo/admin/dashboard');
        </script>

        <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.min.js"
                integrity="sha512-tQYZBKe34uzoeOjY9jr3MX7R/mo7n25vnqbnrkskGr4D6YOoPYSpyafUAzQVjV6xAozAqUFIEFsCO4z8mnVBXA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        @if(!\Illuminate\Support\Facades\Auth::user()->is_admin)
            @section('custom_js')
                <script>
                    const ctx = document.getElementById('myChart');
                    const ctx2 = document.getElementById('myChart2');
                    const ctx3 = document.getElementById('myChart3');
                    const ctx4 = document.getElementById('myChart4');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('getDataChartPieBossMotel',['user_id' => \Illuminate\Support\Facades\Auth::id()]) }}",
                        type: 'GET',
                        success: function (result) {
                            const data = JSON.parse(JSON.stringify(result));
                            let duLieu = {
                                label: [],
                                value: []
                            };
                            data.user.forEach(item => {
                                duLieu.label.push(item.label);
                                duLieu.value.push(item.value);
                            })
                            new Chart(ctx2, {
                                type: 'line',
                                data: {
                                    labels: duLieu.label,
                                    datasets: [{
                                        label: 'Biều đồ tỉ lệ tăng trưởng khách thuê',
                                        data: duLieu.value,
                                        fill: false,
                                        borderColor: 'rgb(75, 192, 192)',
                                        tension: 0.1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Biều đồ tỉ lệ tăng trưởng khách thuê'
                                    },
                                }
                            });
                            new Chart(ctx3, {
                                type: 'doughnut',
                                data: {
                                    labels: ['Tệ', 'Bình thường', 'Tốt', 'Rất tốt', 'Tuyệt'],
                                    datasets: [{
                                        label: 'Biều đồ thái độ của khách sau khi ở trọ',
                                        data: data.vote,
                                        backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                            'rgb(255, 205, 86)',
                                            'rgb(255, 200, 120)',
                                            'rgb(255, 180, 15)'
                                        ],
                                        hoverOffset: 5
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Biều đồ thái độ của khách sau khi ở trọ'
                                    },
                                }
                            });
                            new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: [
                                        'Số phòng trống',
                                        'Số phòng trọ đã có người thuê',
                                        'Số phòng trọ đăng tin'
                                    ],
                                    datasets: [{
                                        label: 'Biểu đồ trạng thái phòng trọ',
                                        data: [data.motel[0].value, data.motel[1].value, data.motel[2].value],
                                        backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                            'rgb(255, 205, 86)'
                                        ],
                                        hoverOffset: 4
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Biểu đồ trạng thái phòng trọ'
                                    },
                                }
                            });
                            new Chart(ctx4, {
                                type: 'pie',
                                data: {
                                    labels: data.bill.label,
                                    datasets: [{
                                        label: 'Biểu đồ tỷ lệ thu tiền phòng tháng {{ now()->month - 1}}',
                                        data: data.bill.data,
                                        backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                        ],
                                        hoverOffset: 4
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Biểu đồ tỷ lệ thu tiền phòng tháng {{ now()->month - 1}}'
                                    },
                                }
                            });
                        }
                    });
                </script>
            @endsection
        @else
            @section('custom_js')
                <script>
                    const ctx = document.getElementById('myChart10');
                    const ctx2 = document.getElementById('myChart11');
                    const ctx3 = document.getElementById('myChart12');
                    const ctx4 = document.getElementById('myChart13');
                    const ctx5 = document.getElementById('myChart14');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('getDataChartPieAdmin') }}",
                        type: 'GET',
                        success: function (result) {
                            const data = JSON.parse(JSON.stringify(result));
                            console.log(ctx);
                            new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: data.people.label,
                                    datasets: [{
                                        label: 'Tỷ lệ tăng trưởng người dùng',
                                        data: data.people.value,
                                        fill: false,
                                        borderColor: 'rgb(75, 192, 192)',
                                        tension: 0.1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Biều đồ tỉ lệ tăng trưởng người dùng'
                                    },
                                }
                            });
                            new Chart(ctx2, {
                                type: 'bar',
                                data: {
                                    labels: data.plan.label,
                                    datasets: [{
                                        label: 'Số lượt mua gọi của từng loại ưu tiên',
                                        data: data.plan.value,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(255, 205, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                        ],
                                        borderColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(255, 159, 64)',
                                            'rgb(255, 205, 86)',
                                            'rgb(75, 192, 192)',
                                            'rgb(54, 162, 235)',
                                            'rgb(153, 102, 255)',
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    title: {
                                        display: true,
                                    },
                                }
                            });
                            new Chart(ctx3, {
                                type: 'pie',
                                data: {
                                    labels: data.money_day.label,
                                    datasets: [{
                                        label: 'Biểu đồ tỷ lệ nạp rút ngày hôm nay',
                                        data: data.money_day.value,
                                        backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                        ],
                                        hoverOffset: 4
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Biều đồ nạp rút ngày hôm nay',
                                    },
                                }
                            });
                            new Chart(ctx4, {
                                type: 'pie',
                                data: {
                                    labels: data.money_month.label,
                                    datasets: [{
                                        label: 'Biểu đồ tỷ lệ nạp rút ngày hôm nay',
                                        data: data.money_month.value,
                                        backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                        ],
                                        hoverOffset: 4
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Biều đồ nạp rút tháng {{now()->month}}',
                                    },
                                }
                            });
                            new Chart(ctx5, {
                                type: 'pie',
                                data: {
                                    labels: data.money_year.label,
                                    datasets: [{
                                        label: 'Biểu đồ tỷ lệ nạp rút ngày hôm nay',
                                        data: data.money_year.value,
                                        backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                        ],
                                        hoverOffset: 4
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Biều đồ nạp rút năm {{now()->year}}',
                                    },
                                }
                            });
                        }
                    });
                </script>
@endsection
@endif

@endsection
