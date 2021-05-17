<?php


namespace Modules\MessageCenter\Services;


use App\Models\MsgSystemMessage;
use Modules\MessageCenter\Contracts\SystemMessageRepository;
use Modules\MessageCenter\Contracts\SystemMessageService as SystemMessageServiceContract;

class SystemMessageService implements SystemMessageServiceContract
{

    private $systemMessageRepository;

    const DEFAULT_PAGINATION = 10;

    public function __construct(SystemMessageRepository $repository)
    {
        $this->systemMessageRepository = $repository;
    }

    public function create($data) : MsgSystemMessage
    {
        $data['from'] = auth()->guard('admin')->user()->id;

        return $this->systemMessageRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->systemMessageRepository->update($id, $data);
    }

    public function findById($id)
    {
        return $this->systemMessageRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->systemMessageRepository->delete($id);
    }

    public function getPaginated($number = null)
    {
        return $this->systemMessageRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

    public function getMessagesForUser()
    {
        $role = auth()->user()->role;

        return $this->systemMessageRepository->getMessagesForRole($role);
    }

    public function getMessagesFormSenderId($senderId)
    {
        $role = auth()->user()->role;

        return $this->systemMessageRepository->getMessagesForRoleWithSenderId($role, $senderId);
    }

    public function markMessageAsRead($senderId, $autoChange = false)
    {
        $userId = auth()->user()->id;
        $status = request('status')? request('status') : 'read';
        
        return $this->systemMessageRepository->markMessage($senderId, $userId, $status, $autoChange);
    }
}