@extends('layouts.admin.main')


@section('title_page','Thêm mới khu trọ')

@section('content')

    <style>
        iframe {
            width: 100%;
        }
    </style>

    <form action="" method="POST">
        <div class="bg-white shadow-lg p-4">
            <div class="row">
                @csrf
                <div class="col-8">
                    <div class="my-2">
                        <label for="">Tên khu trọ</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <label for="">Địa chỉ khu trọ</label>
                    <div class="form-group row">
                        <div class="col-4">
                            <select class="form-control" id="select_city"
                                    name="city_id">
                                <option value="0">Lựa chọn thành phố</option>
                            </select>
                        </div>
                        <div class="col-4">

                            <select class="form-control" id="district_id" name="district_id"
                            >
                                <option value="0">Lựa chọn huyện</option>
                            </select>
                        </div>
                        <div class="col-4">

                            <select class="form-control" name="ward_id" id="ward_id"
                            >
                                <option value="0">Lựa chọn phường, xã</option>
                            </select>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="">Địa chỉ chính xác</label>
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                    <div class="my-2 row">
                        <div class="col-6">
                            <label for="">Latitude</label>
                            <input type="text" class="form-control" name="latitude" id="latitude">
                        </div>
                        <div class="col-6">
                            <label for="">Longitude</label>
                            <input type="text" class="form-control" name="longitude" id="longitude">
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="">Link google map</label>
                        <input type="text" class="form-control" name="link_gg_map" id="link_gg_map">
                    </div>
                    <div class="my-2">
                        <label for="">Ảnh mô tả</label>
                        <div>
                            <img id="preview2"
                                 src="https://xaydungthuanphuoc.com/wp-content/uploads/2022/09/mau-phong-tro-co-gac-lung-dep2020-5.jpg"
                                 style="width: 100px;height: 100px" class="img-thumbnail my-1" alt="">
                        </div>
                        <input type="hidden" id="imgReal" name="imgReal">
                        <input type="file" name="img" class="form-control">
                    </div>
                </div>
                <div class="col-4" id="preview">

                </div>
            </div>
        </div>
        {{--        <div class="col-4" id="preview">--}}
        {{--            <iframe--}}
        {{--                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8638558814587!2d105.74459841533215!3d21.038132792833157!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b991d80fd5%3A0x53cefc99d6b0bf6f!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1665843530176!5m2!1svi!2s"--}}
        {{--                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"--}}
        {{--                referrerpolicy="no-referrer-when-downgrade"></iframe>--}}
        {{--        </div>--}}
        <button class="btn btn-primary my-4">Thêm mới</button>
        <a class="btn btn-success my-4" href="{{route('backend_get_list_area')}}">Quay lại</a>
    </form>
    @section('custom_js')
        <script !src="">
            const divCity = document.getElementById('select_city');
            const divDistrict = document.getElementById('district_id');
            const divWard = document.getElementById('ward_id');
            $(function () {
                // $('select').selectpicker();

                // document.getElementById('link_gg_map').addEventListener('change', (e) => {
                //     document.getElementById('preview').innerHTML = e.target.value;
                // })
                document.getElementsByName('img')[0].addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    var reader = new FileReader();
                    reader.onloadend = function () {
                        document.getElementById('preview2').src = reader.result;
                        document.getElementById('imgReal').value = reader.result;
                    }
                    reader.readAsDataURL(file);
                })


                $.ajax({
                    url: "https://provinces.open-api.vn/api/p",
                    type: 'GET',
                    success: function (result) {
                        divCity.innerHTML +=
                            `${
                                result.map(item => `<option value="${item.code}">${item.name}</option>`).join('')
                            }`;
                    }
                });
                divCity.addEventListener('change', (e) => {
                    const id = e.target.value;
                    if (+id !== 0) {
                        $.ajax({
                            url: `https://provinces.open-api.vn/api/p/${id}/?depth=2`,
                            type: 'GET',
                            success: function (result) {
                                divDistrict.innerHTML = '<option value="0">Lựa chọn huyện</option>' + result.districts.map(districtitem => `<option value="${districtitem.code}">${districtitem.name}</option>`).join('');

                            }
                        });
                    } else {
                        divDistrict.innerHTML = '<option value="0">Bạn chưa chọn thành phố</option>';
                    }

                })
                divDistrict.addEventListener('change', (e) => {
                    const id = e.target.value;
                    if (+id !== 0) {
                        $.ajax({
                            url: `https://provinces.open-api.vn/api/d/${id}?depth=2`,
                            type: 'GET',
                            success: function (result) {
                                divWard.innerHTML = '<option value="0">Lựa chọn phường xã</option>' + result.wards.map(wardItem => `<option value="${wardItem.code}">${wardItem.name}</option>`).join('');
                            }
                        });
                    } else {
                        divWard.innerHTML = '<option value="0">Bạn chưa chọn quận huyện</option>';
                    }
                })
            });

        </script>
    @endsection

@endsection
