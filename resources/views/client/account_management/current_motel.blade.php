@extends('layouts.user.main')
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
        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Đóng</span>
                </button>
            </div>
        @endif
        <?php //Hiển thị thông báo lỗi?>
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
        <h4>Phòng trọ của tôi</h4>
        <div class="my-properties shadow-lg">
            <table class="table-responsive text-center">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Số phòng</th>
                    <th>Khu trọ</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($motels as $motel)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$motel->room_number}}</td>
                        <td>{{$motel->area_name}}</td>
                        <td>{{\Carbon\Carbon::parse($motel->user_motel_start_time)->format('h:i d/m/Y')}}</td>
                        <td>{{$motel->user_motel_end_time ?  \Carbon\Carbon::parse($motel->user_motel_end_time)->format('h:i d/m/Y') : 'Chưa xác đinh'}}</td>
                        <td>{{ number_format($motel->price,0,",",".") }}</td>
                        <td>
                            @if($motel->tt === 1)
                                <span class="text-success font-weight-bold">Đang ở</span>
                            @elseif($motel->tt === 2)
                                <span class="text-secondary font-weight-bold">Đang chờ duyệt rời trọ</span>
                            @else
                                <span class="text-danger font-weight-bold">Đã rời phòng</span>
                            @endif
                        </td>
                        <td>
                            @if ($motel->tt == 1)
                                <a class="btn btn-success text-white"
                                   href="{{ route('client_post_live_together', ['motel_id'=>$motel->motel_id]) }}">Đăng
                                    tin ở ghép</a>
                                <a class="btn btn-warning text-white"
                                   href="{{ route('client.get_history_contact_motel', ['motel_id'=>$motel->motel_id,'area_id' => $motel->area_id]) }}">Đăng
                                    ký ở ghép</a>
                                <a class="btn btn-danger text-white"
                                   href="{{ route('client_out_motel', ['motelId'=>$motel->motel_id]) }}">Rời phòng</a>
                            @else
                                <a class="btn btn-primary text-white" href="">Thông tin phòng</a>
                                @if($motel->tt === 0 && $motel->is_vote === 0)
                                    <button class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{$motel->motel_id}}">
                                        Gửi đánh giá
                                    </button>
                                    <div class="modal fade" id="exampleModal{{$motel->motel_id}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" style="font-size: 14px"
                                                        id="exampleModalLabel">Gửi đánh giá của bạn về phòng trọ
                                                        này</h1>
                                                    <button type="button"
                                                            style="background: white;border: none;font-size: 24px"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"><i
                                                            class="fa-sharp fa-solid fa-xmark"></i>
                                                    </button>
                                                </div>
                                                <form action="{{route('client_send_vote')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_motel_id" value="{{$motel->id}}">
                                                    <input type="hidden" name="motel_id" value="{{$motel->motel_id}}">
                                                    <div class="modal-body">
                                                        <div class="form-group text-left">
                                                            <label for="">Mức độ hài lòng của bạn về phòng trọ này
                                                                ?</label>
                                                            <div class="clearfix"></div>
                                                            <div class="leave-rating margin-bottom-30">
                                                                <input type="radio" name="rating" id="rating-5"
                                                                       value="5"/>
                                                                <label for="rating-5" class="fa fa-star"></label>
                                                                <input type="radio" name="rating" id="rating-4"
                                                                       value="4"/>
                                                                <label for="rating-4" class="fa fa-star"></label>
                                                                <input type="radio" name="rating" id="rating-3"
                                                                       value="3"/>
                                                                <label for="rating-3" class="fa fa-star"></label>
                                                                <input type="radio" name="rating" id="rating-2"
                                                                       value="2"/>
                                                                <label for="rating-2" class="fa fa-star"></label>
                                                                <input type="radio" name="rating" id="rating-1"
                                                                       value="1"/>
                                                                <label for="rating-1" class="fa fa-star"></label>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="text-left form-group">
                                                            <label for="">Hãy cho chúng tôi biết suy nghĩ của bạn về
                                                                phòng
                                                                trọ của chúng tôi</label>
                                                            <textarea name="message" class="form-control" id=""
                                                                      cols="30"
                                                                      rows="10"
                                                                      placeholder="Nội dung"></textarea>
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <label for="">Trong tương lai bạn sẽ quay lại ở phòng trọ
                                                                của
                                                                chúng tôi không ?</label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                       name="question" id="inlineRadio1"
                                                                       value="1">
                                                                <label class="form-check-label"
                                                                       for="inlineRadio1">Có</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                       name="question" id="inlineRadio2"
                                                                       value="1">
                                                                <label class="form-check-label"
                                                                       for="inlineRadio2">Không</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Gửi đánh giá
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($motel->tt === 2)
                                    <a href="{{ route('client_out_motel', ['motelId'=>$motel->motel_id,'status' => 1]) }}"
                                       class="btn btn-danger">Hủy</a>
                                @endif

                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
                integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
                integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
                crossorigin="anonymous"></script>
@endsection
