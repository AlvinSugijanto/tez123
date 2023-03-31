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
use App\Models\OtherPurchase;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class OtherPurchaseController extends Controller
{
    public function __construct()
    {
        $this->detail_purchase = new DetailPurchase();
        $this->ingredients = new Ingredients();
        $this->purchase = new Purchase();


    }
    public function index()
    {
        $purchase = OtherPurchase::all();
        // $ingredients = Ingredients::all();
        return view('purchase.purchase-other',compact('purchase'));
    }
    public function create(Request $request)
    {
        $purchase = OtherPurchase::create([
            'items' => $request->item,
            'description'     => $request->description,
            'total'     => $request->total,
            'created_by'      => $request->created_by,
        ]);
        if($purchase){
            return response()->json(['success' => true]);
        }
      
        
    }
    public function edit(Request $request){
        $purchase = OtherPurchase::where('id_other_purchase', $request->id)->first();
        return response()->json([
            'success' => true,
            'purchase' => $purchase
        ]);
    }
    public function update(Request $request)
    {
        $purchase = OtherPurchase::where('id_other_purchase',$request->id)
                        ->update([
                            'items' => $request->item,
                            'description' => $request->description,
                            'total' => $request->total,
                            'created_by' => $request->created_by,
                        ]);
        return response()->json([
            'success' => true,
        ]);
    }
}
