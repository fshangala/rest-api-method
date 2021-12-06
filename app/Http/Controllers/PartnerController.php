<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\Partner;
use App\Models\Authorization;

class PartnerController extends Controller
{
    function __construct()
    {
        //
    }

    public function all(Request $request)
    {
        $res = ["success"=>false, "message"=>"", "data"=>null];
        $statusCode = 500;

        $partners = Partner::all();
        $res["success"]=true;
        $res["data"]=$partners;
        $statusCode=200;

        return response($res, $statusCode);
    }

    public function add(Request $request)
    {
        $res = ["success"=>false, "message"=>"", "data"=>null];
        $statusCode = 500;

        $rules = [
            'company_name' => 'required',
            'secrete' => 'required'
         ];
 
        $customMessages = [
             'required' => 'Please fill attribute :attribute'
        ];
        $this->validate($request, $rules, $customMessages);
 
        try {
            $hasher = app()->make('hash');
            $company_name = $request->input('company_name');
            $secrete = $hasher->make($request->input('secrete'));
 
            $save = Partner::create([
                'company_name'=> $company_name,
                'secrete'=> $secrete
            ]);

            $res['success'] = true;
            $res['message'] = 'Registration success!';
            $res['data'] = $save;
            $statusCode = 200;
        } catch (\Illuminate\Database\QueryException $ex) {
            $res['success'] = false;
            $res['message'] = $ex->getMessage();
        }

        return response($res, $statusCode);
    }

    public function authenticate(Request $request)
    {
        $res = ["success"=>false, "message"=>"", "data"=>null];
        $statusCode = 500;
         
        $rules = [
            'company_name' => 'required',
            'secrete' => 'required'
        ];
        $customMessages = [
           'required' => ':attribute tidak boleh kosong'
        ];
        $this->validate($request, $rules, $customMessages);

        $company_name = $request->input('company_name');
        try {
            $login = Partner::where('company_name', $company_name)->first();
            if ($login) {
                if ($login->count() > 0) {
                    if (Hash::check($request->input('secrete'), $login->secrete)) {
                        try {
                            $api_token = sha1($login->id.time());
                            $authorization = Authorization::create([
                                "partner_id"=>$login->id,
                                "token"=>$api_token
                            ]);
                            $res['success'] = true;
                            $res['message'] = "Success.";
                            $res['data'] = $authorization;
                            $statusCode = 200; 
 
                        } catch (\Illuminate\Database\QueryException $ex) {
                            $res['success'] = false;
                            $res['message'] = $ex->getMessage();
                        }
                    } else {
                        $res['success'] = false;
                        $res['message'] = 'company_name and secrete combination dont match any account in the system';
                        $statusCode = 401;
                    }
                } else {
                    $res['success'] = false;
                    $res['message'] = 'company_name and secrete combination dont match any account in the system';
                    $statusCode = 401;
                }
            } else {
                $res['success'] = false;
                $res['message'] = 'company_name and secrete combination dont match any account in the system';
                $statusCode = 401;
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            $res['success'] = false;
            $res['message'] = $ex->getMessage();
            $statusCode = 500;
        }

        return response($res, $statusCode);
    }
}