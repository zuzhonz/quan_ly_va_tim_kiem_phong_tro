<div class="row bg-white shadow-lg p-4 mr-2 rounded-3">
    <div class="col-12 text-center">
        <h2 style="">Vòng quay may mắn</h2>
    </div>
    <div class="col-xl-8 col-lg-10">
        <p>Số điểm thưởng có: {{\Illuminate\Support\Facades\DB::table('tickets')->selectRaw('SUM(ticket) as quantity')
 ->where('status',1)->where('user_id',\Illuminate\Support\Facades\Auth::id())->first()->quantity ?? 0}} <i
                class="fa-solid fa-gift text-danger"></i> <a href="#" data-bs-toggle="modal"
                                                             data-bs-target="#exampleModal3000">Đổi ngay</a></p>
        <div class="modal fade" id="exampleModal3000" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-size: 16px">Đổi vé quay</h1>
                        <button type="button" class="btn-close" style="background-color: white;border:none"
                                data-bs-dismiss="modal"
                                aria-label="Close"><span aria-hidden="true" style="font-size: 16px !important;"><i
                                    class="fa-solid fa-xmark"></i></span></button>
                    </div>
                    <form action="{{route('admin_swap_gift_to_ticket')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <p>Điểm hiện có: <span id="point">{{\Illuminate\Support\Facades\DB::table('tickets')->selectRaw('SUM(ticket) as quantity')
 ->where('status',1)->where('user_id',\Illuminate\Support\Facades\Auth::id())->first()->quantity ?? 0}}</span> <i
                                    class="fa-solid fa-gift text-danger"></i></p>
                            <div class="row">
                                <div class="col-5 form-group">
                                    <label for="">Số điểm muốn đổi</label>
                                    <input type="number" step="10" name="gift" id="gift" class="form-control">
                                </div>
                                <div class="col-2 text-center">
                                    <i class="fa-solid fa-right-left"></i>
                                </div>
                                <div class="col-5 form-group">
                                    <label for="">Số vé nhận được</label>
                                    <input type="number" name="ticket" id="ticket1" readonly
                                           class="form-control">
                                </div>
                            </div>
                            <p id="messageSwapTicket"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng
                            </button>
                            <button type="submit" id="swapTicket" class="btn btn-primary">Đổi ngay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="box1" style="height: 620px">
            <link rel="stylesheet" href="{{asset('assets/custom/style.css')}}">
            <div class="rule">
                <div class="rule__content">
                    <div class="rule__color color-1"></div>
                    <div class="rule__text">
                        Tặng 50 <i
                            class="fa-brands fa-bitcoin text-warning"></i>
                    </div>
                </div>
                <div class="rule__content">
                    <div class="rule__color color-2"></div>
                    <div class="rule__text">
                        Tặng 40 <i
                            class="fa-brands fa-bitcoin text-warning"></i>
                    </div>
                </div>
                <div class="rule__content">
                    <div class="rule__color color-3"></div>
                    <div class="rule__text">
                        Tặng 10 <i
                            class="fa-brands fa-bitcoin text-warning"></i>
                    </div>
                </div>
                <div class="rule__content">
                    <div class="rule__color color-4"></div>
                    <div class="rule__text">
                        Tặng 20 <i
                            class="fa-brands fa-bitcoin text-warning"></i>
                    </div>
                </div>
                <div class="rule__content">
                    <div class="rule__color color-5"></div>
                    <div class="rule__text">
                        Tặng 30 <i
                            class="fa-brands fa-bitcoin text-warning"></i>
                    </div>
                </div>
                <div class="rule__content">
                    <div class="rule__color color-6"></div>
                    <div class="rule__text">
                        Chúc bạn may mắn lần sau
                    </div>
                </div>
            </div>
            <div class="wheel">
                <div class="wheel__inner">
                    <div class="wheel__sec">
                    </div>
                    <div class="wheel__sec">
                    </div>
                    <div class="wheel__sec">
                    </div>
                    <div class="wheel__sec">
                    </div>
                    <div class="wheel__sec">
                    </div>
                    <div class="wheel__sec">
                    </div>
                </div>
                <div class="wheel__arrow">
                    <button class="wheel__button">QUAY</button>
                </div>
                <div class="text-center mt-4">
                    <p>Bạn có <span id="number_ticket">{{$number_ticket_user ?? 0}}</span> lượt quay</p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Mua lượt
                    </button>
                </div>
            </div>
            <div class="popup">
                <div class="popup__container">
                    <div class="popup__emotion">
                        <i class="fas fa-meh"></i>
                    </div>
                    <p class="popup__note"></p>
                </div>
            </div>
            <div class="congratulation">
                <div class="congratulation__container">
                    <div class="congratulation__close">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="congratulation__emotion">
                        <i class="fas fa-smile"></i>
                    </div>
                    <p class="congratulation__note">CHÚC MỪNG BẠN ĐÃ TRÚNG 1 NHÀ LẦU</p>
                </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
                    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="{{asset('assets/custom/js.js')}}"></script>

        </div>
        <p><span class="text-danger font-weight-bold">Thể lệ</span>: Sử dụng vé quay để có thể quay vòng quay
            mắn.Quay vào ô màu nào sẽ đc phầm thưởng ô đó.</p>
    </div>

    <div class="col-xl-4 col-lg-2">
        <h3 class="alert alert-success">Lịch sử trúng thưởng</h3>
        <div style="max-height: 400px;overflow-y: auto">
            <table class="table table-striped text-center">
                <tr>
                    <th>STT</th>
                    <th>Phần thưởng</th>
                    <th>Thời gian</th>
                </tr>
                <tbody id="historyWheelLuck">
                @foreach($history_wheel_luck as $history)
                    <tr class="trHistory">
                        <td>{{$loop->iteration}}</td>
                        <td><span class="text-success">
                                @if($history->gift > 0)
                                    +{{$history->gift}}  <i
                                        class="fa-brands fa-bitcoin text-warning"></i></span>
                            @else
                                Chúc may mắn
                            @endif
                        </td>
                        <td>{{\Carbon\Carbon::parse($history->created_at)->format('h:i A d/m/Y')}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mua lượt quay</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 24px !important;"><i
                            class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
            <form action="{{route('buy_ticket')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    <p>Tài khoản gốc: <span
                            class="current_money">{{number_format(\Illuminate\Support\Facades\Auth::user()->money, 0, ',', '.')}}</span>
                        <i
                            class="fa-brands fa-bitcoin text-warning"></i></p>
                    <div>
                        <label for="">Nhập số lượt quay bạn muốn mua</label>
                        <input type="number" min="1" name="number_ticket_buy" id="number_ticket_buy" class="form-control"
                               value="1">
                    </div>
                    <p class="mt-2">Phí tạm tính: <span id="fee">20</span> <i
                            class="fa-brands fa-bitcoin text-warning"></i></p>
                    <p class="messageTicket mt-2"></p>
                    <p class="mt-2">1 lượt quay = 20 <i
                            class="fa-brands fa-bitcoin text-warning"></i></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary" id="btnBuyTicket">Mua ngay</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const ticket1 = document.getElementById('ticket1');
    const gift = document.getElementById('gift');
    const point = document.getElementById('point');
    const swapTicket = document.getElementById('swapTicket');
    const messageSwapTicket = document.getElementById('messageSwapTicket');
    // document.getElementById('btnBuyTicket').setAttribute('disabled', true);
    gift.addEventListener('change', (e) => {
        if (e.target.value > Number(point.innerText)) {
            swapTicket.setAttribute('redo', 'true');
            gift.style.border = '2px solid red';
            messageSwapTicket.innerHTML = `<i class="fa-solid fa-triangle-exclamation text-danger"></i> Bạn không đủ điểm để thực hiện hành động này !`;
        } else if (e.target.value < 0) {
            swapTicket.setAttribute('disabled', 'true');
            gift.style.border = '2px solid red';
            messageSwapTicket.innerHTML = `<i class="fa-solid fa-triangle-exclamation text-danger"></i> Dữ liệu không hợp lệ !`;
        } else {
            gift.value = e.target.value - e.target.value % 10;
            ticket1.value = e.target.value / 10;
            gift.style.border = '1px solid #ced4da';
            messageSwapTicket.innerText = '';
            swapTicket.removeAttribute('disabled');
        }

    })
</script>
