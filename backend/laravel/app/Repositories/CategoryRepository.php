<?php

namespace App\Repositories;

use App\Models\Category;
use Exception;
use Illuminate\Http\Response;

class CategoryRepository extends Repository
{
    public function index($data)
    {
        return Category::select()
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
            ->paginate();
    }

    public function show($id)
    {
        return Category::findOr($id, function () {
            throw new Exception('Category not found.', Response::HTTP_NOT_FOUND);
        });
    }

    public function create($data)
    {
        return Category::create($data)
            ->fresh();
    }

    public function update($category, $data)
    {
        $category->fill($data);

        if ($category->isDirty()) {
            $category->update();
        }

        return $category;
    }

    public function destroy($id)
    {
        $category = $this->show($id);

        return $category->delete();
    }
}
