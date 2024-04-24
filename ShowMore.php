<?php
global $pdo;
require_once "./functions/connect.php";

$service = $pdo->prepare("SELECT * FROM tour");
$service->execute();
$res_serv = $service->fetchAll(PDO::FETCH_OBJ);

// Pagination variables
$results_per_page = 6; // Number of records per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// SQL query to count total records
$count_query = $pdo->prepare("SELECT COUNT(*) AS total FROM tour");
$count_query->execute();
$row = $count_query->fetch(PDO::FETCH_ASSOC);
$total_records = $row['total'];

// Calculate the number of pages
$total_pages = ceil($total_records / $results_per_page);

// Calculate the SQL LIMIT starting number for the results on the displaying page
$offset = ($current_page - 1) * $results_per_page;

// Fetch records for the current page
$service = $pdo->prepare("SELECT * FROM tour LIMIT :offset, :results_per_page");
$service->bindParam(':offset', $offset, PDO::PARAM_INT);
$service->bindParam(':results_per_page', $results_per_page, PDO::PARAM_INT);
$service->execute();
$res_serv = $service->fetchAll(PDO::FETCH_OBJ);
?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Популярные страны</title>
</head>
<body>
<?php
require "NavBar/header.php";
?>
<div style="background-color: antiquewhite">
    <h2 style="text-align: center; margin-top: 0%;">Популярные страны</h2>
    <div style="margin: 2% 10% 2% 10%" class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($res_serv as $serv):?>
            <div class="col">
                <div class="card h-100">
                    <a href="detailTour.php?id=<?php echo $serv->id; ?>">
                        <img src="admin/realising/images/<?php echo $serv->image?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $serv->title?></h5>
                            <br>
                            <h3 class="card-text">От <?php echo $serv->price?></h3>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Pagination links -->
    <div style="text-align: center; margin-top: 20px;">
        <?php for ($page = 1; $page <= $total_pages; $page++): ?>
            <a href="?page=<?php echo $page; ?>" class="btn btn-primary"><?php echo $page; ?></a>
        <?php endfor; ?>
    </div>
    <?php require "NavBar/footer.php"?>
</div>

</body>
</html>
