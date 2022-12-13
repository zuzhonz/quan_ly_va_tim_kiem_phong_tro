@extends('layouts.admin.main')

@section('title_page', 'Thành viên phòng - ' . $info->motel->room_number . ' ' . $info->motel->name)
@section('content')
    <style>
        .select-box {
            position: relative;
            display: flex;
            width: 400px;
            flex-direction: column;
        }

        .select-box .options-container {
            background: #2f3640;
            color: #f5f6fa;
            max-height: 0;
            width: 100%;
            opacity: 0;
            transition: all 0.4s;
            border-radius: 8px;
            overflow: hidden;

            order: 1;
        }

        .selected {
            background: #2f3640;
            border-radius: 8px;
            margin-bottom: 8px;
            color: #f5f6fa;
            position: relative;

            order: 0;
        }

        .selected::after {
            content: "";
            background: url("img/arrow-down.svg");
            background-size: contain;
            background-repeat: no-repeat;

            position: absolute;
            height: 100%;
            width: 32px;
            right: 10px;
            top: 5px;

            transition: all 0.4s;
        }

        .select-box .options-container.active {
            max-height: 240px;
            opacity: 1;
            overflow-y: scroll;
            margin-top: 54px;
        }

        .select-box .options-container.active + .selected::after {
            transform: rotateX(180deg);
            top: -6px;
        }

        .select-box .options-container::-webkit-scrollbar {
            width: 8px;
            background: #0d141f;
            border-radius: 0 8px 8px 0;
        }

        .select-box .options-container::-webkit-scrollbar-thumb {
            background: #525861;
            border-radius: 0 8px 8px 0;
        }

        .select-box .option,
        .selected {
            padding: 12px 24px;
            cursor: pointer;
        }

        .select-box .option:hover {
            background: #414b57;
        }

        .select-box label {
            cursor: pointer;
        }

        .select-box .option .radio {
            display: none;
        }

        /* Searchbox */

        .search-box input {
            width: 100%;
            padding: 12px 16px;
            font-family: "Roboto", sans-serif;
            font-size: 16px;
            position: absolute;
            border-radius: 8px 8px 0 0;
            z-index: 100;
            border: 8px solid #2f3640;

            opacity: 0;
            pointer-events: none;
            transition: all 0.4s;
        }

        .search-box input:focus {
            outline: none;
        }

        .select-box .options-container.active ~ .search-box input {
            opacity: 1;
            pointer-events: auto;
        }
    </style>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Đóng</span>
            </button>
        </div>
    @endif
    <?php //Hiển thị thông báo lỗi
    ?>
    @if (Session::has('error'))
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
    <div class="bg-white p-4 shadow-lg rounded-4">
        <div class="mb-4">
            @if($info->motel->status === 6)
                <a href="{{route('admin.delete_user_motel',['motel_id' => $params['motel_id'],'id' => 'null'])}}"
                   class="btn btn-success" onclick="return confirm('Bạn có chắc muốn xóa thành viên phòng này ?')">Xóa
                    thành viên phòng</a>
            @else
                <button class="btn btn-success my-2" data-toggle="modal" data-target="#exampleModal">Thêm thành viên
                </button>
            @endif

            <a href="{{ route('admin.motel.post', ['id' => $params['area_id'], 'idMotel' => $params['motel_id']]) }}"
               class="btn btn-primary my-2">Đăng tin</a>

            <a href="{{ route('admin.motel.contact', ['id' => $params['area_id'], 'idMotel' => $params['motel_id']]) }}"
               class="btn btn-info my-2">Danh sách người đăng ký ở ghép</a>
            <a href="{{ route('admin.motel.history', ['id' => $params['area_id'], 'idMotel' => $params['motel_id']]) }}"
               class="btn btn-secondary my-2">Lịch sử thuê phòng</a>
            @if ($info->motel->status === 2)
                <button data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-dark my-2">Xuất hợp đồng
                </button>
            @endif
            @if ($info->motel->status === 6 || $info->motel->status === 4)
                <button data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-dark my-2">Gia hạn hợp
                    đồng
                </button>
            @endif
            <a href="{{ route('admin.motel.list_out_motel', ['id' => $params['area_id'], 'idMotel' => $params['motel_id']]) }}"
               class="btn btn-danger position-relative">Yều cầu rời phòng
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            99+
            <span class="visually-hidden">unread messages</span>
        </span>
            </a>
        </div>
        <input type="hidden" value="{{ $data }}" id="data">
        <table class="table text-center">
            <div>
                @if ($info->motel->status === 4)
                    <span class="text-danger font-weight-bold"><i class="fa-solid fa-triangle-exclamation"></i> Phòng trọ
                sắp hết thời hạn đồng.Thời gian còn lại
                {{ \Carbon\Carbon::now()->diffInDays($info[0]->motel_end) !== 0 ? \Carbon\Carbon::now()->diffInDays($info[0]->motel_end) . ' ngày' : \Carbon\Carbon::now()->diffInHours($info[0]->motel_end) . ' giờ' }}</span>
                @elseif($info->motel->status === 6)
                    <span class="text-danger font-weight-bold"> <i class="fa-solid fa-triangle-exclamation"></i> <m>Phòng trọ hết thời hạn hợp đồng</m></span>

                @else
                    @if (count($info) >= $info->motel->max_people)
                        <span class="text-danger font-weight-bold"><i class="fa-solid fa-triangle-exclamation"></i> Số lượng
                    thành viên đã đạt tối đa</span>
                    @elseif(count($info) === $info->motel->max_people - 1)
                        <span class="text-danger font-weight-bold"><i class="fa-solid fa-triangle-exclamation"></i> Số lượng
                    thành viên đã sắp tối đa</span>
                    @endif
                @endif
            </div>
            <div class="text-right my-2">
                <p class="font-weight-bold">Số thành viên: <span
                        class="{{ count($info) > $info->motel->max_people - 1 ? 'text-danger' : '' }}">{{ count($info) }}/{{ $info->motel->max_people }}</span>
                </p>
            </div>
            <thead>
            <tr>
                <th>#</th>
                <th>Họ tên</th>
                <th>Số điện thoại</th>
                {{-- <th>Số thành viên</th> --}}
                <th>Ngày bắt đầu thuê</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($info as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a->name }}</td>
                    <td>{{ $a->phone_number }}</td>
                    {{-- <td>{{ $a->max_people }}</td> --}}
                    <td>{{ $a->start_time }}</td>
                </tr>
            @endforeach
            </tbody>


        </table>

    </div>
    <a href="{{ route('admin.motel.list', ['id' => $params['area_id']]) }}" class="btn btn-warning mt-2 text-white">Quay
        lại</a>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới thành viên</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="">Họ tên</label>
                        <input type="text" class="form-control" disabled id="name">
                    </div>
                    <div>
                        <label for="">Email</label>
                        <input type="text" class="form-control" disabled id="email">
                    </div>
                    <div>
                        <label for="">Số điện thoại</label>
                        <input type="text" class="form-control" disabled id="phone_number">
                    </div>


                    <div class="select-box my-4">
                        <div class="options-container">

                            @foreach ($user as $i)
                                <div class="option">
                                    <input type="radio" class="radio" value="{{ $i->id }}"/>
                                    <label for="tutorials">{{ $i->email }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="selected">
                            Lựa chọn thành viên muốn thêm
                        </div>

                        <div class="search-box">
                            <input type="text" placeholder="Tìm kiếm..."/>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <form
                        action="{{ route('admin.motel.add_people', ['id' => $params['area_id'], 'idMotel' => $params['motel_id']]) }}"
                        method="">
                        @csrf
                        <button class="btn btn-primary" name="user_id" id="user_id">Lưu</button>
                    </form>
                </div>

            </div>
        </div>

    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{ route('admin.print.motel', ['motelId' => $params['motel_id']]) }}" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            {{ $info->motel->status === 4 ? 'Gia hạn hợp đồng' : 'Xuất hợp đồng' }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div>
                            <label>Giá điện</label>
                            <input type="number" name="electric_money" value="{{ $info->motel->electric_money ?? '' }}"
                                   class="form-control" placeholder="Bao tiền 1 số điện">
                        </div>
                        <div>
                            <label>Giá nước</label>
                            <input type="number" name="warter_money" value="{{ $info->motel->warter_money ?? '' }}"
                                   class="form-control" placeholder="Bao tiền 1 khối nước">
                        </div>
                        <div>
                            <label>Giá mạng internet</label>
                            <input type="number" name="wifi" value="{{ $info->motel->wifi ?? '' }}"
                                   class="form-control" placeholder="Số tiền mạng đóng 1 tháng">
                        </div>
                        <div>
                            <label>Số tiền đã cọc</label>
                            <input type="number" name="money_deposit" class="form-control"
                                   value="{{ $info->money_deposit->value ?? 0 }}" disabled>

                            @if ($info->money_deposit)
                                @if ($info->money_deposit->type == 1)
                                    <p class="">
                                        Loại đặt cọc: <span class="font-weight-bold">Chuyển xu</span>
                                    <p class="text-sm">Lưu ý: 1<i class="fa-brands fa-bitcoin text-warning"></i> =
                                        24.555
                                        VNĐ</p>
                                    </p>
                                @else
                                    <p class="">
                                        Loại đặt cọc: <span class="font-weight-bold">Tiền mặt</span>
                                    </p>
                                @endif
                            @endif

                        </div>
                        @if (isset($info[0]->motel_status) && $info[0]->motel_status === 4)
                            <input type="hidden" name="type" value="1">
                        @else
                            <input type="hidden" name="type" value="2">
                        @endif
                        <div>
                            <label>Thời gian bắt đầu thuê</label>
                            <input type="date" name="start_time"
                                   value="{{ $info->motel->start_time ?? \Illuminate\Support\Carbon::now() }}"
                                   class="form-control">
                        </div>
                        <div class="my-4">
                            <label>Thời gian kết thúc hợp đồng</label>

                            <input type="date" name="end_time"
                                   value="{{ $info->motel->end_time ?? \Illuminate\Support\Carbon::now()->addDays(1) }}"
                                   class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Xuất hóa đơn</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        const data = JSON.parse(document.getElementById('data').value);
        const selected = document.querySelector(".selected");
        const optionsContainer = document.querySelector(".options-container");
        const searchBox = document.querySelector(".search-box input");

        const optionsList = document.querySelectorAll(".option");

        selected.addEventListener("click", (e) => {
            optionsContainer.classList.toggle("active");

            searchBox.value = "";
            filterList("");

            if (optionsContainer.classList.contains("active")) {
                searchBox.focus();
            }
        });

        optionsList.forEach(o => {
            o.addEventListener("click", (e) => {
                const id = o.querySelector('input').value;

                const obj = data.find(item => item.id === +id);
                document.getElementById('user_id').value = id;
                document.getElementById('email').value = obj.email;
                document.getElementById('name').value = obj.name;
                document.getElementById('phone_number').value = obj.phone_number;
                selected.innerHTML = o.querySelector("label").innerHTML;
                optionsContainer.classList.remove("active");
            });
        });

        searchBox.addEventListener("keyup", function () {
            filterList(e.target.value);
        });

        const filterList = searchTerm => {
            searchTerm = searchTerm.toLowerCase();
            optionsList.forEach(option => {
                let label = option.firstElementChild.nextElementSibling.innerText.toLowerCase();
                if (label.indexOf(searchTerm) != -1) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            });
        };

        function handleChange(id) {
            console.log(id);
        }
    </script>
@endsection
