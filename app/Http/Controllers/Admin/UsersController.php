<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Modules\Companies\Contracts\CompanyService;
use Modules\Role\Services\RoleService;
use Modules\Users\Contracts\UserService;
use Modules\Users\Requests\CreateUserByAdminRequest;
use Modules\Users\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    use SendsPasswordResetEmails;
    private $userService;
    private $roleService;
    private $companyService;

    public function __construct(UserService $service, CompanyService $companyService, RoleService $roleService)
    {
        $this->userService = $service;
        $this->roleService = $roleService;
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getPaginated();
        // $users->load('seller.company');
        return view('admin.users.index', compact('users'));
    }

    public function exportCsv()
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=users.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $ourCsv = 'phone_number';

        foreach (DB::select(' SELECT phone_number FROM users WHERE phone_number is not null ') as $item) {
            $ourCsv .= PHP_EOL . $item->phone_number;
        }

        return response($ourCsv, 200, $headers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleService->getAll();
        return view('admin.users.create')->with(compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserByAdminRequest $request)
    {
        $data = $request->all();
        $user = $this->userService->create($data, $request->government_business_permit);

        flash('User added successfully', 'success');
        return $this->redirectTo();
    }

    public function redirectTo()
    {
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->findById($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userService->findById($id);
        // dd($user);
        // $data['user'] = $user->toArray();
        // dd($user->seller);
        // if ($user->isSeller()) {
        //     $data['seller'] = $user->seller->toArray();
        // }

        // dd($data['user']);
        // dd($user);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $data = $request->all();
            $data['verified'] = $data['verified'] ?? false;

            $this->userService->updateByAdmin($id, $data);

            flash('Successfully updated!')->success();

            return $this->redirectTo();

        } catch (\Throwable $th) {
            Session('message', $th->getMessage());
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
        $force = true; //adding manully
        try {
            $this->userService->deleteUserAccount($id, $force);

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
            \DB::table("users")->whereIn('id', explode(",", $ids))->delete();
            // $this->userService->deleteBulkUsers($ids);
            flash('successfully deleted');
            return response()->json(['success' => "Users Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted');
            return response()->json(['error' => "Users Could Not Be  Deleted."]);
        }
    }

    public function recover(Request $request, $id)
    {
        $this->userService->recoverUserAccount($id);
        flash('Successfully Recover!');

        return back();
    }

    public function trash(Request $request)
    {
        $users = $this->userService->getTrashItems();

        return view('admin.users.trash', compact('users'));
    }

    public function sendResetEmail($email)
    {
        $response = $this->broker()->sendResetLink(['email' => $email]);

        if ($response == Password::RESET_LINK_SENT) {
            flash('Email successfully sent!');
        } else {
            flash('Something went wrong');
        }

        return back();
    }

    public function sellerTrash()
    {
        $sellers = $this->userService->sellerTrash();

        return view('admin.users.seller-trash', compact('sellers'));
    }

    public function deleteSellerAccount(Request $request, $userId)
    {
        $force = $request->force;
        $this->userService->deleteAssociateSeller($userId, $force);
        flash('Successfully deleted!')->success();

        return back();
    }

    public function mailAll(Request $request)
    {
        $data = $request->all();

        $rtrrimmed = rtrim($request->to, ", ");
        $emails = explode(',', $rtrrimmed);

        $names = null;
        foreach ($emails as $email) {
            $user = User::where('email', $email)->firstOrFail();
            $names .= $user->name . ',';
        }
        $rtrrimmed = rtrim($names, ", ");
        $names = explode(',', $rtrrimmed);

        $data['names'] = $names;
        $data['emails'] = $emails;
        try {
            $job = (new SendEmailJob($data))->delay(now()->addSeconds(5));
            dispatch($job);
            flash('Mail Sent To The User(s)')->success();
        } catch (\Throwable $th) {
            flash('Mail Could Not Sent To The User(s)')->error();
            flash($th->getMessage())->error();
        }
        return redirect()->route('admin.users.index');
    }

    public function mailAllUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = [];
            $emails = null;

            foreach ($request->ids as $id) {
                $user = $this->userService->findByid($id);
                $data[$user->name] = $user->email;
                $emails .= $user->email . ',';
            }
            $route = 'admin.users.mail-all';
            return view('admin.partials.compose-mails-modal')->with(['data' => $data, 'emails' => $emails, 'route' => $route]);
        }
    }

}
