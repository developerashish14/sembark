<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\GenrateUrl;
use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;



class ClientController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('users')->user();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        
        if($this->user->role != 'superadmin'){
            abort(401);
        }
        if ($request->isMethod('post')) {
            $query = Company::select('*');
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return  $row->name;
                })
                ->addColumn('users', function ($row) {
                    return  $row->users->count();
                })
                ->addColumn('total_genrated_url', function ($row) {
                    return  $row->getUrlcount->first() ? $row->getUrlcount->first()->total_genrated_url : 0;
                })
                ->addColumn('total_hit_url', function ($row) {
                    return $row->getUrlcount->first() ? $row->getUrlcount->first()->total_hit_url : 0;
                })
                ->addColumn('created_at', function ($row){
                    return Carbon::parse($row->created_at)->format('d M Y h:i A');
                })
                ->make(true);
        }else{
            return view('client');
        }
        
    }


    public function inviteClient(Request $request){
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required',
        ]);
        if(!$validator->fails()){
            try{
                $company = new Company();
                $company->name = $request->company_name;
                $company->created_at =Carbon::now();
                $company->updated_at =Carbon::now();
                $company->save();
                $adminuser = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => $request->password,
                    'company_id' => $company->id,
                    'role' => "admin",
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ];

                $user = User::create($adminuser);
                if($user){
                    $response['success']=true;
                    $response['alert1']='Client request send successfully'; 
                }else{
                    $response['message']['refrence'] = 'Error! Please try again';
                }

            }catch(\Exception $e){
                
                $response['message']['refrence'] = 'Error! Please try again';
            }
            
        }else{
            $response['border'] = true; 
            foreach($validator->errors()->getMessages() as $key => $value){
                $response['message'][$key] = $value[0];
            }
        }
         return json_encode($response);
    }

}
