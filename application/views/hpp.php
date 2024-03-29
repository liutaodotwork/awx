<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Hosted Payment Page Demo</title>
    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="<?= $asset_path ?>/css/vendor.min.css?v=<?= VER ?>">
    <!-- Main Template Styles-->
    <link id="mainStyles" rel="stylesheet" media="screen" href="<?= $asset_path ?>/css/styles.min.css?v=<?= VER ?>">
    <!-- Modernizr-->
    <script src="<?= $asset_path ?>/js/modernizr.min.js?v=<?= VER ?>"></script>
  </head>
  <!-- Body-->
  <body>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Hosted Payment Page Demo</h1>
        </div>
        <div class="column"></div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
      <div class="row">
        <div class="col-12">
            <h6 class="text-muted text-lg text-uppercase">Basic Example</h6>
            <hr class="margin-bottom-1x">

            <div class="text-center paddin-top-1x mt-4">
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                    <button id="pay-button" class="btn btn-primary btn-block" type="button" data-action="http://awx.local/payments/cards/native-api-checkout"><i class="icon-credit-card"></i> Proceed to Checkout</button>
                    </div>
                    <div class="col-sm-4"></div>
                  </div>
            </div>

        </div>
      </div>
    </div>
    <script src="<?= $asset_path ?>/js/vendor.min.js?v=<?= VER ?>"></script>
    <script src="<?= $asset_path ?>/js/scripts.min.js?v=<?= VER ?>"></script>

    <script src="https://checkout.airwallex.com/assets/elements.bundle.min.js"></script>
    <script>
        $( document ).ready( function()
        {
              Airwallex.init(
              {
                env: "<?= 'production' === ENVIRONMENT ? 'prod' : 'demo' ?>",
                origin: window.location.origin,
                locale: "en",
                fonts: {
                    family: '-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"',
                    src: "",
                    weight: "regular"
                } 
              } );

              const redirectHppForCheckout = () => {
                Airwallex.redirectToCheckout({
                  env: 'demo',
                  mode: 'payment',
                  currency: 'HKD',
                  autoCapture: false,
                  intent_id: "<?= $intent[ 'id' ] ?>", // Required, must provide intent details
                  client_secret: "<?= $intent[ 'client_secret' ] ?>", // Required
                  successUrl: "<?= site_url( '' ) ?>", // Must be HTTPS sites
                  failUrl: 'https://www.google.com', // Must be HTTPS sites
                });
              }


              document.getElementById('pay-button').addEventListener('click', () => {
                  redirectHppForCheckout();
              });

        });
    </script>
    </body>
</html>
