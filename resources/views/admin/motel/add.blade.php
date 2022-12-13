@extends('layouts.admin.main')


@section('title_page','Thêm mới phòng trọ')

@section('content')
    <script>
        tinymce.init({
            selector: 'textarea#desc',
            height: 330
        });
        tinymce.init({
            selector: 'textarea#transfer_infor',
            height: 380
        });
    </script>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-6 bg-white p-4 shadow-sm rounded-4">
                <div class="mt-4">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Mã phòng</label>
                            <input type="text" name="room_number" id="room_number" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">Giá cho thuê</label>
                            <input type="text" name="price" id="price" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Diện tích</label>
                            <input type="text" name="area" id="area" class="form-control">
                        </div>
                        <div class="col-4">
                            <label for="">Đối tượng thuê</label>
                            <select name="actor" id="actor" class="form-control">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Tất cả">Tất cả</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="">Số người ở tối đa</label>
                            <input type="text" name="max_people" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Tiền điện (số)</label>
                            <input type="text" name="electric_money" id="electric_money" class="form-control">
                        </div>
                        <div class="col-4">
                            <label for="">Tiền nước</label>
                            <input type="text" name="warter_money" id="warter_money" class="form-control">
                        </div>
                        <div class="col-4">
                            <label for="">Tiền mạng</label>
                            <input type="text" name="wifi" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="">Dịch vụ phòng</label>
                    <div class="row">
                        <div class="col-6">
                            <input type="number" name="service[bedroom]" placeholder="Số phòng ngủ" class="form-control">
                        </div>
                        <div class="col-6">
                            <input type="number" name="service[toilet]" id="toilet" placeholder="Nhà vệ sinh"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="d-flex flex-row">
                        <div class="ml-2 mr-5">
                            <div class="form-check mb-3">
                                <input class="form-check-input" style="padding: 9px" type="checkbox" name="service[cho_de_xe]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Chỗ để xe
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" style="padding: 9px" type="checkbox" name="service[dieu_hoa]" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Điều hoà
                                </label>
                            </div>
                        </div>
                        <div class="mx-5">
                            <div class="form-check mb-3">
                                <input class="form-check-input" style="padding: 9px" type="checkbox" name="service[thang_may]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Thang máy
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" style="padding: 9px" type="checkbox" name="service[may_giat]" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Máy giặt
                                </label>
                            </div>
                        </div>
                        <div class="mx-5">
                            <div class="form-check mb-3">
                                <input class="form-check-input" style="padding: 9px" type="checkbox" name="service[nong_lanh]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Nóng lạnh
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" style="padding: 9px" type="checkbox" name="service[tu_lanh]" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Tủ lạnh
                                </label>
                            </div>
                        </div>
                        <div class="mx-5">
                            <div class="form-check mb-3">
                                <input class="form-check-input" style="padding: 9px" type="checkbox" name="service[giuong_ngu]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Giường ngủ
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" style="padding: 9px" type="checkbox" name="service[tu_quan_ao]" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Tủ quần áo
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label>Khác</label>
                    <input type="text" name="service_more" placeholder="Gần trường học,chợ..." class="form-control">
                </div>
                <div class="mt-4">
                    <label for="">Loại phòng</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <label for="">Mô tả</label>
                    <textarea name="description" id="desc" cols="30" rows="20" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="bg-white p-4 shadow-sm rounded-4">
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-7">
                                <label>Thông tin liên hệ</label>
                                <input type="text" placeholder="Ngô Văn Phong" class="form-control" disabled>
                            </div>
                            <div class="col-5">
                                <label>Số điện thoại</label>
                                <input type="text" placeholder="0325500080" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="" class="">Video</label>
                        <input type="text" class="form-control" name="video" id="video"
                               placeholder="Video link(youtube)">
                    </div>
                    <div class="mt-4">
                        <label for="">Ảnh 360</label>
                        <input type="text" name="image_360" id="image_360" class="form-control"
                               placeholder="Đoạn code nhúng ảnh 360">
                        <p class="mt-2 ms-2 text-danger">Nếu bạn chưa biết cách sửa dụng ảnh 360.click vào <a
                                href="http://help.web60.vn/bai-viet/huong-dan-nhung-anh-360-do-len-website"
                                target="_blank">đây</a></p>
                    </div>
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-7">
                                <label>Số tiền đặt cọc giữ phòng</label>
                                <input type="number" name="money_deposit" class="form-control">
                            </div>
                            <div class="col-5">
                                <label>Số ngày giữ phòng tối đa</label>
                                <input type="number" name="day_deposit" class="form-control">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="">Thông tin chuyển khoản</label>
                            <textarea name="transfer_infor" id="transfer_infor" cols="30" rows="20" class="form-control">
                                <p>Số tài khoản: <span style="font-weight: bold;">00000000 - Techcombank</span></p>
                                <p>Cú pháp chuyển khoản: <span style="font-weight: bold;">email_mã nhà trọ_mã phòng trọ_datcoc</span></p>
                            </textarea>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="photo" class="">Ảnh phòng trọ</label>
                        <input type="hidden" name="img">
                        <input type="file" multiple class="form-control" name="photo_gallery" id="photo_gallery">
                        <div class="preview mt-2" style="display: grid;grid-template-columns: repeat(4,1fr);gap: 8px;">

                        </div>
                    </div>
                </div>
                @csrf
            </div>
        </div>
        <button class="btn btn-primary mt-4">Thêm mới</button>
        <a href="{{route('admin.motel.list',['id' => $area_id])}}"
           class="btn btn-success mt-4">Quay lại</a>
    </form>
    <script>
        let arr = [];
        document.getElementById('photo_gallery').addEventListener('change', (e) => {
            const file = e.target.files[0];
            var reader = new FileReader();
            reader.onloadend = function () {
                arr.push(reader.result);
                document.getElementsByName('img')[0].value = JSON.stringify(arr);
                render(arr);
            }
            reader.readAsDataURL(file);
        });

        function render(data) {
            document.querySelector('.preview').innerHTML = '';
            data.forEach((item, index) => {
                document.querySelector('.preview').innerHTML += `<div style="position: relative;">
<img  src="${item}" class="img-thumbnail"/>
<i  data-index="${index}" class="fa-solid fa-circle-xmark delete" style="position: absolute;top: 0;right: 2px;color: white;cursor: pointer;"></i> </div>`;
            })


            document.querySelectorAll('.delete').forEach(item => {
                const {index} = item.dataset;

                item.addEventListener('click', () => {
                    const confirm = window.confirm('Bạn có chắc muốn xóa ảnh này');
                    if (confirm) {
                        data = data.filter((item, index1) => index1 !== +index);
                        arr = data;
                        document.getElementsByName('img')[0].value = JSON.stringify(data);
                        render(data);
                    }
                })
            })

        }
    </script>
      <!-- CSS only -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
      <!-- JavaScript Bundle with Popper -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
@endsection

