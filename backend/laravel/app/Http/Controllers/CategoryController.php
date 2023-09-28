<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use Exception;

class CategoryController extends Controller
{
    public function __construct(
        public CategoryService $categoryService
    ) { }

    public function index(Request $request)
    {
        $data = $request->all();

        try {
            $categories = $this->categoryService->index($data);

            return $this->responseOk($categories);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function show($id)
    {
        try {
            $category = $this->categoryService->show($id);

            return $this->responseOk($category);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            $category = $this->categoryService->create($data);

            return $this->responseCreated($category);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        try {
            $category = $this->categoryService->update($id, $data);

            return $this->responseOk($category);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->categoryService->destroy($id);

            return $this->responseOk($result);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
