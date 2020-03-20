<html>

<body>


    <div style="text-align: center">
        <font size='26' color='#055d88b' family='-apple-system'>君の名は</font><br><br>
        <form action="register" method="post">
            @csrf
            Name：<input size='24' type="text" name="user_name"/><br><br>
            Password：<input size='24' type="text" name="password"/><br><br>
            <input type="submit" value="註冊"><br><br>
        </form>
        <form action="../login" method="post">
            @csrf
            Name：<input size='24' type="text" name="user_name"/>
            Password：<input size='24' type="text" name="password"><br><br>
            <input type="submit" value="登入">
        </form>


    </div>


</body>
</html>
