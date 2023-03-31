<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class OtherPurchase extends Model
{
    protected $table = 'other_purchase';
    public $timestamps = true;

    protected $fillable = [
        'id_other_purchase',
        'items',
        'description',
        'total',
        'created_by',
        'created_at',
        'updated_at'
    ];
}
