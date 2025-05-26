<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/login/sign-in" method="post">
    <input type="hidden" name="action">
    <div style="display: flex; flex-direction: column; gap: 10px; max-width: 300px;
padding: 24px 20px; border: 2px solid darkblue; border-radius: 12px; margin: 50px auto 0">
        <label>
            <span style="display: inline-block; width: 110px">Логин:</span>
            <input type="text" name="login" required>
        </label>
        <label>
            <span style="display: inline-block; width: 110px">Пароль:</span>
            <input type="password" name="password" required>
        </label>
        <input style="width: 60px; margin: 10px auto 0" type="submit"
               value="Войти">
    </div>
</form>
</body>
</html>
