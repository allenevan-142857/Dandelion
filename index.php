<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <style>
        /* 内嵌样式 */
        body {
            background-color: #f0f4f8;
            color: #333;
            font-family: Arial, sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            color: #0073e6;
        }

        a {
            color: #0073e6;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .header {
            background-color: #0073e6;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .feature-slider {
            position: relative;
            max-width: 100%;
            overflow: hidden;
            border-radius: 10px;
            margin: 20px 0;
        }

        .feature-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            align-items: center;
            transition: opacity 1s ease-in-out;
            opacity: 0;
            background-color: #0073e6;
            color: #fff;
            padding: 20px;
        }

        .feature-slide img {
            max-width: 50%;
            border-radius: 10px 0 0 10px;
        }

        .feature-slide h2 {
            flex: 1;
            margin: 0;
            padding: 20px;
            font-size: 24px;
            border-radius: 0 10px 10px 0;
        }

        .feature-slide.active {
            opacity: 1;
        }

        .card {
            border-radius: 15px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            padding: 15px;
        }

        .read-more {
            display: inline-block;
            margin-top: 10px;
            background-color: #0073e6;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .read-more:hover {
            background-color: #005bb5;
        }

        .footer {
            background-color: #0073e6;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 15px;
            margin-top: 40px;
        }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- 直接在index.php中内置header -->
<div class="header">
    <h1><?php bloginfo('name'); ?></h1>
    <p><?php bloginfo('description'); ?></p>
</div>

<!-- 图片滚动栏 -->
<div class="feature-slider">
    <?php
    $featured_query = new WP_Query(array('posts_per_page' => 5));
    if ($featured_query->have_posts()) :
        $index = 0;
        while ($featured_query->have_posts()) : $featured_query->the_post();
            $index++;
    ?>
        <div class="feature-slide <?php if ($index === 1) echo 'active'; ?>">
            <?php the_post_thumbnail('medium'); ?>
            <h2><?php the_title(); ?></h2>
        </div>
    <?php endwhile; wp_reset_postdata(); endif; ?>
</div>

<!-- 文章内容 -->
<div class="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="card">
            <h2><?php the_title(); ?></h2>
            <p><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
        </div>
    <?php endwhile; endif; ?>
</div>

<!-- 底部显示网站运行时间 -->
<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    <p id="uptime"></p>
</div>

<?php wp_footer(); ?>

<script>
    jQuery(document).ready(function($) {
        var slides = $('.feature-slide');
        var currentIndex = 0;

        function showSlide(index) {
            slides.removeClass('active');
            slides.eq(index).addClass('active');
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        // 初始显示第一张图
        showSlide(currentIndex);

        // 每4秒切换一次
        setInterval(nextSlide, 4000);

        // 网站运行时间显示脚本
        function updateUptime() {
            var startTime = new Date('2024-08-02T12:00:00');  // 设置网站启动时间
            var currentTime = new Date();
            var diffTime = currentTime - startTime;

            var days = Math.floor(diffTime / (1000 * 60 * 60 * 24));
            var hours = Math.floor((diffTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((diffTime % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((diffTime % (1000 * 60)) / 1000);

            var uptimeString = `Website has been running for ${days} days, ${hours} hours, ${minutes} minutes, ${seconds} seconds.`;
            $('#uptime').text(uptimeString);
        }

        // 每秒更新一次运行时间
        setInterval(updateUptime, 1000);
        updateUptime();  // 初始化调用
    });
</script>
</body>
</html>
