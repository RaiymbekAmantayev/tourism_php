<?php
$user = "root";
$password = "";
$host = "localhost";
$db = "tourism";
$dbn = "mysql:host=".$host.';dbname='.$db.';charset=utf8';
$pdo = new PDO($dbn, $user, $password);
$pdo->exec("USE $db");

// Получаем значение из формы поиска
$search_login = isset($_GET['login']) ? $_GET['login'] : '';

// Формируем запрос с учетом фильтрации по логину пользователя
$sql = "SELECT c.*, t.title, t.price, t.datastart, t.dataend, u.name, u.login FROM comments c INNER JOIN tour t ON c.tourID = t.id INNER JOIN users u ON c.userID = u.id WHERE c.archive IS NULL";

// Добавляем условие для фильтрации, если указан логин
if (!empty($search_login)) {
    $sql .= " AND u.login = :login";
}

$sql .= " ORDER BY id DESC";

$service = $pdo->prepare($sql);

// Подставляем значение в запрос, если логин указан
if (!empty($search_login)) {
    $service->bindParam(':login', $search_login, PDO::PARAM_STR);
}

$service->execute();
$res_serv = $service->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Requests</title>
    <link rel="stylesheet" href="/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<?php require "../NavBar/header_admin.php" ?>
<body>
<h1 style="text-align: center">Комментарии пользователей на туры</h1>
<form method="GET" action="">
    <div class="form-group">
        <label for="login">Поиск по логину пользователя:</label>
        <input type="text" class="form-control" id="login" name="login" placeholder="Введите логин">
    </div>
    <button type="submit" class="btn btn-primary">Поиск</button>
</form>
<?php foreach($res_serv as $serv):?>
    <div class="request">
        <div class="card h-100">
            <div class="card-body">
                <a class="black-link" href="/detailTour.php?id=<?php echo $serv->tourID; ?>" >
                    <h5 class="card-title">Названия тура: <?php echo $serv->title?></h5>
                </a>
                <h5 class="card-title">Логин пользователя: <?php echo $serv->login?></h5>
                <h5 class="card-title">Текст: <?php echo $serv->text?></h5>
            </div>
            <div class="buttons">
            <form action="realising/comments.php" method="post" >
                <input type="hidden" name="form_id" value="delete">
                <input type="hidden" name="id" value="<?php echo $serv->id; ?>">
                <button class="btn btn-danger" type="submit" name="del">delete</button>
            </form>
            <form action="realising/comments.php" method="post">
                <input type="hidden" name="form_id" value="show">
                <input type="hidden" name="id" value="<?php echo $serv->id; ?>">
                <button class="btn btn-success" type="submit" name="show">show</button>
            </form>
            <form action="realising/comments.php" method="post" >
                <input type="hidden" name="form_id" value="leave">
                <input type="hidden" name="id" value="<?php echo $serv->id; ?>">
                <button class="btn btn-warning" type="submit" name="leave">archive</button>
            </form>
            <form action="updateComment.php?id=<?php echo $serv->id; ?>" method="post" >
                <input type="hidden" name="form_id" value="leave">
                <input type="hidden" name="id" value="<?php echo $serv->id; ?>">
                <button class="btn btn-primary" type="submit" name="leave">update</button>
            </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<a href="archives.php"><button class="btn btn-primary" type="submit">Archives</button></a>
<?php require "../NavBar/footer.php" ?>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: cyan;
    }
    .requests {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .request {
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .request h3 {
        margin-top: 0;
        font-size: 18px;
        color: #333;
    }
    .request p {
        margin: 5px 0;
        font-size: 16px;
    }
</style>