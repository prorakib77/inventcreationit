<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id',
        'plan_type',
        'name',
        'email',
        'phone',
        'file',
        'file_link'
    ];
    public const IMAGE_PATH = 'storage/plan_order/';

}
