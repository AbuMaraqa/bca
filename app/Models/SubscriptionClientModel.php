<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionClientModel extends Model
{
    use HasFactory;

    protected $table = 'client_subscriptions';

    public function subscription()
    {
        return $this->belongsTo(SubscriptionModel::class , 'subscriptions_id' , 'id');
    }
}
