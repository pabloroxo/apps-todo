<?php

namespace App\Repositories;

use App\Models\Category;
use Exception;
use Illuminate\Http\Response;

class CategoryRepository extends Repository
{
    public function index($data)
    {
        $categories = Category::select()

            // Filters
            ->when(!empty($data['title']), function (&$query) use ($data) {
                $query->where('title', 'like', '%' . $data['title'] . '%');
            })
            ->when(!empty($data['description']), function (&$query) use ($data) {
                $query->where('description', 'like', '%' . $data['description'] . '%');
            })

            // Ordering
            ->when(!empty($data['orderBy']), function (&$query) use ($data) {
                $order = (!empty($data['order']) && $data['order'] === 'desc')
                    ? 'desc'
                    : 'asc';
                $query->orderBy($data['orderBy'], $order);
            })

            ->paginate();

        return $categories;
    }

    public function show($id)
    {
        $category = Category::select()
            ->where('id', $id)
            ->first();

        if (!$category) {
            throw new Exception('Category not found.', Response::HTTP_NOT_FOUND);
        }

        return $category;
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
