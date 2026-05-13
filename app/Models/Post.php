<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'description', 'content', 'category_id', 'thumbnail'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sluggable():array
    {
        return [
            'slug' =>[
                'source'
            ]
        ];
    }

    public function getImage(){

        if (!$this->thumbnail) {
        return asset("no-image.png");
    }
    return asset("uploads/{$this->thumbnail}");
    
    }

    

}
