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
                    <button id="pay-button-hkd" class="btn btn-primary btn-block" type="button" data-action="http://awx.local/payments/cards/native-api-checkout"><i class="icon-credit-card"></i> Checkout with HKD</button>
                    <button id="pay-button-twd" class="btn btn-success btn-block" type="button" data-action="http://awx.local/payments/cards/native-api-checkout"><i class="icon-credit-card"></i> Checkout with TWD</button>
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
                env: "<?= 'production' !== ENVIRONMENT ? 'demo' : 'prod' ?>",
                origin: window.location.origin,
                fonts: {
                    family: '-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"',
                    src: "",
                    weight: "regular"
                } 
              } );

              const redirectHppForCheckoutHKD = () => {
                Airwallex.redirectToCheckout({
                  env: 'demo',
                  locale: "zh-HK",
                  country_code: 'HK',
                  mode: 'payment',
                  autoCapture: true,
                  withBilling:true,
                  requiredBillingContactFields:[ 'name', 'email', 'address' ],
                  intent_id: "<?= $intent_hkd[ 'id' ] ?>", // Required, must provide intent details
                  client_secret: "<?= $intent_hkd[ 'client_secret' ] ?>", // Required
                  successUrl: "<?= site_url( 'payments/hpp' ) ?>", // Must be HTTPS sites
                  failUrl: 'https://www.google.com', // Must be HTTPS sites
                });
              }


              document.getElementById('pay-button-hkd').addEventListener('click', () => {
                  redirectHppForCheckoutHKD();
              });



              const redirectHppForCheckoutTWD = () => {
                Airwallex.redirectToCheckout({
                  env: 'demo',
                  locale: "zh-HK",
                  country_code: 'TW',
                  mode: 'payment',
                  autoCapture: true,
                  withBilling:true,
                  requiredBillingContactFields:[ 'name', 'email', 'address' ],
                  intent_id: "<?= $intent_twd[ 'id' ] ?>", // Required, must provide intent details
                  client_secret: "<?= $intent_twd[ 'client_secret' ] ?>", // Required
                  successUrl: "<?= site_url( 'payments/hpp' ) ?>", // Must be HTTPS sites
                  failUrl: 'https://www.google.com', // Must be HTTPS sites
                });
              }


              document.getElementById('pay-button-twd').addEventListener('click', () => {
                  redirectHppForCheckoutTWD();
              });

        });
    </script>
    </body>
</html>
