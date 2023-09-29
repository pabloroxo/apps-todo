<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use Exception;

class TaskController extends Controller
{
    public function __construct(
        public TaskService $taskService
    ) { }

    public function index(Request $request)
    {
        $data = $request->all();

        try {
            $tasks = $this->taskService->index($data);

            return $this->responseOk($tasks);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function show($id)
    {
        try {
            $task = $this->taskService->show($id);

            return $this->responseOk($task);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            $task = $this->taskService->create($data);

            return $this->responseCreated($task);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        try {
            $task = $this->taskService->update($id, $data);

            return $this->responseOk($task);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->taskService->destroy($id);

            return $this->responseOk($result);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
