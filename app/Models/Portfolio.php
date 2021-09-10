<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsTo(CategoriesPortfolio::class, 'category_id' , 'id');
    }
}
