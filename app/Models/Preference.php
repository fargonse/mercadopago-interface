<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'preference_payer_id',
        'client_id',
        'auto_return',
        'notification_url',
        'external_reference',
        'expires',
        'expiration_date_from',
        'expiration_date_to',
    ];

    public function client(){
        return $this->belongsTo( Client::class );
    }

    public function items(){
        return $this->hasMany( PreferenceItem::class );
    }

    public function payer(){
        return $this->belongsTo( PreferencePayer::class, 'preference_payer_id' );
    }

    public function back_urls(){
        return $this->hasOne( PreferenceBackUrl::class );
    }

    public function payment_method(){
        return $this->hasOne( PreferencePaymentMethod::class );
    }
}
