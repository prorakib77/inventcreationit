<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicePackItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'package_name',
        'package_price',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
