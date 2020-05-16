<?php
    require "init.php";

    $book = isset($_GET['id']) ? selectBook($_GET['id']) : null;
    $isCreation = empty($book);
    $action = !$isCreation ? 'რედაქტირება' : 'დამატება';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = !empty($_POST['id']) ? $_POST['id'] : null;

        $name = $_POST['name'];
        $pageNumber = $_POST['page_number'];
        $releaseDate = $_POST['release_date'];
        $price = $_POST['price'];
        $author = $_POST['author'];

        if ($id) {
            update($id, $name, $pageNumber, $releaseDate, $price, $author);
        }
        else {
            insert($name, $pageNumber, $releaseDate, $price, $author);
        }

        redirect('/index.php');
    }
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
        <form action="" method="POST" class="form">
            <?php if (!$isCreation) : ?>
            <input type="hidden" name="id" value="<?= $book['id'] ?>">
            <?php endif; ?>
            <div class="form-group">
                <label for="">დასახელება</label>
                <input required type="text" class="form-control" name="name" value="<?= $book['name'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="">გვერდების რაოდენობა</label>
                <input required type="range" min="10" max="1000" class="form-control" name="page_number" value="<?= $book['page_number'] ?? 10 ?>">
                <label id="numbers"><?= $book['page_number'] ?? 10 ?></label>
            </div>
            <div class="form-group">
                <label for="">გამოშვების თარიღი</label>
                <input required  type="date" class="form-control" name="release_date" value="<?= $book['release_date'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="">ფასი</label>
                <input required type="number" class="form-control" name="price" value="<?= $book['price'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="">ავტორი</label>
                <input required type="text" class="form-control" name="author" value="<?= $book['author'] ?? '' ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="<?= $action ?>">
            </div>
        </form>
    </div>
</body>

<script>
    document.querySelector("[name='page_number']").addEventListener("input", function () {
        document.querySelector("#numbers").innerHTML = this.value;
    });
</script>
</html>
