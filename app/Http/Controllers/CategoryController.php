<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCategories()
    {
        $categories = (new CategoryService)->showCategories();
        return $this->sendResponse($categories);
    }
    public function destroyCategory($id)
    {
        $deleted = (new CategoryService)->deleteCategory($id);
        return $this->sendResponse($deleted);
    }
    public function storeCategory(PostRequest $request)
    {
        $category = (new CategoryService)->storeCategory($request->all());
        return $this->sendResponse($category);
    }
    public function updateCategory(PostRequest $request, $id)
    {
        $category = (new CategoryService)->updateCategory($request->all(), $id);
        return $this->sendResponse($category);
    }
}
