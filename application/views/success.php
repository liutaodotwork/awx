<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Success - Smooth CKO Flow</title>
        <!-- SEO Meta Tags-->
        <meta name="description" content="Checkout Success Result - Smooth CKO Flow">
        <!-- Mobile Specific Meta Tag-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
        <link rel="stylesheet" media="screen" href="<?= $asset_path ?>/css/vendor.min.css">
        <!-- Main Template Styles-->
        <link id="mainStyles" rel="stylesheet" media="screen" href="<?= $asset_path ?>/css/styles.min.css">
        <!-- Modernizr-->
        <script src="<?= $asset_path ?>/js/modernizr.min.js"></script>
    </head>
    <!-- Body-->
    
    <body>
        <!-- Page Title-->
        <div class="page-title">
            <div class="container">
                <div class="column">
                    <h1>Success</h1>
                </div>
            </div>
        </div>
        <!-- Page Content-->
        <div class="container padding-bottom-3x mb-2">
            <div class="card text-center">
                <div class="card-body padding-top-2x">
                <h2 class="card-title mb-4 text-success"><i class="icon-check-circle"></i> Thank You, <?= $name ?></h2>
                    <p class="card-text">Your order has been placed and will be processed as soon as possible.</p>
                    <p>Your payment ID is <span class="text-medium text-primary"><?= $cko_source_id ?></span></p>

                    <p class="card-text">Make sure you make note of your order number, which is
                    <span class="text-medium text-primary"><?= $order_number ?></span></p>

                    <p class="card-text">You will be receiving an email (<span class="text-medium text-primary"><?= $email ?></span>) shortly with confirmation of your order.
                    </p>
                    <div class="padding-top-1x padding-bottom-1x">
                        <a href="/" class="btn btn-primary"><i class="icon-shopping-cart"></i> Go Back Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
