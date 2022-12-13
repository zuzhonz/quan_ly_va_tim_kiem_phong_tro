<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function __construct()
    {

        $arr = [
            'function' => [
                'index_roles',
                'add_roles',
                'update_roles',
                'saveUpdate_roles',
                'saveAdd_roles',
                'delete_roles',
            ]
        ];
        foreach ($arr['function'] as $item) {
            $this->middleware('check_permission:' . $item)->only($item);
        }
    }

    public function index_roles()
    {
        $modelRole = new Role();
        $Role = $modelRole->getRoles();

        return view('admin.role.index', ['Role' => $Role]);
    }

    public function add_roles()
    {
        $modelRole = new Role();
        $all = $modelRole->getAll();
        return view('admin.role.add', [
            '_title' => 'Thêm mới quyền',
            'all' => $all
        ]);
    }

    public function update_roles(Request $request, $id)
    {
        $modelRole = new Role();
        $request->session()->put('id', $id);
        //lấy permission
        $all = $modelRole->getAll();
        $roleDetail = $modelRole->getDetail($id);
        $permission_role = $modelRole->getPermissionRole($id);

        return view('admin.role.edit', [
            '_title' => 'Sửa quyền',
            'all' => $all,
            'roleDetail' => $roleDetail,
            'permission_role' => $permission_role
        ]);
    }

    public function saveUpdate_roles(RoleRequest $request)
    {
        $id = $request->id;
        if (empty($id)) {
            return back()->with('msg', 'Liên kết không tồn tại');

        }

        $dataUpdate = [
            'name' => $request->name,
            'desc' => $request->desc,
            'status' => $request->status,
            'updated_at' => date('Y-m-d H:i:s')
        ];


        $modelRole = new Role();
        $modelRole->delete_Permission_Role($id);
        $res = $modelRole->saveUpdate_Role($dataUpdate, $id);
        $modelRole->saveNew_Permission_Role($id, $request->permission);
        return redirect()->route('list_role')->with('msg', 'Cập nhật quyền thành công');
    }

    public function saveAdd_roles(RoleRequest $request)
    {


        $dataInsert = [
            'name' => $request->name,
            'desc' => $request->desc,
            'status' => $request->status,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $modelRole = new Role();

        $res = $modelRole->saveNew($dataInsert);

        $modelRole->saveNew_Permission_Role($res, $request->permission);

        return redirect()->route('list_role')->with('msg', 'Thêm quyền thành công');

    }

    public function delete_roles($id)
    {

        if (!empty($id)) {
            $modelRole = new Role();
            $role = $modelRole->getDetail($id);
            if (!empty($role[0])) {
                $delStatus = $modelRole->delete_Roles($id);
                $modelRole->delete_Permission_Role($id);
                if ($delStatus) {
                    $msg = 'Xóa quyền thành công';
                } else {
                    $msg = 'Xóa thất bại';
                }
            } else {
                $msg = 'Quyền không tồn tại';
            }

        } else {
            $msg = 'Liên kết không tồn tại';
        }
        return redirect()->route('list_role')->with('msg', $msg);
    }
}

