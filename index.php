<?php require_once("inc/header.php"); ?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>핸드폰 케이스 쇼핑몰</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;700&display=swap" rel="stylesheet">
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            font-family: 'Noto Sans KR', sans-serif;
            background-color: #fff;
            color: #333;
            overflow-x: hidden;
            min-height: 100vh;
        }

        #main-banner {
            width: 100vw;
            height: 100vh;
            min-height: 400px;
            background: #222;
            display: flex;
            align-items: stretch;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .banner-container {
            width: 100vw;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .banner-center-buttons {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
            z-index: 10;
        }

        .series-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.92);
            color: #222;
            border-radius: 14px;
            padding: 18px 36px;
            font-size: 1.15rem;
            font-weight: 600;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
            border: 2px solid #e0e0e0;
            text-decoration: none;
            transition: background 0.18s, color 0.18s, box-shadow 0.18s;
            cursor: pointer;
            min-width: 260px;
            justify-content: center;
        }

        .series-btn:hover {
            background: #4a90e2;
            color: #fff;
            border-color: #4a90e2;
            box-shadow: 0 6px 24px rgba(74, 144, 226, 0.16);
        }

        .checkbox-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            font-size: 1.1em;
            background: #fff;
            border: 2px solid #4a90e2;
            border-radius: 6px;
            color: #4a90e2;
            margin-right: 6px;
            font-weight: bold;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        }

        .banner {
            width: 100vw;
            height: 100vh;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            z-index: 1;
            transition: opacity 1s ease;
            pointer-events: none;
        }

        .banner.active {
            opacity: 1;
            z-index: 2;
            pointer-events: auto;
        }

        .banner img {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            display: block;
        }

        .banner-controls {
            position: absolute;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 18px;
            z-index: 50;
            background: none;
            box-shadow: none;
        }

        .banner-index {
            font-size: 1.2rem;
            font-weight: 500;
            color: #222;
            opacity: 0.8;
            margin-right: 10px;
            letter-spacing: 0.01em;
            border-radius: 12px;
            padding: 2px 14px 2px 10px;
            user-select: none;
        }

        .banner-index .current {
            color: #222;
            font-weight: bold;
            opacity: 1;
            font-size: 1.2em;
        }

        .banner-index .total {
            color: #999;
            opacity: 0.5;
            font-weight: 400;
        }

        .banner-btn {
            background: none;
            border: none;
            color: #222;
            font-size: 1.2rem;
            padding: 0 6px;
            cursor: pointer;
            border-radius: 0;
            width: auto;
            height: auto;
            line-height: 1;
            transition: color 0.2s;
            display: flex;
            align-items: center;
        }

        .banner-btn:focus {
            outline: none;
        }

        .banner-btn:hover {
            color: #000;
        }

        .banner-btn svg {
            vertical-align: middle;
            width: 1.2em;
            height: 1.2em;
        }

        .banner-hero-center {
            position: absolute;
            top: 30%;
            left: 30%;
            transform: translate(-50%, -50%);
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            border-radius: 18px;
            padding: 48px 36px 36px 36px;
            min-width: 340px;
            text-align: left;
        }

        .hero-top-en {
            font-size: 1.05rem;
            color: #333;
            font-weight: 400;
            margin-bottom: 12px;
            letter-spacing: 0.02em;
            text-align: left;
        }

        .hero-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #111;
            margin: 0 0 18px 0;
            line-height: 1.25;
            text-align: left;
            letter-spacing: -0.01em;
        }

        /* 2번 배너 타이틀 시작 */
        .bannerN-hero {
            position: absolute;
            top: 35%;
            left: 8%;
            transform: translate(-50%, -50%);
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            border-radius: 18px;
            padding: 48px 36px 36px 36px;
            min-width: 340px;
            text-align: left;
        }

        .hero-title1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #111;
            margin: 0 0 18px 0;
            line-height: 1.25;
            letter-spacing: -0.01em;
            color: #e0e0e0;
            text-align: left;
        }

        .hero-desc1 {
            font-size: 1.05rem;
            color: #444;
            margin-bottom: 32px;
            font-weight: 400;
            line-height: 1.5;
            color: #e0e0e0;
            text-align: left;
        }

        .hero-btn-row1 {
            display: flex;
            gap: 16px;
            margin-top: 0;
            color: #e0e0e0;
            text-align: left;
        }

        .detail-btn1 {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 180px;
            max-width: 260px;
            padding: 14px 22px;
            border: 2px solid #222;
            border-radius: 8px;
            background: transparent;
            color: #222;
            font-size: 1.08rem;
            font-weight: 500;
            text-decoration: none;
            transition: border-color 0.18s, color 0.18s, background 0.18s;
            cursor: pointer;
            gap: 16px;
            color: #e0e0e0;
            text-align: left;
        }

        /* ↑ 여기까지 2번 배너 css 코드 */

        .hero-desc {
            font-size: 1.05rem;
            color: #444;
            margin-bottom: 32px;
            font-weight: 400;
            line-height: 1.5;
        }

        .hero-btn-row {
            display: flex;
            gap: 16px;
            margin-top: 0;
        }

        .detail-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 180px;
            max-width: 260px;
            padding: 14px 22px;
            border: 2px solid #222;
            border-radius: 8px;
            background: transparent;
            color: #222;
            font-size: 1.08rem;
            font-weight: 500;
            text-decoration: none;
            transition: border-color 0.18s, color 0.18s, background 0.18s;
            cursor: pointer;
            gap: 16px;
        }

        .detail-btn:hover,
        .detail-btn:focus {
            border-color: #000000;
            color: #000000;
            background: #f5faff;
        }

        .detail-text {
            flex: 1;
            text-align: left;
        }

        .detail-plus {
            font-size: 1.35em;
            font-weight: 400;
            margin-left: 18px;
            line-height: 1;
        }

        @media (max-width: 700px) {
            .banner-hero-center {
                padding: 30px 12px 20px 12px;
                min-width: 0;
                width: 95vw;
            }

            .hero-title {
                font-size: 1.3rem;
            }

            .hero-btn-row {
                flex-direction: column;
                gap: 10px;
                width: 100%;
            }

            .detail-btn {
                width: 100%;
                min-width: 0;
                max-width: none;
                justify-content: center;
            }
        }

        /* 반응형 */
        @media (max-width: 900px) {

            #main-banner,
            .banner-container,
            .banner,
            .banner img {
                min-height: 320px;
                height: 60vh;
            }

            .banner-controls {
                bottom: 18px;
            }
        }

        @media (max-width: 768px) {

            #main-banner,
            .banner-container,
            .banner,
            .banner img {
                min-height: 220px;
                height: 50vh;
            }

            .banner-controls {
                bottom: 10px;
            }
        }

        main.container {
            width: 100%;
            max-width: 1200px;
            padding: 0 20px;
            margin: 0 auto;
            margin-top: 0;
            position: relative;
            z-index: 1;
        }

        .product-section {
            display: flex;
            flex-direction: row;
            padding: 50px 0;
            justify-content: space-between;
            align-items: center;
        }

        .product-section:nth-child(even) {
            background-color: #f9f9f9;
        }

        .product-description {
            flex: 1;
            position: sticky;
            top: 50px;
            z-index: 10;
            padding-left: 20px;
            margin-right: 25px;
        }

        .product-description h1 {
            font-weight: bold;
            font-size: 2rem;
            margin: 0;
            padding-top: 10px;
            margin-bottom: 25px;
        }

        .product-list-container {
            flex: 3;
            position: relative;
            overflow: hidden;
            margin-top: 40px;
        }

        .slider-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 30;
        }

        .slide-btn {
            background-color: rgba(0, 0, 0, 0.4);
            border: none;
            color: white;
            font-size: 1.2rem;
            margin-left: 5px;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .slide-btn:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .product-list {
            display: flex;
            transition: transform 1s ease;
            gap: 20px;
        }

        .product-card {
            min-width: 250px;
            max-width: 250px;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex-shrink: 0;
            height: 350px;
            justify-content: space-between;
        }

        .product-card img {
            width: 250px;
            height: 250px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .product-card h4 {
            margin: 10px 0 5px;
        }

        .product-card p {
            font-size: 0.9rem;
            color: #555;
        }

        .cart-btn {
            margin-top: 10px;
            padding: 5px 10px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        @media (max-width: 1200px) {
            .product-card {
                min-width: 160px;
                max-width: 160px;
            }

            .product-list {
                gap: 15px;
            }
        }

        @media (max-width: 768px) {
            .product-section {
                flex-direction: column;
                padding: 20px 0;
            }

            .product-card {
                min-width: 140px;
                max-width: 140px;
            }

            .product-list {
                gap: 10px;
            }

            .product-description {
                padding-left: 10px;
                margin-right: 0;
                position: static;
            }

            .product-description h1 {
                font-size: 1.3rem;
                margin-bottom: 15px;
            }

            .product-list-container {
                overflow-x: auto;
                margin-top: 15px;
            }
        }


        @keyframes slideInLeft {
            0% {
                transform: translateX(-60px);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .banner-hero-center,
        .bannerN-hero {
            opacity: 0;
            transform: translateX(-60px);
        }

        .banner-hero-center.slide-in,
        .bannerN-hero.slide-in {
            animation: slideInLeft 0.7s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .banner.event-banner {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #9dd2e1 20%, #006991 80%);
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
        }

        .wave-container {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 120px;
            pointer-events: none;
            z-index: 2;
        }

        .wave {
            width: 100%;
            height: 100%;
            display: block;
        }
            .banner.event-banner img {
                display: none;
                /* 배경 이미지를 숨기고 그라데이션만 사용 */
            }

            .event-inner {
                background: rgba(255, 255, 255, 0.04);
                border-radius: 32px;
                padding: 48px 36px 40px 36px;
                box-shadow: 0 8px 32px rgba(80, 60, 120, 0.10);
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                max-width: 370px;
                width: 100%;
            }

            .event-title {
                font-size: 1.6rem;
                font-weight: 700;
                color: #fff;
                margin-bottom: 10px;
                letter-spacing: -0.01em;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .event-highlight {
                font-size: 2.3rem;
                font-weight: 800;
                color: #f7f7f7;
                margin: 0 0 18px 0;
                letter-spacing: -0.02em;
            }

            .event-desc {
                font-size: 1.08rem;
                color: #e0e0e0;
                margin-bottom: 38px;
                font-weight: 400;
            }

            .event-btn {
                display: flex;
                align-items: center;
                padding: 16px 36px;
                font-size: 1.18rem;
                font-weight: 500;
                background: rgba(255, 255, 255, 0.1);
                color: #fff;
                border: 2px solid #fff;
                border-radius: 14px;
                cursor: pointer;
                transition: background 0.18s, color 0.18s, transform 0.18s;
                outline: none;
                letter-spacing: 0.01em;
                margin-top: 10px;
            }

            .event-btn:hover,
            .event-btn:focus {
                background: #fff;
                color: #a18cd1;
            }

            .event-btn:active {
                transform: scale(0.97);
                box-shadow: 0 0 0 3px #fff2;
            }

            .event-btn-plus {
                font-size: 1.5em;
                margin-left: 18px;
                font-weight: 600;
                line-height: 1;
            }

            @keyframes shake {
                0% {
                    transform: rotate(0deg);
                }

                20% {
                    transform: rotate(-18deg);
                }

                40% {
                    transform: rotate(14deg);
                }

                60% {
                    transform: rotate(-10deg);
                }

                80% {
                    transform: rotate(8deg);
                }

                100% {
                    transform: rotate(0deg);
                }
            }

            .shake {
                display: inline-block;
                animation: shake 0.7s cubic-bezier(.36, .07, .19, .97) infinite;
            }

            .event-notice {
                font-size: 0.95rem;
                color: #ffe4e1;
                margin-top: 18px;
            }

            @media (max-width: 500px) {
                .event-inner {
                    padding: 32px 10px 28px 10px;
                    max-width: 95vw;
                }

                .event-title {
                    font-size: 1.1rem;
                }

                .event-highlight {
                    font-size: 1.4rem;
                }

                .event-btn {
                    font-size: 1rem;
                    padding: 12px 16px;
                }
            }

            @media (max-width: 350px) {

                .event-title,
                .event-highlight {
                    font-size: 1rem;
                }
            }

            .shake:hover {
                transform: scale(1.2) rotate(0deg);
                transition: transform 0.18s;
            }
    </style>
</head>

<body>
    <!-- 메인 배너 -->
    <header id="main-banner">
        <div class="banner-container">
            <div class="banner active">
                <img src="img/luminous_banner1.jpg" alt="Banner 1">
                <div class="banner-hero-center">
                    <div class="hero-top-en">New Arrival</div>
                    <h1 class="hero-title">신상 케이스도<br>루미너스와 함께!</h1>
                    <div class="hero-desc">New Galaxy25 &amp; iPhone case Launching</div>
                    <div class="hero-btn-row">
                        <a href="/Luminous/product.php?content_fild=galaxy_s25" class="detail-btn">
                            <span class="detail-text">갤럭시 시리즈 만나러 가기</span>
                            <span class="detail-plus">+</span>
                        </a>
                        <a href="/Luminous/product.php?content_fild=iphone_16" class="detail-btn">
                            <span class="detail-text">아이폰 시리즈 만나러 가기</span>
                            <span class="detail-plus">+</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner">
            <img src="img/luminous_banner2.jpg" alt="Banner 2">
            <div class="banner-hero-center bannerN-hero">
                <div class="hero-top-en1">New Arrival</div>
                <h1 class="hero-title1">당신의 라이프 스타일<br>루미너스와 함께</h1>
                <div class="hero-desc1">New Apple WatchStrap &amp; Galaxy WatchStrap Launching</div>
                <div class="hero-btn-row1">
                    <a href="index.php" class="detail-btn1">
                        <span class="detail-text">자세히 보기</span>
                        <span class="detail-plus">+</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="banner">
            <img src="img/luminous_banner3.jpg" alt="Banner 2">
            <div class="banner-hero-center bannerN-hero">
                <div class="hero-top-en1">Macsafe or wireless charging</div>
                <h1 class="hero-title1">2025 신상 보조배터리</h1>
                <div class="hero-desc1">2025 Luminous Macsefe&amp;Battery pack</div>
                <div class="hero-btn-row1">
                    <a href="index.php" class="detail-btn1">
                        <span class="detail-text">자세히 보기</span>
                        <span class="detail-plus">+</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="banner">
            <img src="img/luminous_banner4.jpg" alt="Banner 4">
            <div class="banner-hero-center bannerN-hero">
                <div class="hero-top-en1">Macsafe or wireless charging</div>
                <h1 class="hero-title1">2025 보조배터리 </h1>
                <div class="hero-desc1">2025 Luminous Macsefe&amp;Battery pack</div>
                <div class="hero-btn-row1">
                    <a href="index.php" class="detail-btn1">
                        <span class="detail-text">자세히 보기</span>
                        <span class="detail-plus">+</span>
                    </a>
                </div>
            </div> <!-- 배너4 문구 -->
        </div>
        </div>
        <div class="banner event-banner">
            <img src="img/luminous_banner4.jpg" alt="Banner 5">
            <div class="event-inner">
                <h2 class="event-title">
                    선물이 도착했습니다! <span class="shake">🎁</span>
                </h2>
                <h1 class="event-highlight">특별 이벤트</h1>
                <p class="event-desc">루미너스의 최신 소식을 확인하세요.</p>
                <button class="event-btn"
                    onclick="location.href='http://localhost/Luminous/event_detail.php?event_code=event2'">
                    선물 확인하기
                    <span class="event-btn-plus">+</span>
                </button>
                <p class="event-notice">* 본 이벤트는 6월 30일까지 진행됩니다.</p>
                <!-- 여기서부터 파도 SVG 추가 -->
                <div class="wave-container">
                    <svg class="wave" viewBox="0 0 1440 120" preserveAspectRatio="none">
                        <path d="M0,60 C360,120 1080,0 1440,60 L1440,120 L0,120 Z" fill="#fff" opacity="0.7">
                            <animate attributeName="d" dur="6s" repeatCount="indefinite"
                                values="
                  M0,60 C360,120 1080,0 1440,60 L1440,120 L0,120 Z;
                  M0,80 C400,0 1040,180 1440,80 L1440,120 L0,120 Z;
                  M0,60 C360,120 1080,0 1440,60 L1440,120 L0,120 Z
                " />
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="banner-controls">
            <span class="banner-index">
                <span class="current" id="bannerCurrent">1</span>
                <span class="total">/5</span>
            </span>
            <button class="banner-btn" id="prevBanner" aria-label="이전 배너">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button class="banner-btn" id="togglePlay" aria-label="배너 자동재생">
                <svg id="pauseIcon" viewBox="0 0 24 24" width="24" height="24">
                    <rect x="6" y="5" width="4" height="14" fill="currentColor" />
                    <rect x="14" y="5" width="4" height="14" fill="currentColor" />
                </svg>
                <svg id="playIcon" viewBox="0 0 24 24" width="24" height="24" style="display:none;">
                    <polygon points="6,4 20,12 6,20" fill="currentColor" />
                </svg>
            </button>
            <button class="banner-btn" id="nextBanner" aria-label="다음 배너">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 6 15 12 9 18"></polyline>
                </svg>
            </button>
        </div>
        </div>
    </header>

    <!-- 메인 컨테이너 -->
    <main class="container">
        <!-- iPhone 16 시리즈 추천 -->
        <section class="product-section">
            <div class="product-description">
                <h1>iPhone 16 Series</h1>
                <p>프리미엄 디자인으로</p>
                <p>내 핸드폰을 보호하세요.</p>
            </div>
            <div class="product-list-container">
                <div class="slider-controls">
                    <button class="slide-btn" onclick="moveSlide('iphone16-list', -1)">&#8592;</button>
                    <button class="slide-btn" onclick="moveSlide('iphone16-list', 1)">&#8594;</button>
                </div>
                <div class="product-list" id="iphone16-list">
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                        <div class="product-card">
                            <img src="img/iphone16_case<?= $i ?>.jpg" alt="iPhone 16 케이스 <?= $i ?>">
                            <h4>iPhone 16 케이스 <?= $i ?></h4>
                            <p>프리미엄 디자인과 완벽한 보호</p>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </section>
        <!-- Galaxy S25 시리즈 추천 -->
        <section class="product-section">
            <div class="product-description">
                <h1>Galaxy S25 Series</h1>
                <p>지금 가장 사랑받는</p>
                <p>인기 상품들을 만나보세요.</p>
            </div>
            <div class="product-list-container">
                <div class="slider-controls">
                    <button class="slide-btn" onclick="moveSlide('galaxyS25-list', -1)">&#8592;</button>
                    <button class="slide-btn" onclick="moveSlide('galaxyS25-list', 1)">&#8594;</button>
                </div>
                <div class="product-list" id="galaxyS25-list">
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                        <div class="product-card">
                            <img src="img/galaxyS25_case<?= $i ?>.jpg" alt="Galaxy S25 케이스 <?= $i ?>">
                            <h4>[갤럭시S25] 케이스 <?= $i ?></h4>
                            <p>₩11,800원 <span style="color: green;">34%</span></p>
                            <button class="cart-btn">CART</button>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </section>
        <!-- 악세사리 추천 -->
        <section class="product-section">
            <div class="product-description">
                <h1>Accessories</h1>
                <p>실용적이고 스타일리시한 필수템을 만나보세요.</p>
            </div>
            <div class="product-list-container">
                <div class="slider-controls">
                    <button class="slide-btn" onclick="moveSlide('accessory-list', -1)">&#8592;</button>
                    <button class="slide-btn" onclick="moveSlide('accessory-list', 1)">&#8594;</button>
                </div>
                <div class="product-list" id="accessory-list">
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                        <div class="product-card">
                            <img src="img/accessory<?= $i ?>.jpg" alt="악세사리 <?= $i ?>">
                            <h4>악세사리 <?= $i ?></h4>
                            <p>실용적이고 스타일리시한 필수템</p>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </section>
    </main>
    <!-- 컨테이너 끝 -->

    <script>
        // 상품 슬라이더 기능
        const sliderStates = {
            iphone16: {
                index: 0,
                timer: null
            },
            galaxyS25: {
                index: 0,
                timer: null
            },
            accessory: {
                index: 0,
                timer: null
            }
        };

        function autoScrollProductList(listId, key) {
            const list = document.getElementById(listId);
            const totalItems = list.children.length;
            const visibleItems = 4;
            const state = sliderStates[key];

            function scheduleNextSlide() {
                state.timer = setTimeout(() => {
                    if (state.index + visibleItems < totalItems) {
                        state.index++;
                    } else {
                        state.index = 0;
                    }
                    list.style.transform = `translateX(-${state.index * 270}px)`;
                    scheduleNextSlide();
                }, 5000);
            }
            scheduleNextSlide();
        }

        window.onload = function() {
            autoScrollProductList('iphone16-list', 'iphone16');
            autoScrollProductList('galaxyS25-list', 'galaxyS25');
            autoScrollProductList('accessory-list', 'accessory');
        }

        function moveSlide(listId, direction) {
            const list = document.getElementById(listId);
            const itemWidth = 270;
            const key = listId.split('-')[0];
            const state = sliderStates[key];
            const currentTransform = getComputedStyle(list).transform;
            let matrix = new WebKitCSSMatrix(currentTransform);
            let currentX = matrix.m41;
            let newX = currentX - direction * itemWidth;
            const maxOffset = 0;
            const minOffset = -(list.scrollWidth - list.parentElement.offsetWidth);
            if (newX > maxOffset) newX = maxOffset;
            if (newX < minOffset) newX = minOffset;
            list.style.transform = `translateX(${newX}px)`;
            state.index = Math.round(Math.abs(newX / itemWidth));
            if (state.timer) clearTimeout(state.timer);
            autoScrollProductList(listId, key);
        }

        // 배너 컨트롤러(현대적 스타일)
        const banners = document.querySelectorAll('.banner');
        const toggleButton = document.getElementById('togglePlay');
        const prevButton = document.getElementById('prevBanner');
        const nextButton = document.getElementById('nextBanner');
        const bannerCurrent = document.getElementById('bannerCurrent');
        const pauseIcon = document.getElementById('pauseIcon');
        const playIcon = document.getElementById('playIcon');
        let current = 0;
        let playing = true;
        let interval = null;

        function showBanner(index) {
            banners.forEach((b, i) => {
                if (i === index) {
                    b.classList.add('active');
                } else {
                    b.classList.remove('active');
                }
            });
            bannerCurrent.textContent = index + 1;
            document.querySelectorAll('.banner-hero-center, .bannerN-hero').forEach(el => {
                el.classList.remove('slide-in');
            });
            // 현재 배너의 문구에 slide-in 추가
            const activeBanner = banners[index];
            const hero = activeBanner.querySelector('.banner-hero-center, .bannerN-hero');
            if (hero) {
                void hero.offsetWidth; // 리플로우로 애니메이션 재실행
                hero.classList.add('slide-in');
            }
        }

        function nextBannerFunc() {
            current = (current + 1) % banners.length;
            showBanner(current);
        }

        function prevBannerFunc() {
            current = (current - 1 + banners.length) % banners.length;
            showBanner(current);
        }

        function startSlider() {
            interval = setInterval(nextBannerFunc, 5000);
            pauseIcon.style.display = '';
            playIcon.style.display = 'none';
            playing = true;
        }

        function stopSlider() {
            clearInterval(interval);
            pauseIcon.style.display = 'none';
            playIcon.style.display = '';
            playing = false;
        }

        toggleButton.addEventListener('click', () => {
            playing ? stopSlider() : startSlider();
        });
        nextButton.addEventListener('click', () => {
            stopSlider();
            nextBannerFunc();
        });
        prevButton.addEventListener('click', () => {
            stopSlider();
            prevBannerFunc();
        });

        showBanner(current);
        startSlider();
    </script>
</body>

</html>
<?php require_once("inc/footer.php"); ?>