<html>

<body>

<form action="register" method="post">
    @csrf
    <div style="text-align: center">
        <font size='26' color='#055d88b' family='-apple-system'>君の名は</font><br><br>
        Name：<input size='24' type="text" name="user_name"/><br><br>
        Password：<input size='24' type="text" name="password"/><br><br>
        <input type="submit" value="註冊">
    </div>
</form>

</body>
</html>
