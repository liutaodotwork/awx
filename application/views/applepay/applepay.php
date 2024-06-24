<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Applepay Demo</title>
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
          <h1>Applepay Demo</h1>
        </div>
        <div class="column"></div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
      <div class="row">
        <div class="col-12">
            <h6 class="text-muted text-lg text-uppercase">ApplePay Example</h6>
            <hr class="margin-bottom-1x">
                <div id="applePayButton"></div>
            </div>

        </div>
      </div>
    </div>
    <script src="<?= $asset_path ?>/js/vendor.min.js?v=<?= VER ?>"></script>
    <script src="<?= $asset_path ?>/js/scripts.min.js?v=<?= VER ?>"></script>
    <script src="https://checkout.airwallex.com/assets/elements.bundle.min.js"></script>
    <script>
      // STEP #2: Initialize the Airwallex global context for event communication
      Airwallex.init({
        env: 'demo', // Setup which Airwallex env('staging' | 'demo' | 'prod') to integrate with
        origin: window.location.origin, // Setup your event target to receive the browser events message
        locale: 'zh'
      });
      // STEP #4: Create 'applePayButton' element
      const element = Airwallex.createElement('applePayButton', {
          mode: "recurring",
          customer_id: "<?= $customer[ 'id' ] ?>",
          client_secret: "<?= $customer[ 'client_secret' ] ?>",
          amount: {
            value: '0',
            currency: 'HKD',
          },
          autoCapture: true,
          merchantInfo: {
            merchantName: 'Merchant Demo',
          },
          origin: window.location.origin,
          countryCode: 'HK', // merchant country code
          totalPriceLabel: '这里显示公司名称', // merchant country code
          totalPriceType: 'pending', // merchant country code
          buttonType:'rent',
      });
      // STEP #5: Mount 'applePayButton' element
      const domElement = element.mount('applePayButton');

      // STEP #6: Add an event listener to handle events when the element is mounted
      domElement.addEventListener('onReady', (event) => {
        /*
          ... Handle event
        */
        console.log(event.detail);
      });

      // STEP #7: Add an event listener to handle events when the payment is successful.
      domElement.addEventListener('onSuccess', (event) => {
        /*
          ... Handle event on success
        */
        console.log(event.detail);
      });

      // STEP #8: Add an event listener to handle events when the payment has failed.
      domElement.addEventListener('onError', (event) => {
        /*
          ... Handle event on error
        */
        console.log(event.detail);
      });
    </script>
    </body>
</html>
