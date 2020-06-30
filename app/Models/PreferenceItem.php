<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreferenceItem extends Model
{
    protected $guarded = [ 'id' ];
    protected $fillable = [
        'preference_id',
        'custom_id',
        'title',
        'currency_id',
        'picture_url',
        'description',
        'category_id',
        'quantity',
        'unit_price',
    ];
}
