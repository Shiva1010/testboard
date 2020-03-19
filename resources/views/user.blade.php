<?php
session_start();

    $_SESSION["user_name"]=$_POST["user_name"];

?>
新增 User 成功 <br>
<form action = '/board' method = 'POST'>
    @csrf
    <input type='submit' name='submit' value='返回留言板'>
</form>

