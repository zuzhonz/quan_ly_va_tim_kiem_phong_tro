<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    protected $table = "roles";
    protected $fillable = ['name', 'desc', 'status'];

    public function getRoles()
    {
        $data = DB::table('roles')->get();
        return $data;
    }

    public function saveNew($data)
    {
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }

    public function getAll()
    {
        $data = [];
        foreach (DB::table('permissions')->where('parent_id', 0)->get() as $item) {
            $x = [];
            foreach (DB::table('permissions')->where('parent_id', '!=', 0)->get() as $key) {
                if ($key->parent_id == $item->id) {
                    $x[] = [
                        'id' => $key->id,
                        'name' => $key->desc
                    ];
                }
            }
            $data[] = [
                'name' => $item->desc,
                'id' => $item->id,
                'permission' => $x
            ];

        }
        return $data;
    }

    public function saveNew_Permission_Role($role_id, $permission)
    {
        foreach ($permission as $i) {
            DB::table('permission_role')->insert([
                'role_id' => $role_id,
                'permission_id' => $i
            ]);
        }

    }

    public function saveUpdate_Role($data, $id)
    {
        return DB::table('roles')->where('id', $id)->update($data);
    }
    // public function saveUpdate_Permission_Role(){
    // return DB::table('permission_role')->where('id',$id)->()
    // }
    public function getPermissionRole($role_id)
    {
        $x = [];
        foreach (DB::table('permission_role')->where('role_id', $role_id)->get() as $i) {
            $x[] = $i->permission_id;
        }
        return $x;
    }

    public function delete_Roles($id)
    {
        return DB::table('roles')->where('id', $id)->delete();
    }

    public function getDetail($id)
    {
        return DB::select('SELECT * FROM roles WHERE id = ?', [$id]);
    }

    public function delete_Permission_Role($role_id)
    {
        return DB::table('permission_role')->where('role_id', $role_id)->delete();
    }

    public function permissionRoles()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
}
