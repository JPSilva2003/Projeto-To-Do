<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushSubscription extends Model
{
    protected $fillable = ['endpoint', 'public_key', 'auth_token'];


    public function triggers()
    {
        return $this->belongsToMany(NotificationTrigger::class, 'trigger_subscriptions');
    }

}
