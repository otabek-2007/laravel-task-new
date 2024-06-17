<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function updateCategory($data, $id)
    {
        return DB::transaction(function () use ($data, $id) {
            $category = Category::findOrFail($id);

            if (request()->hasFile('image')) {
                $oldImage = $category->image;

                $image = request()->file('image');
                $imagePath = $image->store('public/new_category_images');
                $data['image'] = str_replace('public/', 'storage/', $imagePath);
                $url = url($data['image']);

                $category->update([
                    'name' => $data['name'],
                    'about' => $data['about'],
                    'image' => $url,
                    'user_id' => $data['user_id'],
                ]);

                if ($oldImage) {
                    $oldImagePath = str_replace('storage/', 'public/', $oldImage);
                    Storage::delete($oldImagePath);
                }
            } else {
                $category->update([
                    'name' => $data['name'],
                    'about' => $data['about'],
                    'user_id' => $data['user_id'],
                ]);
            }

            return $category;
        });

    }

    public function storeCategory($data)
    {
        return DB::transaction(function () use (&$data) {

            if (!isset($data['user_id'])) {
                $data['user_id'] = auth()->id();
            }

            $url = null;

            $url = null;
            if (request()->hasFile('image')) {
                $image = request()->file('image');
                $imagePath = $image->store('public/new_category_images');
                $data['image'] = str_replace('public/', 'storage/', $imagePath);
                $url = url($data['image']);
            }

            $categoryData = [
                'name' => $data['name'],
                'about' => $data['about'],
                'image' => $url,
                'user_id' => $data['user_id'],
            ];

            $category = Category::create($categoryData);
            return $category;
        });
    }

    public function showCategories()
    {
        $categories = Category::all();
        return $categories;
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $new = Post::where('category_id', $category->id)->delete();

        return $category->delete();
    }


}