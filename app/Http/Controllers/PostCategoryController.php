<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostCategorService;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function showCategories()
    {
        $categories = (new PostCategorService)->showCategories();
        return $this->sendResponse($categories);
    }
    public function destroyCategory($id)
    {
        $deleted = (new PostCategorService)->deleteCategory($id);
        return $this->sendResponse($deleted);
    }
    public function storeCategory(PostRequest $request)
    {
        $category = (new PostCategorService)->storeCategory($request->all());
        return $this->sendResponse($category);
    } 
    public function updateCategory(PostRequest $request, $id)
    {
        $category = (new PostCategorService)->updateCategory($request->all(), $id);
        return $this->sendResponse($category);
    } 
}
