<?php

namespace App\Services;

use App\Exceptions\ArrayException;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CategoryService extends Service
{
    public function __construct(
        private CategoryRepository $categoryRepository,
    ) { }

    public function index($data)
    {
        return $this->categoryRepository->index($data);
    }

    public function show($id)
    {
        return $this->categoryRepository->show($id);
    }

    public function create($data)
    {
        $validator = Validator::make(
            $data,
            [
                'title' => [
                    'required',
                    'min:1',
                    'max:25',
                    'unique:categories,title,NULL,id,deleted_at,NULL',
                ],
                'color' => [
                    'required',
                    'size:7',
                    'regex:/#([0-9a-f]{3}|[0-9a-f]{6})\\b/i',
                ]
            ]
        );

        if ($validator->fails()) {
            throw new ArrayException(
                '',
                Response::HTTP_UNPROCESSABLE_ENTITY,
                $validator->errors()->all(),
            );
        }

        return $this->categoryRepository->create($data);
    }

    public function update($id, $data)
    {
        $category = $this->categoryRepository->show($id);

        $validator = Validator::make(
            $data,
            [
                'title' => [
                    'required',
                    'min:1',
                    'max:25',
                    'unique:categories,title,' . $id . ',id,deleted_at,NULL',
                ],
                'color' => [
                    'required',
                    'size:7',
                    'regex:/#([0-9A-F]{6})\b/i/',
                ]
            ]
        );

        if ($validator->fails()) {
            throw new ArrayException(
                '',
                Response::HTTP_UNPROCESSABLE_ENTITY,
                $validator->errors()->all(),
            );
        }

        return $this->categoryRepository->update($category, $data);
    }

    public function destroy($id)
    {
        return $this->categoryRepository->destroy($id);
    }
}
