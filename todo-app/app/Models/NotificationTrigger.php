<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class NotificationTrigger extends Model
{
    protected $fillable = ['name', 'description'];

    public function subscriptions()
    {
        return $this->hasMany(\App\Models\TriggerSubscription::class);
    }



}
