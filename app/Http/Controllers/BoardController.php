<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;

use App\Suser;
use App\Board;
use App\Msg;
use App\Remsg;
use App\Good;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BoardController extends Controller
{


    public function allboard()
    {
        $boards_desc =Board::select()
            ->orderBy('id','desc')
            ->get();

        $msgs_desc =Msg::select()
            ->orderBy('id','desc')
            ->get();

        $remsg_desc = Remsg::select()
            ->orderBy('id','desc')
            ->get();


        return view('board',compact('boards_desc','msgs_desc','remsg_desc'));


    }


    //  顯示所有留言、評論、回覆，依新到舊排序
    public function all(){

        $all = Board::orderBy('id','desc')
            ->withcount('goods')
            ->with('goods')
            ->with(['msgs' => function($query){
                $query->with(['remsgs' =>function($query){
                    $query->orderBy('id','desc');
            }])->orderBy('id','desc');
        }])->get();

        return response()->json(["all"=>$all]);
    }

    public function  allgood()
    {
//        $goods_board =

    }

    public function  good()
    {
        $board_id = $_POST['board_id'];
        $user = $_POST['user'];
        $create_time = Carbon::now();

        $have_good = Good::
            where ('user_name','=',$user)
            ->where('boards_id','=',$board_id)
            ->first();

        $suser=Suser::where('user_name','=',$user)->first();
        $user_id = $suser->id;
//        dd($have_good);

        if ($have_good == null){

            $dogoood=Good::Create
            ([
                'user_id' => $user_id,
                'boards_id' => $board_id,
                'user_name' => $user,
                'create_time' => $create_time,
            ]);
//            echo  "按讚完成<br>";
//            return response()->json(["info" => "按讚完成","action" =>$dogoood]);
            return redirect()->route("allboard");

        }else{

            $nogoood=Good::where ('user_id','=',$user_id)
                ->where('boards_id','=',$board_id)
                ->delete();
            echo  "收回讚<br>";

//            return response()->json(["info" => "收回讚","action" =>$nogoood]);
            return redirect()->route("allboard");
        }


    }

    public function whogood()
    {
        session_start();

        $board_id = $_POST['board_id'];

        $who_good = Good::where('boards_id','=',$board_id)->get();

        if ($who_good != null) {

            return view('whogood',compact('who_good'));
//            foreach ($who_good as $who_end) {
//
//                $who_user_name = $who_end -> user_name;
//                $who_user_id = $who_end -> user_id;
//                echo "$who_user_id "," $who_user_name<br>";
//
//            }
        }else{
            echo "目前無人按讚";
        }

    }


    public function store()
    {
        if (isset($_POST["author"])) {

            $author = $_POST["author"];
            $content = $_POST["content"];
            $create_time = Carbon::now();

            Board::Create
            ([
                'author' => $author,
                'content' => $content,
                'create_time' => $create_time,
            ]);


            return redirect()->route("allboard");
        }
    }


    public function msg()
    {
        if (isset($_POST["board_id"])) {

            $board_id = $_POST["board_id"];
            $msg_user = $_POST["msg_user"];
            $msg = $_POST["msg"];
            $create_time = Carbon::now();

            Msg::Create
            ([
                'boards_id' => $board_id,
                'msg_user' => $msg_user,
                'msg' => $msg,
                'create_time' => $create_time,
            ]);


            return redirect()->route("allboard");
        }
    }

    public function remsg()
    {
        if (isset($_POST["board_id"])) {

            $board_id = $_POST["board_id"];
            $msg_id = $_POST["msg_id"];
            $remsg_user = $_POST["remsg_user"];
            $remsg = $_POST["remsg"];
            $create_time = Carbon::now();

            Remsg::Create
            ([
                'boards_id' => $board_id,
                'msg_id' => $msg_id,
                'remsg_user' => $remsg_user,
                'remsg' => $remsg,
                'create_time' => $create_time,
            ]);


            return redirect()->route("allboard");
        }
    }

//    public function allmsg()
//    {
//        $msgs_desc =Msg::select()
//            ->orderBy('id','desc')
//            ->get();
//
//
//        return view("board",compact('msgs_desc'));
//
//    }



}
