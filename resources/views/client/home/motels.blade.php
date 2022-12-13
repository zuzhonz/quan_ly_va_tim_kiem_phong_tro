@extends('layouts.client.main')

@section('content')

    <!-- STAR HEADER SEARCH -->
    <section id="hero-area" class="parallax-searchs home15 overlay thome-6 thome-1"
             data-stellar-background-ratio="0.5">
        <div class="hero-main">
            <div class="container" data-aos="zoom-in">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-inner">
                            <!-- Welcome Text -->
                            <div class="welcome-text">
                                <h1 class="h1">Tìm giấc mơ của bạn
                                    <br class="d-md-none">
                                    <span class="typed border-bottom"></span>
                                </h1>
                                <p class="mt-4">Chúng tôi có hơn 1 triệu lựa chọn cho bạn</p>
                            </div>
                            <!--/ End Welcome Text -->
                            <!-- Search Form -->
                            <div>
                                <div class="col-12">
                                    <div class="banner-search-wrap">
                                        <ul class="nav nav-tabs rld-banner-tab">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#tabs_1">Tìm kiếm
                                                    phòng
                                                    trọ bạn muốn</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">

                                            <div class="tab-pane fade show active" id="tabs_1">
                                                <div class="rld-main-search">
                                                    {{-- <form id="formSearch"> --}}
                                                    <div class="row">

                                                        <div class="rld-single-select ml-22" id="city_id">
                                                            <select class="select single-select">
                                                                <option value="0">Lựa chọn thành phố</option>
                                                            </select>
                                                            <input type="hidden" name="city_id" id="city_id_value">
                                                        </div>
                                                        <div class="rld-single-select ml-22" id="district_id">
                                                            <select class="select single-select">
                                                                <option value="0">Lựa chọn quận huyện</option>
                                                            </select>
                                                            <input type="hidden" name="district_id"
                                                                   id="district_id_value">
                                                        </div>
                                                        <div class="rld-single-select" id="ward_id">
                                                            <select class="select single-select mr-0">
                                                                <option value="0">Lựa chọn phường/xã</option>
                                                            </select>
                                                            <input type="hidden" name="ward_id" id="ward_id_value">
                                                        </div>
                                                        <div class="dropdown-filter d-none d-none d-lg-none d-xl-block">
                                                            <span>Tìm kiếm nâng cao</span>
                                                        </div>
                                                        <div class="pl-0">
                                                            <button type="button" id="btnSearch"
                                                                    class="btn btn-yellow search" style="width:165px;">
                                                                Tìm
                                                                kiếm
                                                                ngay
                                                            </button>
                                                        </div>
                                                        <div
                                                            class="explore__form-checkbox-list full-filter d-none d-none d-lg-none d-xl-flex  shadow p-3 mb-5 bg-body rounded">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 p-2">
                                                                    <!-- Form Bedrooms -->
                                                                    <!-- Form Bedrooms -->
                                                                    <div class="form-group beds">
                                                                        <input type="hidden" name="bedroom">
                                                                        <div class="nice-select form-control wide"
                                                                             tabindex="0">
                                                                            <span class="current"><i class="fa fa-bed"
                                                                                                     aria-hidden="true"></i>Phòng
                                                                                ngủ</span>
                                                                            <ul class="list" id="bedroom">
                                                                                @for ($i = 1; $i < 5; $i++)
                                                                                    <li data-value="{{ $i }}"
                                                                                        class="option">
                                                                                        {{ $i }}</li>
                                                                                @endfor
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <!--/ End Form Bedrooms -->
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 p-2">
                                                                    <!-- Form Bathrooms -->
                                                                    <div class="form-group bath">
                                                                        <div class="nice-select form-control wide"
                                                                             tabindex="0">
                                                                            <input type="hidden" name="toilet">
                                                                            <span class="current"><i class="fa fa-bath"
                                                                                                     aria-hidden="true"></i>Phòng
                                                                                tắm/WC</span>
                                                                            <ul class="list" id="toilet">
                                                                                @for ($i = 1; $i < 5; $i++)
                                                                                    <li data-value="{{ $i }}"
                                                                                        class="option">
                                                                                        {{ $i }}</li>
                                                                                @endfor
                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                    <!--/ End Form Bathrooms -->
                                                                </div>
                                                                <div
                                                                    class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld">
                                                                    <!-- Price Fields -->
                                                                    <div class="main-search-field-2">
                                                                        <!-- Area Range -->
                                                                        <div class="range-slider">
                                                                            <label>Diện tích</label>
                                                                            <div id="area-range" data-min="0"
                                                                                 data-max="{{$template_search->max_area}}"
                                                                                 data-unit="m&#178"
                                                                                 class="area_range">
                                                                                <a class="ui-slider-handle ui-state-default ui-corner-all"
                                                                                   href="#" style="left: 0%;"
                                                                                   id="area_min"></a>
                                                                                <a class="ui-slider-handle ui-state-default ui-corner-all"
                                                                                   href="#" style="left: 0%;"
                                                                                   id="area_max"></a>
                                                                            </div>
                                                                            <input type="hidden" name="area_min"
                                                                                   id="area_min">
                                                                            <input type="hidden" name="area_max"
                                                                                   id="area_max">
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                        <br>
                                                                        <!-- Price Range -->
                                                                        <div class="range-slider">
                                                                            <label>Phạm vi giá</label>
                                                                            <div id="price-range" data-min="0"
                                                                                 data-max="{{$template_search->max_price}}"
                                                                                 data-unit="VND ">
                                                                                <a class="ui-slider-handle ui-state-default ui-corner-all"
                                                                                   href="#" style="left: 0%;"
                                                                                   id="price_min"></a>
                                                                                <a class="ui-slider-handle ui-state-default ui-corner-all"
                                                                                   href="#" style="left: 0%;"
                                                                                   id="price_max"></a>
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                                                            <input type="hidden" name="price_min"
                                                                                   id="price_min">
                                                                            <input type="hidden" name="price_max"
                                                                                   id="price_max">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">
                                                                    <!-- Checkboxes -->
                                                                    <div
                                                                        class="checkboxes one-in-row margin-bottom-10 ch-1">
                                                                        <input id="check2-1" type="checkbox"
                                                                               value="1" name="locations[]"
                                                                               class="location">
                                                                        <label for="check2-1">Gần trường
                                                                            học</label>
                                                                        <input id="check2-2" value="2"
                                                                               type="checkbox" name="locations[]">
                                                                        <label for="check2-2">Bệnh viện</label>
                                                                        <input id="check2-3" value="3"
                                                                               type="checkbox" name="locations[]"
                                                                               class="location">
                                                                        <label for="check2-3">Gần siêu thị</label>
                                                                        <input id="check2-4" type="checkbox"
                                                                               name="locations[]" value="4"
                                                                               class="location">
                                                                        <label for="check2-4">Gần bến xe</label>
                                                                    </div>
                                                                    <!-- Checkboxes / End -->
                                                                    <input type="number" style="width: 400px" required
                                                                           placeholder="Lựa chọn phạm vị muốn tìm kiếm"
                                                                           name="dis" class="form-control"
                                                                           max="10" id="dis">
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">
                                                                    <!-- Checkboxes -->
                                                                    <div
                                                                        class="checkboxes one-in-row margin-bottom-10 ch-2">
                                                                        <input id="check2-5" type="checkbox"
                                                                               name="services[]" value="nong_lanh">
                                                                        <label for="check2-5">Nóng lạnh</label>
                                                                        <input id="check2-7" type="checkbox"
                                                                               name="services[]" value="tu_lanh">
                                                                        <label for="check2-7">Tủ lạnh</label>
                                                                        <input id="check2-8" type="checkbox"
                                                                               name="services[]" value="giuong_ngu">
                                                                        <label for="check2-8">Điều hòa</label>
                                                                        <input id="check2-9" type="checkbox"
                                                                               name="services[]" value="tu_quan_ao">
                                                                        <label for="check2-9">Tủ quần áo</label>
                                                                    </div>
                                                                    <!-- Checkboxes / End -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    {{-- </form> --}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <!--/ End Search Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END HEADER SEARCH -->
    <!-- <div class="listing-title-bar" style="padding-left: 10px;">
        <div class="rtext-heading text-left">
            <p><a href="index.html">Trang chủ</a> &nbsp;/&nbsp; <span>Phòng trọ</span></p>
        </div>
        <h3>Phòng trọ</h3>
    </div> -->
    <!-- START SECTION FEATURED PROPERTIES -->
    <section class="featured portfolio bg-white-2 rec-pro full-l" style="padding-top: 10px;">
        <div class="container-fluid">
            <div class="listing-title-bar" style="padding-left: 10px;">
                <div class="rtext-heading text-left">
                    <p><a href="index.html">Trang chủ</a> &nbsp;/&nbsp; <span>Phòng trọ</span></p>
                </div>
            </div>
            <div id="tin_dang">
                <div class="row portfolio-items">
                    @foreach($motels as $key)
                        <div class="item col-xl-6 col-lg-12 col-md-12 col-xs-12 landscapes sale">
                            <div class="project-single" data-aos="fade-right">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="{{route('client.motel.detail',['id' => $key->motel_id])}}"
                                           class="homes-img">
                                            <img
                                                src="{{json_decode($key->photo_gallery_i)[0]}}"
                                                alt="home-1"
                                                class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="{{route('client.motel.detail',['id' => $key->motel_id])}}" class="btn"><i
                                                class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY"
                                           class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="{{route('client.motel.detail',['id' => $key->motel_id])}}"
                                           class="img-poppu btn"><i
                                                class="fa fa-photo"></i></a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h4 class=" mb-3">
                                        <a href="{{route('client.motel.detail',['id' => $key->motel_id])}}">
                                            <span
                                                style="color: {{$key->title_color}};font-weight: bold">{{$key->areaName .'- '.$key->room_number}}</span>
                                        </a>
                                    </h4>
                                    <p class="homes-address mb-3">
                                        <a href="{{route('client.motel.detail',['id' => $key->motel_id])}}">
                                            <i class="fa fa-map-marker"></i><span>{{$key->address}}</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix pb-3">
                                        @if(isset($key->locationNearMotel))
                                            @foreach($key->locationNearMotel as $location)
                                                @if($location->type === 1)
                                                    <p>Cách trường học gần nhất {{round($location->minDistance,2)}}
                                                        km</p>
                                                @endif
                                                @if($location->type === 2)
                                                    <p>Cách bệnh viện gần nhất {{round($location->minDistance,2)}}
                                                        km</p>
                                                @endif
                                                @if($location->type === 3)
                                                    <p>Cách siêu thị gần nhất {{round($location->minDistance,2)}} km</p>
                                                @endif
                                                @if($location->type === 4)
                                                    <p>Cách bến xe gần nhất {{round($location->minDistance,2)}} km</p>
                                                @endif
                                            @endforeach
                                        @else
                                            <li class="the-icons">
                                                <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                <span>{{json_decode($key->services)->bedroom}} Phòng ngủ</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                <span>{{json_decode($key->services)->toilet}} Phòng tắm</span>
                                            </li>

                                        @endif


                                    </ul>
                                    <div class="price-properties footer pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="{{route('client.motel.detail',['id' => $key->motel_id])}}">{{number_format($key->price, 0, ',', '.')}}
                                                VNĐ</a>
                                        </h3>
                                        <div class="text-warning" style="font-size: 12px!important;">
                                            @if($key->vote > 0)
                                                @for ($i = 1; $i <= round($key->vote,0); $i++)
                                                    <i class="fa-solid fa-star"></i>
                                                @endfor
                                            @else
                                                <span>Chưa có lượt đánh giá nào</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- End div motel --}}
                    <div class="bg-all">
                        <nav aria-label="..." class="agents pt-55">
                            {!! $motels->links() !!}
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </section>

    @include('custom.js.searchIndex')
    <script>
        $(document).ready(function () {
            $("#btnSearch").on('click', function (e) {
                e.preventDefault();

                let city_id = document.getElementById('district_id_value').value ? +JSON.parse(document.getElementsByName('city_id')[0].value).id : null;
                let district_id = document.getElementById('district_id_value').value ? +JSON.parse(document.getElementById('district_id_value').value).id : null;
                let ward_id = document.getElementById('ward_id_value').value ? +JSON.parse(document.getElementById('ward_id_value').value).id : null;
                let bedroom = +document.getElementsByName('bedroom')[0].value;
                let toilet = +document.getElementsByName('toilet')[0].value;
                let area_min = +document.getElementsByName('area_min')[0].value;
                let area_max = +document.getElementsByName('area_max')[0].value;
                let price_min = +document.getElementsByName('price_min')[0].value;
                let price_max = +document.getElementsByName('price_max')[0].value;
                let location = [];
                document.getElementsByName('locations[]').forEach(item => {
                    if (item.checked) {
                        location.push(+item.value);
                    }
                })
                let services = [];
                document.getElementsByName('services[]').forEach(item => {
                    if (item.checked) {
                        services.push(item.value);
                    }
                })
                let dis = document.getElementsByName('dis')[0].value;

                $.ajax({
                    type: 'GET',
                    url: "{{ route('search_motels') }}",
                    data: {
                        'city_id': city_id,
                        'district_id': district_id,
                        'ward_id': ward_id,
                        'bedroom': bedroom,
                        'toilet': toilet,
                        'area_min': area_min,
                        'area_max': area_max,
                        'price_min': price_min,
                        'price_max': price_max,
                        'location': location,
                        'services': services,
                        'dis': dis,
                        'city': document.getElementsByName('city_id')[0].value ? JSON.parse(document.getElementsByName('city_id')[0].value).label : null,
                        'district': document.getElementById('district_id_value').value ? JSON.parse(document.getElementById('district_id_value').value).label : null,
                        'ward': document.getElementById('ward_id_value').value ? JSON.parse(document.getElementById('ward_id_value').value).label : null
                    },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data.motel);
                        document.getElementById("tin_dang").innerHTML = data.motel;
                        document.getElementById("tin_dang").style.visibility = 'visible';
                        document.getElementById("tin_dang").style.display = 'block';
                        document.getElementById("tin_dang").tabIndex = "-1";
                        document.getElementById("tin_dang").focus();
                        const pagination = document.querySelector('#phan_trang');
                        const li = pagination.querySelectorAll('li');
                        if (pagination) {
                            li.forEach(item => {
                                const a = item.querySelector('a');
                                if (a) {
                                    a.setAttribute('data-href', a.href);
                                    a.href = '#';

                                    a.addEventListener('click', () => {
                                        $.ajax({
                                            type: 'GET',
                                            url: a.dataset.href,
                                            data: {
                                                'city_id': city_id,
                                                'district_id': district_id,
                                                'ward_id': ward_id,
                                                'bedroom': bedroom,
                                                'toilet': toilet,
                                                'area_min': area_min,
                                                'area_max': area_max,
                                                'price_min': price_min,
                                                'price_max': price_max,
                                                'location': location,
                                                'services': services,
                                                'dis': dis,
                                                'city': document.getElementsByName('city_id')[0].value ? JSON.parse(document.getElementsByName('city_id')[0].value).label : null,
                                                'district': document.getElementById('district_id_value').value ? JSON.parse(document.getElementById('district_id_value').value).label : null,
                                                'ward': document.getElementById('ward_id_value').value ? JSON.parse(document.getElementById('ward_id_value').value).label : null
                                            },
                                            dataType: 'json',
                                            success: function (data) {
                                                document.getElementById("tin_dang").innerHTML = data.motel;

                                                const pagination = document.querySelector('#phan_trang');
                                                const li = pagination.querySelectorAll('li');
                                                document.getElementById("tin_dang").style.visibility = 'visible';
                                                document.getElementById("tin_dang").style.display = 'block';
                                                document.getElementById("tin_dang").tabIndex = "-1";
                                                document.getElementById("tin_dang").focus();
                                                if (pagination) {
                                                    li.forEach(item => {
                                                        const a = item.querySelector('a');
                                                        if (a) {
                                                            a.setAttribute('data-href', a.href);
                                                            a.href = '#';

                                                            a.addEventListener('click', () => {
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: a.dataset.href,
                                                                    data: {
                                                                        'city_id': city_id,
                                                                        'district_id': district_id,
                                                                        'ward_id': ward_id,
                                                                        'bedroom': bedroom,
                                                                        'toilet': toilet,
                                                                        'area_min': area_min,
                                                                        'area_max': area_max,
                                                                        'price_min': price_min,
                                                                        'price_max': price_max,
                                                                        'location': location,
                                                                        'services': services,
                                                                        'dis': dis,
                                                                        'city': document.getElementsByName('city_id')[0].value ? JSON.parse(document.getElementsByName('city_id')[0].value).label : null,
                                                                        'district': document.getElementById('district_id_value').value ? JSON.parse(document.getElementById('district_id_value').value).label : null,
                                                                        'ward': document.getElementById('ward_id_value').value ? JSON.parse(document.getElementById('ward_id_value').value).label : null
                                                                    },
                                                                    dataType: 'json',
                                                                    success: function (data) {
                                                                        document.getElementById("tin_dang").innerHTML = data.motel;
                                                                        const pagination = document.querySelector('#phan_trang');
                                                                        const li = pagination.querySelectorAll('li');
                                                                        document.getElementById("tin_dang").style.visibility = 'visible';
                                                                        document.getElementById("tin_dang").style.display = 'block';
                                                                        document.getElementById("tin_dang").tabIndex = "-1";
                                                                        document.getElementById("tin_dang").focus();
                                                                        if (pagination) {
                                                                            li.forEach(item => {
                                                                                const a = item.querySelector('a');
                                                                                if (a) {
                                                                                    a.setAttribute('data-href', a.href);
                                                                                    a.href = '#';

                                                                                    a.addEventListener('click', () => {
                                                                                        $.ajax({
                                                                                            type: 'GET',
                                                                                            url: a.dataset.href,
                                                                                            data: {
                                                                                                'city_id': city_id,
                                                                                                'district_id': district_id,
                                                                                                'ward_id': ward_id,
                                                                                                'bedroom': bedroom,
                                                                                                'toilet': toilet,
                                                                                                'area_min': area_min,
                                                                                                'area_max': area_max,
                                                                                                'price_min': price_min,
                                                                                                'price_max': price_max,
                                                                                                'location': location,
                                                                                                'services': services,
                                                                                                'dis': dis,
                                                                                                'city': document.getElementsByName('city_id')[0].value ? JSON.parse(document.getElementsByName('city_id')[0].value).label : null,
                                                                                                'district': document.getElementById('district_id_value').value ? JSON.parse(document.getElementById('district_id_value').value).label : null,
                                                                                                'ward': document.getElementById('ward_id_value').value ? JSON.parse(document.getElementById('ward_id_value').value).label : null
                                                                                            },
                                                                                            dataType: 'json',
                                                                                            success: function (data) {
                                                                                                document.getElementById("tin_dang").innerHTML = data.motel;
                                                                                                const pagination = document.querySelector('#phan_trang');
                                                                                                const li = pagination.querySelectorAll('li');
                                                                                                document.getElementById("tin_dang").style.visibility = 'visible';
                                                                                                document.getElementById("tin_dang").style.display = 'block';
                                                                                                document.getElementById("tin_dang").tabIndex = "-1";
                                                                                                document.getElementById("tin_dang").focus();
                                                                                                if (pagination) {
                                                                                                    li.forEach(item => {
                                                                                                        const a = item.querySelector('a');
                                                                                                        if (a) {
                                                                                                            a.setAttribute('data-href', a.href);
                                                                                                            a.href = '#';

                                                                                                            a.addEventListener('click', () => {
                                                                                                                $.ajax({
                                                                                                                    type: 'GET',
                                                                                                                    url: a.dataset.href,
                                                                                                                    data: {
                                                                                                                        'city_id': city_id,
                                                                                                                        'district_id': district_id,
                                                                                                                        'ward_id': ward_id,
                                                                                                                        'bedroom': bedroom,
                                                                                                                        'toilet': toilet,
                                                                                                                        'area_min': area_min,
                                                                                                                        'area_max': area_max,
                                                                                                                        'price_min': price_min,
                                                                                                                        'price_max': price_max,
                                                                                                                        'location': location,
                                                                                                                        'services': services,
                                                                                                                        'dis': dis,
                                                                                                                        'city': document.getElementsByName('city_id')[0].value ? JSON.parse(document.getElementsByName('city_id')[0].value).label : null,
                                                                                                                        'district': document.getElementById('district_id_value').value ? JSON.parse(document.getElementById('district_id_value').value).label : null,
                                                                                                                        'ward': document.getElementById('ward_id_value').value ? JSON.parse(document.getElementById('ward_id_value').value).label : null
                                                                                                                    },
                                                                                                                    dataType: 'json',
                                                                                                                    success: function (data) {
                                                                                                                        document.getElementById("tin_dang").innerHTML = data.motel;
                                                                                                                        document.getElementById("tin_dang").style.visibility = 'visible';
                                                                                                                        document.getElementById("tin_dang").style.display = 'block';
                                                                                                                        document.getElementById("tin_dang").tabIndex = "-1";
                                                                                                                        document.getElementById("tin_dang").focus();
                                                                                                                        const pagination = document.querySelector('#phan_trang');
                                                                                                                        const li = pagination.querySelectorAll('li');
                                                                                                                        if (pagination) {
                                                                                                                            li.forEach(item => {
                                                                                                                                const a = item.querySelector('a');
                                                                                                                                if (a) {
                                                                                                                                    a.setAttribute('data-href', a.href);
                                                                                                                                    a.href = '#';

                                                                                                                                    a.addEventListener('click', () => {
                                                                                                                                        $.ajax({
                                                                                                                                            type: 'GET',
                                                                                                                                            url: a.dataset.href,
                                                                                                                                            data: {
                                                                                                                                                'city_id': city_id,
                                                                                                                                                'district_id': district_id,
                                                                                                                                                'ward_id': ward_id,
                                                                                                                                                'bedroom': bedroom,
                                                                                                                                                'toilet': toilet,
                                                                                                                                                'area_min': area_min,
                                                                                                                                                'area_max': area_max,
                                                                                                                                                'price_min': price_min,
                                                                                                                                                'price_max': price_max,
                                                                                                                                                'location': location,
                                                                                                                                                'services': services,
                                                                                                                                                'dis': dis,
                                                                                                                                                'city': document.getElementsByName('city_id')[0].value ? JSON.parse(document.getElementsByName('city_id')[0].value).label : null,
                                                                                                                                                'district': document.getElementById('district_id_value').value ? JSON.parse(document.getElementById('district_id_value').value).label : null,
                                                                                                                                                'ward': document.getElementById('ward_id_value').value ? JSON.parse(document.getElementById('ward_id_value').value).label : null
                                                                                                                                            },
                                                                                                                                            dataType: 'json',
                                                                                                                                            success: function (data) {
                                                                                                                                                document.getElementById("tin_dang").innerHTML = data.motel;
                                                                                                                                                const pagination = document.querySelector('#phan_trang');
                                                                                                                                                const li = pagination.querySelectorAll('li');
                                                                                                                                                document.getElementById("tin_dang").style.visibility = 'visible';
                                                                                                                                                document.getElementById("tin_dang").style.display = 'block';
                                                                                                                                                document.getElementById("tin_dang").tabIndex = "-1";
                                                                                                                                                document.getElementById("tin_dang").focus();
                                                                                                                                                if (pagination) {
                                                                                                                                                    li.forEach(item => {
                                                                                                                                                        const a = item.querySelector('a');
                                                                                                                                                        if (a) {
                                                                                                                                                            a.setAttribute('data-href', a.href);
                                                                                                                                                            a.href = '#';

                                                                                                                                                            a.addEventListener('click', () => {
                                                                                                                                                                $.ajax({
                                                                                                                                                                    type: 'GET',
                                                                                                                                                                    url: a.dataset.href,
                                                                                                                                                                    data: {
                                                                                                                                                                        'city_id': city_id,
                                                                                                                                                                        'district_id': district_id,
                                                                                                                                                                        'ward_id': ward_id,
                                                                                                                                                                        'bedroom': bedroom,
                                                                                                                                                                        'toilet': toilet,
                                                                                                                                                                        'area_min': area_min,
                                                                                                                                                                        'area_max': area_max,
                                                                                                                                                                        'price_min': price_min,
                                                                                                                                                                        'price_max': price_max,
                                                                                                                                                                        'location': location,
                                                                                                                                                                        'services': services,
                                                                                                                                                                        'dis': dis,
                                                                                                                                                                        'city': document.getElementsByName('city_id')[0].value ? JSON.parse(document.getElementsByName('city_id')[0].value).label : null,
                                                                                                                                                                        'district': document.getElementById('district_id_value').value ? JSON.parse(document.getElementById('district_id_value').value).label : null,
                                                                                                                                                                        'ward': document.getElementById('ward_id_value').value ? JSON.parse(document.getElementById('ward_id_value').value).label : null
                                                                                                                                                                    },
                                                                                                                                                                    dataType: 'json',
                                                                                                                                                                    success: function (data) {
                                                                                                                                                                        document.getElementById("tin_dang").innerHTML = data.motel;
                                                                                                                                                                        const pagination = document.querySelector('#phan_trang');
                                                                                                                                                                        const li = pagination.querySelectorAll('li');
                                                                                                                                                                        document.getElementById("tin_dang").style.visibility = 'visible';
                                                                                                                                                                        document.getElementById("tin_dang").style.display = 'block';
                                                                                                                                                                        document.getElementById("tin_dang").tabIndex = "-1";
                                                                                                                                                                        document.getElementById("tin_dang").focus();
                                                                                                                                                                        if (pagination) {
                                                                                                                                                                            li.forEach(item => {
                                                                                                                                                                                const a = item.querySelector('a');
                                                                                                                                                                                if (a) {
                                                                                                                                                                                    a.setAttribute('data-href', a.href);
                                                                                                                                                                                    a.href = '#';

                                                                                                                                                                                    a.addEventListener('click', () => {
                                                                                                                                                                                        $.ajax({
                                                                                                                                                                                            type: 'GET',
                                                                                                                                                                                            url: a.dataset.href,
                                                                                                                                                                                            data: {
                                                                                                                                                                                                'city_id': city_id,
                                                                                                                                                                                                'district_id': district_id,
                                                                                                                                                                                                'ward_id': ward_id,
                                                                                                                                                                                                'bedroom': bedroom,
                                                                                                                                                                                                'toilet': toilet,
                                                                                                                                                                                                'area_min': area_min,
                                                                                                                                                                                                'area_max': area_max,
                                                                                                                                                                                                'price_min': price_min,
                                                                                                                                                                                                'price_max': price_max,
                                                                                                                                                                                                'location': location,
                                                                                                                                                                                                'services': services,
                                                                                                                                                                                                'dis': dis,
                                                                                                                                                                                                'city': document.getElementsByName('city_id')[0].value ? JSON.parse(document.getElementsByName('city_id')[0].value).label : null,
                                                                                                                                                                                                'district': document.getElementById('district_id_value').value ? JSON.parse(document.getElementById('district_id_value').value).label : null,
                                                                                                                                                                                                'ward': document.getElementById('ward_id_value').value ? JSON.parse(document.getElementById('ward_id_value').value).label : null
                                                                                                                                                                                            },
                                                                                                                                                                                            dataType: 'json',
                                                                                                                                                                                            success: function (data) {
                                                                                                                                                                                                document.getElementById("tin_dang").innerHTML = data.motel;
                                                                                                                                                                                            }
                                                                                                                                                                                        })
                                                                                                                                                                                        $.ajaxSetup({
                                                                                                                                                                                            headers: {
                                                                                                                                                                                                'csrftoken': '{{ csrf_token() }}'
                                                                                                                                                                                            }
                                                                                                                                                                                        });
                                                                                                                                                                                    })

                                                                                                                                                                                }
                                                                                                                                                                            })
                                                                                                                                                                        }
                                                                                                                                                                    }
                                                                                                                                                                })
                                                                                                                                                                $.ajaxSetup({
                                                                                                                                                                    headers: {
                                                                                                                                                                        'csrftoken': '{{ csrf_token() }}'
                                                                                                                                                                    }
                                                                                                                                                                });
                                                                                                                                                            })

                                                                                                                                                        }
                                                                                                                                                    })
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        })
                                                                                                                                        $.ajaxSetup({
                                                                                                                                            headers: {
                                                                                                                                                'csrftoken': '{{ csrf_token() }}'
                                                                                                                                            }
                                                                                                                                        });
                                                                                                                                    })

                                                                                                                                }
                                                                                                                            })
                                                                                                                        }
                                                                                                                    }
                                                                                                                })
                                                                                                                $.ajaxSetup({
                                                                                                                    headers: {
                                                                                                                        'csrftoken': '{{ csrf_token() }}'
                                                                                                                    }
                                                                                                                });
                                                                                                            })

                                                                                                        }
                                                                                                    })
                                                                                                }
                                                                                            }
                                                                                        })
                                                                                        $.ajaxSetup({
                                                                                            headers: {
                                                                                                'csrftoken': '{{ csrf_token() }}'
                                                                                            }
                                                                                        });
                                                                                    })

                                                                                }
                                                                            })
                                                                        }
                                                                    }
                                                                })
                                                                $.ajaxSetup({
                                                                    headers: {
                                                                        'csrftoken': '{{ csrf_token() }}'
                                                                    }
                                                                });
                                                            })

                                                        }
                                                    })
                                                }
                                            }
                                        })
                                        $.ajaxSetup({
                                            headers: {
                                                'csrftoken': '{{ csrf_token() }}'
                                            }
                                        });
                                    })

                                }
                            })
                        }
                    }
                })
                $.ajaxSetup({
                    headers: {
                        'csrftoken': '{{ csrf_token() }}'
                    }
                });
            })
        })
    </script>
@endsection

