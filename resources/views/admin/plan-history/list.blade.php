@extends('layouts.admin.main')

@section('title_page', 'Lịch sử giao dịch')

@section('content')
    <div class="bg-white shadow-lg p-4 rounded-4">
    <form action="" class="my-4">
        <div class="row">
            <div class="col-3">
                <input class="form-control" name="name" value="{{ $params['name'] ?? '' }}"
                       placeholder="Tìm kiếm theo tên mã phòng trọ">
            </div>
            <div class="col-2">
                <select class="form-control" name="order_by">
                    <option value="desc"
                        {{ isset($params['order_by']) && $params['order_by'] == 'desc' ? 'selected' : '' }}>
                        Sắp xếp mới nhất
                    </option>
                    <option value="asc"
                        {{ isset($params['order_by']) && $params['order_by'] == 'asc' ? 'selected' : '' }}>Sắp
                        xếp cũ nhất
                    </option>
                </select>
            </div>
            <div class="col-2">
                <select class="form-control" name="limit">
                    <option value="" {{ !isset($params['limit']) ? 'selected' : '' }}>Số lượng bản ghi hiển thị
                    </option>
                    <option value="10" {{ isset($params['limit']) && $params['limit'] == '10' ? 'selected' : '' }}>
                        10
                    </option>

                    <option value="25" {{ isset($params['limit']) && $params['limit'] == '25' ? 'selected' : '' }}>
                        25
                    </option>
                    <option value="50" {{ isset($params['limit']) && $params['limit'] == '50' ? 'selected' : '' }}>
                        50
                    </option>
                    <option
                        value="100" {{ isset($params['limit']) && $params['limit'] == '100' ? 'selected' : '' }}>
                        100
                    </option>
                </select>
            </div>
            <div class="col-5">
                <button class="btn btn-primary">Tìm kiếm</button>
                <a class="btn btn-danger" href="{{route('admin.plan-history.list')}}">Bỏ chọn</a>
            </div>
        </div>
    </form>
    <table class="table text-center">
        <thead>
        <tr>
            <th class="">#</th>
            <th class="">Phòng trọ</th>
            <th class="">Khu trọ</th>
            <th class="">Gói dịch vụ</th>
            <th>Loại gói</th>
            <th class="">Ngày mua</th>
            <th>Tiền</th>
            <th>Ghi chú</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($plansHistory as $planHistory)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $planHistory->room_number }}</td>
                <td class="">{{ $planHistory->areaName }}</td>
                <td class="">{{ $planHistory->planName }}</td>
                <td>
                    @if($planHistory->type == 1)
                        <span class="text-danger font-weight-bold">Đăng tin thuê trọ</span>
                    @else
                        <span class="text-success font-weight-bold">Đăng tin ở ghép</span>
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($planHistory->date)->format('d/m/Y H:i:s') }}</td>
                <th>
                    @if($planHistory->tt == 2)
                        <span class="text-danger mx-1">-{{$planHistory->gia * $planHistory->day}}</span><i
                            class="fa-brands fa-bitcoin text-warning"></i>

                    @elseif($planHistory->tt ==1)
                        <span class="text-danger mx-1">-{{$planHistory->gia * $planHistory->day}}</span><i
                            class="fa-brands fa-bitcoin text-warning"></i>
                    @else
                        <span
                            class="text-success mx-1">+{{$planHistory->gia * (\Carbon\Carbon::parse($planHistory->date)->addDays($planHistory->day)->diffInDays(\Carbon\Carbon::now()) + 1)}}</span>
                        <i
                            class="fa-brands fa-bitcoin text-warning"></i>
                    @endif
                </th>
                <td>
                    @if($planHistory->is_first)
                        <span class="text-success font-weight-bold">Mua mới</span>
                    @elseif($planHistory->tt == 2)
                        <span class="text-warning font-weight-bold">Gia hạn</span>
                    @else
                        <span class="text-danger font-weight-bold">Chuyển gói</span>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{$plansHistory->links()}}
@endsection

@section('custom_js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
            var gradient = ctx.createLinearGradient(0, 0, 0, 225);
            gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
            gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
            // Line chart
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                        label: "Sales ($)",
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: window.theme.primary,
                        data: [
                            2115,
                            1562,
                            1584,
                            1892,
                            1587,
                            1923,
                            2566,
                            2448,
                            2805,
                            3438,
                            2917,
                            3327
                        ]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 1000
                            },
                            display: true,
                            borderDash: [3, 3],
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }]
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: ["Chrome", "Firefox", "IE"],
                    datasets: [{
                        data: [4306, 3801, 1689],
                        backgroundColor: [
                            window.theme.primary,
                            window.theme.warning,
                            window.theme.danger
                        ],
                        borderWidth: 5
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 75
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Bar chart
            new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: "bar",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                        label: "This year",
                        backgroundColor: window.theme.primary,
                        borderColor: window.theme.primary,
                        hoverBackgroundColor: window.theme.primary,
                        hoverBorderColor: window.theme.primary,
                        data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                        barPercentage: .75,
                        categoryPercentage: .5
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            stacked: false,
                            ticks: {
                                stepSize: 20
                            }
                        }],
                        xAxes: [{
                            stacked: false,
                            gridLines: {
                                color: "transparent"
                            }
                        }]
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var markers = [{
                coords: [31.230391, 121.473701],
                name: "Shanghai"
            },
                {
                    coords: [28.704060, 77.102493],
                    name: "Delhi"
                },
                {
                    coords: [6.524379, 3.379206],
                    name: "Lagos"
                },
                {
                    coords: [35.689487, 139.691711],
                    name: "Tokyo"
                },
                {
                    coords: [23.129110, 113.264381],
                    name: "Guangzhou"
                },
                {
                    coords: [40.7127837, -74.0059413],
                    name: "New York"
                },
                {
                    coords: [34.052235, -118.243683],
                    name: "Los Angeles"
                },
                {
                    coords: [41.878113, -87.629799],
                    name: "Chicago"
                },
                {
                    coords: [51.507351, -0.127758],
                    name: "London"
                },
                {
                    coords: [40.416775, -3.703790],
                    name: "Madrid "
                }
            ];
            var map = new jsVectorMap({
                map: "world",
                selector: "#world_map",
                zoomButtons: true,
                markers: markers,
                markerStyle: {
                    initial: {
                        r: 9,
                        strokeWidth: 7,
                        stokeOpacity: .4,
                        fill: window.theme.primary
                    },
                    hover: {
                        fill: window.theme.primary,
                        stroke: window.theme.primary
                    }
                },
                zoomOnScroll: false
            });
            window.addEventListener("resize", () => {
                map.updateSize();
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
            var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
            document.getElementById("datetimepicker-dashboard").flatpickr({
                inline: true,
                prevArrow: "<span title=\"Previous month\">&laquo;</span>",
                nextArrow: "<span title=\"Next month\">&raquo;</span>",
                defaultDate: defaultDate
            });
        });
    </script>
    </div>
@endsection
