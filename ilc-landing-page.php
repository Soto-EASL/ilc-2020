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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content-wrapper {
            width: 355px;
        }

        .ilc-password  {
            background: rgba(255, 255, 255 , .75);
            width: 100%;
            display: block;
            border: 1px solid #ddd;
            height: 40px;
            margin: 0 15px 25px 0;
            padding: 0 8px;
            font-size: 16px;
            line-height: 40px;
            color: #666;
            font-weight: normal;
        }

        .ilc-submit {
            display: block;
            height: 40px;
            padding: 0;
            margin: 0;
            line-height: 40px;
            font-size: 16px;
            font-weight: normal;
            float: left;
            cursor: pointer;
            width: 100%;
            background: #63cef5;
            border: 0 none;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="main-container">
    <div class="main-content">
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
