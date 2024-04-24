<?php
global $pdo;
require_once "./functions/connect.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $service = $pdo->prepare("SELECT * FROM tour WHERE id = :id");
    $service->bindParam(':id', $id);
    $service->execute();

    $res_serv = $service->fetch(PDO::FETCH_OBJ);
    $archive = 1;
    $comments = $pdo->prepare("SELECT c.*, t.title, t.price, t.datastart, t.dataend, u.name, u.login 
                            FROM comments c 
                            INNER JOIN tour t ON c.tourID = t.id 
                            INNER JOIN users u ON c.userID = u.id 
                            WHERE c.tourID = :id and c.archive = :archive
                            ORDER BY c.id DESC");

    $comments->execute([
        ':archive' => $archive,
        ':id' => $id
    ]);
    $res_comments = $comments->fetchAll(PDO::FETCH_OBJ);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Детальная информация</title>
</head>
<body>
<?php
require "NavBar/header.php";
?>
<div style="background-color: antiquewhite; text-align: center">
    <?php if(isset($res_serv)): ?>
        <h2 style="text-align: center; margin-top: 0%;"><?php echo $res_serv->title ?></h2>
        <img src="admin/realising/images/<?php echo $res_serv->image; ?>" alt="...">
        <p>Цена: <?php echo $res_serv->price; ?></p>
        <p>Начало тура: <?php echo $res_serv->datastart; ?></p>
        <p>Конец тура: <?php echo $res_serv->dataend; ?></p>
    <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] === "admin") {
        ?>
    <div class="buttons">
        <a href="admin/updateTour.php?id=<?php echo $res_serv->id; ?>" class="black-link">
            <button class="btn btn-primary ">edit</button>
        </a>
        <form style="text-align: center;" action="admin/realising/delete.php" method="post">
            <input type="hidden" name="id_to_delete" value="<?php echo $res_serv->id; ?>">
            <button type="submit" name="delete" class="btn btn-primary ">delete</button>
        </form>
    </div>
        <?php
        } else if (isset($_SESSION['login']) && $_SESSION['login'] != "admin") {
            ?>
        <div class="buttons">
            <form style="text-align: center;" action="admin/realising/response.php" method="post">
                <input type="hidden" name="response_id" value="<?php echo $res_serv->id; ?>">
                <button type="submit" name="response" class="btn btn-primary ">Откликнуться</button>
            </form>
        </div>
        <div style="padding: 2%">
            <div class="mb-3">
                <form action="admin/realising/addComment.php" method="post">
                    <label for="exampleFormControlTextarea1" class="form-label">Напишите отзыв</label>
                    <input type="hidden" name="tour_id" value="<?php echo $res_serv->id; ?>">
                    <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <button type="submit" name="send" class="btn btn-primary ">Отправить</button>
                </form>
            </div>
        </div>
    <?php
        }
        ?>
    <?php else: ?>
        <p>Страна не найдена</p>
    <?php endif; ?>
</div>
<?php if (isset($res_comments)): ?>
<?php foreach($res_comments as $com):?>
    <div class="request">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title"><?php echo $com->login?></h5>
                <br>
                <h3 class="card-text"><?php echo $com->text?></h3>
            </div>
            <?php
            if ($_SESSION['login'] === "admin" || $_SESSION['login'] === $com->login) {
            ?>
            <div class="buttons">
            <form action="admin/realising/comments.php" method="post" name="delClick">
                <input type="hidden" name="form_id" value="delete">
                <input type="hidden" name="id" value="<?php echo $com->id; ?>">
                <button class="btn btn-primary" type="submit" name="del">delete</button>
            </form>
            <?php
            }
            if ($_SESSION['login'] == "admin") {
                ?>
                <form action="admin/realising/comments.php" method="post" >
                    <input type="hidden" name="form_id" value="leave">
                    <input type="hidden" name="id" value="<?php echo $com->id; ?>">
                    <button class="btn btn-primary" type="submit" name="leave">leave</button>
                </form>
                    </div>
                <?php
            }
?>
        </div>
    </div>
<?php endforeach; ?>
<?php endif; ?>
<?php require "NavBar/footer.php"?>
</body>
</html>
<style>
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