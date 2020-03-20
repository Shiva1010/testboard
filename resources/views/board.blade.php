<?php session_start();
use App\Good;
$user = $_SESSION["user_name"];

?>

<html>
<meta charset="UTF-8"/>


<title>Shiva の　留言板</title>



<body>

<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }



    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }
</style>

<div class="links">
    <a href="http://localhost:8000/">返回首頁</a>

</div>
<div style="padding:10px">
<form action="../suser/logout" method="POST">
    @csrf
    <input type="submit" name="submit" value="登出"><br>
</form>
</div>

<div style="text-align: center">
    <font size='6' color='#02C88b'>Shiva の 留言板</font><br><br>

    <form action="../storeboard" method="POST">
    @csrf
        <font size='4' color='#02C7c'>
            留言者<br>
            <input type='hidden' name='author' value=<?= $user; ?>>
            <font size='4' color="#796a55"><?= $user; ?></font><br><br>

            <!--            留言內容<br><input type="text" name="content" id="content" border="3" style="width:200px; height:50px;"><br>-->
            留言內容<br><textarea name="content" rows="5" cols="35"></textarea><br>
        </font>
        <input type="submit" name="submit" value="新增留言"><br>

    </form>
</div>


    @foreach ($boards_desc as $end)

            <div style='border:3px 	#FF7575 ridge'>
            <font size='2' color='#8b4513'>番號：{{$end->id}}</font><br>
            <font size='2' color='#8b4513'>留言者：</font>{{$end->author}}<br>
            <font size='1' color='#9D9D9D'>留言時間：{{$end->create_time}}</font><br>
            <br>
            <font size='2' color='#8b4513'>留言內容</font><br>

            {{$end->content}}<br><br>


{{--<!--                --><?php--}}
{{--                $goods_board = $end->id;--}}
{{--                $count_good =Good::where('boards_id','=',$goods_board)->count();--}}
{{--                ?>--}}

{{--                <font size='2' color='#8b0000'>讚數：$count_good </font>--}}
                <form action = '../good' method= 'POST'>
                    @csrf
                    <input type = 'hidden' name='board_id' value={{$end->id}}>
                    <input type = 'hidden' name='user' value=<?= $user; ?>>
                    <input type='submit' name='submit' value='讚'>
                </form>

                <form action = '../whogood' method= 'POST'>
                    @csrf
                    <input type = 'hidden' name='board_id' value={{$end->id}}>
                    <input type = 'hidden' name='user' value=<?= $user; ?>>
                    <input type='submit' name='submit' value='查看讚者'>
                </form>

            <form action = "../msg" method= "POST">
                @csrf
                <input type = 'hidden' name='board_id' value={{$end->id}}>
                <input type = 'hidden' name='msg_user' value=<?= $user; ?> >
                <font size='2' color='#006400'>評論留言：</font><input type='text' name='msg'><br>
                <input type='submit' name='submit' value='評論'>
            </form>
                <br></div>


        @foreach( $msgs_desc as $msg_end)

                    @if ($end->id != $msg_end->boards_id)
                     @continue;
                    @endif

            <div style='border:3px #A3D1D1 ridge'	><font size='1' color='#7E3D76'>評論號：</font>{{$msg_end->id}}<br>
                <font size='1' color='#7E3D76'>評論者：</font>{{$msg_end->msg_user}}<br>
                <font size='1' color='#a9a9a9'>評論時間：{{$msg_end->create_time}}</font>
                <br><br>
                <font size='2' color='	#7E3D76'>評論內容</font><br>
                <font size='1' color='black'>{{$msg_end->msg}}</font><br><br>

                <form action = '../remsg' method = 'POST'>
                    @csrf
                    <input type= 'hidden' name= 'board_id' value={{$msg_end->boards_id}}>
                    <input type= 'hidden' name= 'msg_id' value ={{$msg_end->id}}>
                    <input type= 'hidden' name= 'remsg_user' value = <?= $user ?>>
                    <font size='1' color='teal'>回覆評論：<input type= 'text' name= 'remsg'></font><br>
                    <div><input type='submit' name='submit' value='回覆'></div>
                </form><br>
            </div>


            @foreach($remsg_desc as $remsg_end)

                    @if($msg_end->id != $remsg_end->msg_id)
                        @continue
                    @endif

                    <font size='1' color='#f08080'>回覆者：</font>
                    <font size='1' color='#5B4B00'>{{$remsg_end->remsg_user}}</font><br>
                    <font size='1' color='#a9a9a9'>回覆時間：{{$remsg_end->create_time}}</font><br>
                    <font size='1' color='#f08080'>回覆內容</font><br>
                    <font size='1' color='#5B4B00'>{{$remsg_end->remsg}}</font><br><br>

            @endforeach

        @endforeach

    @endforeach

</body>
</html>