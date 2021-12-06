<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\AdWordCampaign;
use App\Models\WebsiteDetail;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all(Request $request)
    {
        $res = ["success"=>false, "message"=>"", "data"=>null];
        $statusCode = 500;

        $entries = Order::where("partner", $request->user()->id)->get();

        $res['success'] = true;
        $res['message'] = 'success!';
        $res['data'] = $entries;
        $statusCode = 200;

        return response($res, $statusCode);
    }
    
    public function order(Request $request)
    {
        
        $res = ["success"=>false, "message"=>"", "data"=>null];
        $statusCode = 500;

        $rules = [
            'type' => 'required',
            'submitted_by' => 'required',
            'company_id' => 'required',
            'company_name' => 'required'
        ];
 
        $customMessages = [
             'required' => 'Please fill attribute :attribute'
        ];
        $this->validate($request, $rules, $customMessages);
        
        try {
            $inputData = $request->all();
            $inputData["partner"] = $request->user()->id;

            $cart = Cart::where("partner_id", $request->user()->id)->where("status", "pending")->get();
            if (count($cart)>0){
                $order = Order::create($inputData);
    
                $list_items = array();
                foreach($cart as $c){
                    $f_product = array();
                    $a_items = array();
                    $product = Product::where("id",$c->product_id)->first();
                    if ($product){
                        $a_items = $product;
                        if($product->type == "adword"){
                            $adDetail = AdWordCampaign::where("id",$c->detail_id)->first();
                            if($adDetail){
                                $a_items["AdWordCampaign"] = $adDetail;
                            }
                        } elseif ($product->type == "website"){
                            $websiteDetail = WebsiteDetail::where("id", $c->detail_id)->first();
                            if($websiteDetail){
                                $a_items["WebsiteDetails"] = $websiteDetail;
                            }
                        }
                        $f_product = $a_items;
                    }
                    array_push($list_items, $f_product);
                }
                foreach($cart as $c){
                    $c->update(["status"=>"ordered"]);
                }
                $allData = $order;
                $allData["ListItems"]=$list_items;
    
                $res['success'] = true;
                $res['message'] = 'success!';
                $res['data'] = $allData;
                $statusCode = 200;
            } else {
                $res['success'] = false;
                $res['message'] = "Add some products in the cart";
                $statusCode = 422;
            }

        } catch (\Illuminate\Database\QueryException $ex) {
            $res['success'] = false;
            $res['message'] = $ex->getMessage();
        }

        return response($res);
    }
}
