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
            $( window ).on( 'pageshow', function()
            {
                $( '#pay-button-hkd' ).html( '<i class="icon-credit-card"></i> Checkout with HKD' ).prop( 'disabled', false );
                $( '#pay-button-twd' ).html( '<i class="icon-credit-card"></i> Checkout with TWD' ).prop( 'disabled', false );
            } );

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

                $( '#pay-button-hkd' ).html('<div class="spinner-border spinner-border-sm text-white mr-2" role="status"></div>Processing...').prop('disabled', true);

                var url = Airwallex.redirectToCheckout({
                env: 'demo',
                    locale: "zh-HK",
                    country_code: 'HK',
                    mode: 'payment',
                    autoCapture: true,
                    disableAutoRedirect: true,
                    withBilling:true,
                    requiredBillingContactFields:[ 'name', 'email', 'address' ],
                    intent_id: "<?= $intent_hkd[ 'id' ] ?>", // Required, must provide intent details
                    client_secret: "<?= $intent_hkd[ 'client_secret' ] ?>", // Required
                    successUrl: "<?= site_url( 'payments/hpp' ) ?>", // Must be HTTPS sites
                    failUrl: 'https://www.google.com', // Must be HTTPS sites
                    methods: [],
                    applePayRequestOptions: {
                        buttonType: 'buy', // Indicate the type of button you want displayed on your payments form. Like 'buy' 
                        buttonColor: 'white-with-line', // Indicate the color of the button. Default value is 'black' 
                        countryCode: 'HK', // The merchant's two-letter ISO 3166 country code. Like 'HK' 
                        totalPriceLabel: 'COMPANY, INC.', // Provide a business name for the label field.
                        requiredBillingContactFields: [
                            'postalAddress', 'email', 'name', 'phone', 'phoneticName'
                        ],
                    }
                });

                return url;
            }


            $( '#pay-button-hkd' ).on( "<?= $is_mobile ? 'touchstart' : 'click' ?>", function() {
                window.location = redirectHppForCheckoutHKD();
            });



            const redirectHppForCheckoutTWD = () => {

                $( '#pay-button-twd' ).html('<div class="spinner-border spinner-border-sm text-white mr-2" role="status"></div>Processing...').prop('disabled', true);

                var url = Airwallex.redirectToCheckout({
                env: 'demo',
                    locale: "zh-HK",
                    country_code: 'TW',
                    mode: 'payment',
                    autoCapture: true,
                    withBilling:true,
                    disableAutoRedirect: true,
                    requiredBillingContactFields:[ 'name', 'email', 'address' ],
                    intent_id: "<?= $intent_twd[ 'id' ] ?>", // Required, must provide intent details
                    client_secret: "<?= $intent_twd[ 'client_secret' ] ?>", // Required
                    successUrl: "<?= site_url( 'payments/hpp' ) ?>", // Must be HTTPS sites
                    failUrl: 'https://www.google.com', // Must be HTTPS sites
                });


                return url;
            }


            $( '#pay-button-twd' ).on( "<?= $is_mobile ? 'touchstart' : 'click' ?>", function() {
                window.location = redirectHppForCheckoutTWD();
            });

        });
    </script>
    </body>
</html>
