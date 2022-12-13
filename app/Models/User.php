<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'phone_number',
        'avatar',
        'money',
        'address',
        'role_id',
        'confirmation_code',
        'token',
        'status',
        'money',
        'google_id',
        'script_fb'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function checkAndRetunUser($email)
    {
        $user = DB::table('users')
            ->where('email', $email)
            ->orWhere('id', $email)
            ->first();

        if ($user) {
            return $user;
        }

        return 0;
    }

    public function updateUser($params = [], $id)
    {
        if ($id) {
            DB::table('users')
                ->where('id', $id)
                ->update($params);

            return DB::table('users')
                ->where('id', $id)
                ->first();
        }
        return 0;
    }

    public function getUserByEmail($email)
    {
        return DB::table($this->table)->where('email', $email)->first();
    }

    public function getAll($params = [])
    {
        $params['order_by'] = $params['order_by'] ?? 'asc';
        $params['limit'] = $params['limit'] ?? 10;

        $query = DB::table($this->table)->select($this->fillable);
        if (isset($params['name']) && $params['name']) {
            $query = $query->where('name', 'like', '%' . $params['name'] . '%')
                ->orWhere('email', 'like', '%' . $params['name'] . '%');
        }
        return $query->orderBy('id', $params['order_by'])->paginate($params['limit']);
    }

    public function getOne($id)
    {
        $query = DB::table($this->table)->where('id', $id)->select($this->fillable);
        $user = $query->first();
        return $user;
    }

    public function saveNew($params)
    {
        $data = array_merge($params);
        $request = DB::table($this->table)->insertGetId($data); //$request sẽ trả về id của bản ghi vừa được tạo trong db
        return $request;
    }

    public function saveUpdate($params)
    {
        if (empty($params['id'])) {
            Session::flash('error', 'Không xác định bản ghi cần cập nhật');
            return null;
        }
        $res = DB::table($this->table)->where('id', $params['id'])->update($params);
        return $res; //trả ra số trường bị thay đổi
    }

    public function del($id)
    {
        $query = DB::table($this->table)->where('id', $id);
        $user = $query->delete();
        return $user;
    }

    // public function countOwnMotel() {
    //     $query = DB::table('users')->where('is_admin', 1)
    // }
    
}
