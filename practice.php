<?php global $pdo;
require_once "./functions/connect.php";  ?>

<?php


$service = $pdo->prepare("SELECT * FROM tour order by id desc LIMIT 6");
$service->execute();
$res_serv = $array = $service->fetchAll(PDO::FETCH_OBJ);
?>

<?php


$data = $pdo->prepare("SELECT * FROM tour order by datastart asc LIMIT 3");
$data->execute();
$res_data = $array = $data->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css " rel="stylesheet " integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ " crossorigin="anonymous ">
    <title>Document</title>
</head>

<body>
<?php
    require "NavBar/header.php";
?>
    </div>
    <div id="main" class="banner ">
        <h2 style="color: white">Турагентство</h2>
        <h1 style="color:white;">
            Туристік агенттік
            Мексикадағы авторлық турлар " шытырман оқиға<br> ЮКАТАН ТҮБЕГІНДЕ"</h1>
        <p style="margin-bottom: 2%; color: white;">Мексика өміріне толықтай енетін бірегей маршрут</p>
    </div>
<div style="background-color: antiquewhite; height:900px">
    <h2 style="text-align: center; margin-top: 0%;">Танымал елдер</h2>
    <div style="margin: 2% 10% 2% 10%" class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($res_serv as $serv):?>
            <div class="col">
                <div class="card h-100">
                    <a href="detailTour.php?id=<?php echo $serv->id; ?>" class="black-link">
                        <img src="admin/realising/images/<?php echo $serv->image?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $serv->title?></h5>
                            <br>
                            <h3 class="card-text">От <?php echo $serv->price?> tg</h3>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        <a href="ShowMore.php">Show More</a>
    </div>
</div>
        <br>
        <br>
    <h2 style="text-align: center; color: black; font-weight: bold;">Шұғыл турлар уақыты</h2>
    <p style="text-align: center; color: black; ">Қолайлы күндерді таңдаңыз немесе жеке турға сұраныс жасаңыз</p>
    <div id="price" class=" containers ">
        <div class="prices ">
            <?php foreach($res_data as $datas):?>
            <a href="detailTour.php?id=<?php echo $datas->id; ?>" class="black-link">
                <p style="font-size: larger"><?php echo $datas->title?></p>
            <h3><?php echo $datas->datastart?> - <?php echo $datas->dataend?> </h3>
            <p class="price"><?php echo $datas->price?> tg</p>
                <p>Подробнее</p>
            <p>---------------------------------------------------------------------------------------------------------</p>
            <?php endforeach; ?>
                </a>
        </div>

    </div>

    <div id="gallery" style="margin-top:3%; background-color: antiquewhite;" class="gallery">
        <h2 style="margin-bottom:3%;">Компания галереясы</h2>
        <div class="container">
            <div><img src="admin/realising/images/egypt.jpg" alt="images">
                <p>Egypt</p>
            </div>
            <div><img src="admin/realising/images/egypt2.jpg" alt="images">
                <p>Egypt</p>
            </div>
            <div><img src="admin/realising/images/sw2.jpg" alt="images">
                <p>Switzerland</p>
            </div>
            <div><img src="admin/realising/images/mx.jpg" alt="images">
                <p>Mexica</p>
            </div>
            <div><img src="admin/realising/images/do.jpg" alt="images">
                <p>Thailand</p>
            </div>
            <div><img src="admin/realising/images/swjpg.jpg" alt="images">
                <p>
                    Switzerland
                </p>
            </div>
        </div>
    </div>


    <form action="/admin/realising/Clicks.php" method="post" style="width: 50%;" class="container">
        <div style="text-align: center;">
            <h2>Форма</h2>
            <p>Менеджер сізбен хабарласа алуы үшін форманы толтырыңыз</p>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Есіміңізді жазыңыз</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
            <div id="Form" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1"  class="form-label">Номеріңізді жазыңыз</label>
            <input type="number" class="form-control" id="exampleInputPassword1" name="number">
        </div>
        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary ">Жіберу</button>
        </div>
    </form>
    <div>

    </div>
<?php require "NavBar/footer.php"?>
</body>

</html>