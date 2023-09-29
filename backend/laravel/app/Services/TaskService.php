<?php

namespace App\Services;

use App\Exceptions\ArrayException;
use App\Repositories\TaskRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TaskService extends Service
{
    public function __construct(
        private TaskRepository $taskRepository,
    ) { }

    public function index($data)
    {
        return $this->taskRepository->index($data);
    }

    public function show($id)
    {
        return $this->taskRepository->show($id);
    }

    public function create($data)
    {
        $validator = Validator::make(
            $data,
            [
                'title' => [
                    'required',
                    'min:1',
                    'max:50',
                ],
                'start_date' => [
                    'required_with:start_time',
                    'date_format:Y-m-d',
                ],
                'start_time' => [
                    'date_format:H:i:s',
                ],
                'end_date' => [
                    'required_with:end_time',
                    'date_format:Y-m-d',
                ],
                'end_time' => [
                    'date_format:H:i:s',
                ],
                'category_id' => [
                    'integer',
                    'exists:categories,id',
                ],
            ]
        );

        if ($validator->fails()) {
            throw new ArrayException(
                '',
                Response::HTTP_UNPROCESSABLE_ENTITY,
                $validator->errors()->all(),
            );
        }

        return $this->taskRepository->create($data);
    }

    public function update($id, $data)
    {
        $task = $this->taskRepository->show($id);

        $validator = Validator::make(
            $data,
            [
                'title' => [
                    'required',
                    'min:1',
                    'max:50',
                ],
                'start_date' => [
                    'required_with:start_time',
                    'date_format:Y-m-d',
                ],
                'start_time' => [
                    'date_format:H:i:s',
                ],
                'end_date' => [
                    'required_with:end_time',
                    'date_format:Y-m-d',
                ],
                'end_time' => [
                    'date_format:H:i:s',
                ],
                'category_id' => [
                    'integer',
                    'exists:categories,id',
                ],
            ]
        );

        if ($validator->fails()) {
            throw new ArrayException(
                '',
                Response::HTTP_UNPROCESSABLE_ENTITY,
                $validator->errors()->all(),
            );
        }

        return $this->taskRepository->update($task, $data);
    }

    public function destroy($id)
    {
        return $this->taskRepository->destroy($id);
    }
}
