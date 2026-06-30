<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
         use HasFactory,HasUuids;
             protected $table = 'blogs';
     protected $keyType = 'string';
     public $incrementing = false;
         protected $fillable = [
        'autoseo_id',
        'source',
        'title',
        'slug',
        'content',
        'excerpt',
        'description',
        'keywords',
        'meta_keywords',
        'status',
        'published_at',
        'hero_image',
        'info_graphic_image',
        'language',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
