<?php
// MySQL 연결 설정
$conn = new mysqli("localhost", "root", "", "dewaura");
$conn->set_charset("utf8mb4");

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 카테고리 필터링
$volume = isset($_GET['volume']) ? $_GET['volume'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 8;
$offset = ($page - 1) * $items_per_page;

// 정렬 기준 설정
$orderBy = "";
switch ($sort) {
    case 'new':
        $orderBy = "ORDER BY content_code DESC";
        break;
    case 'name':
        $orderBy = "ORDER BY content_name ASC";
        break;
    case 'low':
        $orderBy = "ORDER BY content_price ASC";
        break;
    case 'high':
        $orderBy = "ORDER BY content_price DESC";
        break;
}

// SQL 쿼리
$sql = "SELECT content_code, content_img, deliv_today, content_name, discount_rate, content_cost, content_price 
        FROM female_perfume";

if ($volume == '30ml') {
    $sql .= " WHERE capacity_1 = 30";
} elseif ($volume == '50ml') {
    $sql .= " WHERE capacity_2 = 60";
} elseif ($volume == 'large') {
    $sql .= " WHERE capacity_3 = 100";
}

$sql .= " " . $orderBy;

// 전체 아이템 개수 확인
$count_sql = "SELECT COUNT(*) AS total FROM female_perfume";
$count_result = $conn->query($count_sql);
$total_items = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_items / $items_per_page);

// 페이지네이션 적용
$sql .= " LIMIT $offset, $items_per_page";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>Luminous</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            all: unset;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }

        .main-content {
            max-width: 1200px;
            margin: 120px auto 40px auto;
            /* 헤더 아래 80px 여백 */
            padding: 0 20px;
        }

        .sale-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }

        .filter-section {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .filter-section a {
            text-decoration: none;
            color: #555;
            font-weight: normal;
        }

        .filter-section a.active-filter {
            font-weight: bold;
            color: #000;
        }

        .products-container_f {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 30px;
        }

        .product {
            background: #f9f9f9;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            transition: box-shadow 0.2s ease;
            padding: 15px;
        }

        .product:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .product-image img {
            width: 100%;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .product:hover .product-image img {
            transform: scale(1.05);
        }

        .product h3 {
            font-size: 16px;
            font-weight: 500;
            margin: 12px 0 6px;
        }

        .product a {
            text-decoration: none;
            color: inherit;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: purple;
            text-decoration: none;
            color: black;
        }

        .price {
            font-size: 14px;
            color: #333;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 12px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #555;
            font-size: 14px;
        }

        .pagination a.active {
            background-color: #555;
            color: #fff;
            border-color: #555;
        }
        header.header#mainHeader {
            background-color: white !important;
        }
    </style>
</head>

<body>
    <?php require_once("inc/header.php"); ?>

    <div class="main-content">
        <div class="products-section">
            <div class="sale-title">
                갤럭시S25 시리즈
                <!--이거도 DB로 받아와서 아이폰에 들어가면 "아이폰 시리즈" 식으로 표시되게 바꿔야함 -->
            </div>

            <!-- 필터 섹션 -->
            <div class="filter-section">
                <a href="?<?= ($volume ? "volume=$volume&" : "") ?>sort=new" class="<?= ($sort == 'new') ? 'active-filter' : '' ?>">신상품</a>
                <a href="?<?= ($volume ? "volume=$volume&" : "") ?>sort=name" class="<?= ($sort == 'name') ? 'active-filter' : '' ?>">상품명</a>
                <a href="?<?= ($volume ? "volume=$volume&" : "") ?>sort=low" class="<?= ($sort == 'low') ? 'active-filter' : '' ?>">낮은가격</a>
                <a href="?<?= ($volume ? "volume=$volume&" : "") ?>sort=high" class="<?= ($sort == 'high') ? 'active-filter' : '' ?>">높은가격</a>
            </div>

            <!-- 상품 목록 -->
            <div class="products-container_f">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="product">';
                        echo '<a href="product_detail.php?content_code=' . $row['content_code'] . '">';
                        echo '<div class="product-image"><img src="' . $row["content_img"] . '" alt="' . $row["content_name"] . '"></div>';
                        echo '<h3>' . $row["content_name"] . '</h3>';
                        echo '<p class="price">' . number_format($row["content_price"]) . '원</p>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>등록된 상품이 없습니다.</p>";
                }
                ?>
            </div>
            <div class="pagination">
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<a href="?page=' . $i . ($volume ? "&volume=$volume" : "") . ($sort ? "&sort=$sort" : "") . '" 
                    class="' . ($i == $page ? "active" : "") . '">' . $i . '</a>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
<?php require_once("inc/footer.php"); ?>
<?php $conn->close(); ?>