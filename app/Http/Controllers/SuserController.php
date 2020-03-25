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

                return response()->json(['info' => $validator->errors()]);

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

//            echo "此帳戶已被註冊";
            return response()->json(['info' => '此帳戶已被註冊'],403);
        }
    }







        public function login(Request $request)
        {


            $rules = [
                'user_name' => ['required', 'string', 'max:20'],
                'password' => ['required', 'string', 'min:8', 'max:12'],
            ];

            $input = $request->all();

            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {

                return response()->json(['info' => $validator->errors()], 403);

            } else {

                $check_name = Suser::where('user_name', $request->user_name)->first();


                if ($check_name == null) {

                    return response()->json(['info' => '帳戶尚未註冊'], 403);

                } else {

                    // 從註冊名單內提取被 hash 的 password
                    $hash_password = $check_name->password;

                    $pwd = $request['password'];

                    // 將 $request 的 password 與 DB 內已被 hash 的 password 做 check
                    if (Hash::check($pwd, $hash_password)) {


                        $api_token = Str::random(10);

                        $check_name->update(['api_token' => $api_token]);

                        $now_user = Suser::where('user_name', $request->user_name)->first();
//
                        session_start();
                        $_SESSION['user_name'] = $request['user_name'];

                        return redirect()->route("allboard");

                    } else {


                        echo "密碼錯誤";
//                        return response()->json(['info' => '密碼錯誤'], 403);

                    }

                }


            }
        }


            public function logout()
            {
                session_start();

                session_destroy();

                return view('logout');
            }



    public function frontstore(Request $request)
    {
        // 確認是否有相同 user_name
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

                return response()->json(['info' => $validator->errors()],400);

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


                return response()->json(['info' => '新用戶註冊成功','create' => $create]);
            }

        } else {

//            echo "此帳戶已被註冊";
            return response()->json(['info' => '此帳戶已被註冊'],403);
        }
    }


    public function frontlogin(Request $request)
    {


        $rules = [
            'user_name' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'max:12'],
        ];

        $input = $request->all();

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {

            return response()->json(['info' => $validator->errors()], 403);

        } else {

            $check_name = Suser::where('user_name', $request->user_name)->first();


            if ($check_name == null) {

                return response()->json(['info' => '帳戶尚未註冊'], 403);

            } else {

                // 從註冊名單內提取被 hash 的 password
                $hash_password = $check_name->password;

                $pwd = $request['password'];

                // 將 $request 的 password 與 DB 內已被 hash 的 password 做 check
                if (Hash::check($pwd, $hash_password)) {


                    $api_token = Str::random(10);

                    $check_name->update(['api_token' => $api_token]);

                    $now_user = Suser::where('user_name', $request->user_name)->first();
//


                    return response()->json(['info' => '你已成功登入','now_user' => $now_user]);

                } else {


                        return response()->json(['info' => '密碼錯誤'], 403);

                }

            }

        }
    }


    public function frontlogout(Request $request)
    {


        $check_name = Suser::where('user_name', $request->user_name)->first();
        $api_token = Str::random(10);

        $check_name->update(['api_token' => $api_token]);


        return response()->json(['info' => '使用者已登出']);
    }




}
