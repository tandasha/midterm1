<?php
    require "init.php";

    $books = selectBooks();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="custom.css">
</head>
<body>
    <div class="container">
        <h5 class="text-center">წიგნები</h5>
        <a href="<?= siteUrl('change.php') ?>" class="btn btn-primary">დამატება</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>დასახელება</th>
                    <th>გვერდების რაოდენობა</th>
                    <th>გამოშვების თარიღი</th>
                    <th>წიგნის კოდი</th>
                    <th>ფასი</th>
                    <th>ავტორი</th>
                    <th>დამატების თარიღი</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book) : ?>
                    <tr>
                        <td><?= $book['id'] ?></td>
                        <td><?= $book['name'] ?></td>
                        <td><?= $book['page_number'] ?></td>
                        <td><?= $book['release_date'] ?></td>
                        <td><?= $book['code'] ?></td>
                        <td><?= $book['price'] ?></td>
                        <td><?= $book['author'] ?></td>
                        <td><?= $book['created_at'] ?></td>
                        <td>
                            <a class="btn btn-secondary" href="<?= siteUrl("change.php?id=$book[id]") ?>">რედაქტირება</a>
                            <a class="btn btn-danger" href="<?= siteUrl("delete.php?id=$book[id]") ?>">წაშლა</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
