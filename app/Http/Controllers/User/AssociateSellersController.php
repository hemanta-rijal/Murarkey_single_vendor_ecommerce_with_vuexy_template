<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MessageCenter\Contracts\InvitationMessageService;
use Modules\MessageCenter\Requests\CancelInvitationRequest;
use Modules\MessageCenter\Requests\PostNewInviteRequest;
use Modules\Users\Contracts\UserService;

class AssociateSellersController extends Controller
{
    private $userService;
    private $invitationMessageService;

    public function __construct(UserService $service, InvitationMessageService $invitationMessageService)
    {
        $this->userService = $service;
        $this->invitationMessageService = $invitationMessageService;
    }

    public function myAssociateSellers()
    {
        $sellers = $this->userService->getCompanyAssociates();


        return view('user.associate-sellers.my-associates', compact('sellers'));
    }

    public function invitedAssociates()
    {
        $invitations = $this->invitationMessageService->getInvitedAssociates();
        $invitations->load('user');

        return view('user.associate-sellers.invited-associates', compact('invitations'));
    }

    public function inviteNew(Request $request)
    {
        $search = $request->search;
        $message = null;
        $users = [];

        if ($search) {
            $users = $this->userService->searchForAssociateSellers($search);
            if ($users->count() == 0)
                $message = "No search result found";
        } else {
            $message = "Please search!";
        }

        return view('user.associate-sellers.invite-new', compact('message', 'users'));
    }

    public function postInviteNew(PostNewInviteRequest $request)
    {
        $invitation = $this->invitationMessageService->createInviteRequest($request->user_id);

        return redirect('/user/associate-sellers/invited-associates');
    }

    public function cancelInvitation(CancelInvitationRequest $request)
    {
        $this->invitationMessageService->delete($request->get('id'));

        return back();
    }

    public function removeCompanyAssociateSeller($id)
    {
        $this->userService->deleteAssociateSeller($id);

        return back();
    }
}
