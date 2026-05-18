<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, Sluggable;

    
    protected $fillable = ['title', 'description', 'content', 'category_id', 'thumbnail', 'views'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getImage()
    {
        if (!$this->thumbnail) {
            return asset("no-image.png");
        }
        
        return Storage::url($this->thumbnail);
    }

    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile('thumbnail')) {
            if ($image) {
                Storage::disk('public')->delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('thumbnail')->store("images/{$folder}", 'public');
        }
        return null;
    }

    public function getPostDate()
    {
        
        return $this->created_at ? $this->created_at->format('d F, Y') : '';
    }
    

}
