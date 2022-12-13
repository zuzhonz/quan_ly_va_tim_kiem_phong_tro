@extends('layouts.user.main')
@section('content')
    @include('custom.wheel_luck')
    <script>
        const historyWheelLuck = document.getElementById('historyWheelLuck');
        const number_ticket = document.getElementById('number_ticket');
        const currentMoney = document.querySelectorAll('.current_money');
        const number_ticket_buy = document.getElementById('number_ticket_buy');
        const btnBuyTicket = document.getElementById('btnBuyTicket');
        const tableRender = document.getElementById('tableRender');
        const paginateHistory = document.getElementById('paginateHistory');
        if (+number_ticket.innerText === 0) {
            document.querySelector('.wheel__button').setAttribute('disabled', 'true');
        }
        number_ticket_buy.addEventListener('change', (e) => {
            if (e.target.value * 20 >= Number(currentMoney[0].innerText)) {
                document.querySelector('.messageTicket').innerHTML =
                    '<i class="fa-solid fa-triangle-exclamation text-danger"></i> Bạn không đủ xu để thực hiện hành động này';
                btnBuyTicket.setAttribute('disabled', 'true');
            } else {
                document.querySelector('.messageTicket').innerHTML = '';
                btnBuyTicket.removeAttribute('disabled');
            }

            if (e.target.value) {
                document.getElementById('fee').innerText = e.target.value * 20;
            } else {
                document.getElementById('fee').innerText = 0;
            }

        })

        function callAPi(gift) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('post_wheel_luck') }}",
                data: {
                    gift: gift,
                    user_id: {{\Illuminate\Support\Facades\Auth::id()}}
                },
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    const icon = '<i class="fa-brands fa-bitcoin text-warning"></i>';
                    const data = JSON.parse(JSON.stringify(result));
                    number_ticket.innerText = Number(number_ticket.innerText) - 1;
                    if (+number_ticket.innerText === 0) {
                        document.querySelector('.wheel__button').setAttribute('disabled', 'true');
                    }
                    currentMoney.forEach((item) => {
                        item.innerText = item.innerText.replace(".","");
                        item.innerText = (Number(item.innerText) + Number(data.history.gift)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                        ;
                    })
                    historyWheelLuck.innerHTML = `
                    <tr class="trHistory">
                    <td>${document.querySelectorAll('.trHistory').length + 1}</td>
                    <td>${data.history.gift > 0 ? '<span class="text-success">+' + data.history.gift + icon + '</span>' : 'Chúc may mắn'}</td>
                        <td>${data.history.time}</td>
                        </tr>
                            ` + historyWheelLuck.innerHTML;
                    document.querySelectorAll('.trHistory').forEach((item, index) => {
                        const td = item.querySelector('td');
                        td.innerText = index + 1;
                    })


                }
            });
        }
    </script>
    <script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
@endsection
