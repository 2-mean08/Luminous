<?php
// MySQL 연결 설정
$conn = new mysqli("localhost", "root", "1234", "dewaura");

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 카테고리 필터링
$volume = isset($_GET['volume']) ? $_GET['volume'] : '';

// SQL 쿼리
if ($volume) {
    // volume 값에 따라 capacity_1, capacity_2, capacity_3을 필터링
    if ($volume == '30ml') {
        $sql = "SELECT content_code, content_img, deliv_today, content_name, discount_rate, content_cost, content_price 
                FROM female_perfume WHERE capacity_1 = 30";
    } elseif ($volume == '50ml') {
        $sql = "SELECT content_code, content_img, deliv_today, content_name, discount_rate, content_cost, content_price 
                FROM female_perfume WHERE capacity_2 = 60";
    } elseif ($volume == 'large') {
        $sql = "SELECT content_code, content_img, deliv_today, content_name, discount_rate, content_cost, content_price 
                FROM female_perfume WHERE capacity_3 = 100";
    } else {
        $sql = "SELECT content_code, content_img, deliv_today, content_name, discount_rate, content_cost, content_price 
                FROM female_perfume";
    }
} else {
    $sql = "SELECT content_code, content_img, deliv_today, content_name, discount_rate, content_cost, content_price 
            FROM female_perfume";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>여자 향수 쇼핑몰</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .sale-title {
            font-size: 3rem;
            font-weight: 600;
            margin-bottom: 40px;
            color: #495057;
            display: flex;
            justify-content: flex-start;
            /* 왼쪽 정렬 */
            align-items: center;
            /* 수직 중앙 정렬 */
            height: 100px;
            /* 충분한 높이 설정 */
            margin-left: 60px;
            /* 왼쪽으로 약간 이동 */
        }

        .menu {
            background-color: #495057;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu .logo a {
            color: #fff;
            text-decoration: none;
            font-size: 1.5rem;
        }

        .main-content {
            display: flex;
            margin-top: 20px;
            position: relative;
            padding: 20px;
            justify-content: flex-start;
        }

        /* 사이드바 */
        .sidebar {
            width: 220px;
            background-color: #f4f4f4;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            height: calc(100vh - 80px);
            overflow-y: auto;
            margin-right: 20px;
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
        }

        .sidebar a div {
            cursor: pointer;
            margin-bottom: 10px;
            padding: 10px;
        }

        .sidebar a:hover div {
            text-decoration: underline;
        }

        /* 필터 섹션 */
        .filter-section {
            position: absolute;
            top: 80px;
            right: 20px;
            display: flex;
            gap: 10px;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            z-index: 1;
        }

        .filter-section span {
            cursor: pointer;
            font-size: 0.9rem;
            color: #333;
        }

        /* 상품 표시 */
        .products-section {
            flex: 1;
            margin-left: 240px;
            padding: 20px;
        }

        .products-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 40px;
            justify-items: center;
            width: 100%;
            margin: 0 auto;
        }

        .product {
            text-align: center;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            height: 350px;
            /* 고정 높이 */
            width: 270px;
            /* 고정 너비 */
            transition: transform 0.3s ease;
            margin-left: -150px;
            /* 상품칸을 왼쪽으로 조금 이동 */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product:hover {
            transform: translateY(-10px);
        }

        .product img {
            width: 100%;
            height: 200px;
            /* 이미지 높이 고정 */
            object-fit: cover;
            /* 이미지 비율에 맞게 자르기 */
            border-radius: 10px;
        }

        .product a {
            text-decoration: none;
            color: #333;
        }

        .price {
            color: #777;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="menu">
        <div class="logo">
            <a href="index.php">DewAura</a>
        </div>
    </div>

    <div class="main-content">
        <!-- 사이드바 -->
        <div class="sidebar">
            <h2>카테고리</h2>
            <a href="female_perfume.php?volume=50ml">
                <div>30ml</div>
            </a>
            <a href="female_perfume.php?volume=100ml">
                <div>60ml</div>
            </a>
            <a href="female_perfume.php?volume=large">
                <div>대용량(100ml)</div>
            </a>
        </div>

        <!-- 상품 및 필터 -->
        <div class="products-section">
            <div class="sale-title">
                여자 향수 판매칸
            </div>

            <!-- 필터 섹션 -->
            <div class="filter-section">
                <span>신상품</span>
                <span>상품명</span>
                <span>낮은가격</span>
                <span>높은가격</span>
            </div>

            <!-- 상품 목록 -->
            <div class="products-container">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="product">';
                        echo '<a href="female_detail.php?content_code=' . $row['content_code'] . '">';
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
        </div>
    </div>
</body>

</html>

<?php
$conn->close();
?>