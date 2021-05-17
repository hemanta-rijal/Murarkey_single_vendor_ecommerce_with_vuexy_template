<?php


namespace Modules\MessageCenter\Repositories;


use App\Models\MsgSystemMessage;
use App\Models\SystemMessageNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\MessageCenter\Contracts\SystemMessageRepository;

class DbSystemMessageRepository implements SystemMessageRepository
{
    public function create($data) : MsgSystemMessage
    {
        $message = MsgSystemMessage::create($data);

        //reset notification
        SystemMessageNotification::where('sender_id', $data['from'])
            ->when($data['for_role'] != 'all', function ($query) use ($data) {
                return $query->whereHas('user', function ($q) use ($data) {
                    return $q->where('role', $data['for_role']);
                });
            })
            ->update(['status' => 'unread', 'auto_change_status' => true]);

        return $message;
    }

    public function findById($id)
    {
        return MsgSystemMessage::findOrFail($id);
    }

    public function update($id, $data)
    {
        return ['status' => $this->findById($id)->update($data)];
    }

    public function delete($id)
    {
        return MsgSystemMessage::destroy($id);
    }

    public function getPaginated($number)
    {
        return MsgSystemMessage::latest()->with('sender')->paginate($number);
    }

    public function findByKey($key)
    {
        return MsgSystemMessage::findByKeyOrFail($key);
    }

    public function getMessagesForRole($role)
    {
        return MsgSystemMessage::where('for_role', $role)
            ->orWhere('for_role', 'all')
            ->when(request()->search, function ($query) {
                return $query->search(request()->search);
            })
            ->latest()
            ->with('sender', 'notification')
            ->get()
            ->unique('from');
    }

    public function getMessagesForRoleWithSenderId($role, $senderId)
    {
        return MsgSystemMessage::where('for_role', $role)
            ->orWhere('for_role', 'all')
            ->where('from', $senderId)
            ->with('sender')
            ->get();
    }

    public function markMessage($senderId, $userId, $status, $auto_change)
    {
        try {
            $notification = SystemMessageNotification::where('sender_id', $senderId)->where('user_id', $userId)->firstOrFail();
            $notification->status = $status;
            $notification->auto_change_status = $auto_change;
            $notification->save();

            return $notification;
        } catch (ModelNotFoundException $e) {

            $notification = SystemMessageNotification::create(['user_id' => $userId, 'sender_id' => $senderId, 'status' => $status, 'auto_change_status' => $auto_change]);
        }
    }

    public function getUnreadMessageCount($user)
    {
        $messageSenderCount = MsgSystemMessage::select(\DB::raw("COUNT(DISTINCT(`from`)) as sender_count"))->where('for_role', $user->role)
        ->orWhere('for_role', 'all')->groupBy('from')->first();
        $messageSenderCount = $messageSenderCount ? $messageSenderCount->sender_count : 0;
        
        $readMessageCount = SystemMessageNotification::where('user_id', $user->id)->groupBy('sender_id')->where('status', 'read')->count();

        return $messageSenderCount - $readMessageCount;
    }
}