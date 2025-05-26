<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles.css">
    <title>Список задач</title>
</head>
<body>

<?php
if (isset($_SESSION['user'])): ?>
    <div style="text-align: right; margin: 10px;">
        <p style="
                padding-bottom: 10px">Добро пожаловать, <?= htmlspecialchars(
                $_SESSION['user']
            ) ?></p>
        <a href="/login/logout">
            <button class="submit-btn">Выйти</button>
        </a>
    </div>
<?php
else: ?>
    <div style="text-align: right; margin: 10px;">
        <a href="/login">
            <button class="submit-btn">Войти</button>
        </a>
    </div>
<?php
endif; ?>

<div class="form-container" style="max-width: 440px;">
    <h2>Добавить задачу</h2>
    <form action="/todo/add" method="post">
        <input type="hidden" name="action" value="add">
        <div style="display: flex; gap: 10px; align-items: flex-end;">
            <label style="flex-grow: 1;">
                <span>Введите задачу:</span>
                <input type="text" name="Todo" required style="width: 100%;">
                <input type="submit" value="Добавить" class="submit-btn">
            </label>
        </div>
    </form>
</div>

<div class="form-container" style="max-width: 440px; margin-top: 20px;">
    <h2>Список задач:</h2>
    <?php
    if (!empty($todos)): ?>
        <ul style="list-style: none; padding-left: 0;">
            <?php
            foreach ($todos as $todo): ?>
                <li style="margin-bottom: 10px; display: flex; align-items: center; justify-content: space-between;">
                    <div style="width: 250px">
                        <?php
                        if ($todo['done']): ?>
                            <s><?= htmlspecialchars($todo['title']) ?></s> — ✅
                        <?php
                        else: ?>
                            <?= htmlspecialchars($todo['title']) ?> — ❌
                        <?php
                        endif; ?>
                    </div>
                    <form action="/todo/done" method="post"
                          style="margin-left: auto; margin-right: 0;">
                        <input type="hidden" name="action" value="done">
                        <input type="hidden" name="Todo_id"
                               value="<?= $todo['id'] ?>">
                        <input type="checkbox"
                               name="complete"
                            <?= $todo['done'] ? 'checked' : '' ?>
                               onchange="this.form.submit()"
                               aria-label="Отметить как выполненное">
                    </form>
                </li>
            <?php
            endforeach; ?>
        </ul>
    <?php
    else: ?>
        <p>Список задач пуст</p>
    <?php
    endif; ?>
</div>

</body>
</html>