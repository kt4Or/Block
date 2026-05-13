<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public static function uploadImage(Request $request, $image = null){
        if ($request->hasFile('thumbnail')){
            if ($image){
                Storage::disk('public')->delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('thumbnail')->store("images/{$folder}", 'public');
        }
        return null;
    }

    

}
