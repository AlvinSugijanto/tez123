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
use Auth;
use Illuminate\Support\Facades\Hash;


class OrderController extends Controller
{

    public function __construct()
    {
        $this->order = new Order();
        $this->detail_order = new DetailOrder();
        $this->varian_harga = new VarianHarga();

    }

    public function index()
    {
        $order = Order::where('jenis_pembayaran' ,'!=', NULL)->get();
        // $order->toArray();
        return view('order.order-index',compact('order'));
      
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
            'total' => $request['total'],
            'created_by' => Auth::user()->name
            
        ]);
        for($i=0;$i<count($request['nama_menu']);$i++){
            $detail_order[$i] = DetailOrder::create([
                'jumlah'           => $request['qty'][$i],
                'menu_id_menu'     => $this->detail_order->getMenu($request['nama_menu'][$i]),
                'order_id_order'   => $order->id_order,
                'varian'           => $request['varian'][$i],
                'subtotal'           => $request['subtotal'][$i]

            ]);
        }
        if(isset($request['jenis_pembayaran'])){
            $history_stok = $this->order->historyStok($detail_order,$order->id_order);
            $reduce_stok = $this->order->reduceStok($detail_order);
        }
        if($order){
            return response()->json([
                'success' => true,
            ]);        
        }
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

    public function getDetailOrder(Request $request){

        $id = $request->id;
        $detail = $this->detail_order->getDetail($id);
        $order = Order::where('id_order',$id)->first();
        
        return response()->json([
            'success'   => true,
            'order'     => $order,
            'detail'    => $detail
        ]);

    }
    public function editOrder($id){
        $order = Order::where('id_order',$id)->first();
        $detail = $this->detail_order->getDetail($id);
        $menu = Menu::all();
        $kategori = Kategori::all();
        return view('order.order-edit',compact('detail','menu','kategori','order'));

    }
    public function editStore(Request $request){
        $order = Order::updateOrCreate([
            'id_order'  => $request->id_order
        ],
        [
            'status' => $request['status'],
            'jenis_order'     => $request['jenis_order'],
            'jenis_pembayaran'      => $request['jenis_pembayaran'],
            'total' => $request['total'],
            'created_by' => Auth::user()->name
            
        ]);

        $this->order->findDetail($request);
        return response()->json([
            'success' => true,
        ]); 


    }
    
}
