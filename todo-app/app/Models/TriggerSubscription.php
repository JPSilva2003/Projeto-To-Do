<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TriggerSubscription extends Model
{
    protected $fillable = ['push_subscription_id', 'notification_trigger_id'];

    public function pushSubscription()
    {
        return $this->belongsTo(\App\Models\PushSubscription::class);
    }

    public function trigger()
    {
        return $this->belongsTo(NotificationTrigger::class, 'notification_trigger_id');
    }
}
