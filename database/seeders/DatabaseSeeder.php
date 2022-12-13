<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Motel;
use App\Models\PlanHistory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $a = "
            <div id='fb-root'></div>

    <!-- Your Plugin chat code -->
    <div id='fb-customer-chat' class='fb-customerchat'>
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute('page_id', '103703272570083');
        chatbox.setAttribute('attribution', 'biz_inbox');
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                xfbml: true,
                version: 'v15.0'
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
        ";
        $data = File::get(public_path('json/deposits.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('deposits')->insert(
                [
                    "type" => 1,
                    "user_id" => $item["user_id"],
                    "value" => $item["value"],
                    "motel_id" => $item['motel_id'],
                    'created_at' => Carbon::now()
                ]
            );
        }
        $data = File::get(public_path('json/areas.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('areas')->insert(
                [
                    "id" => $item['id'],
                    "name" => $item["name"],
                    "address" => $item["address"],
                    "img" => $item['img'],
                    'link_gg_map' => $item['link_gg_map'],
                    'user_id' => $item['user_id'],
                    'created_at' => Carbon::now(),
                    'city_id' => $item['city_id'],
                    'district_id' => $item['district_id'],
                    'ward_id' => $item['ward_id'],
                    'latitude' => $item['latitude'],
                    'longitude' => $item['longitude']
                ]
            );
        }
        $data = File::get(public_path('json/users.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('users')->insert(
                [
                    "name" => $item["name"],
                    "email" => $item["email"],
                    "password" => Hash::make('123456'),
                    "role_id" => $item['role_id'],
                    'created_at' => Carbon::now(),
                    'money' => 0,
                    'is_admin' => $item['is_admin'],
                    'script_fb' => $a,
                ]
            );
        }
        $data = File::get(public_path('json/motels.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('motels')->insert(
                [
                    'id' => $item['id'],
                    "room_number" => $item['room_number'],
                    "price" => $item['price'],
                    "area" => $item['area'],
                    'status' => $item['status'],
                    "area_id" => $item['area_id'],
                    "description" => $item['description'],
                    "image_360" => $item['image_360'],
                    "photo_gallery" => $item['photo_gallery'],
                    "services" => $item['services'],
                    "max_people" => $item['max_people'],
                    "category_id" => 1,
                    "video" => $item['video'],
                ]
            );
        }

        $data = File::get(public_path('json/roles.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('roles')->insert(
                [
                    "name" => $item["name"],
                    "desc" => $item["desc"],
                    "status" => $item["status"],
                    'created_at' => Carbon::now(),
                ]
            );
        }

        $data = File::get(public_path('json/permissions.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('permissions')->insert(
                [
                    "name" => $item["name"],
                    "desc" => $item["desc"],
                    "parent_id" => $item["parent_id"],
                    "status" => $item["status"],
                    'created_at' => Carbon::now(),
                ]
            );
        }

        $data = File::get(public_path('json/permission_role.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('permission_role')->insert(
                [
                    "role_id" => $item["role_id"],
                    "permission_id" => $item["permission_id"],
                    'created_at' => Carbon::now(),
                ]
            );
        }

        $data = File::get(public_path('json/categories.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('categories')->insert(
                [
                    "name" => $item["name"],
                    "status" => $item["status"],
                    "desc" => $item["desc"],
                    'created_at' => Carbon::now(),
                ]
            );
        }
        $data = File::get(public_path('json/plans.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('plans')->insert(
                [
                    "name" => $item["name"],
                    "desc" => $item["desc"],
                    "priority_level" => $item["priority_level"],
                    'type' => $item['type'],
                    'time' => $item['time'],
                    'price' => $item['price'],
                    'status' => $item['status'],
                    'created_at' => Carbon::now(),
                    'title_color' => $item['title_color']
                ]
            );


        }
        $data = File::get(public_path('json/area_location.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('area_location')->insert(
                [
                    "area_id" => $item["area_id"],
                    "location_id" => $item["location_id"],
                    "distance" => $item["distance"],
                ]
            );


        }

        $data = File::get(public_path('json/bills.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('bills')->insert(
                [
                    "title" => $item["title"],
                    "motel_id" => $item["motel_id"],
                    "number_elec" => $item["number_elec"],
                    'number_warter' => $item['number_warter'],
                    'number_elec_old' => $item['number_elec_old'],
                    'number_warter_old' => $item['number_warter_old'],
                    'status' => $item['status'],
                    'created_at' => Carbon::now()->addMonth(-1)]
            );


        }
        $data = File::get(public_path('json/locations.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('locations')->insert(
                [
                    "name" => $item["name"],
                    "latitude" => $item["latitude"],
                    "longitude" => $item["longitude"],
                    'type' => $item['type'],
                ]
            );


        }

        $data = File::get(public_path('json/motel_vote.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('motel_vote')->insert(
                [
                    "motel_id" => $item["motel_id"],
                    "vote_id" => $item["vote_id"]
                ]
            );


        }
        $data = File::get(public_path('json/plan_history.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('plan_history')->insert(
                [
                    "plan_id" => $item["plan_id"],
                    "motel_id" => $item["motel_id"],
                    "day" => $item["day"],
                    "status" => $item["status"],
                    "parent_id" => $item["parent_id"],
                    "is_first" => $item["is_first"],
                    "user_id" => $item["user_id"],
                    "created_at" => Carbon::now()
                ]
            );


        }

        $data = File::get(public_path('json/recharges.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('recharges')->insert(
                [
                    "user_id" => $item["user_id"],
                    "date" => Carbon::now(),
                    "recharge_code" => $item["recharge_code"],
                    "payment_type" => $item["payment_type"],
                    "status" => $item["status"],
                    "note" => $item["note"],
                    "fee" => $item["fee"],
                    "value" => $item["value"],
                    'created_at' => Carbon::now()
                ]
            );


        }
        $data = File::get(public_path('json/user_motel.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('user_motel')->insert(
                [
                    "user_id" => $item["user_id"],
                    "motel_id" => $item["motel_id"],
                    "start_time" => Carbon::now(),
                    "end_time" => Carbon::now(),
                    "status" => $item["status"],
                    "created_at" => Carbon::now()
                ]
            );


        }

        $data = File::get(public_path('json/votes.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('votes')->insert(
                [
                    "score" => $item["score"],
                    "message" => $item["message"],
                    "question" => $item["question"],
                    "user_id" => $item["user_id"],
                    "created_at" => Carbon::now()
                ]
            );


        }


        $data = File::get(public_path('json/withdraws.json'));
        $data = json_decode($data, true);

        foreach (array_shift($data) as $item) {
            DB::table('withdraws')->insert(
                [
                    "user_id" => $item["user_id"],
                    "fee" => $item["fee"],
                    "money" => $item["money"],
                    "address_balance" => $item["address_balance"],
                    "status" => $item["status"],
                    "created_at" => Carbon::now()
                ]
            );


        }
    }
}
