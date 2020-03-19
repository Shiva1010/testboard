<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Suser;
use App\Msg;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;




class SuserController extends Controller
{

    public function test()
    {
        $getuser="試試看";

//        echo $getuser;


        return view('testqq',compact('getuser'));
    }







    public function store(Request $request)
    {
        // 確認是否有相同 account
        $check_name =Suser::where('user_name', $request->user_name)->first();

        // 如果未註冊，則進入驗證資料是否符合格式跟創建會員資料
        if($check_name == null) {

            $rules = [
                'user_name' => ['required', 'string','max:30'],
                'password' => ['required', 'string', 'min:8', 'max:20'],
            ];

            $input = request()->all();

            // 驗證請求資料規則是否符合
            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {

                return response()->json(['msg' => $validator->errors()]);

            } else {

                $api_token = Str::random(10);
                $create_time = Carbon::now();

                // hash password
                $HashPwd = Hash::make($request['password']);

                $create = Suser::create([
                    'user_name' => $request['user_name'],
                    'password' => $HashPwd,
                    'api_token' => $api_token,
                    'create_time' => $create_time,
                ]);
//                if(!isset($_SESSION)) {
//                    session_start();
//                    $_SESSION['user_name'] = $request['user_name'];
//                }

                return view('user');
            }

        } else {

            echo "此帳戶已被註冊";
//            return response()->json(['msg' => '此帳戶已被註冊'],403);
        }
    }




}
