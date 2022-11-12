<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateOrderRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Kategori;
use App\Models\DetailOrder;
use App\Models\VarianHarga;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class ReportController extends Controller{

public function overall_report(){

    return view('report.penjualan.overall-report');
}
public function get_overall_report(Request $request){
    $from = Carbon::createFromFormat('m/d/Y', $request->all_date[0]);
    $to = Carbon::createFromFormat('m/d/Y', $request->all_date[1]);

    $total_transaksi = Order::whereDate('created_at', '>=',$from)
    ->whereDate('created_at', '<=',$to)
    ->where('status', 'Lunas')
    ->count();

    $metode_pemb = DB::table('order')
                 ->whereDate('created_at', '>=',$from)
                 ->whereDate('created_at', '<=',$to)
                 ->where('jenis_pembayaran','!=',NULL)
                 ->select('jenis_pembayaran', DB::raw('count(*) as jumlah'), DB::raw('SUM(total) as total'))
                 ->groupBy('jenis_pembayaran')
                 ->get();

    $total_penj = Order::whereDate('created_at', '>=',$from)
    ->whereDate('created_at', '<=',$to)
    ->where('status', 'Lunas')
    ->sum('total');

    $total_menu = DetailOrder::whereDate('created_at', '>=',$from)
    ->whereDate('created_at', '<=',$to)
    ->sum('jumlah');

    $top_kategori = DB::table('detail_order')
    ->whereDate('created_at', '>=',$from)
    ->whereDate('created_at', '<=',$to)
    ->join('menu','detail_order.menu_id_menu','menu.id_menu')
    ->join('kategori','menu.kategori_id_kategori','kategori.id_kategori')
    ->select('nama_kategori', DB::raw('count(*) as total'))
    ->groupBy('nama_kategori')
    ->orderBy('total','desc')
    ->first();

    $top_menu = DB::table('detail_order')
    ->whereDate('created_at', '>=',$from)
    ->whereDate('created_at', '<=',$to)
    ->join('menu','detail_order.menu_id_menu','menu.id_menu')
    ->select('menu.nama_menu', DB::raw('SUM(jumlah) as total'))
    ->groupBy('menu.nama_menu')
    ->orderBy('total','desc')
    ->first();

    return response()->json([
        'success' => true,
        'total_trans' => $total_transaksi,
        'metode_pemb' => $metode_pemb,
        'total_penj'  => $total_penj,
        'total_menu'  => $total_menu,
        'top_kategori'=> $top_kategori,
        'top_menu'    => $top_menu
    ]);

}
public function by_menu(){
    return view('report.penjualan.per-menu');
}
public function get_by_menu(Request $request){
    $from = Carbon::createFromFormat('m/d/Y', $request->all_date[0]);
    $to = Carbon::createFromFormat('m/d/Y', $request->all_date[1]);

    $menu = DB::table('detail_order')
            ->whereDate('created_at', '>=',$from)
            ->whereDate('created_at', '<=',$to)
            ->join('menu','detail_order.menu_id_menu','menu.id_menu')
            ->join('kategori','menu.kategori_id_kategori','kategori.id_kategori')
            ->select('menu.nama_menu', DB::raw('SUM(jumlah) as jumlah'), DB::raw('SUM(subtotal) as subtotal'), 'kategori.nama_kategori')
            ->groupBy('menu.nama_menu','kategori.nama_kategori')
            ->get();
    return response()->json([
        'menu' => $menu
    ]);

}
public function stok_report(){
    $ingredient = DB::table('ingredients')
            ->pluck('nama');
    return view('report.stok.stok-report',compact('ingredient'));
}
public function get_stok_report(Request $request){
    $from = Carbon::createFromFormat('m/d/Y', $request->all_date[0]);
    $to = Carbon::createFromFormat('m/d/Y', $request->all_date[1]);

    $stok = DB::table('history_stok')
            ->join('ingredients','history_stok.ingredients_id_ingredient','ingredients.id_ingredient')
            ->where('ingredients.nama',$request->ingredient)
            ->whereDate('history_stok.created_at', '>=',$from)
            ->whereDate('history_stok.created_at', '<=',$to)
            ->select('history_stok.created_at','history_stok.qty','history_stok.satuan','history_stok.jenis','ingredients.nama','history_stok.references_id')
            ->orderBy('created_at','desc')
            ->get();


    return response()->json([
        'stok' => $stok
    ]);
}


public function detail_hpp(){
    $menu = DB::table('menu')
            ->pluck('nama_menu');
    return view('report.pembelian.hpp-report',compact('menu'));
}


public function get_detail_hpp(Request $request){
    $menu = DB::table('detail_menu')
            ->join('menu','detail_menu.menu_id_menu','menu.id_menu')
            ->join('ingredients','detail_menu.ingredients_id_ingredient','ingredients.id_ingredient')
            ->where('menu.nama_menu', $request->menu)
            ->select('ingredients.nama','detail_menu.ukuran', DB::raw('ingredients.hpp_rata * detail_menu.ukuran as hpp'),'ingredients.hpp_rata')
            ->get();
        return response()->json([
            'menu' => $menu
        ]);
}
// public function tx_history()
// {
//     $order = DB::table('order')
//                 ->whereMonth('created_at', today())
//                 ->get();

//     $month = [];
//     for ($m=1; $m<=12; $m++) {
//         $month[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
//     }

//     return response()->json([
//         'success' => true,
//         'order' => $order,
//         'month' => $month
//     ]);      
// }
// public function findMonthTx(Request $request)
// {
//     $month = date('m', strtotime($request->month));
    
//     $order = DB::table('order')
//     ->whereMonth('created_at', $month)
//     ->get();
    
//     return response()->json([
//         'success' => true,
//         'order' => $order,
//     ]);
// }
// public function sales_category()
// {
//     $detail = DetailOrder::join('menu','detail_order.menu_id_menu','menu.id_menu')
//     ->join('kategori','menu.kategori_id_kategori','kategori.id_kategori')
//     ->get(['detail_order.jumlah','kategori.nama_kategori']);

//     $kategori = Kategori::all();
//     foreach($kategori as $kategoris){
//         foreach($detail as $row){
//             if($row->nama_kategori == $kategoris->nama_kategori)
//                 $kategoris->jumlah += $row->jumlah;
//         }
//     }
// }

    
}
