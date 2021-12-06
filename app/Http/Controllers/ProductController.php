<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\AdWordCampaign;
use App\Models\WebsiteDetail;
use App\Models\Cart;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addToCart(Request $request, $product_id)
    {
        $res = ["success"=>false, "message"=>"", "data"=>null];
        $statusCode = 500;

        try{
            $product = Product::find($product_id);
            if($product){
                if($product->type == "adword"){
                    $rules = [
                        "campaign_name"=>"required",
                        "campaign_address_line_1"=>"required",
                        "campaign_address_line_2"=>"required",
                        "campaign_address_post_number"=>"required",
                        "campaign_address_phone_number"=>"required",
                    ];
    
                    $customMessages = [
                        'required' => 'Please fill attribute :attribute'
                    ];
                    $this->validate($request, $rules, $customMessages);

                    $entry = AdWordCampaign::create($request->all());

                    $cartEntry = Cart::create([
                        "partner_id"=>$request->user()->id,
                        "product_id"=>$product_id,
                        "detail_id"=>$entry->id,
                    ]);

                    $res["success"]=true;
                    $res["message"]="success!";
                    $res["data"]=$entry;
                    $statusCode=200;
                }elseif ($product->type == "website"){
                    $rules = [
                        "template_id"=>"required",
                        "website_business_name"=>"required",
                        "website_address_line_1"=>"required",
                        "website_address_line_2"=>"required",
                        "website_city"=>"required",
                        "website_state"=>"required",
                        "website_post_code"=>"required",
                        "website_phone"=>"required",
                        "website_email"=>"required",
                        "website_mobile"=>"required",
                    ];
    
                    $customMessages = [
                        'required' => 'Please fill attribute :attribute'
                    ];
                    $this->validate($request, $rules, $customMessages);

                    $entry = WebsiteDetail::create($request->all());

                    $cartEntry = Cart::create([
                        "partner_id"=>$request->user()->id,
                        "product_id"=>$product_id,
                        "detail_id"=>$entry->id,
                    ]);

                    $res["success"]=true;
                    $res["message"]="success!";
                    $res["data"]=$entry;
                    $statusCode=200;
                } else {
                    $res["success"]=false;
                    $res["message"]="Product type is not recognised!";
                    $statusCode=422;
                }
            } else {
                $res["success"]=false;
                $res["message"]="Product not found!";
                $statusCode=404;
            }

        } catch (Exception $ex) {
            $res['success'] = false;
            $res['message'] = $ex->getMessage();
        }

        return response($res, $statusCode);
    }

    public function all(Request $request)
    {
        $res = ["success"=>false, "message"=>"", "data"=>null];
        $statusCode = 500;

        $entries = Product::all();

        $res["success"]=true;
        $res["message"]="success!";
        $res["data"]=$entries;
        $statusCode=200;

        return response($res, $statusCode);

    }

    public function delete(Request $request, $product_id)
    {
        $res = ["success"=>false, "message"=>"", "data"=>null];
        $statusCode = 500;
        
        try {

            $entry = Product::find($product_id);
            if($entry){
                $entry->delete();
            }

            $res["success"]=true;
            $res["message"]="success!";
            $res["data"]=$entry;

        } catch (Exception $ex) {
            $res['success'] = false;
            $res['message'] = $ex->getMessage();
        }

        return response($res, $statusCode);
    }
    
    public function add(Request $request)
    {
        
        $res = ["success"=>false, "message"=>"", "data"=>null];
        $statusCode = 500;

        $rules = [
            'type' => 'required',
            'notes' => 'required',
            'category' => 'required'
        ];
 
        $customMessages = [
             'required' => 'Please fill attribute :attribute'
        ];
        $this->validate($request, $rules, $customMessages);

        try {
            $entry = Product::create($request->all());

            $res["success"]=true;
            $res["message"]="success!";
            $res["data"]=$entry;
            $statusCode=200;
        } catch (Exception $ex) {
            $res['success'] = false;
            $res['message'] = $ex->getMessage();
        }

        return response($res, $statusCode);
    }
}
