<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\MessageCenter\Contracts\SystemMessageService;
use Modules\MessageCenter\Requests\CreateSystemMessageRequest;
use Modules\MessageCenter\Requests\UpdateSystemMessageRequest;

class SystemMessageController extends Controller
{
    private $systemMessageService;

    public function __construct(SystemMessageService $service)
    {
        $this->systemMessageService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = $this->systemMessageService->getPaginated();

        return view('admin.system-messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.system-messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSystemMessageRequest $request)
    {
        $data = $request->all();
        $message = $this->systemMessageService->create($data);
        flash('System Message added successfully', 'success');

        return $this->redirectTo();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = $this->systemMessageService->findById($id);

        return view('admin.system-messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = $this->systemMessageService->findById($id);

        return view('admin.system-messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSystemMessageRequest $request, $id)
    {
        $data = $request->all();
        $this->systemMessageService->update($id, $data);
        flash('Successfully Updated!');

        return $this->redirectTo();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->systemMessageService->delete($id);
        flash('Successfully deleted!');

        return $this->redirectTo();
    }

    public function redirectTo()
    {
        return redirect()->route('admin.system-messages.index');
    }
}
