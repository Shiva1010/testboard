<html>


<body>

<?php
session_start();
use App\Good;

$board_id = $_POST['board_id'];


$who_good = Good::where('boards_id','=',$board_id)->get();

if ($who_good != null) {

    foreach ($who_good as $who_end) {

        $who_user_name = $who_end -> user_name;
        $who_user_id = $who_end -> user_id;
        echo "$who_user_id "," $who_user_name<br>";

    }
}else{
    echo "目前無人按讚";
}
?>


<form action='../totalboard' method='get'>
    @csrf
    <input type='submit' value='返回留言板'>
</form>

</body>
</html>



