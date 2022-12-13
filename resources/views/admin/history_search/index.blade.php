@extends('layouts.admin.main')

@section('title_page', 'Lịch sử tìm kiếm')

@section('content')
    <div class="bg-white shadow-lg p-4 rounded-4">
        <canvas id="myChart" width="400" height="150"></canvas>
    </div>
    <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.min.js"
            integrity="sha512-tQYZBKe34uzoeOjY9jr3MX7R/mo7n25vnqbnrkskGr4D6YOoPYSpyafUAzQVjV6xAozAqUFIEFsCO4z8mnVBXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('custom_js')
    <script>
        const ctx = document.getElementById('myChart');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('backend_api_history_search') }}",
            type: 'GET',
            success: function (result) {
                const data = JSON.parse(JSON.stringify(result));
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.label,
                        datasets: [{
                            label: 'Số lượt tìm kiếm theo thành phố',
                            data: data.value,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
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
            }
        });
    </script>

@endsection
