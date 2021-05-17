<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Modules\MessageCenter\Contracts\MessageService;
use Modules\MessageCenter\Requests\CreateConversationRequest;
use Modules\MessageCenter\Requests\DeleteMessageRequest;
use Modules\MessageCenter\Requests\HideConversationRequest;
use Modules\MessageCenter\Requests\LoadMoreRequest;
use Modules\MessageCenter\Requests\MarkAsReadRequest;
use Modules\MessageCenter\Requests\StoreMessageRequest;

class MessagesController extends Controller
{
    private $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function createConversation(CreateConversationRequest $request)
    {
        $ids[] = $request->user_id;
        $ids[] = auth()->user()->id;

        return $this->messageService->createConversation($ids);
    }


    public function getChatData()
    {
        return $this->messageService->getChatAppData();
    }

    public function storeMessage(StoreMessageRequest $request)
    {
        $data = $request->all();
        if ($request->type == 'attachment')
            $data['body'] = $request->attachment->store('public/messages/attachments');

        return $this->messageService->storeGeneralMessage($data);
    }

    public function markAsRead(MarkAsReadRequest $request)
    {
        return $this->messageService->markAsRead($request->conversation_id);
    }

    public function loadMore(LoadMoreRequest $request)
    {
        return $this->messageService->loadMore($request->conversation_id, $request->skip);
    }

    public function deleteMessage(DeleteMessageRequest $request)
    {

        return $this->messageService->deleteMessage($request->message_id, $request->conversation_id);
    }

    /**
     * @param HideConversationRequest $request
     * @return mixed
     */
    public function conversationHide(HideConversationRequest $request)
    {
        return $this->messageService->hideConversation($request->conversation_id);
    }
}
