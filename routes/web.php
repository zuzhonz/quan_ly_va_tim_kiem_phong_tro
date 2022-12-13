<?php

use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Client\BillController as ClientBillController;
use App\Http\Controllers\Admin\PlanHistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PlansController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Client\LiveTogetherController;
use App\Http\Controllers\Client\MotelController as ClientMotelController;
use App\Http\Controllers\Auth\registerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/abc/test', function () {
    return view('email.bill');
});
Route::get('/phong-tro', [\App\Http\Controllers\Client\HomeController::class, 'motels'])->name('motels');

Route::get('/', [\App\Http\Controllers\Client\HomeController::class, 'index'])->name('home');
Route::get('/khu-tro/{areaID}', [\App\Http\Controllers\Client\HomeController::class, 'motel_by_area'])->name('motel_by_area');

Route::get('/test', function () {
    return view('test');
});
Route::get('/lua-chon-vai-tro', 'App\Http\Controllers\GoogleController@getFormSelectRole')->name('get_select_role_resign');
Route::post('/lua-chon-vai-tro', 'App\Http\Controllers\GoogleController@postFormSelectRole')->name('get_select_role_resign');
Route::get('/tim-kiem', [\App\Http\Controllers\Client\HomeController::class, 'search'])->name('search');
Route::get('/phong-tro/tim-kiem', [\App\Http\Controllers\Client\HomeController::class, 'searchMotels'])->name('search_motels');


Route::get('/dang-nhap', 'App\Http\Controllers\Auth\LoginController@getLogin')->name('get_login');
Route::post('/dang-nhap', 'App\Http\Controllers\Auth\LoginController@postLogin')->name('post_login');
Route::get('/dang-xuat', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/quen-mat-khau', 'App\Http\Controllers\Auth\LoginController@getFormForgotPassword')->name('get_form_forgot_password');
Route::post('/quen-mat-khau', 'App\Http\Controllers\Auth\LoginController@getCodeForgotPassword')->name('get_code_forgot_password');
Route::get('/xac-minh', 'App\Http\Controllers\Auth\LoginController@getFormConfirmAcc')->name('get_form_confirm_account');
Route::post('/xac-minh', 'App\Http\Controllers\Auth\LoginController@postCodeConfirmAcc')->name('get_post_code_confirm_account');
Route::get('/lay-lai-mat-khau', 'App\Http\Controllers\Auth\LoginController@passwordRetrieval')->name('password_retrieval');
Route::post('/lay-lai-mat-khau', 'App\Http\Controllers\Auth\LoginController@changePassword')->name('change_password');
Route::get('/tim-nguoi-o-ghep/{id}', [LiveTogetherController::class, 'detail'])->name('client.live-together.detail');
//Chi tiết phòng trọ
Route::get('/phong-tro/{id}', [ClientMotelController::class, 'detail'])->name('client.motel.detail');
Route::get('/lich-su-nap-tien', [PlanHistoryController::class, "list"])->name("admin.plan-history.list");

Route::get('/test', [ClientMotelController::class, 'test'])->name('client.motel.detail');

//Liên hệ
Route::get('/lien-he/{id}', [ClientMotelController::class, 'sendContact'])->name('client.contact.send');

//client các gói dịch vụ,đăng ký
Route::get('/goi-dich-vu', [\App\Http\Controllers\Client\PlanController::class, 'index_plan'])->name('frontend_get_plans');

Route::get('/dang-ky', [registerController::class, 'index_register'])->name('get_register');
Route::post('/dang-ky', [registerController::class, 'register_user'])->name('post_register');

Route::post('/xac-minh-email', [registerController::class, 'change_email'])->name('confirm_account_register');
Route::get('/xac-minh-email/{code}', [registerController::class, 'get_change_email'])->name('get_confirm_account_register');

// end client các gói dịch vụ,đăng ký


//Chi tiết tìm nguwoif ở ghép


Route::middleware(['auth'])->group(function () {
    Route::get('/quan-ly-tai-khoan/vong-quay', 'App\Http\Controllers\Client\AccountManagementController@wheel_luck')->name('client.get_rotation');
    Route::post('/dat-lich-hen', 'App\Http\Controllers\Client\AppointmentController@post_appointment')->name('client.post_appointment');
    Route::get('/quan-ly-tai-khoan/lich-su-dat', 'App\Http\Controllers\Client\AppointmentController@history_appointment')->name('client.history_appointment');
    Route::get('/quan-ly-tai-khoan/lich-su-dat/{appoint_id}', 'App\Http\Controllers\Client\AppointmentController@cancelAppoint')->name('client.cancelAppoint');

    Route::get('/quan-ly-tai-khoan/', 'App\Http\Controllers\Client\AccountManagementController@profile')->name('client.get_profile');
    Route::post('/quan-ly-tai-khoan/', 'App\Http\Controllers\Client\AccountManagementController@editProfile')->name('client.edit_profile');
    Route::get('/quan-ly-tai-khoan/doi-mat-khau', 'App\Http\Controllers\Client\AccountManagementController@changePassword')->name('client.change_password');
    Route::post('/quan-ly-tai-khoan/doi-mat-khau', 'App\Http\Controllers\Client\AccountManagementController@saveChangePassword')->name('client.save_change_password');
    Route::get('/quan-ly-tai-khoan/hoa-don-can-thanh-toan', 'App\Http\Controllers\Client\BillController@index')->name('client_get_list_bill');

    Route::get('/quan-ly-tai-khoan/lich-su-dang-ky/{motel_id}/{area_id}', [LiveTogetherController::class, 'historyContactMotel'])->name('client.get_history_contact_motel');
    Route::get('/quan-ly-tai-khoan/lich-su-dang-ky/{motel_id}/{area_id}/xac-nhan/{status}/{contact_id}', [LiveTogetherController::class, 'ConfirmContactMotel'])->name('client.confirm_contact_motel');

    Route::get('/quan-ly-tai-khoan/nap-tien', 'App\Http\Controllers\Client\AccountManagementController@getRecharge')->name('getRecharge');
    Route::get('/quan-ly-tai-khoan/lich-su-nap-tien', 'App\Http\Controllers\Client\AccountManagementController@historyRecharge')->name('get_history_recharge');
    Route::get('/quan-ly-tai-khoan/roi-phong,{motelId}', 'App\Http\Controllers\Client\AccountManagementController@outMotel')->name('client_out_motel');
    Route::get('/quan-ly-tai-khoan/dang-ky-o-ghep', 'App\Http\Controllers\Client\AccountManagementController@history_contact_by_user')->name('get_history_contact_by_user');
    Route::post('/quan-ly-tai-khoan/gui-danh-gia', 'App\Http\Controllers\Client\VoteController@sendVote')->name('client_send_vote');

    Route::get('/quan-ly-tai-khoan/lich-su-mua-goi', 'App\Http\Controllers\Client\AccountManagementController@historyBuyPlan')->name('get_history_buy_plan');
    Route::get('/dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('admin_home');

    Route::get('/quan-ly-tai-khoan/lich-su-dat-coc', 'App\Http\Controllers\Client\DepositController@historyDeposit')->name('get_history_deposit');

    Route::get('phong-tro-cua-toi/', 'App\Http\Controllers\Client\MotelController@currentMotel')->name('client_current_motel');
    Route::get('phong-o-ghep/tim-kiem', 'App\Http\Controllers\Client\MotelController@searchListLiveTogether')->name("client_search_list_live_together");

    Route::get('phong-o-ghep/{motel_id}', 'App\Http\Controllers\Client\MotelController@postLiveTogether')->name("client_post_live_together");
    Route::post('phong-o-ghep/{motel_id}', 'App\Http\Controllers\Client\MotelController@savePostLiveTogether')->name("client_save_post_live_together");
    Route::get('phong-o-ghep', 'App\Http\Controllers\Client\MotelController@listLiveTogether')->name("client_list_live_together");

    //Đặt cọc
    Route::get('phong-tro/dat-coc/{id}', 'App\Http\Controllers\Client\DepositController@deposit')->name("client_deposit");
    Route::post('phong-tro/dat-coc/{id}', 'App\Http\Controllers\Client\DepositController@post_deposit')->name("client_post_deposit");

    // thành toán hóa đơn
    Route::get('phong-tro/thanh-toan-hoa-don/{bill}', [ClientBillController::class, 'get_pay_bill'])->name("client_get_pay_bill");
    Route::post('phong-tro/thanh-toan-hoa-don/{bill}', [ClientBillController::class, 'pay_bill'])->name("client_pay_bill");

    Route::prefix('admin')->group(function () {
        // Màn thống kê
        // Chủ trọ và admin
        Route::get('dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('backend_get_dashboard');
        Route::post('thong-tin-tai-khoan', 'App\Http\Controllers\Admin\DashboardController@updateProfile')->name('updateProfile');

        Route::get('thong-tin-tai-khoan', 'App\Http\Controllers\Admin\DashboardController@profile')->name('backend_get_profile');
        // Lịch sửa mua gói dịch vụ
        Route::get('/lich-su-mua-goi', [PlanHistoryController::class, "index_plan_history"])->name("admin.plan-history.list");
        Route::get('/lich-hen-xem-phong', 'App\Http\Controllers\Admin\AppointmentController@get_list_appoint')->name("admin.get_list_appoint");
        Route::post('/xac-nhan-lich-hen', 'App\Http\Controllers\Admin\AppointmentController@confirm_appoint')->name("admin.confirm_appoint");

        // Lịch sử đặt cọc
        Route::prefix('vong-quay')->group(function () {
            Route::post('/doi-ve', 'App\Http\Controllers\Admin\TicketController@admin_swap_gift_to_ticket')->name('admin_swap_gift_to_ticket');
            Route::get('', 'App\Http\Controllers\Admin\TicketController@get_view_whell_luck')->name('admin_get_view_wheel_luck');
            Route::post('mua-luot', 'App\Http\Controllers\Admin\TicketController@buy_ticket')->name('buy_ticket');
        });
        Route::prefix('dat-coc')->group(function () {
            Route::get('/', 'App\Http\Controllers\Admin\DepositController@index_deposits')->name('backend_get_list_deposit');
            Route::post('/change_status/{id}', 'App\Http\Controllers\Admin\DepositController@change_status_deposit')->name('backend_admin_change_status_deposit');
        });
        // Lịch sử nạp tiền
        Route::prefix('lich-su-nap-tien')->group(function () {
            Route::get('/', 'App\Http\Controllers\Admin\RechargeController@index_recharges')->name('backend_get_list_recharge');
        });
        Route::prefix('nap-tien')->group(function () {
            Route::get('/', 'App\Http\Controllers\Admin\RechargeController@get_form_recharge')->name('backend_get_form_recharge');
        });
        Route::prefix('rut-tien')->group(function () {
            Route::get('/', 'App\Http\Controllers\WithdrawController@get_form_withdraw')->name('backend_get_form_withdraw');
            Route::post('/', 'App\Http\Controllers\WithdrawController@withdraw');
            Route::get('/lich-su-rut-tien', 'App\Http\Controllers\WithdrawController@list')->name('backend_get_history_withdraw');
        });
        Route::prefix('hoa-don')->group(function () {
            Route::get('/', 'App\Http\Controllers\Admin\BillController@index')->name('backend_get_list_bill');
            Route::post('/xac-nhan', 'App\Http\Controllers\Admin\BillController@confirm')->name('backend_confirm_bill');
        });
        // Chỉ chủ trọ
        Route::prefix('khu-tro')->group(function () {
            Route::get('/', 'App\Http\Controllers\Admin\AreaController@index_areas')->name('backend_get_list_area');
            Route::get('/tao-moi', 'App\Http\Controllers\Admin\AreaController@add_areas')->name('backend_get_create_area');
            Route::post('/tao-moi', 'App\Http\Controllers\Admin\AreaController@saveAdd_areas')->name('backend_get_post_create_area');
            Route::get('/{id}/cap-nhat', 'App\Http\Controllers\Admin\AreaController@update_areas')->name('backend_get_edit_area');
            Route::post('/{id}/cap-nhat', 'App\Http\Controllers\Admin\AreaController@saveUpdate_areas')->name('backend_get_post_edit_area');
            Route::get('/{id}/xoa', 'App\Http\Controllers\Admin\AreaController@delete_areas')->name('backend_delete_area');
            Route::post('/xuat-hoa-don', 'App\Http\Controllers\Admin\AreaController@send_bill')->name('backend_send_bill');
        });

        // Quản lý phòng trọ
        Route::prefix('phong-tro')->group(function () {
            Route::post('nhap-danh-sach', [\App\Http\Controllers\Admin\MotelController::class, "import"])->name("admin.motel.import");

            Route::post('{motelId}/xuat-hoa-don', [\App\Http\Controllers\Admin\MotelController::class, "print"])->name("admin.print.motel");
            Route::get('{id}/danh-sach-nguoi-dat-coc', [\App\Http\Controllers\Admin\DepositController::class, "listDeposit"])->name("admin.list-deposit.motel");
            Route::get('{id}/{idMotel}/danh-sach-roi-phong', [\App\Http\Controllers\Admin\MotelController::class, "list_out_motel"])->name("admin.motel.list_out_motel");
            Route::get('{id}/dong-y-roi-phong', [\App\Http\Controllers\Admin\MotelController::class, "confirm_out_motel"])->name("admin.motel.confirm_out_motel");
            Route::get('{id}/xoa-thanh-vien', [\App\Http\Controllers\Admin\MotelController::class, "deleteUserFormMotel"])->name('admin.delete_user_motel');

            Route::get('{id}/{idMotel}/lich-su-thue', [\App\Http\Controllers\Admin\MotelController::class, "history_motel"])->name("admin.motel.history");
            Route::get('{id}', [\App\Http\Controllers\Admin\MotelController::class, "index_motels"])->name("admin.motel.list");
            Route::get('{id}/create', [\App\Http\Controllers\Admin\MotelController::class, "add_motels"])->name("admin.motel.create");
            Route::post('{id}/create', [\App\Http\Controllers\Admin\MotelController::class, "saveAdd_motels"])->name("admin.motel.store");
            Route::get('{id}/{idMotel}', [\App\Http\Controllers\Admin\MotelController::class, "detail"])->name("admin.motel.detail");
            Route::get('{id}/{idMotel}/sao-chep', [\App\Http\Controllers\Admin\MotelController::class, "duplicate"])->name("admin.duplicate.motel");


            Route::get('/phong-tro/{id}/edit/{idMotel}', [\App\Http\Controllers\Admin\MotelController::class, "edit_motels"])->name("admin.motel.edit");
            Route::get('/phong-tro/{id}/detail/{idMotel}', [\App\Http\Controllers\Admin\MotelController::class, "detail_motels"])->name("admin.motel.detail");
            Route::get('/phong-tro/{id}/del/{idMotel}', [\App\Http\Controllers\Admin\MotelController::class, "delete_motels"])->name("admin.motel.delete");
            Route::post('phong-tro/{id}/update', [\App\Http\Controllers\Admin\MotelController::class, 'saveUpdate_motels'])->name('saveUpdate_motel');


            Route::get('{id}/{idMotel}/chi-tiet', [\App\Http\Controllers\Admin\MotelController::class, "info_user_motels"])->name("admin.motel.info");
            Route::get('{id}/{idMotel}/chi-tiet/them', [\App\Http\Controllers\Admin\MotelController::class, "add_peolpe_of_motels"])->name("admin.motel.add_people");
            Route::get('{id}/{idMotel}/dang-tin', [\App\Http\Controllers\Admin\MotelController::class, "create_post_motels"])->name("admin.motel.post");
            Route::post('{id}/{idMotel}/dang-tin', [\App\Http\Controllers\Admin\MotelController::class, "save_create_post_motels"])->name("admin.motel.post_post");
            Route::get('{id}/{idMotel}/dang-ky-o-ghep', [\App\Http\Controllers\Admin\MotelController::class, "contact_motel"])->name("admin.motel.contact");
        });

        // Chỉ có admin
        // Quản lý gói dịch vụ
        Route::prefix('goi-dich-vu')->group(function () {
            Route::get('/', [PlansController::class, 'index_plans'])->name('backend_admin_get_list_plans');
            Route::get('/tao-moi', [PlansController::class, 'add_plans'])->name('backend_admin_create_plans');
            Route::post('/tao-moi', [PlansController::class, 'saveAdd_plans'])->name('backend_admin_post_create_plans');
            Route::get('/{id}/cap-nhat', [PlansController::class, 'update_plans'])->name('backend_admin_edit_plans');
            Route::post('/{id}/cap-nhat', [PlansController::class, 'saveUpdate_plans'])->name('backend_admin_update_plans');
            Route::get('/{id}/xoa', [PlansController::class, 'delete_plans'])->name('backend_admin_delete_plans');
        });

        // Quản lý quyền
        Route::prefix('quyen')->group(function () {
            Route::get('/', [RoleController::class, 'index_roles'])->name('list_role');
            Route::get('/tao-moi', [RoleController::class, 'add_roles'])->name('create_role');
            Route::post('/tao-moi', [RoleController::class, 'saveAdd_roles'])->name('saveAdd_role');
            Route::get('/cap-nhat/{id}', [RoleController::class, 'update_roles'])->name('edit_role');
            Route::post('/cap-nhat', [RoleController::class, 'saveUpdate_roles'])->name('saveEdit_role');
            Route::get('/xoa/{id}', [RoleController::class, 'delete_roles'])->name('del_role');
        });
        Route::prefix('lich-su-tim-kiem')->group(function () {
            Route::get('/', 'App\Http\Controllers\Admin\HistorySearchController@index')->name('backend_get_history_search');
            Route::get('/thong-ke', 'App\Http\Controllers\Admin\HistorySearchController@api')->name('backend_api_history_search');


        });
        Route::prefix('dia-diem')->group(function () {
            Route::get('/', 'App\Http\Controllers\Admin\LocationController@index')->name('backend_get_list_location');
            Route::post('/nhap-danh-sach', 'App\Http\Controllers\Admin\LocationController@importFileExcel')->name('backend_importFileExcel_location');

        });
        Route::prefix('tai-khoan')->group(function () {
            Route::get('/doi-mat-khau', 'App\Http\Controllers\Admin\UserController@changePassword')->name('backend_user_change_password');
            Route::post('/doi-mat-khau', 'App\Http\Controllers\Admin\UserController@saveChangePassword');

            Route::get('/', 'App\Http\Controllers\Admin\UserController@index_users')->name('backend_user_getAll');
            Route::get('/chi-tiet/{id}/{used_to}', 'App\Http\Controllers\Admin\UserController@update_users')->name('backend_user_detail');
            Route::match(['get', 'post'], '/add', 'App\Http\Controllers\Admin\UserController@add')->name('backend_user_add');
            Route::post('/update/{id}', 'App\Http\Controllers\Admin\UserController@saveUpdate_users')->name('backend_user_update');
        });
        Route::get('pay', 'App\Http\Controllers\PayPalPaymentController@pay')->name('make.payment');

        Route::get('error', 'App\Http\Controllers\PayPalPaymentController@error')->name('cancel.payment');

        Route::get('success/{id}', 'App\Http\Controllers\PayPalPaymentController@success')->name('success.payment');
    });
});

Route::get('/403', function () {
    return view('error.403');
})->name('403');
