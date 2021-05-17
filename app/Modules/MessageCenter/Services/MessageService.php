<?php


namespace Modules\MessageCenter\Services;


use App\Events\MessageDeleted;
use App\Events\NewMessage;
use Modules\MessageCenter\Contracts\MessageRepository;
use Modules\MessageCenter\Contracts\MessageService as MessageServiceContract;
use Modules\Users\Contracts\UserRepository;
use Musonza\Chat\Conversations\ConversationUser;
use Musonza\Chat\Facades\ChatFacade as Chat;

class MessageService implements MessageServiceContract
{
    protected $messageRepository;
    private $userRepository;

    public function __construct(MessageRepository $messageRepository, UserRepository $userRepository)
    {
        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;
    }

    public function storeGeneralMessage($data)
    {
        $data['user_id'] = auth()->user()->id;
        $message = Chat::send($data);

        $this->unHideConversation($message->conversation_id);

        event(new NewMessage($message));
    }

    public function getChatAppData()
    {
        $user = auth()->user();
        $conversations = Chat::conversations($user->id);
        $users = [];
        $hideList = ConversationUser::whereIn('conversation_id', $conversations->pluck('id'))->where('user_id', $user->id)->pluck('hide_on_chat_box', 'conversation_id');
        $conversations->map(function ($conversation) use (&$users, $user, $hideList) {
            $messages = [];
            $conversation->show = false;
            $conversation->isRead = true;
            $conversation->position = '';


            $conversation->hide_on_chat_list = $hideList[$conversation->id] ?? false;

            $conversation->setRelation(
                'messages',
                $conversation->messages()
                    ->orderBy('id', 'DESC')
                    ->when($conversation->deleted_at, function ($query) use ($conversation) {
                        return $query->where('created_at', '>', $conversation->deleted_at);
                    })
                    ->take(5)
                    ->get()
            );

            $lastMessage = $conversation->messages->first();
            if ($lastMessage) {
                $lastNotification = $conversation->notification()->where('message_id', $lastMessage->id)->where('user_id', $user->id)->first();
                if ($lastNotification)
                    $conversation->isRead = (bool)$lastNotification->is_seen;
            }

            $conversation->last_message = $lastMessage ? $lastMessage->body : 'No messages yet';

            if ($conversation->users->count() == 0)
                $conversation->users->push(null_user());

            $conversation->users->map(function ($user) use (&$users) {
                $user->is_online = false;
                $users[] = $user;
            });

            $conversation->messages->reverse()->map(function ($message) use (&$messages) {
                $messages[] = $message->toArray();
            });

            unset($conversation->messages);

            $conversation->messages = $messages;
        });

        return ['user' => $user, 'conversations' => $conversations->toArray(), 'users' => $users];
    }

    public function createConversation($ids)
    {
        $conversation = Chat::createConversation(array_unique($ids));
        $conversation->isRead = true;
        $conversation->show = false;
        $conversation->last_message = $conversation->messages->first() ? $conversation->messages->first()->body : 'No messages yet';
        $conversation->position = '';

        $userId = auth()->user()->id;

        $conversation->load(['users' => function ($query) use ($userId) {
            $query->where('user_id', '<>', $userId);
            $query->select('id', 'first_name', 'last_name', 'profile_pic');
        }]);

        return $conversation;
    }

    public function markAsRead($conversationId, $userId = null)
    {
        $userId = $userId ? $userId : auth()->user()->id;

        return Chat::conversationRead($conversationId, $userId);
    }

    public function loadMore($conversationId, $skip, $userId = null, $number = 20)
    {
        $userId = $userId ? $userId : auth()->user()->id;

        return $this->messageRepository->loadMore($userId, $conversationId, $skip, $number);
    }

    public function getConversationsByUserId($userId = null)
    {
        $user = auth()->user();
        $conversations = Chat::conversations($user->id);

        $conversations->map(function ($conversation) use ($user) {
            $lastMessage = $conversation->messages()->when($conversation->deleted_at, function ($query) use ($conversation) {
                return $query->where('created_at', '>', $conversation->deleted_at);
            })->orderBy('id', 'DESC')->first();

            $conversation->isRead = true;


            if ($lastMessage) {
                $lastNotification = $conversation->notification()->where('message_id', $lastMessage->id)->where('user_id', $user->id)->first();
                if ($lastNotification)
                    $conversation->isRead = (bool)$lastNotification->is_seen;
            }


            $conversation->last_message = $lastMessage ? $lastMessage->body : null;

            if ($conversation->users->count() == 0)
                $conversation->users->push(null_user());

        });

        if ($search = request()->search) {
            $search = '%' . $search . '%';
            $conversations = $conversations->filter(function ($conversation) use ($search) {
                $user = $conversation->getRelation('users')[0];

                return (like_match($search, $user->first_name, false) || like_match($search, $user->last_name, false) || like_match($search, $user->email, false));
            });
        }

        return $conversations->filter(function ($conversation) {
            return $conversation->last_message;
        });
    }

    public function getSentMessages($userId = null)
    {

        $user = auth()->user();
        $conversations = Chat::conversations($user->id);
        $conversations->map(function ($conversation) use ($user) {
            $lastMessage = $conversation->messages()->where('user_id', $user->id)->orderBy('id', 'DESC')->first();

            $conversation->last_message = $lastMessage ? $lastMessage->body : null;
        });

        return $conversations->filter(function ($conversation) {
            return $conversation->last_message;
        });
    }


    public function getConversationById($id, $userId = null)
    {
        $userId = $userId ? $userId : auth()->user()->id;

        return $this->messageRepository->getConversationById($id, $userId);
    }

    public function postConversations($data)
    {
        $userId = auth()->user()->id;

        if (isset($data['delete_item']))
            return $this->messageRepository->deleteConversations($data['delete_item'], $userId);
    }

    public function deleteConversation($id)
    {
        $userId = auth()->user()->id;

        return $this->messageRepository->deleteConversations([$id], $userId);
    }

    public function markAsUnreadConversation($id, $userId = null)
    {
        $userId = $userId ? $userId : auth()->user()->id;

        return $this->messageRepository->markAsUnread($id, $userId);
    }

    public function deleteMessage($messageId, $conversationId, $userId = null)
    {
        $userId = $userId ? $userId : auth()->user()->id;

        if ($message = $this->messageRepository->deleteMessage($messageId, $conversationId, $userId))
            event(new MessageDeleted($message));
        else
            abort(404);

    }

    public function hideConversation($conversationId, $userId = null)
    {
        $userId = $userId ? $userId : auth()->user()->id;

        return $this->messageRepository->hideConversation($conversationId, $userId);
    }

    public function unHideConversation($conversationId)
    {
        $this->messageRepository->unHideConversation($conversationId);
    }
}