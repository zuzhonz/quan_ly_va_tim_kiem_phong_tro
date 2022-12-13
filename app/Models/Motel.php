<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Motel extends Model
{
    use HasFactory;

    protected $fillable = [
        "room_number",
        "price",
        "area",
        'status',
        "area_id",
        "description",
        "image_360",
        "photo_gallery",
        "services",
        "address",
        "max_people",
        "start_time",
        "end_time",
        "desc",
        "category_id",
        "day_deposit",
        "money_deposit",
        "transfer_infor",
        'created_at',
        'electric_money',
        'wifi',
        'warter_money',
        "video",
    ];

    protected $table = "motels";

    public function LoadMotelsWithPage($params = [], $id)
    {
        $this->fillable[] = "id";

        $params['order_by'] = $params['order_by'] ?? 'desc';
        $params['name'] = $params['name'] ?? '';
        $params['limit'] = $params['limit'] ?? 10;

        $motels = DB::table($this->table)
            ->select(['room_number', 'price', 'max_people', 'motels.status', 'id', 'area_id', 'image_360', 'electric_money', 'warter_money', 'start_time', 'end_time'])
            ->where('area_id', $id);

        if ($params['name']) {
            $motels->where('room_number', 'like', '%' . $params['name'] . '%');
        }

        return $motels->orderBy('id', $params['order_by'])
            ->paginate($params['limit']);

    }

    public function createMotel($data)
    {
        $res = DB::table($this->table)->insert(
            [
                "room_number" => $data['room_number'],
                "price" => $data['price'],
                "area" => $data['area'],
                'status' => 1,
                "area_id" => $data['area_id'],
                "description" => $data['description'],
                "image_360" => $data['image_360'],
                "photo_gallery" => json_encode($data['photo_gallery']),
                "services" => json_encode([
                    'bedroom' => $data['service']['bedroom'],
                    'toilet' => $data['service']['toilet'],
                    'service_checkbox' => $data['service']['service_checkbox'],
                    'more' => $data['service_more'],
                    'actor' => $data['actor']
                ]),
                "max_people" => $data['max_people'],
                "category_id" => $data['category_id'],
                "video" => $data['video'],
                'electric_money' => $data['electric_money'],
                'warter_money' => $data['warter_money'],
                'wifi' => $data['wifi'],
                "day_deposit" => $data['day_deposit'],
                "money_deposit" => $data['money_deposit'],
                "transfer_infor" => $data['transfer_infor'],
            ]
        );
        return $res;
    }

    public function saveNew($data)
    {
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }

    public function detailMotel($idMotel)
    {
        $motel = DB::table('categories')
            ->select([
                'motels.id as motel_id',
                'area_id',
                'areas.name as areaName',
                'category_id',
                'room_number',
                'price',
                'area',
                'image_360',
                'photo_gallery',
                'services',
                'end_time',
                'max_people',
                'areas.address as address',
                'description',
                'areas.address as area_address',
                'areas.link_gg_map as area_link_gg_map',
                'motels.updated_at as motel_updateAt',
                'categories.name as category_name',
                'users.name as user_name',
                'users.address as user_address',
                'users.avatar as user_avatar',
                'users.phone_number as user_phone',
                'users.email as user_email',
                'start_time',
                'electric_money',
                'wifi',
                'warter_money',
                'video',
                'day_deposit',
                'money_deposit',
                'transfer_infor',
            ])
            ->join('motels', 'categories.id', '=', 'motels.category_id')
            ->join('areas', 'areas.id', '=', "motels.area_id")
            ->join('users', 'areas.user_id', '=', 'users.id')
            ->where('motels.id', $idMotel)
            ->first();
        return $motel;
    }

    public function detailMotel1($idMotel)
    {
        $motel = DB::table('categories')
            ->select([
                'motels.id as motel_id',
                'area_id',
                'areas.name as areaName',
                'category_id',
                'room_number',
                'price',
                'area',
                'image_360',
                'photo_gallery',
                'services',
                'end_time',
                'max_people',
                'areas.address as address',
                'description',
                'areas.address as area_address',
                'areas.link_gg_map as area_link_gg_map',
                'motels.updated_at as motel_updateAt',
                'categories.name as category_name',
                'users.name as user_name',
                'users.address as user_address',
                'users.avatar as user_avatar',
                'users.phone_number as user_phone',
                'users.email as user_email',
                'start_time',
                'video',
                'script_fb'
            ])
            ->join('motels', 'categories.id', '=', 'motels.category_id')
            ->join('areas', 'areas.id', '=', "motels.area_id")
            ->join('users', 'areas.user_id', '=', 'users.id')
            ->where('motels.id', $idMotel)
            ->first();
        if ($motel) {
            $currentPlanMotel = PlanHistory::join('plans', 'plan_history.plan_id', '=', 'plans.id')->where('motel_id', $motel->motel_id)->where('type', 1)->where('plan_history.status', 1)->first();
            if ($currentPlanMotel) {
                return $motel;
            }
        }


        return null;
    }

    public function delete_motels($id)
    {
        return DB::table('motels')->where('id', $id)->delete();
    }


    public function info_motel($id)
    {
        $query = DB::table('users')
            ->select(['name', 'motels.status as motel_status', 'motels.end_time as motel_end', 'phone_number', 'user_motel.start_time', "max_people", 'motel_id', 'user_id', 'email', "motels.room_number as room", 'motels.status'])
            ->join('user_motel', 'users.id', '=', 'user_motel.user_id')
            ->join('motels', 'user_motel.motel_id', '=', 'motels.id')
            ->where('motel_id', $id)
            ->where('user_motel.status', 1)
            ->get();
        $query->motel = DB::table('motels')->select(['max_people', 'room_number', 'start_time', 'end_time', 'areas.name', 'electric_money', 'warter_money', 'wifi', 'motels.status'])->join('areas', 'motels.area_id', '=', 'areas.id')->where('motels.id', $id)->first();
        $query->money_deposit = DB::table('deposits')
                ->select(['value', 'type'])
                ->where('status', 1)
                ->where('motel_id', $id)
                ->first() ?? 0;
        return $query;
    }

    public function info_motel_email($email)
    {
        return DB::table('users')
            ->select(['name', 'user_id', 'motel_id', 'email', "motels.room_number as room"])
            ->join('user_motel', 'users.id', '=', 'user_motel.user_id')
            ->join('motels', 'user_motel.motel_id', '=', 'motels.id')
            ->where('email', $email)
            ->where('user_motel.status', 1)
            ->get();
    }


    public function get_list_contact($motel_id, $area_id)
    {
        return DB::table('users')
            ->select(['contact_motel_history.user_id', 'motels.id as motel_id', 'area_id', 'name', 'email', 'phone_number', 'contact_motel_history.status as tt', 'contact_motel_history.created_at as tg', 'contact_motel_history.id as contact_id'])
            ->join('contact_motel_history', 'users.id', '=', 'contact_motel_history.user_id')
            ->join('motels', 'contact_motel_history.motel_id', '=', 'motels.id')
            ->where('area_id', $area_id)
            ->where('motel_id', $motel_id)
            ->orderBy('contact_motel_history.created_at', 'desc')
            ->paginate(10);
    }

    public function get_list_contact_by_user($id)
    {
        return DB::table('users')
            ->select(['contact_motel_history.user_id', 'motels.id as motel_id', 'area_id', 'name', 'email', 'phone_number', 'contact_motel_history.status as tt', 'contact_motel_history.created_at as tg', 'contact_motel_history.id as contact_id'])
            ->join('contact_motel_history', 'users.id', '=', 'contact_motel_history.user_id')
            ->join('motels', 'contact_motel_history.motel_id', '=', 'motels.id')
            ->where('user_id', $id)
            ->orderBy('contact_motel_history.created_at', 'desc')
            ->paginate(10);
    }

    public function client_get_List_Motel_top()
    {
        // dd($params);
        $query = DB::table('areas')
            ->select(['title_color', 'priority_level', 'motels.id as motel_id', 'areas.name as areaName', 'motels.room_number', 'motels.price', 'motels.area', 'services', 'motels.max_people', 'motels.area_id', 'areas.address', 'motels.photo_gallery as photo_gallery_i', 'plan_history.plan_id'])
            ->join('motels', 'areas.id', '=', 'motels.area_id')
            ->join('plan_history', 'motels.id', '=', 'plan_history.motel_id')
            ->join('plans', 'plan_history.plan_id', 'plans.id')
            ->where('plan_history.status', 1)
            ->where('type', 1)
            ->where('motels.status', 5)
            ->orderBy('priority_level', 'asc')
            ->paginate(5);

        foreach ($query as $item) {
            $sql = DB::table('locations')
                ->selectRaw('COUNT(locations.id) as numberLocation,type,Min(distance) as minDistance')
                ->join('area_location', 'locations.id', '=', 'area_location.location_id')
                ->where('area_id', $item->area_id)
                ->groupBy(['type'])
                ->orderBy('distance')
                ->get();
            $item->locationNearMotel = $sql;

            $sql2 = DB::table('votes')->selectRaw('AVG(score) as tb')->where('motel_id', $item->motel_id)->groupBy(['motel_id'])->first()->tb ?? 0;

            $item->vote = $sql2;
        }
        return $query;
    }

    public function client_get_List_Motel_contact($params = [])
    {

        return DB::table('areas')
            ->select(['motels.room_number', 'motels.price', 'motels.area', 'services', 'motels.max_people', 'motels.area_id', 'areas.address', 'motels.photo_gallery', 'plan_history.plan_id', 'data_post', 'motels.id'])
            ->join('motels', 'areas.id', '=', 'motels.area_id')
            ->join('plan_history', 'motels.id', '=', 'plan_history.motel_id')
            ->join('plans', 'plan_history.plan_id', 'plans.id')
            ->where('type', 2)
            ->where('plan_history.status', 1)
            ->where('motels.end_time', '>', Carbon::now())
            ->orderBy('priority_level', 'asc')
            ->get();
    }

    public function client_Get_all_Motel()
    {
        $query = DB::table('plans')
            ->select(['plan_history.created_at', 'avatar', 'users.name', 'title_color', 'motels.room_number', 'areas.name as areaName', 'motels.price', 'priority_level', 'motels.area', 'services', 'motels.max_people', 'motels.area_id', 'areas.address', 'motels.photo_gallery as photo_gallery_i', 'motels.id as motel_id'])
            ->join('plan_history', 'plans.id', '=', 'plan_history.plan_id')
            ->join('motels', 'plan_history.motel_id', '=', 'motels.id')
            ->join('areas', 'areas.id', '=', 'motels.area_id')
            ->join('users', 'areas.user_id', '=', 'users.id')
            ->where('plan_history.status', 1)
            ->where('type', 1)
            ->orderBy('priority_level', 'asc')
            ->paginate(6);


        foreach ($query as $item) {
            $sql2 = DB::table('votes')->selectRaw('AVG(score) as tb')->where('motel_id', $item->motel_id)->groupBy(['motel_id'])->first()->tb ?? 0;

            $item->vote = $sql2;
        }

        return $query;
    }

    public function saveUpdate_motels($data, $id)
    {
        return DB::table('motels')->where('id', $id)->update($data);
    }

    public function users()
    {
        return $this->hasMany(UserMotel::class, "motel_id", "id");
    }

    public function infoMotelLiveTogether($motel_id)
    {
        $countUser = DB::table('users')
            ->join('user_motel', 'users.id', '=', 'user_motel.user_id')
            ->where('motel_id', $motel_id)
            ->where('user_motel.status', 1)
            ->count();
        $motel = DB::table('plans')
            ->select([
                'motels.id as motel_id',
                'area_id',
                'priority_level',
                'areas.name as areaName',
                'room_number',
                'motels.price',
                'area',
                'image_360',
                'photo_gallery',
                'services',
                'end_time',
                'max_people',
                'areas.address as address',
                'description',
                'areas.address as area_address',
                'areas.link_gg_map as area_link_gg_map',
                'motels.updated_at as motel_updateAt',
                'users.name as user_name',
                'users.address as user_address',
                'users.avatar as user_avatar',
                'users.phone_number as user_phone',
                'users.email as user_email',
                'start_time',
                'data_post',
                'video'
            ])
            ->join('plan_history', 'plans.id', '=', 'plan_history.plan_id')
            ->join('motels', 'plan_history.motel_id', '=', 'motels.id')
            ->join('areas', 'areas.id', '=', "motels.area_id")
            ->join('users', 'areas.user_id', '=', 'users.id')
            ->where('motels.id', $motel_id)
            ->where('plan_history.status', 1)
            ->where('type', 2)
            ->first();
        if ($motel) {
            return $motel;
        }
        return null;
    }

    public function search($params = [], $type = 1)
    {
        // dd($params)

        $query = DB::table('areas')
            ->select(['title_color', 'data_post', 'plans.name', 'plans.type', 'motels.id as motel_id', 'priority_level', 'areas.name as areaName', 'motels.room_number', 'motels.price', 'motels.area', 'services', 'motels.max_people', 'motels.area_id', 'areas.address', 'motels.photo_gallery as photo_gallery_i', 'plan_history.plan_id'])
            ->join('motels', 'areas.id', '=', 'motels.area_id')
            ->join('plan_history', 'motels.id', '=', 'plan_history.motel_id')
            ->join('plans', 'plan_history.plan_id', '=', 'plans.id')
            ->where('plan_history.status', '=', 1)
            ->where('plans.type', $type);
        if (isset($params['city_id']) && $params['city_id'] > 0) {
            $query->where('areas.city_id', '=', $params['city_id']);
        }
        if (isset($params['ward_id']) && $params['ward_id'] > 0) {
            $query->where('areas.ward_id', '=', $params['ward_id']);
        }
        if (isset($params['district_id']) && $params['district_id'] > 0) {
            $query->where('areas.district_id', '=', $params['district_id']);
        }
        if (isset($params['bedroom']) && $params['bedroom'] > 0) {
            $query->where('motels.services', 'LIKE', '%\"bedroom\":\"' . $params['bedroom'] . '\"%');
        }
        if (isset($params['toilet']) && $params['toilet'] > 0) {
            $query->where('motels.services', 'LIKE', '%\"toilet\":\"' . $params['toilet'] . '\"%');
        }
        if (isset($params['services'])) {
            if (in_array('dieu_hoa', $params['services'])) {
                $query->where('motels.services', 'LIKE', '%\"dieu_hoa\"%');
            }
            if (in_array('nong_lanh', $params['services'])) {
                $query->where('motels.services', 'LIKE', '%\"nong_lanh\"%');
            }
            if (in_array('tu_lanh', $params['services'])) {
                $query->where('motels.services', 'LIKE', '%\"tu_lanh\"%');
            }
            if (in_array('tu_quan_ao', $params['services'])) {
                $query->where('motels.services', 'LIKE', '%\"tu_quan_ao\"%');
            }
        }


        $query->whereBetween('motels.area', [$params['area_min'], $params['area_max']])
            ->whereBetween('motels.price', [$params['price_min'], $params['price_max']]);
        $query->orderBy('priority_level', 'asc');
        // dd($query->toSql());
        $query = $query->paginate(5);
        if (isset($params['location'])) {
            foreach ($query as $item) {
                $sql2 = DB::table('votes')->selectRaw('AVG(score) as tb')->where('motel_id', $item->motel_id)->groupBy(['motel_id'])->first()->tb ?? 0;

                $item->vote = $sql2;
                $sql = DB::table('locations')
                    ->selectRaw('COUNT(locations.id) as numberLocation,type,Min(distance) as minDistance')
                    ->join('area_location', 'locations.id', '=', 'area_location.location_id');
                $sql = $sql->whereIn('type', $params['location']);
                $sql = $sql->where('area_id', $item->area_id);

                if ($params['dis'] > 0 && isset($params['dis'])) {
                    $sql = $sql->where('distance', '<=', $params['dis']);
                }
                $sql = $sql->
                groupBy(['type'])
                    ->orderBy('distance')
                    ->get();
                if (!empty($sql)) {
                    $item->locationNearMotel = $sql;
                } else {
                    unset($item);
                }

            }
        } else {
            foreach ($query as $item) {
                $sql2 = DB::table('votes')->selectRaw('AVG(score) as tb')->where('motel_id', $item->motel_id)->groupBy(['motel_id'])->first()->tb ?? 0;

                $item->vote = $sql2;
                $sql = DB::table('locations')
                    ->selectRaw('COUNT(locations.id) as numberLocation,type,Min(distance) as minDistance')
                    ->join('area_location', 'locations.id', '=', 'area_location.location_id')
                    ->where('area_id', $item->area_id);
                if ($params['dis'] > 0 && isset($params['dis'])) {
                    $sql = $sql->where('distance', '<=', $params['dis']);
                };
                $sql = $sql->
                groupBy(['type'])
                    ->orderBy('distance')
                    ->get();
                $item->locationNearMotel = $sql;
                if (!empty($sql)) {
                    $item->locationNearMotel = $sql;
                } else {
                    unset($item);
                }
            }
        }


        return $query;


    }

    public function getMotelsByAreas($id)
    {
        $area = DB::table('motels')->where('id', $id)->first();
        $motelsByAreas = DB::table('motels')
            ->select([
                'photo_gallery',
                'room_number',
                'motels.price as priceMotel'
            ])
            ->where('area_id', $area->area_id)
            ->join('plan_history', 'motels.id', '=', 'plan_history.motel_id')
            ->join('plans', 'plan_history.plan_id', 'plans.id')
            ->where('plan_history.status', 1)
            ->where('type', 1)
            ->orderBy('priority_level', 'asc')
            ->limit(5)->get();
        return $motelsByAreas;
    }

    public function getMotelsHot()
    {
        return DB::table('areas')
            ->select([
                'photo_gallery',
                'room_number',
                'motels.price as priceMotel'
            ])
            ->join('motels', 'areas.id', '=', 'motels.area_id')
            ->join('plan_history', 'motels.id', '=', 'plan_history.motel_id')
            ->join('plans', 'plan_history.plan_id', 'plans.id')
            ->where('plan_history.status', 1)
            ->where('type', 1)
            ->orderBy('priority_level', 'asc')
            ->limit(5)->get();
    }

    public function getLiveTogethersByAreas($id)
    {
        $area = DB::table('motels')->where('id', $id)->first();
        $liveTogethers = DB::table('motels')
            ->select([
                'photo_gallery',
                'room_number',
                'motels.price as priceMotel'
            ])
            ->join('plan_history', 'motels.id', '=', 'plan_history.motel_id')
            ->join('plans', 'plan_history.plan_id', 'plans.id')
            ->where('plan_history.status', 1)
            ->where('type', 2)
            ->where('area_id', $area->area_id)->orderBy('priority_level', 'asc')->limit(5)->get();
        return $liveTogethers;
    }

    public function getLiveTogethersHot()
    {
        return DB::table('areas')
            ->select([
                'photo_gallery',
                'room_number',
                'motels.price as priceMotel'
            ])
            ->join('motels', 'areas.id', '=', 'motels.area_id')
            ->join('plan_history', 'motels.id', '=', 'plan_history.motel_id')
            ->join('plans', 'plan_history.plan_id', 'plans.id')
            ->where('plan_history.status', 1)
            ->where('type', 2)
            ->orderBy('priority_level', 'asc')
            ->limit(5)->get();
    }
}
