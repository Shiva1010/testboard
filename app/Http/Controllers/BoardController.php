<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Board;
use App\Msg;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BoardController extends Controller
{
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


            return view("board");
        }
    }

    public function allboard()
    {
        $boards_desc =Board::select()
            ->orderBy('id','desc')
            ->get();


        return view("board",compact('boards_desc'));

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


            return view("board");
        }
    }

    public function allmsg()
    {
        $msgs_desc =Msg::select()
            ->orderBy('id','desc')
            ->get();


        return view("board",compact('msgs_desc'));

    }



}
