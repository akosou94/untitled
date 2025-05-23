<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <form action="/todo/add" method="post">
        <input type="hidden" name="action" value="add">
        <div style="display: flex; gap: 10px;">
            <label>
                Введите задачу:
                <input type="text" name="Todo" required>
            </label>
            <input type="submit" value="Добавить">
        </div>
    </form>

    <h1>
        Список задач:
    </h1>

    <?php
    if (!empty($todos)): ?>
        <ul>
            <?php
            foreach ($todos as $todo): ?>
                <li>
                    <?php
                    if ($todo['done']): ?>
                        <s><?= $todo['title'] ?></s> —
                    <?php
                    else: ?>
                        <?= $todo['title'] ?> —
                    <?php
                    endif; ?>
                    <?= $todo['done'] ? '✅' : '❌' ?>

                    <form action="/todo/done" method="post"
                          style="display:inline;">
                        <input type="hidden" name="action" value="done">
                        <input type="hidden" name="Todo_id"
                               value="<?= $todo['id'] ?>">
                        <input type="checkbox"
                               name="complete"
                            <?= $todo['done'] ? 'checked' : '' ?>
                               onchange="this.form.submit()">
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

