<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleOrder extends Model
{
    use HasFactory;
    protected $fillable = [
       'service_id',
        'name',
        'email',
        'phone',
        'file_link',
        'file',
       'service_name',
       'service_price',
    ];
    public const IMAGE_PATH = 'storage/single_order/';
}
