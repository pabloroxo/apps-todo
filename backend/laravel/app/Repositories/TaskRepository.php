<?php

namespace App\Repositories;

use App\Models\Task;
use Exception;
use Illuminate\Http\Response;

class TaskRepository extends Repository
{
    public function index($data)
    {
        return Task::select()
            ->when(!empty($data['title']), function ($query) use ($data) {
                $query->where('title', 'like', '%' . $data['title'] . '%');
            })
            ->when(!empty($data['description']), function ($query) use ($data) {
                $query->where('description', 'like', '%' . $data['description'] . '%');
            })
            ->when(true, function ($query) use ($data) {
                if (!empty($data['orderBy'])) {
                    $orderBy = $data['orderBy'];
                    $order = (!empty($data['order']) && $data['order'] === 'desc')
                        ? 'desc'
                        : 'asc';
                } else {
                    $orderBy = 'title';
                    $order = 'asc';
                }
                $query->orderBy($orderBy, $order);
            })
            ->with('category')
            ->paginate();
    }

    public function show($id)
    {
        return Task::findOr($id, function () {
            throw new Exception('Task not found.', Response::HTTP_NOT_FOUND);
        });
    }

    public function create($data)
    {
        return Task::create($data)
            ->fresh();
    }

    public function update($task, $data)
    {
        $task->fill($data);

        if ($task->isDirty()) {
            $task->update();
        }

        return $task;
    }

    public function destroy($id)
    {
        $task = $this->show($id);

        return $task->delete();
    }
}
