@extends('layouts.admin.main')


@section('title_page','Thêm mới phòng trọ')

@section('content')
    <link href="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.css" rel="stylesheet">

    <script src="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea#desc',
        });
    </script>
    <form action="" method="POST" enctype="multipart/form-data">
        <div style="display: grid !important;grid-template-columns: 10fr 1fr !important;gap: 12px">
            <div class="bg-white p-4 shadow-lg rounded-4">
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
                    <label for="">Dịch vụ phòng</label>
                    <div class="row">
                        <div class="col-4">
                            <input type="number" name="bedroom" placeholder="Số phòng ngủ" class="form-control">
                        </div>
                        <div class="col-4">
                            <input type="number" name="bed" placeholder="Số giường" class="form-control">
                        </div>
                        <div class="col-4">
                            <input type="number" name="toilet" id="toilet" placeholder="Nhà vệ sinh"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label>Khác</label>
                    <input type="text" name="service_more" placeholder="Gần trường học,chợ..." class="form-control">
                </div>
                <div class="mt-4">
                    <label for="">Mô tả</label>
                    <textarea name="desc" id="desc" cols="30" rows="32" class="form-control"></textarea>
                </div>
            </div>
            <div style="display: grid;grid-template-rows: 1fr 0.25fr;gap: 12px">
                <div class="bg-white p-4 shadow-lg rounded-4">
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
                        <input type="hidden" id="img" name="img">
                        <input type="text" class="form-control" name="video" id="video"
                               placeholder="Video link(youtube)">
                    </div>
                    <div class="mt-4">
                        <label for="">Ảnh 360</label>
                        <input type="text" name="image360" id="image360" class="form-control"
                               placeholder="Đoạn code nhúng ảnh 360">
                        <p class="mt-2 ms-2 text-danger">Nếu bạn chưa biết cách sửa dụng ảnh 360.click vào <a
                                href="http://help.web60.vn/bai-viet/huong-dan-nhung-anh-360-do-len-website"
                                target="_blank">đây</a></p>
                    </div>
                </div>
                <div class="bg-white p-4 shadow-lg rounded-4">
                    <label for="photo" class="">Ảnh phòng trọ</label>
                    <div id="drag-drop-area"></div>
                </div>
                @csrf

            </div>
        </div>
        <button class="btn btn-primary mt-4">Thêm mới</button>
        <a href="" class="btn btn-success mt-4">Quay lại</a>
    </form>
    <script>
        var uppy = Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area'
            })
            .use(Uppy.Tus, {endpoint: 'https://master.tus.io/files/'}) //you can put upload URL here, where you want to upload images

        uppy.on('complete', (result) => {
            let data = [];
            result.successful.forEach(item => {
                data.push(item.response.uploadURL);
            })

            document.getElementById('img').value = JSON.stringify(data);
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        })
    </script>
@endsection



