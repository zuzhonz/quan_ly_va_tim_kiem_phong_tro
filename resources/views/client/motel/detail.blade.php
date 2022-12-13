@extends('layouts.client.main')

@section('content')
    <section class="single-proper blog details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="row pr-4">
                        <div class="col-md-12 ">
                            <section class="headings-2 pt-0">
                                <div class="pro-wrapper mt-5">
                                    <div class="detail-wrapper-body mr-3">
                                        <div class="listing-title-bar">
                                            <h2>Phòng {{ $motel->room_number }} - {{$motel->areaName}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- main slider carousel items -->


                        </div>
                    </div>
                    <div id="listingDetailsSlider" class="carousel listing-details-sliders slide mb-30">
                        <h5 class="mb-4">Thư viện ảnh</h5>
                        <div class="carousel-inner">
                            @foreach (json_decode($motel->photo_gallery) as $key => $item)
                                @if($key !== 0)
                                    @if ($key == 1)
                                        <div class="active item carousel-item" data-slide-number="{{ $key }}">
                                            <img src="{{ $item }}" class="img-fluid" style="width: 100%"
                                                 alt="slider-listing">
                                        </div>
                                    @else
                                        <div class="item carousel-item" data-slide-number="{{ $key }}">
                                            <img src="{{ $item }}" class="img-fluid" style="width: 100%"
                                                 alt="slider-listing">
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
                    {{--                    <div class="my-4 blog-info homes-content details">--}}
                    {{--                        <h5 class="mb-4">Ảnh 360</h5>--}}
                    {{--                        {!! $motel->image_360 ?? '<a data-flickr-embed="true" data-vr="true" href="https://www.flickr.com/photos/uofl/46702390722/in/album-72157677766389858/" title="DSCN0019"><img src="https://live.staticflickr.com/7916/46702390722_521f589445_c.jpg" width="800" height="400" alt="DSCN0019"></a><script async src="//embedr.flickr.com/assets/client-code.js" charset="utf-8"></script>'!!}--}}
                    {{--                    </div>--}}


                    <div class="floor-plan property wprt-image-video w50 pro">
                        <h5>Cái gì ở gần</h5>
                        <div class="property-nearby">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="nearby-info mb-4">
                                        <span class="nearby-title mb-3 d-block text-info">
                                            <i class="fas fa-graduation-cap mr-2"></i><b class="title">Giáo
                                                dục</b>
                                        </span>
                                        <div class="nearby-list">
                                            <ul class="property-list list-unstyled mb-0 locationMotel"
                                                style="max-height: 177px;overflow: hidden">
                                                @foreach($locationNearMotel as $location)

                                                    @if($location->type == 1)

                                                        <li class="d-flex">
                                                            <h6 class="mb-3 mr-2">{{$location->name}}</h6>
                                                            <span>{{round($location->distance,2)}} km</span>
                                                        </li>
                                                    @endif
                                                @endforeach

                                            </ul>
                                            <a style="cursor: pointer" class="moreUlSchool">Xem thêm</a>
                                            <a style="cursor: pointer;display: none" class="cancelUlSchool">Thu gọn</a>
                                        </div>
                                    </div>
                                    <div class="nearby-info mb-4">
                                        <span class="nearby-title mb-3 d-block text-success">
                                            <i class="fas fa-user-md mr-2"></i><b class="title">Sức khỏe va y
                                                tế</b>
                                        </span>
                                        <div class="nearby-list">
                                            <ul class="property-li  st list-unstyled mb-0 locationMotel"
                                                style="max-height: 177px;overflow: hidden">
                                                @foreach($locationNearMotel as $location)

                                                    @if($location->type == 2)

                                                        <li class="d-flex">
                                                            <h6 class="mb-3 mr-2">{{$location->name}}</h6>
                                                            <span>{{round($location->distance,2)}} km</span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="nearby-info">
                                        <span class="nearby-title mb-3 d-block text-danger">
                                            <i class="fas fa-car mr-2"></i><b class="title">Di chuyển</b>
                                        </span>
                                        <div class="nearby-list">
                                            <ul class="property-li  st list-unstyled mb-0 locationMotel"
                                                style="max-height: 177px;overflow: hidden">
                                                @foreach($locationNearMotel as $location)

                                                    @if($location->type == 4)

                                                        <li class="d-flex">
                                                            <h6 class="mb-3 mr-2">{{$location->name}}</h6>
                                                            <span>{{round($location->distance,2)}} km</span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="nearby-info mt-4">
                                        <span class="nearby-title mb-3 d-block text-danger">
                                          <i class="fa-solid fa-shop mr-2"></i><b class="title">Mua sắm</b>
                                        </span>
                                        <div class="nearby-list">
                                            <ul class="property-li  st list-unstyled mb-0 locationMotel"
                                                style="max-height: 177px;overflow: hidden">
                                                @foreach($locationNearMotel as $location)

                                                    @if($location->type == 3)

                                                        <li class="d-flex">
                                                            <h6 class="mb-3 mr-2">{{$location->name}}</h6>
                                                            <span>{{round($location->distance,2)}} km</span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="single homes-content details mb-30 ">
                        <!-- title -->
                        <h5 class="mb-4">Chi tiết phòng trọ</h5>
                        <ul class="homes-list clearfix">
                            <!-- <li>
                                <span class="font-weight-bold mr-1">Property ID:</span>
                                <span class="det">V254680</span>
                            </li> -->
                            <li>
                                <span class="font-weight-bold mr-1">Loại phòng:</span>
                                <span class="det">{{ $motel->category_name }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Trạng thái phòng:</span>
                                <span class="det">Tìm người thuê</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Giá phòng(tháng):</span>
                                <span class="det">{{ $motel->price }} vnđ </span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Số phòng:</span>
                                <span class="det">6</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Số phòng ngủ:</span>
                                <span class="det">7</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Số giường:</span>
                                <span class="det">4</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Số người tối đa:</span>
                                <span class="det">{{ $motel->max_people }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Ngày đăng:</span>
                                <span
                                    class="det">{{ \Carbon\Carbon::parse($motel->motel_updateAt)->format('h:i d/m/Y') }}</span>
                            </li>
                        </ul>
                        <!-- title -->
                        <h5 class="mt-5">Tiện nghi</h5>
                        <!-- cars List -->
                        <ul class="homes-list clearfix">
                            <li>
                                <i class="fa-solid fa-shop"></i>
                                <span>Gần chợ</span>
                            </li>
                            <li>
                                <i class="fa-sharp fa-solid fa-shield-halved"></i>
                                <span>An ninh tốt</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-face-smile"></i>
                                <span>Hàng xóm tốt bụng</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-school"></i>
                                <span>Gần các trường đại học</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-hospital"></i>
                                <span>Gần bệnh viện</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-bus"></i>
                                <span>Gần bên xe buýt</span>
                            </li>
                        </ul>
                    </div>
                    <div class="blog-info homes-content details mb-30">
                        <h5 class="mb-4">Thông tin mô tả</h5>
                        <p>Khu trọ: {{$motel->areaName}}</p>
                        <p>Địa chỉ: {{$motel->area_address}}</p>
                        <p class="mb-3">{!! $motel->description !!}</p>

                    </div>


                    <div class="property wprt-image-video w50 pro">
                        <h5>Video Phòng trọ</h5>
                        <style>
                            .youtube iframe {
                                width: 100%;
                                height: 400px;
                            }
                        </style>
                        <div class="youtube">
                            {!! $motel->video ?? '  <iframe width="560" height="315" src="https://www.youtube.com/embed/Hp7L6D5uOa0"
                                      title="YouTube video player" frameborder="0"
                                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                      allowfullscreen></iframe>' !!}
                        </div>
                    </div>


                    <!-- Star Reviews -->
                    <section class="reviews comments ">
                        <h3 class="mb-5">{{isset($votes) ? count($votes) : 0}} đánh giá</h3>
                        @if(isset($votes))
                            @foreach($votes as $vote)
                                <div class="row my-4">
                                    <ul class="col-12 commented pl-0">
                                        <li class="comm-inf">
                                            <div class="col-md-2">
                                                <img
                                                    src="{{!$vote->avatar ? 'https://toigingiuvedep.vn/wp-content/uploads/2021/05/hinh-anh-dai-dien-nguoi-giau-mat-bi-an.jpg' : $vote->avatar}}"
                                                    class="img-fluid" alt="">
                                            </div>
                                            <div class="col-md-10 comments-info">
                                                <div class="conra">
                                                    <h5 class="mb-2">{{$vote->name}}</h5>
                                                    <div class="rating-box">
                                                        <div class="detail-list-rating mr-0">
                                                            @for($i = 0 ; $i < $vote->score;$i++)
                                                                <i class="fa fa-star"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mb-4">{{\Carbon\Carbon::parse($vote->created_at)->format('h:i d/m/Y')}}</p>
                                                <p>{{$vote->message}}</p>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            @endforeach
                        @endif


                    </section>
                    <!-- Star Add Review -->

                </div>

                <aside class="col-lg-4 col-md-12 car mt-5">
                    <div class="single widget">
                        <!-- Start: Schedule a Tour -->
                        <div class="schedule widget-boxed mt-33 mt-0">
                            <div class="widget-boxed-header">
                                <h4><i class="fa fa-calendar pr-3 padd-r-10"></i>Đặt trước phòng</h4>
                            </div>
                            @if ( Session::has('success') )
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('success') }}</strong>
                                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Đóng</span>
                                    </button>
                                </div>
                            @endif
                            @if ( Session::has('error') )
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('error') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Đóng</span>
                                    </button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
                            @if ($deposit_exist !== null)
                                <a href="{{route('get_history_deposit')}}"
                                   class="btn reservation btn-radius theme-btn full-width mrg-top-10">Xem lịch sử đặt
                                    cọc</a>
                            @else
                                <a href="{{ route('client_deposit', ['id'=>$motel->motel_id]) }}"
                                   class="btn reservation btn-radius theme-btn full-width mrg-top-10">Đặt cọc ngay</a>
                            @endif
                        </div>
                    </div>
                    <!-- End: Schedule a Tour -->
                    <div class="schedule widget-boxed mt-33 my-4">
                        <div class="widget-boxed-header">
                            <h4><i class="fa fa-calendar pr-3 padd-r-10"></i>Đăt lịch xem phòng</h4>
                        </div>
                        <div class="widget-boxed-body">
                            @if(isset($appoint) && $appoint->status === 3 || !$appoint)
                                <form action="{{route('client.post_appointment')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="motel_id" value="{{$motel->motel_id}}">
                                    <input type="datetime-local" id="time" name="time" class="form-control">
                                    <button type="submit" onclick="return confirm('Bạn có chắc muốn đăt lịch hẹn ?')"
                                            class="btn reservation btn-radius theme-btn full-width mrg-top-10">Gửi
                                        yêu cầu
                                    </button>
                                </form>
                            @else
                                <a href="{{route('client.history_appointment')}}"
                                   class="btn reservation btn-radius theme-btn full-width mrg-top-10">Xem tình trạng
                                    lịch đặt</a>
                            @endif
                        </div>

                    </div>
                    <!-- end author-verified-badge -->
                    <div class="sidebar">
                        <div class="widget-boxed mt-33 mt-5">
                            <div class="widget-boxed-header">
                                <h4>Thông tin chủ trọ</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="sidebar-widget author-widget2">
                                    <div class="author-box clearfix">
                                        <img
                                            src="https://mondaycareer.com/wp-content/uploads/2020/11/anime-l%C3%A0-g%C3%AC-v%C3%A0-kh%C3%A1i-ni%E1%BB%87m.jpg"
                                            alt="author-image"
                                            class="author__img w-full">
                                        <h4 class="author__title">{{ $motel->user_name }}</h4>
                                        <p class="author__meta">Chủ khu trọ</p>
                                    </div>
                                    <ul class="author__contact">
                                        <li><span class="la la-map-marker"><i
                                                    class="fa fa-map-marker"></i></span>{{ $motel->user_address }}
                                        </li>
                                        <li><span class="la la-phone"><i class="fa fa-phone"
                                                                         aria-hidden="true"></i></span><a
                                                href="#">{{ $motel->user_phone }}</a></li>

                                        <li><span class="la la-envelope-o"><i class="fa fa-envelope"
                                                                              aria-hidden="true"></i></span><a
                                                href="#">{{ $motel->user_email }}</a>
                                        </li>
                                        <li>

                                            <a style="background: white; Color:rgb(0, 149, 255); "
                                               class="btn btn-outline-info btn-rounded"
                                               href="https://zalo.me/{{$motel->user_phone}}">
                                                <img style="width:15%" class="img-fluid"
                                                     src="{{asset('assets/client/images/icons/logo-zalo-02.jpg')}}"
                                                     alt="">
                                                Liên hệ Zalo </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="property-location map mt-3">
                        <h5>Địa chỉ phòng trọ</h5>
                        <style>
                            #map-contact iframe {
                                height: 100%;
                                width: 100%;
                            }
                        </style>
                        <div class="divider-fade"></div>
                        <div id="map-contact" class="contact-map">
                            {!! $motel->area_link_gg_map !!}
                        </div>
                    </div>
                    <div class="main-search-field-2">
                        <div class="widget-boxed mt-5">
                            <div class="widget-boxed-header">
                                <h4>Các phòng trong khu vực</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="recent-post">
                                    @foreach ($motelsByAreas as $item)
                                        <div class="recent-main mb-4">
                                            <div class="recent-img">
                                                <a href="blog-details.html"><img
                                                        src="{{json_decode($motel->photo_gallery)[0]}}"
                                                        alt=""></a>
                                            </div>
                                            <div class="info-img">
                                                <a href="blog-details.html">
                                                    <h6>{{$item->room_number}}</h6>
                                                </a>
                                                <p>{{number_format($item->priceMotel, 0, ',', '.')}}
                                                    VNĐ</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="widget-boxed mt-5">
                            <div class="widget-boxed-header mb-5">
                                <h4>Phòng Nổi bật</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="recent-post">
                                    @foreach ($motelsHot as $item)
                                        <div class="recent-main mb-4">
                                            <div class="recent-img">
                                                <a href="blog-details.html"><img
                                                        src="{{json_decode($motel->photo_gallery)[0]}}"
                                                        alt=""></a>
                                            </div>
                                            <div class="info-img">
                                                <a href="blog-details.html">
                                                    <h6>{{$item->room_number}}</h6>
                                                </a>
                                                <p>{{number_format($item->priceMotel, 0, ',', '.')}} VNĐ</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                    {{--            </div>--}}

                </aside>
            </div>
        </div>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
              crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
                crossorigin="anonymous"></script>
        <!-- START SIMILAR PROPERTIES -->
        <!-- END SIMILAR PROPERTIES -->
    </section>
    <!-- Messenger Plugin chat Code -->
    {!! $motel->script_fb ?? ''!!}
    <script>
        document.querySelectorAll('.moreUlSchool').forEach((item, index) => {
            item.addEventListener('click', () => {
                document.querySelectorAll('.locationMotel')[index].setAttribute('style', 'max-height: auto;overflow: hidden;')
                item.style.display = 'none';
                document.querySelectorAll('.cancelUlSchool')[index].style.display = 'block';
                document.querySelectorAll('.cancelUlSchool')[index].addEventListener('click', () => {
                    item.style.display = 'block';
                    document.querySelectorAll('.locationMotel')[index].setAttribute('style', 'max-height: 177px;overflow: hidden;')
                    document.querySelectorAll('.cancelUlSchool')[index].style.display = 'none';
                })

            })
        })
    </script>
@endsection
