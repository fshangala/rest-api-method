<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function partnerCart(Request $request)
    {
        
        $res = ["success"=>false, "message"=>"", "data"=>null];
        $statusCode = 500;

        if ($request->user()){
            $entries = Cart::where("partner_id", $request->user()->id)->get();

            $res["success"] = true;
            $res["message"] = "Cart retrieved";
            $res["data"] = $entries;
            $statusCode = 200;
        }

        return response($res, $statusCode);
    }
}
