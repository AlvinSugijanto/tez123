<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kategori;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Datetime;
use DB;
class DashboardController extends Controller
{

    public function index()
    {
        $total_penj_harian = Order::whereDate('created_at',Carbon::now())
        ->where('status', 'Lunas')
        ->sum('total');

        $total_penj_bulanan = Order::whereMonth('created_at',Carbon::now())
        ->where('status', 'Lunas')
        ->sum('total');

        $weekStartDate = Carbon::now()->startOfWeek();
        $weekEndDate = Carbon::now()->endOfWeek();

        for($i=0;$i<7;$i++){
            $total_penj_mingguan[$i] = Order::whereDate('created_at', $weekStartDate)
            ->where('status', 'Lunas')
            ->sum('total');
            $weekStartDate = $weekStartDate->addDays(1);
        }
        $from = Carbon::now()->startOfWeek();
        $to = Carbon::now()->endOfWeek();

        $top_menu = DB::table('detail_order')
        ->whereDate('created_at', '>=',$from)
        ->whereDate('created_at', '<=',$to)
        ->join('menu','detail_order.menu_id_menu','menu.id_menu')
        ->select('menu.nama_menu', DB::raw('SUM(jumlah) as total'))
        ->groupBy('menu.nama_menu')
        ->orderBy('total','desc')
        ->first();

        $metode_pemb[0] = DB::table('order')
        ->whereDate('created_at', '>=',$from)
        ->whereDate('created_at', '<=',$to)
        ->where('jenis_pembayaran','!=',NULL)
        ->where('jenis_order','dine_in')
        ->count();
        $metode_pemb[1] = DB::table('order')
        ->whereDate('created_at', '>=',$from)
        ->whereDate('created_at', '<=',$to)
        ->where('jenis_pembayaran','!=',NULL)
        ->where('jenis_order','online_order')
        ->count();

        return view('dashboard',compact('total_penj_harian','total_penj_bulanan','total_penj_mingguan','top_menu','metode_pemb'));

    }


}
