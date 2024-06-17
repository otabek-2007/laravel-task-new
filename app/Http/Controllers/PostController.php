<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function storePost(PostRequest $request)
    {
        $validatedData = $request->validated();
        $news = (new PostService)->store($validatedData);
        return $this->sendResponse($news);
    }

    public function updatePost(PostRequest $request, $id = null)
    {
        $news = (new PostService)->update($request->all(), $id);
        return $this->sendResponse($news);
    }

    public function destroy($id)
    {
        $deleted = (new PostService)->delete($id);
        return $this->sendResponse($deleted);
    }

    public function showPosts()
    {
        $newses = (new PostService)->showPosts();
        return $this->sendResponse($newses);
    }

    public function showPost(Request $request, $slug)
    {
        $showItem = (new PostService())->showPost($request, $slug);
        return $this->sendResponse($showItem);
    }
}
