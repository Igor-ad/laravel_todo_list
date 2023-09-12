<?php

namespace App\Services\Task;

use App\Exceptions\ProcessingException;
use App\Models\User;
use App\Repositories\TaskRepository;
use App\Services\ResponseService;
use Illuminate\Support\Facades\Auth;

class ShowService
{
    public function __construct(
        protected TaskRepository  $repository,
        protected ResponseService $response,
    )
    {
    }

    /**
     * @param int $id
     * @return ResponseService
     * @throws ProcessingException
     */
    public function show(int $id): ResponseService
    {
        $result = User::find(Auth::id())->tasks()
            ->where('id', $id)
            ->first();
        if ($result) {
            $this->response->setTaskShowData($id, $result);
        } else {
            throw new ProcessingException(
                message: __('task.not_found', ['id' => $id]),
            );
        }
        return $this->response;
    }
}
