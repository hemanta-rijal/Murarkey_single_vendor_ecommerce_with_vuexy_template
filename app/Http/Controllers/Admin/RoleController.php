<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Role\Contracts\RoleServiceRepository;
use Modules\Role\Requests\CreateRoleRequest;

class RoleController extends Controller
{

    private $roleService;

    public function __construct(RoleServiceRepository $service)
    {
        $this->roleService = $service;
    }

    public function redirectTo()
    {
        return redirect()->route('admin.roles.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleService->getPaginated();
        return view('admin.roles.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $permission = Permission::get();

        $permission_groups = $permissions->reduce(function ($carry, $permission) {

            $first_letter = explode('-', $permission->slug)[0];
            if (!isset($carry[$first_letter])) {
                $carry[$first_letter] = [];
            }

            $carry[$first_letter][] = $permission;

            return $carry;

        }, []);

        return view('admin.roles.create')->with('permission_groups', $permission_groups);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $data = $request->all();
        try {
            $data['slug'] = Str::slug($data['name']);
            $this->roleService->create($data);
            flash('Successfully Added!!!')->success();
            return redirect()->route('admin.roles.index');
        } catch (\Throwable $th) {
            $message = "Could Not Be Added \n" . $th->getMessage();
            flash($message)->error();
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleService->findById($id);
        $permissions = $permission = Permission::get();
        $permission_groups = $permissions->reduce(function ($carry, $permission) {
            $first_letter = explode('-', $permission->slug)[0];
            if (!isset($carry[$first_letter])) {
                $carry[$first_letter] = [];
            }
            $carry[$first_letter][] = $permission;
            return $carry;
        }, []);
        $role_permissions = $role->permissions->pluck('id')->toArray();
        return view('admin.roles.edit')->with(compact('role', 'permission_groups', 'role_permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only('name', 'permissions');
        try {
            $data['slug'] = Str::slug($data['name']);
            $this->roleService->update($id, $data);
            flash('Successfully Updated!!!')->success();
            return redirect()->route('admin.roles.index');
        } catch (\Throwable $th) {
            // dd($th);
            $message = "Could Not Be Updated \n" . $th->getMessage();
            flash($message)->error();
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ($role) {
                $this->roleService->delete($role->id);
            }
            flash('data deleted successfully')->success();
            return $this->redirectTo();
        } catch (\Throwable $th) {
            flash('data could not be deleted')->danger();
            flash($th->getMessage())->danger();
            return $this->redirectTo();
        }

    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        try {
            \DB::table("roles")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted')->success();
            return response()->json(['success' => "Roles Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted');
            return response()->json(['error' => "Roles Could Not Be  Deleted."]);
        }
    }
}
