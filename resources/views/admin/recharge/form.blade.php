@extends('layouts.admin.main')



@section('content')
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap");


        body {
            background-color: #f5eee7;
            font-family: "Poppins", sans-serif;
            font-weight: 300;
        }


        .card {

            border: none;
        }

        .card-header {
            padding: .5rem 1rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: none;
        }

        .btn-light:focus {
            color: #212529;
            background-color: #e2e6ea;
            border-color: #dae0e5;
            box-shadow: 0 0 0 0.2rem rgba(216, 217, 219, .5);
        }

        .form-control {

            height: 50px;
            border: 2px solid #eee;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #039be5;
            outline: 0;
            box-shadow: none;

        }

        .input {

            position: relative;
        }

        .input i {

            position: absolute;
            top: 16px;
            left: 11px;
            color: #989898;
        }

        .input input {

            text-indent: 25px;
        }

        .card-text {

            font-size: 13px;
            margin-left: 6px;
        }

        .certificate-text {

            font-size: 12px;
        }


        .billing {
            font-size: 11px;
        }

        .super-price {

            top: 0px;
            font-size: 22px;
        }

        .super-month {

            font-size: 11px;
        }


        .line {
            color: #bfbdbd;
        }

        .free-button {

            background: #1565c0;
            height: 52px;
            font-size: 15px;
            border-radius: 8px;
        }


        .payment-card-body {

            flex: 1 1 auto;
            padding: 24px 1rem !important;

        }
    </style>
    <div class="w-full overflow-hidden rounded-lg shadow-xs my-3">
        @if ( Session::has('recharge_success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('recharge_success') }}</strong>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Đóng</span>
                </button>
            </div>
        @endif
        <?php //Hiển thị thông báo lỗi?>
        @if ( Session::has('recharge_error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{ Session::get('recharge_error') }}</strong>
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
        <form action="{{route('make.payment')}}">


            <div class="row g-3">

                <div class="col-md-6">

                    <span>Phương thức thanh toán</span>
                    <div class="card">

                        <div class="accordion" id="accordionExample">

                            <div class="card">
                                <div class="card-header p-0" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button
                                            class="btn btn-light btn-block text-left collapsed p-3 rounded-0 border-bottom-custom"
                                            type="button" data-toggle="collapse" data-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            <div class="d-flex align-items-center justify-content-between">

                                                <span>Paypal</span>
                                                <img src="https://i.imgur.com/7kQEsHU.png" width="30">

                                            </div>
                                        </button>
                                    </h2>
                                </div>
                                <div>
                                    <div class="card-body">
                                        <input type="text" class="form-control my-4" name="amount"
                                               placeholder="Số tiền nạp">
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>

                <div class="col-md-6">
                    <span>Chi tiết</span>

                    <div class="card">

                        <hr class="mt-0 line">

                        <hr class="mt-0 line">


                        <div class="p-3 d-flex justify-content-between">

                            <div class="d-flex flex-column">

                                <span>Số tiền nạp</span>
                            </div>
                            <span id="total">0 $</span>


                        </div>


                        <div class="p-3">
                            <button class="btn btn-primary btn-block free-button">Nạp tiền</button>
                        </div>


                    </div>
                </div>

            </div>
        </form>

        <script>
            document.getElementsByName('amount')[0].addEventListener('keyup', (e) => {
                if (e.target.value) {
                    document.getElementById('total').innerText = e.target.value + ' $';
                } else {
                    document.getElementById('total').innerText = 0 + ' $';
                }


            })
        </script>
@endsection
