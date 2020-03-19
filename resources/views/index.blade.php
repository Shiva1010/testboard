<html>
<body>

<form action="/user" method="post">
    @csrf
    <div style="text-align: center">
        <font size='26' color='#055d88b' family='-apple-system'>君の名は</font><br><br>
        <input size='24' type="text" name="user_name"/><br><br>
        <input size='24' type="text" name="password"/><br><br>
        <input type="submit" value="註冊">
    </div>
</form>


</body>
</html>
