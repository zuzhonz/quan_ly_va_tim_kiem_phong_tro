@extends('layouts.client.main')

@section('content')
    <style>
        section.single-proper.details {
            padding: 10rem 0 !important;
        }

        p {
            font-size: 17px
        }

        .hp-6 .btn {
            background: none;
            /* color: #fff;  */
        }

        .btn-success {
            color: #fff !important;
            background-color: #198754 !important;
            border-color: #198754 !important;
        }

        .btn-success:hover {
            color: #fff !important;
            background-color: #157347 !important;
            border-color: #146c43 !important;
        }

        .btn-primary {
            color: #fff !important;
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
        }

        .btn-primary:hover {
            color: #fff !important;
            background-color: #0b5ed7 !important;
            border-color: #0a58ca !important;
        }

        .inner-pages .form-control {
            padding: 0.7rem;
            border: 1px solid #dddddd;
        }


    </style>
    <section class="single-proper blog details">
        <div class="container">
            <section class="headings-2 pt-0 pb-0">
                <div class="pro-wrapper">
                    <div class="detail-wrapper-body">
                        <div class="listing-title-bar">
                            <div class="text-heading text-left">
                                <p><a href="index.html">Home </a> &nbsp;/&nbsp; <span>Phòng trọ</span></p>
                            </div>
                            <h3>Đặt cọc</h3>
                        </div>
                    </div>
                </div>
            </section>
            <section class="headings-2 pt-0 pb-0 shadow mb-5 px-2 bg-body rounded" style=" height:1000px">
                <div class="row p-4">
                    <div id="listingDetailsSlider" class="carousel listing-details-sliders slide mb-30 col-4"
                         style="box-shadow: none">
                        <h5 class="mb-4">Thư viện ảnh</h5>
                        <div class="carousel-inner">
                            @foreach (json_decode($motel->photo_gallery) as $key => $item)
                                @if($key !== 0)
                                    @if ($key == 1)
                                        <div class="active item carousel-item" data-slide-number="{{ $key }}">
                                            <img src="{{ $item }}" class="img-fluid" alt="slider-listing" width="100%">
                                        </div>
                                    @else
                                        <div class="item carousel-item" data-slide-number="{{ $key }}">
                                            <img src="{{ $item }}" class="img-fluid" alt="slider-listing" width="100%">
                                        </div>
                                    @endif
                                @endif
                            @endforeach

                            <a class="carousel-control left" href="#listingDetailsSlider" data-slide="prev"><i
                                    class="fa fa-angle-left"></i></a>
                            <a class="carousel-control right" href="#listingDetailsSlider" data-slide="next"><i
                                    class="fa fa-angle-right"></i></a>

                        </div>
                        <!-- main slider carousel nav controls -->
                        <ul class="carousel-indicators smail-listing list-inline">

                            @foreach (json_decode($motel->photo_gallery) as $key => $item)
                                @if($key !== 0)
                                    <li class="list-inline-item active">
                                        <a id="carousel-selector-{{ $key }}"
                                           data-slide-to="{{ $key }}" data-target="#listingDetailsSlider">
                                            <img src="{{ $item }}" class="img-fluid" alt="listing-small">
                                        </a>
                                    </li>
                                @endif
                            @endforeach


                        </ul>
                        <!-- main slider carousel items -->
                    </div>
                    <div class="col-7 ml-3 mt-2">
                        <h3 class="mb-4">Thông tin phòng trọ: {{$motel->room_number}}</h3>
                        <p>Mã nhà trọ: {{$motel->area_id}} </p>
                        <p>Mã phòng trọ: {{$motel->motel_id}} </p>
                        <p>Tên nhà trọ: {{$motel->areaName}} </p>
                        <p>Danh mục: {{$motel->category_name}} </p>
                        <p>Diện tích: {{$motel->area}} m&#178</p>
                        <p>Giá: {{number_format($motel->price, 0, ',', '.')}} VND</p>
                        <p>Địa chỉ: {{$motel->address}}</p>

                    </div>
                </div>
                <div class="mx-4">
                    <h3 class="mb-4">Lựa chọn hình thức đặt cọc</h3>
                    @if ( Session::has('success') )
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong>{{ Session::get('success') }}</strong>
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Đóng</span>
                            </button>
                        </div>
                    @endif
                    @if ( Session::has('error') )
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong>{{ Session::get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Đóng</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>
                    @endif


                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <ul class="nav nav-tabs mx-2" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="fw-bolder nav-link active " id="pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">Đặt cọc bằng xu
                                    </button>
                                </li>
                                <li class="fw-bolder nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">Đặt cọc bằng tiền mặt
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content mx-2" id="pills-tabContent">
                                {{-- Đặt cọc bằng xu --}}
                                <div class="tab-pane fade show active col-6" id="pills-home" role="tabpanel"
                                     aria-labelledby="pills-home-tab">
                                    <div class="d-flex flex-row justify-content-between mr-4">
                                        <li style="list-style:none ;">
                                            <p class="">Tài khoản gốc: <span id="user_money"
                                                                             class="font-weight-bold">{{ number_format(\Illuminate\Support\Facades\Auth::user()->money, 0, ',', '.') }}</span>
                                                <i class="fa-brands fa-bitcoin text-warning"></i></p>
                                        </li>
                                        <button class="btn btn-primary">Nạp thêm tiền</button>
                                    </div>
                                    <form action="{{ route('client_post_deposit', ['id'=>$motel->motel_id]) }}"
                                          method="POST">@csrf
                                        <div>
                                            <label for="">Số xu cọc giữ phòng</label>
                                            <input type="number" name="value" class="form-control" id="money_deposit"
                                                   value="{{number_format($motel->money_deposit/1000, 0, ',', '.')}}"
                                                   readonly>
                                            <label for="">Số ngày giữ phòng tối đa</label>
                                            <input type="number" class="form-control" id="day_deposit"
                                                   value="{{$motel->day_deposit}}" readonly>
                                            <input type="hidden" name="motel_id" value="{{$motel->motel_id}}">
                                            <input type="hidden" name="area_id" value="{{$motel->area_id}}">
                                            <input type="hidden" name="type" value="1">
                                            <input type="hidden" name="status" value="1">

                                            <p id="message" class="text-danger mt-1"></p>
                                        </div>
                                        <div class="my-4">
                                            <button type="submit" id="button_submit" class="btn btn-success">Xác nhận
                                                đặt cọc
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                {{-- Đặt cọc chuyển khoản --}}
                                <div class="tab-pane fade col-10" id="pills-profile" role="tabpanel"
                                     aria-labelledby="pills-profile-tab">
                                    <div class="mr-4 d-flex flex-row-reverse justify-content-between">
                                        <div class="col-5">
                                            <li class="px-3 pt-3"
                                                style="list-style:none; border: 2px solid #d3d6d8; border-radius: 5px; background-color: #e2e3e5; color:#41464b;">
                                                <p>Họ tên chủ trọ: <span
                                                        class="font-weight-bold"> {{$motel->user_name}} </span></p>
                                                {!!substr($motel->transfer_infor, 0, strpos($motel->transfer_infor,'</p>'))!!}

                                            </li>
                                        </div>
                                        <div>
                                            <form action="{{ route('client_post_deposit', ['id'=>$motel->motel_id]) }}"
                                                  method="POST">@csrf
                                                <p>Số tiền cọc giữ phòng: <span class="font-weight-bold">{{number_format($motel->money_deposit, 0, ',', '.')}} VND</span>
                                                </p>
                                                <p>Số ngày giữ phòng tối đa: <span class="font-weight-bold">{{$motel->day_deposit}} ngày</span>
                                                </p>
                                                <p>{!!str_replace(substr($motel->transfer_infor, 0, strpos($motel->transfer_infor,'</p>')),'',$motel->transfer_infor)!!}</p>
                                                {{-- <div>{!!$motel->transfer_infor!!}</div> --}}
                                                <p class="text-warning fs-6">Sau khi chuyển tiền, hãy click button bên
                                                    dưới để thông báo với chủ trọ</p>

                                                <input type="hidden" name="value" value="{{$motel->money_deposit}}">
                                                <input type="hidden" value="{{$motel->day_deposit}}">
                                                <input type="hidden" name="motel_id" value="{{$motel->motel_id}}">
                                                <input type="hidden" name="area_id" value="{{$motel->area_id}}">
                                                <input type="hidden" name="type" value="2">
                                                <input type="hidden" name="status" value="0">
                                                <button type="submit" class="btn btn-primary">Xác nhận đã chuyển tiền
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </section>
    <script>
        var user_money = document.getElementById('user_money');
        var money_deposit = document.getElementById('money_deposit');
        if (Number(user_money.innerText.replaceAll(".", "")) < Number(money_deposit.value.replaceAll(".", ""))) {
            document.getElementById('button_submit').setAttribute('disabled', 'true');
            document.getElementById('message').innerText = "Tài khoản của bạn không đủ, hãy nạp thêm";
        }
    </script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>

@endsection
