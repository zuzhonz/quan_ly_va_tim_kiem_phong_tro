@extends('layouts.admin.main')

@section('title_page', 'Thêm mới gói dịch vụ')

@section('content')
    <script>
        tinymce.init({
            selector: 'textarea#desc',
        });
    </script>

    <form id="plans_form" action="" method="POST">
        <div class="container-fluid p-0">
            @csrf
            <div class="row shadow p-3 mb-5 bg-white rounded ">
                <div class="col-12 col-lg-6">
                    <div class="">
                        {{-- input name plans  --}}
                        <div class="header m-2 p-2">
                            <h5 class="card-title mb-0">
                                Tên gói dịch vụ
                                @error('name')
                                <a class="  text-danger small ms-2">
                                    <i data-feather="alert-circle" class="mb-1"></i>
                                    {{ $message }} </a>
                                @enderror
                            </h5>

                        </div>
                        <div class="body m-2 p-2">
                            <input type="text" name="name" id="name" class="form-control"
                                   placeholder="nhập tên của gói dịch vụ" value="{{ old('name') }}">
                        </div>
                        {{-- input name plans  --}}
                        {{-- ////// --}}
                        {{-- input priority lever plans  --}}
                        <div class="header m-2 p-2">
                            <h5 class="card-title mb-0">
                                Mức độ ưu tiên
                                @error('priority_level')
                                <a class="  text-danger small ms-2">
                                    <i data-feather="alert-circle" class="mb-1"></i>
                                    {{ $message }} </a>
                                @enderror
                            </h5>
                        </div>
                        <div class="body m-2 p-2">
                            <select name="priority_level" id="priority_level" class="form-select mb-1">
                                <option value="0">Chọn mức ưu tiên cho gói dịch vụ</option>
                                <option value="1" @if (old('priority_level') == '1')
                                    {{ 'selected' }}
                                    @endif>
                                    level 1
                                </option>
                                <option value="2" @if (old('priority_level') == '2')
                                    {{ 'selected' }}
                                    @endif>
                                    level 2
                                </option>
                                <option value="3" @if (old('priority_level') == '3')
                                    {{ 'selected' }}
                                    @endif>
                                    level 3
                                </option>
                                <option value="4" @if (old('priority_level') == '3')
                                    {{ 'selected' }}
                                    @endif>
                                    level 4
                                </option>
                                <option value="5" @if (old('priority_level') == '3')
                                    {{ 'selected' }}
                                    @endif>
                                    level 5
                                </option>
                                <option value="6" @if (old('priority_level') == '3')
                                    {{ 'selected' }}
                                    @endif>
                                    level 6
                                </option>
                            </select>
                        </div>
                        {{-- input priority lever plans  --}}
                        {{-- ////// --}}
                        {{-- input type plans  --}}
                        <div class="header m-2 p-2">
                            <h5 class="card-title mb-0">
                                Loại của gói dịch vụ
                                @error('type')
                                <a class=" text-danger small ms-2">
                                    <i data-feather="alert-circle" class="mb-1"></i>
                                    {{ $message }} </a>
                                @enderror

                            </h5>
                        </div>

                        <div class="body m-2 p-2">
                            <select name="type" id="type" class="form-select mb-1">
                                <option value="0">Chọn loại dùng cho gói</option>
                                <option value="1" @if (old('type') == '1')
                                    {{ 'selected' }}
                                    @endif>
                                    Tìm người thuê trọ
                                </option>
                                <option value="2" @if (old('type') == '2')
                                    {{ 'selected' }}
                                    @endif>
                                    Tìm người ở ghép
                                </option>
                            </select>
                        </div>
                        {{-- input type plans  --}}
                        {{-- ////// --}}
                        {{-- input price plans  --}}
                        <div class="header m-2 p-2">
                            <h5 class="card-title mb-0">
                                Giá của gói dịch vụ
                                @error('price')
                                <a class="text-danger small ms-2">
                                    <i data-feather="alert-circle" class="mb-1"></i>
                                    {{ $message }} </a>
                                @enderror
                            </h5>
                        </div>
                        <div class="body m-2 p-2">
                            <input name="price" type="text" id="price" class="form-control"
                                   placeholder="Nhập giá của gói dịch vụ" value="{{ old('price') }}">
                        </div>
                        {{-- input price plans  --}}


                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="">
                        {{-- input time plans  --}}
                        <div class="header m-2 p-2">
                            <h5 class="card-title mb-0">
                                Thời gian
                                @error('time')
                                <a class="text-danger small ms-2">
                                    <i data-feather="alert-circle" class="mb-1"></i>
                                    {{ $message }} </a>
                                @enderror
                            </h5>
                        </div>
                        <div class="body m-2 p-2">
                            <input type="text" name="time" class="form-control" id="time"
                                   value="{{ old('time') }}" placeholder="Nhập thời hạn của gói dịch vụ">
                        </div>
                        {{-- input time plans  --}}
                        {{-- input description plans  --}}
                        <div class="header m-2 p-2">
                            <h5 class="card-title mb-0">
                                Mô tả của gói dịch vụ
                                @error('desc')
                                <a class="text-danger small ms-2">
                                    <i data-feather="alert-circle" class="mb-1"></i>
                                    {{ $message }}
                                </a>
                                @enderror
                            </h5>
                        </div>
                        <div class="body m-2 p-2">
                            <textarea id="desc" name="desc" class="form-control" rows="2"
                                      placeholder="Mô tả của gói dịch vụ"></textarea>
                        </div>
                        {{-- input description plans  --}}
                    </div>

                </div>
            </div>
        </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="{{route('backend_admin_get_list_plans')}}" class="btn btn-success">Quay lại</a>
    </form>
    @include('layouts.admin._js')
    {{-- validate jquery form plans --}}
    <script>
        $("#plans_form").validate({
            rules: {
                "name": {
                    required: true,
                    minlength: 6
                },
                "desc": {
                    required: true,
                    min: 20
                },
                "priority_level": {
                    required: true,
                    min: 1
                },
                "type": {
                    required: true,
                    min: 1
                },

                'time': {
                    required: true,
                    maxlength: 10,
                    digits: true,
                },

                'price': {
                    digits: true,
                    required: true,
                    maxlength: 8,
                }
            },
            messages: {

                "name": {
                    required: 'Bắt buộc nhập tên gói',
                    minlength: 'Tối thiểu 6 ký tự',
                },
                "priority_level": {
                    required: 'Bạn chưa chon mức ưu tiên',
                    min: 'Bạn chưa chọn mức độ ưu tiên'
                },
                "desc": {
                    required: 'Bắt buộc nhập mô tả của gói',
                    min: 'nhập tối thiểu 20 ký tự'
                },

                "type": {
                    required: 'Bắt buộc chon loại gói',
                    min: "Bạn chưa chọn mức độ ưu tiên"
                },

                'time': {
                    required: 'Bạn chưa nhập thời hạn',
                    maxlength: 'Nhập quá giới hạn tối đa',
                    digits: "Chỉ nhập số không nhập các ký tự khác"
                },

                'price': {
                    required: "Bạn chưa nhập giá sản phẩm",
                    digits: "Chỉ nhập số không nhập các ký tự khác",
                    maxlength: 'Nhập quá giới hạn tối đa',
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    </script>

    {{-- sweet alert --}}

    @if (Session::has('save_plans'))
        <script>
            function modal() {
                Swal.fire(
                    'Success fully',
                    'Thêm gói dịch vụ thành công.',
                    'success'
                )
            }

            modal();
        </script>
    @elseif(Session::has('not_plans'))
        <script>
            function modal() {
                Swal.fire(
                    'Error',
                    'Thêm gói dịch vụ không thành công.',
                    'error'
                )
            }

            modal();
        </script>
    @endif

@endsection
