<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $guard = ['id'];

    public function client(){
        $this->belongsTo( Client::class );
    }

    public function items(){
        $this->hasMany( PreferenceItem::class );
    }

    public function payer(){
        $this->belongsTo( PreferencePayer::class );
    }

    public function back_urls(){
        $this->hasOne( PreferenceBackUrl::class );
    }

    public function payment_method(){
        $this->hasOne( PreferencePaymentMethod::class );
    }
}
