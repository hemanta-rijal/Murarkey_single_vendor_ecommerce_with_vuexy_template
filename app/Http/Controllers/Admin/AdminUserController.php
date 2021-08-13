<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\AdminUser\Contracts\AdminUserService;
use Modules\AdminUser\Requests\CreateAdminUserRequest;
use Modules\AdminUser\Requests\UpdateAdminUserRequest;
use Modules\Role\Services\RoleService;

class AdminUserController extends Controller
{
    private $adminService;
    private $roleService;

    public function __construct(AdminUserService $adminService, RoleService $roleService)
    {
        $this->adminService = $adminService;
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->adminService->getPaginated();
        return view('admin.admin-users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleService->getAll();
        return view('admin.admin-users.create')->with(compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdminUserRequest $request)
    {
        $data = $request->all();
        $user = $this->adminService->create($data, $request->government_business_permit);

        flash('User added successfully', 'success');
        return $this->redirectTo();
    }

    public function redirectTo()
    {
        return redirect()->route('admin.admin-users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->adminService->findById($id);

        return view('admin.admin-users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->adminService->findById($id);
        $roles = $this->roleService->getAll();
        return view('admin.admin-users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateAdminUserRequest $request, $id)
    {
        // if ($request->has('password') || $request->has('password_confirmation')) {
        //     $this->validate($request, [
        //         'password' => 'sometimes|regex:/^(?=.*[A-Za-z])(?=.*\d).{8,}$/|confirmed',
        //     ]);
        // }

        try {
            $data = $request->all();
            $this->adminService->updateByAdmin($id, $data);

            flash('Successfully updated!')->success();

            return $this->redirectTo();

        } catch (\Throwable $th) {
            // dd($th);
            flash($th->getMessage())->success();
            // Session('message', $th->getMessage());
            return $this->redirectTo();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $this->adminUserService->deleteUserAccount($id, request('force'));

            flash('successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            $message = 'The user has company. please delete that first';

            flash($message, 'danger');
        }

        return $this->redirectTo();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        try {
            \DB::table("admin_users")->whereIn('id', explode(",", $ids))->delete();
            // $this->adminService->deleteBulkUsers($ids);
            flash('successfully deleted');
            return response()->json(['success' => "Users Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted');
            return response()->json(['error' => "Users Could Not Be  Deleted."]);
        }
    }

}
