<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class PostService
{

    public function showPost($request, $slug)
    {
        $item = Post::where('slug', $slug)->with('category')->firstOrFail();
        return $item;
    }

    public function showPosts()
    {
        $newses = Post::with('category')->get();
        return $newses;
    }
    public function update($data, $id)
    {
        return DB::transaction(function () use ($data, $id) {
            $update = Post::findOrFail($id);
            $oldThumbnail = $update->thumbnail;

            if (request()->hasFile('thumbnail')) {
                $thumbnail = request()->file('thumbnail');
                $thumbnailPath = $thumbnail->store('public/news_medias');
                $data['thumbnail'] = str_replace('public/', 'storage/', $thumbnailPath);
                $url = url($data['thumbnail']);
            } elseif (isset($data['thumbnail']) && is_string($data['thumbnail']) && filter_var($data['thumbnail'], FILTER_VALIDATE_URL)) {
                $url = $data['thumbnail'];
            }

            $updateData = [
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'text_ru' => $data['text_ru'],
                'text_uz' => $data['text_uz'],
            ];

            if (isset($url)) {
                $updateData['thumbnail'] = $url;
            }

            $update->update($updateData);

            if (isset($url) && $oldThumbnail) {
                $oldThumbnailPath = str_replace('storage/', 'public/', $oldThumbnail);
                Storage::delete($oldThumbnailPath);
            }

            return $update;
        });
    }
    public function store($data)
    {
        return DB::transaction(function () use ($data) {
            $url = null;
            if (request()->hasFile('thumbnail')) {
                $thumbnail = request()->file('thumbnail');
                $thumbnailPath = $thumbnail->store('public/news_medias');
                $data['thumbnail'] = str_replace('public/', 'storage/', $thumbnailPath);
                $url = url($data['thumbnail']);
            }

            $new = Post::create([
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'text_ru' => $data['text_ru'],
                'text_uz' => $data['text_uz'],
                'thumbnail' => $url,
            ]);

            return $new;
        });
    }
    public function delete($id)
    {
        return Post::find($id)->delete();
    }
}
