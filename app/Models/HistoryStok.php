<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class HistoryStok extends Model
{
    protected $table = 'history_stok';
    protected $primaryKey = 'id_history_stok';
    public $timestamps = true;

    protected $fillable = [
        'qty',
        'satuan',
        'ingredients_id_ingredient',
        'jenis',
        'references_id'
    ];


    public function store($request){
        $this->create([
            'jenis' => $request['jenis_stok'],
            'ukuran' => $request['ukuran'],
            'satuan' => 'gram',
            'ingredients_id_ingredient' => $request['id'],
        ]);
    }
}
