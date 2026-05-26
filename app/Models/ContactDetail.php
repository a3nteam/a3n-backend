<?php

namespace App\Models;

use App\Enum\ContactFormType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
     use HasFactory,HasUuids;
    protected $table = 'contact_details';
     protected $keyType = 'string';
     public $incrementing = false;
     protected $casts = [
    'form_type' => ContactFormType::class,
];
      protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'company',
        'phone_number',
        'service_id',
        'budget',
        'form_type',
        'service_description',
    ];
    public function service()
{
    return $this->belongsTo(Service::class);
}
}
