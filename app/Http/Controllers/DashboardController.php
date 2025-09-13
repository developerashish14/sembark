<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Yajra\DataTables\Facades\DataTables;
use App\Models\GenrateUrl;
use Carbon\Carbon;
use Validator;

class DashboardController extends Controller
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
        if ($request->isMethod('post')) {

            if($this->user->role == 'superadmin'){
                $query = GenrateUrl::select('*');
            }elseif($this->user->role == 'admin'){
                $query = GenrateUrl::select('*')->where('company_id',$this->user->company_id);
            }elseif($this->user->role == 'member'){
                $query = GenrateUrl::select('*')->where('member_id',$this->user->id);
            }

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('company', function ($row) {
                    return $row->company->name;
                })
                ->addColumn('short_url', function ($row) {
                    return URL('semx/'.$row->short_url);
                })
                ->addColumn('created_at', function ($row){
                    return Carbon::parse($row->created_at)->format('d M Y h:i A');
                })
                ->make(true);

        }else{
            return view('dashboard');
        }
        
    }


    public function genrateurl(Request $request){
        $validator = Validator::make($request->all(), [
            'long_url' => 'required',
        ]);
        if(!$validator->fails()){
            $input = [
                'long_url' => $request->long_url,
                'short_url' => GenrateUrl::genrateShortUrl(),
                'company_id' => $this->user->company_id,
                'member_id' => $this->user->role == 'member' ? $this->user->id : null,
                'created_by' => $this->user->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ];
            $user = GenrateUrl::create($input);
            if($user){
                $response['success']=true;
                $response['alert1']='Url successfully genrate'; 
            }else{
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


    public function logout(Request $request)
    {
        Auth::guard('users')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }

}
