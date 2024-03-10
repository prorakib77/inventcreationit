<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
       'service_name',
       'service_slug',
       'service_description',
       'service_image',
    ];


    public function ServicePackItems(): HasMany
    {
        return $this->hasMany(ServicePackItem::class);
    }
    
}
