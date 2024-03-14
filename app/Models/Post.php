<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $fillable=[
        'title',
        'description',
        'content',
        'image',
        'view_counts',
        'new_post',
        'slug',
        'user_id',
        'category_id',
        'highlight_post',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function category()
    {
            return $this->belongsTo(Category::class,'category_id','id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id','id');
    }
    public function imageURL()
    {
        return '/image/post/'.$this->image;
    }
}
