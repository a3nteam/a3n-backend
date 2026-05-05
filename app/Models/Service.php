<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'services';

    // UUID settings
    protected $keyType = 'string';
    public $incrementing = false;

    // Fillable fields (based on your schema)
    protected $fillable = [
        'name',
        'description',
    ];
}
