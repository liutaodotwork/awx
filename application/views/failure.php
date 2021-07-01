<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Failure - Smooth CKO Flow</title>
        <!-- SEO Meta Tags-->
        <meta name="description" content="Checkout Failure Result - Smooth CKO Flow">
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
                    <h1>Failure</h1>
                </div>
            </div>
        </div>
        <!-- Page Content-->
        <div class="container padding-bottom-3x mb-2">
            <div class="card text-center">
                <div class="card-body padding-top-2x">
                    <h2 class="card-title mb-4 text-primary"><i class="icon-x-circle"></i> Sorry</h2>
                    <p class="card-text">Your payment failed, but you can try again with other cards within 5 minutes.</p>
                    <p class="card-text">Your order number is
                    <span class="text-medium text-primary"><?= $order_number ?></span></p>
                    <p class="card-text">We will keep this UNPAID order for 5 minutes.
                    </p>
                    <div class="padding-top-1x padding-bottom-1x">
                        <a href="<?= site_url() ?>" class="btn btn-primary"><i class="icon-credit-card"></i> Try Agian</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
