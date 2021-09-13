<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Payment Failed</title>
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
                    <h1>Payment Failed</h1>
                </div>
            </div>
        </div>
        <!-- Page Content-->
        <div class="container padding-bottom-3x mb-2">
            <div class="card text-center">
                <div class="card-body padding-top-2x">
                    <h2 class="card-title mb-4 text-danger"><i class="icon-x-circle"></i> Your Payment Failed</h2>
                    <p class="card-text">You can try again with another Visa or Mastercard card.</p>
                    <p class="card-text">Please also ensure that the billing address you provided is the same one where your debit/credit card is registered.</p>
<?php if ( ! empty( $code ) ) { ?>
                    <p class="card-text">Error Code: <?= $code ?></p>
<?php } ?>
                    <div class="padding-top-1x padding-bottom-1x">
                        <a href="<?= $back_url ?>" class="btn btn-primary"><i class="icon-credit-card"></i> Try Again</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
