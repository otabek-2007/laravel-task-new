<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "user_id",
        "about",
        "slug",
        "image"
    ];

    protected static function booted(): void
    {
        static::creating(function (PostCategory $model) {
            $model->slug = self::generateUniqueSlug($model->name);
        });
    }

    protected function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
