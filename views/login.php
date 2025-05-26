<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles.css">
    <title>Войти</title>
</head>
<body>

<form class="auto" action="/login/sign-in" method="post">
    <input type="hidden" name="action">

    <div class="form-container">
        <h1>Войти</h1>
        <label>
            <span>Логин</span>
            <input type="text" name="login" required>
        </label>
        <label>
            <span>Пароль</span>
            <input type="password" name="password" required>
        </label>
        <button class="submit-btn" type="submit">Войти</button>
    </div>
</form>

</body>
</html>