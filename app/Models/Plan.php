<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;


    protected $fillable = [
        'plan_name',
        'plan_description',
        'plan_price',
    ];


    public function planItems(): HasMany
    {
        return $this->hasMany(PlanItem::class);
    }
}
