<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Purchase extends Model
{
    protected $table = 'purchase';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'id_purchase',
        'jenis_pembayaran',
        'total',
        'created_by',
        'created_at'
    ];
    public function generateId()
    {
        $count = $this->count()+1;
        if($count<10)
        {
            $count = '0'.$count;
        }
        $day = Carbon::now()->format('d');
        return 'PRC-EK'.$day.$count;
    }
}
