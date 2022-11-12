<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateOrderRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Menu;
use App\Models\Purchase;
use App\Models\Kategori;
use App\Models\DetailPurchase;
use App\Models\Ingredients;
use App\Models\HistoryStok;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->detail_purchase = new DetailPurchase();
        $this->ingredients = new Ingredients();
        $this->purchase = new Purchase();


    }
    public function index()
    {
        $purchase = Purchase::all();
        $ingredients = Ingredients::all();

        return view('purchase.purchase-index',compact('purchase','ingredients'));
    }
    public function create(Request $request)
    {
        $purchase = Purchase::create([
            'id_purchase'            => $this->purchase->generateId(),
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'total'     => $request->total,
            'created_by'      => $request->created_by,
        ]);
        for($i=0;$i<count($request['nama_ingredient']);$i++){
            $detail_purchase[$i] = DetailPurchase::create([
                'jumlah'                        => $request['qty'][$i],
                'subtotal'                      => $request['subtotal'][$i],
                'ingredients_id_ingredient'     => $this->detail_purchase->getIngredient($request['nama_ingredient'][$i]),
                'purchase_id_purchase'          => $purchase->id_purchase,
            ]);
            $history_stok[$i] = HistoryStok::create([
                'qty'           => $request['qty'][$i],
                'satuan'        => 'Gram',
                'jenis'         => $request->jenis_stok,
                'ingredients_id_ingredient'     => $this->detail_purchase->getIngredient($request['nama_ingredient'][$i]),
                'references_id' => $purchase->id_purchase
            ]);
            $this->ingredients->updateHpp($request['nama_ingredient'][$i], $request['qty'][$i], $request['subtotal'][$i]);
        }
        if($purchase){
            return redirect('ingredients_purchase');
        }
      
        
    }
    public function show(Request $request){
        $detail = $this->detail_purchase->getDetail($request->id);
        return response()->json([
            'success' => true,
            'detail' => $detail
        ]);
    }
}
