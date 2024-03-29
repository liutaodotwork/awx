<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Alipay Demo</title>
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
          <h1>Alipay Demo</h1>
        </div>
        <div class="column"></div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
      <div class="row">
        <div class="col-12">
            <h6 class="text-muted text-lg text-uppercase">Authorization Example</h6>
            <hr class="margin-bottom-1x">

            <div class="text-center paddin-top-1x mt-4">
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                    <button id="pay-button" class="btn btn-primary btn-block" type="button" data-action="<?= site_url( 'payments/apms/alipay-auth' ) ?>"><i class="icon-credit-card"></i> Proceed to Authorize</button>
                    </div>
                    <div class="col-sm-4"></div>
                  </div>
            </div>

        </div>
      </div>
    </div>
    <script src="<?= $asset_path ?>/js/vendor.min.js?v=<?= VER ?>"></script>
    <script src="<?= $asset_path ?>/js/scripts.min.js?v=<?= VER ?>"></script>

    <script>
        $( document ).ready( function()
        {
            $('#pay-button').click( function()
            {
                submitPayment();
            });
        });

        function submitPayment()
        {
            $.ajax({
                url : $( '#pay-button' ).attr( 'data-action' ),
                data : {
                    '<?= $this->security->get_csrf_token_name() ?>':'<?= $this->security->get_csrf_hash() ?>'
                },
                type : 'post',
                beforeSend : function()
                {
                    $( '#pay-button' ).html('<div class="spinner-border spinner-border-sm text-white mr-2" role="status"></div>Processing...').prop('disabled', true);
                },
                success : function( data )
                {
                    window.location = data.msg;
                }
            });
        }
    </script>
    </body>
</html>
