<?php session_start();
use App\Board;

$user = $_SESSION["user_name"];

?>

<html>
<meta charset="UTF-8"/>
<title>Shiva の　留言板</title>
<body>
<div style="text-align: center">
    <font size='6' color='#02C88b'>Shiva の 留言板</font><br><br>

    <form action="../board/store" method="POST">
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



<div style='border:3px 	#FF7575 ridge'>

    <?php
        $boards_desc =Board::select()
        ->orderBy('id','desc')
        ->get();
    ?>

    @foreach ($boards_desc as $end)
            @csrf
    <font size='2' color='#8b4513'>番號：{{$end->id}}</font><br>
    <font size='2' color='#8b4513'>留言者：</font>{{$end->author}}<br>
    <font size='1' color='#9D9D9D'>留言時間：{{$end->create_time}}</font><br>
    <br>
    <font size='2' color='#8b4513'>留言內容</font><br>

        {{$end->content}}<br><br>
            <font size='1' color='#9D9D9D'>{$end->create_time}</font><br>
            <form action = '../msg/store' method= 'POST'>
                @csrf
                <input type = 'hidden' name='board_id' value={{$end->id}}>
                <input type = 'hidden' name='msg_user' value=$user >
                <font size='2' color='#006400'>評論留言：</font><input type='text' name='msg'><br>
                <input type='submit' name='submit' value='評論'>
            </form>
            <br>";

    @endforeach
</div>





</body>
</html>