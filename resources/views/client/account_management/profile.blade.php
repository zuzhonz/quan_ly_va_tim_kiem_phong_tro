@extends('layouts.user.main')
@section('content')
    @include('custom.profile')
    <div class="main-body">
        <h4>Thông tin tài khoản</h4>

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">

                            <div id="avatar">
                                <img
                                    src="{{\Illuminate\Support\Facades\Auth::user()->avatar ?? 'https://mondaycareer.com/wp-content/uploads/2020/11/anime-l%C3%A0-g%C3%AC-v%C3%A0-kh%C3%A1i-ni%E1%BB%87m.jpg'}}"
                                    alt="Admin"
                                    class="rounded-circle avatar_admin" width="150">
                                <input class="input_file" title="Chọn ảnh để thay đổi" id="upload_img" type="file">
                                <div class="spinner icon-spinner-2" aria-hidden="true" style="display: none"
                                     id="loading"></div>
                            </div>

                            <div class="mt-3">
                                <h4>{{\Illuminate\Support\Facades\Auth::user()->name}}</h4>
                                <p class="text-secondary mb-1">Thành viên</p>
                                <p class="text-muted font-size-sm">{{\Illuminate\Support\Facades\Auth::user()->address}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                </svg>
                                Website
                            </h6>
                            <span class="text-secondary">https://bootdey.com</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-github mr-2 icon-inline">
                                    <path
                                        d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                                </svg>
                                Github
                            </h6>
                            <span class="text-secondary">bootdey</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="feather feather-twitter mr-2 icon-inline text-info">
                                    <path
                                        d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                </svg>
                                Twitter
                            </h6>
                            <span class="text-secondary">@bootdey</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="feather feather-instagram mr-2 icon-inline text-danger">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                                Instagram
                            </h6>
                            <span class="text-secondary">bootdey</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="feather feather-facebook mr-2 icon-inline text-primary">
                                    <path
                                        d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                                Facebook
                            </h6>
                            <span class="text-secondary">bootdey</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Họ tên</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <span class="name">{{$user->name}}  <i class="fa-solid fa-pen" id="btnEdit"
                                                                           style="cursor: pointer;margin-left: 8px;margin-bottom: 4px;font-size: 12px"></i></span>

                                    <input type="text" name="name" id="name" class="form-control name"
                                           style="display: none"
                                           value="{{$user->name}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <span class="email">{{$user->email}}</span>
                                    <input type="text" name="email" id="email" disabled class="form-control email"
                                           style="display: none"
                                           value="{{$user->email}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Số điện thoại</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <span class="phone_number">{{$user->phone_number?? '??????????'}}</span>
                                    <input type="text" name="phone_number" id="phone_number"
                                           class="form-control phone_number"
                                           style="display: none"
                                           value="{{$user->phone_number?? '??????????'}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Địa chỉ</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <span class="address">{{$user->address?? '??????????'}}</span>
                                    <input type="text" name="address" id="address" class="form-control address"
                                           style="display: none"
                                           value="{{$user->address?? '??????????'}}">
                                </div>
                            </div>
                            <div class="row mt-5 ml-2" id="submit" style="display: none">
                                <button class="btn btn-success mr-1">Lưu thay đổi</button>
                                <button class="btn btn-warning" type="button" id="cancel">Hùy</button>
                            </div>
                            <hr>
                        </form>
                        <div class="my-4">
                            @if(isset($currentMotel[0]))
                                <h6 class="font-weight-bold">Thành viên phòng ({{$currentMotel[0]->room_number}} -
                                    {{$currentMotel[0]->area_name}})</h6>
                            @endif

                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Họ Tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày bắt đầu ở</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($currentMotel as $user)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$user->userName}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone_number?? '0325500080'}}</td>
                                        <td>{{strlen($user->userAdd) > 20 ? substr($user->userAdd,0,20).'...' : $user->userAdd}}</td>
                                        <td>{{\Carbon\Carbon::parse($user->tg)->format('h:i d/m/Y')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('upload_img').addEventListener('change', (e) => {
            const file = e.target.files[0];
            var reader = new FileReader();
            document.querySelector('.avatar_admin').style.filter = "grayscale(100%)";
            document.querySelector('#loading').style.display = 'block';
            reader.onloadend = function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('upload_img') }}",
                    data: {
                        img: reader.result,
                        user_id: {{\Illuminate\Support\Facades\Auth::id()}}
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function (result) {
                        document.querySelectorAll('.avatar_admin').forEach(item => {
                            item.src = JSON.parse(JSON.stringify(result));
                        })
                        Swal.fire(
                            'Cập nhật ảnh đại diện thành công!',
                            '',
                            'success'
                        )
                        document.querySelector('.avatar_admin').style.filter = "grayscale(0%)";
                        document.querySelector('#loading').style.display = 'none';
                    }
                });
            }
            reader.readAsDataURL(file);
        })

        function active(className) {
            className.forEach(element => {
                if (element !== 'email') {
                    document.querySelectorAll(`.${element}`).forEach((item, index) => {
                        if (index % 2 == 0) {
                            item.style.display = 'none'
                        } else {
                            item.style.display = 'block'
                            item.removeAttribute('disabled');
                        }

                    })
                } else {
                    document.querySelectorAll(`.${element}`).forEach((item, index) => {
                        if (index % 2 == 0) {
                            item.style.display = 'none'
                        } else {
                            item.style.display = 'block'
                        }
                    })
                }
            })
        }

        function inActive(className) {
            className.forEach(element => {
                if (element !== 'email') {
                    document.querySelectorAll(`.${element}`).forEach((item, index) => {
                        if (index % 2 == 0) {
                            item.style.display = 'block'
                        } else {
                            item.style.display = 'none'
                            item.setAttribute('disabled', 'true');
                        }

                    })
                } else {
                    document.querySelectorAll(`.${element}`).forEach((item, index) => {
                        if (index % 2 === 0) {
                            item.style.display = 'block'
                        } else {
                            item.style.display = 'none'
                        }
                    })
                }
            })
        }

        document.getElementById('btnEdit').addEventListener('click', (e) => {
            active(['name', 'phone_number', 'address', 'email']);
            document.getElementById('submit').style.display = 'block';
            document.getElementById('cancel').addEventListener('click', () => {
                inActive(['name', 'phone_number', 'address', 'email']);
                document.getElementById('submit').style.display = 'none';
            })

        })

    </script>

    @if(\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Thay đổi thông tin thành công',
                timer: 1500
            })
        </script>
    @endif
@endsection
