<?php session_start();
//require "bootstrap.php";
//use Illuminate\Database\Capsule\Manager as Capsule;

////if (isset($_POST["user"])) {
////
//    $_SESSION["user"] = $_POST["user"];
////}

$user = $_SESSION["user"];

?>

    <html>
    <meta charset="UTF-8"/>
    <title>Shiva の　留言板</title>
<body>
<div style="text-align: center">
    <font size='6' color='#02C88b'>Shiva の 留言板</font><br><br>

    <form action="ormnewboard.php" method="POST">

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



<?php


    $boards_desc = Capsule::table('boards')
        ->select()
        ->orderBy('id','desc')
        ->get();

    $user_desc = Capsule::table('users')
        ->select()
        ->orderBy('id','desc')
        ->first();

    $user_id = $user_desc -> id;

    foreach ($boards_desc as $end) {

        echo "
                <div style='border:3px 	#FF7575 ridge'>
                <font size='2' color='#8b4513'>番號：{$end->id}</font><br>
                <font size='2' color='#8b4513'>留言者：</font>{$end->author}<br>
                <font size='1' color='#9D9D9D'>留言時間：{$end->create_time}</font><br>
                <br>
                <font size='2' color='#8b4513'>留言內容</font><br>
                
                {$end->content}<br><br>";


            $goods_board = $end->id;
            $count_good = Capsule::table('goods')
                ->where('boards_id','=',$goods_board)
                ->count();

        echo "                 
                <font size='2' color='#8b0000'>讚數：$count_good </font>
                <form action = 'ormgood.php' method= 'POST'>
                <input type = 'hidden' name='board_id' value='{$end->id}'>
                <input type = 'hidden' name='user_id' value=$user_id >
                <input type = 'hidden' name='user' value=$user >
                <input type='submit' name='submit' value='讚'>
                </form>
                ";

        echo "
                <form action = 'ormwhogood.php' method= 'POST'>
                <input type = 'hidden' name='board_id' value='{$end->id}'>
                <input type = 'hidden' name='user_id' value=$user_id >
                <input type = 'hidden' name='user' value=$user >
                <input type='submit' name='submit' value='查看讚者'>
                </form>
                ";


        echo "  
                <font size='1' color='#9D9D9D'>{$end->create_time}</font><br>
                <form action = 'ormmsg.php' method= 'POST'>
                <input type = 'hidden' name='board_id' value='{$end->id}'>
                <input type = 'hidden' name='msg_user' value=$user >
                <font size='2' color='#006400'>評論留言：</font><input type='text' name='msg'><br>
                <input type='submit' name='submit' value='評論'></div>
                </form>
                <br>";

        $msgs_desc = Capsule::table('msgs')
            ->select()
            ->orderBy('id','desc')
            ->get();

        foreach ($msgs_desc as $msg_end) {


            if ($end->id != $msg_end->boards_id) {
                continue;
            }

            echo "
                    <div style='border:3px #A3D1D1 ridge'	><font size='1' color='#7E3D76'>評論號：</font>{$msg_end->id}<br>
                    <font size='1' color='#7E3D76'>評論者：</font>{$msg_end->msg_user}<br>
                    <font size='1' color='#a9a9a9'>評論時間：{$msg_end->create_time}</font>
                    <br><br>
                    <font size='2' color='	#7E3D76'>評論內容</font><br>
                    <font size='1' color='black'>{$msg_end->msg}</font><br><br>

                    <form action = 'ormremsg.php' method = 'POST'>
                    <input type= 'hidden' name= 'board_id' value='{$msg_end->boards_id}'>
                    <input type= 'hidden' name= 'msg_id' value ='{$msg_end->id}'>
                    <input type= 'hidden' name= 'remsg_user' value = $user>
                    <font size='1' color='teal'>回覆評論：<input type= 'text' name= 'remsg'></font><br>
                    <div><input type='submit' name='submit' value='回覆'></div>
                    </form>
                    </div>
                    <br>";

            $remsgs_desc = Capsule::table('remsgs')
                ->select()
                ->orderBy('id','desc')
                ->get();

            foreach ($remsgs_desc as $remsg_end) {


                if ($msg_end->id != $remsg_end->msg_id) {
                    continue;
                }

                echo "
                        
                        <font size='1' color='#f08080'>回覆者：</font>
                        <font size='1' color='#5B4B00'>{$remsg_end->remsg_user}</font><br>
                        <font size='1' color='#a9a9a9'>回覆時間：{$remsg_end->create_time}</font><br>
                        <font size='1' color='#f08080'>回覆內容</font><br>
                        <font size='1' color='#5B4B00'>{$remsg_end->remsg}</font><br><br>
                       
                     ";

            }

        }

    }
    ?>

</body>
</html>