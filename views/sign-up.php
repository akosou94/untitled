<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<form class="auto" action="/login/sign-up" method="post">
    <input type="hidden" name="action">

    <div class="form-container">
        <h1>Регистрация</h1>
        <label>
            <span>Логин</span>
            <input type="text" name="login" required>
        </label>
        <label>
            <span>Пароль</span>
            <input type="password" name="password" required>
        </label>
        <button class="submit-btn" type="submit">Зарегистрироваться</button>
    </div>
</form>

</body>
</html>