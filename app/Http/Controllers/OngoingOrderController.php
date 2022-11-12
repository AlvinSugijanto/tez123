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

use Illuminate\Support\Facades\Hash;


class OngoingOrderController extends Controller
{

    public function __construct()
    {
        $this->order = new Order();
        $this->detail_order = new DetailOrder();
        $this->varian_harga = new VarianHarga();

    }

    public function index()
    {
        $order = Order::where('status','Belum Lunas')->get();
        
        return view('order.ongoing-order',compact('order'));
    }

    public function create_order()
    {
        $menu = Menu::all();
        $kategori = Kategori::all();

        return view('order.order-create',compact('menu','kategori'));
    }
    public function store(Request $request)
    {
        $order = Order::create([
            'id_order'  => $this->order->generateId(),
            'status' => $request['status'],
            'jenis_order'     => $request['jenis_order'],
            'jenis_pembayaran'      => $request['jenis_pembayaran'],
            'total' => $request['total']
        ]);
        for($i=0;$i<count($request['nama_menu']);$i++){
            DetailOrder::create([
                'jumlah'           => $request['qty'][$i],
                'menu_id_menu'     => $this->detail_order->getMenu($request['nama_menu'][$i]),
                'order_id_order'   => $order->id_order,
                'varian'           => $request['varian'][$i]
            ]);
        }
        if($order){
            return redirect('/menu');
        }
        return 400;
    }

    public function getHarga(Request $request)
    {
        $varian_harga = $this->varian_harga->getMenu($request->nama_menu);

        return response()->json([
            'success' => true,
            'varian_harga' => $varian_harga
        ]);

    }
    public function show(Request $request){
        $detail = $this->detail_order->getDetail($request->id);
        // dd($detail);
        return response()->json([
            'success' => true,
            'detail' => $detail
        ]);
    }
    
}
