<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Drop-in Payment Demo</title>
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
          <h1>Drop-in Payment Demo</h1>
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
                <div id="dropIn"></div>
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
                locale: "en", // "en" | "zh" | "ja" | "ko" | "ar" | "fr" | "es" | "nl" | "de" | "it" | "zh-HK" | "pl" | "fi" | "ru" | "da" | "id" | "ms" | "sv" | "ro" | "pt"
                // fonts: {
                //     family: "",
                //     src: "",
                //     weight: ""
                // }
            } );

            const dropIn = Airwallex.createElement('dropIn', {
                intent_id: "<?= $intent[ 'id' ] ?>",
                client_secret: "<?= $intent[ 'client_secret' ] ?>",
                currency: "<?= $intent[ 'currency' ] ?>",
                methods: [ 'card' ],
                autoCapture: true, // true | false
                billing: {
                    first_name: "FirstName",
                    last_name: "LastName",
                    email: "email@example.com",
                    phone_number: "109900",
                    address: {
                        country_code: "US",
                        state: "CA",
                        city: "Mammoth Lakes",
                        street: "2443 Sierra Nevada Road",
                        postcode: "93546"
                    },
                },
                // requiredBillingContactFields: [ 'name', 'email', 'phone', 'address' ],
                // mode: 'payment', // payment | recurring
                // customer_id: '',
                // authorizationType: 'final_auth' // final_auth | pre_auth
                // country_code: '', // Consumer location
            });


            const domElement = dropIn.mount('dropIn');

            domElement.addEventListener('onReady', (event) => {
                dropIn.update( {
                    billing: {
                        first_name: "First",
                        last_name: "Last",
                        email: "email@example.cn",
                        phone_number: "109911",
                        address: {
                            country_code: "US",
                            state: "CA",
                            city: "Mammoth Lakes",
                            street: "2443 Sierra Nevada Road",
                            postcode: "93546"
                        },
                    },
                } );
            });


            domElement.addEventListener('onSuccess', (event) => {
                console.log(event.detail);
            });

            domElement.addEventListener('onError', (event) => {
                console.log(event.detail);
            });
        } );
    </script>
    </body>
</html>
