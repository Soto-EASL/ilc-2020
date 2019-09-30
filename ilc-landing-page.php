<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<!doctype html>
<html class="no-js">
<head>
    <title>Website coming soon</title>
    <meta charset="utf-8">
    <style>
        html, body {
            margin: 0;
            background-color: #fff;
            height: 100%;
            font-family: arial, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .main-content {
            position: relative;
            min-height: 100vh;
        }

        .main-content img {
            width: 100%;
            height: auto;
            display: block;
        }

        .content-wrapper {
            position: fixed;
            bottom: 20px;
            width: 355px;
            right: 20px;
            z-index: 1;
        }

        .ilc-password  {
            background: rgba(255, 255, 255 , .75);
            width: 220px;
            display: block;
            border: 1px solid #eee;
            height: 32px;
            margin: 0 15px 0 0;
            padding: 0 8px;
            font-size: 16px;
            line-height: 32px;
            color: #666;
            font-weight: normal;
            float: left;
        }

        .ilc-submit {
            display: block;
            height: 32px;
            padding: 0;
            margin: 0;
            line-height: 32px;
            font-size: 16px;
            font-weight: normal;
            float: left;
            cursor: pointer;
            width: 120px;
            background: rgba(255, 255, 255 , .75);
            border: 1px solid #eee;
            color: #666;
        }
    </style>
</head>
<body>
<div class="main-container">
    <div class="main-content">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/website-coming-soon-ilc-2020.jpg" alt="">
        <div class="content-wrapper">
            <form action="" method="post">
                <input class="ilc-password" type="password" name="ilcmh_pass" id="ilcmh_pass" value=""/>
                <button class="ilc-submit">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
