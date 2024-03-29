<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trail extends Model
{
    use HasFactory;
    public const IMAGE_PATH = 'storage/trails/';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'file',
    ];
}
