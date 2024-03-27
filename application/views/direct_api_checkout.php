<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Checkout</title>
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
          <h1>Checkout</h1>
        </div>
        <div class="column"></div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
      <div class="row">
        <!-- Checkout Adress-->
        <div class="col-xl-8 col-lg-7">
            <div class="steps flex-sm-nowrap mb-5">
                <a class="step" href="#">
                    <h4 class="step-title"><i class="icon-check-circle"></i>1. Product Selection</h4>
                </a>
                <a class="step" href="#">
                    <h4 class="step-title"><i class="icon-check-circle"></i>2. Shipping</h4>
                </a>
                <a class="step active" href="">
                    <h4 class="step-title">3. Payment and Confirmation</h4>
                </a>
            </div>
          <h4>Select a Payment Method</h4>
          <hr class="padding-bottom-1x">
          <div class="accordion" id="accordion" role="tablist">
            <div class="card">
              <div class="card-header" role="tab">
                <h6><a href="#card" data-toggle="collapse"><i class="icon-credit-card"></i>Credit/Debit Card</a></h6>
              </div>
              <div class="collapse show" id="card" data-parent="#accordion" role="tabpanel">
                <div class="card-body">
                    <p>We accept following cards:&nbsp;&nbsp;
                        <img class="d-inline-block align-middle" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzUiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAzNSAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxwYXRoIGQ9Ik0wIDMuMjVDMCAxLjQ1NTA4IDEuNDU1MDcgMCAzLjI1IDBIMzEuNzVDMzMuNTQ0OSAwIDM1IDEuNDU1MDcgMzUgMy4yNVYyMC43NUMzNSAyMi41NDQ5IDMzLjU0NDkgMjQgMzEuNzUgMjRIMy4yNUMxLjQ1NTA3IDI0IDAgMjIuNTQ0OSAwIDIwLjc1VjMuMjVaIiBmaWxsPSJ3aGl0ZSIgLz4KICAgIDxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBkPSJNMTAuNzUwMyAxNi41NjhIOC40MTM2Mkw2LjY2MTM5IDkuODY4OTZDNi41NzgyMiA5LjU2MDggNi40MDE2MyA5LjI4ODM3IDYuMTQxODcgOS4xNTk5OEM1LjQ5MzYxIDguODM3MyA0Ljc3OTI4IDguNTgwNTEgNCA4LjQ1MDk5VjguMTkzMDhINy43NjQyMkM4LjI4Mzc0IDguMTkzMDggOC42NzMzOCA4LjU4MDUxIDguNzM4MzIgOS4wMzA0Nkw5LjY0NzQ3IDEzLjg2MjdMMTEuOTgzIDguMTkzMDhIMTQuMjU0OEwxMC43NTAzIDE2LjU2OFpNMTUuNTUzMyAxNi41NjhIMTMuMzQ2NUwxNS4xNjM3IDguMTkzMDhIMTcuMzcwNUwxNS41NTMzIDE2LjU2OFpNMjAuMjI1NyAxMC41MTMzQzIwLjI5MDYgMTAuMDYyMiAyMC42ODAzIDkuODA0MjcgMjEuMTM0OSA5LjgwNDI3QzIxLjg0OTIgOS43Mzk1MiAyMi42MjczIDkuODY5MDMgMjMuMjc2NyAxMC4xOTA2TDIzLjY2NjQgOC4zODc0M0MyMy4wMTcgOC4xMjk1MSAyMi4zMDI2IDggMjEuNjU0NCA4QzE5LjUxMjUgOCAxNy45NTM5IDkuMTYwMDUgMTcuOTUzOSAxMC43NzAxQzE3Ljk1MzkgMTEuOTk0OSAxOS4wNTc5IDEyLjYzOCAxOS44MzcyIDEzLjAyNTRDMjAuNjgwMyAxMy40MTE3IDIxLjAwNSAxMy42Njk2IDIwLjk0IDE0LjA1NTlDMjAuOTQgMTQuNjM1NCAyMC4yOTA2IDE0Ljg5MzMgMTkuNjQyNCAxNC44OTMzQzE4Ljg2MzEgMTQuODkzMyAxOC4wODM4IDE0LjcwMDIgMTcuMzcwNiAxNC4zNzc1TDE2Ljk4MSAxNi4xODE4QzE3Ljc2MDMgMTYuNTAzMyAxOC42MDMzIDE2LjYzMjggMTkuMzgyNiAxNi42MzI4QzIxLjc4NDIgMTYuNjk2NSAyMy4yNzY3IDE1LjUzNzUgMjMuMjc2NyAxMy43OThDMjMuMjc2NyAxMS42MDc0IDIwLjIyNTcgMTEuNDc5IDIwLjIyNTcgMTAuNTEzM1pNMzEgMTYuNTY4TDI5LjI0NzggOC4xOTMwOEgyNy4zNjU3QzI2Ljk3NiA4LjE5MzA4IDI2LjU4NjQgOC40NTA5OSAyNi40NTY1IDguODM3M0wyMy4yMTE4IDE2LjU2OEgyNS40ODM2TDI1LjkzNyAxNS4zNDQzSDI4LjcyODNMMjguOTg4IDE2LjU2OEgzMVpNMjcuNjkwNCAxMC40NDg3TDI4LjMzODYgMTMuNjA1MUgyNi41MjE1TDI3LjY5MDQgMTAuNDQ4N1oiIGZpbGw9IiMyMjREQkEiIC8+CiAgICA8cGF0aCBkPSJNMy4yNSAxSDMxLjc1Vi0xSDMuMjVWMVpNMzQgMy4yNVYyMC43NUgzNlYzLjI1SDM0Wk0zMS43NSAyM0gzLjI1VjI1SDMxLjc1VjIzWk0xIDIwLjc1VjMuMjVILTFWMjAuNzVIMVpNMy4yNSAyM0MyLjAwNzM2IDIzIDEgMjEuOTkyNiAxIDIwLjc1SC0xQy0xIDIzLjA5NzIgMC45MDI3ODkgMjUgMy4yNSAyNVYyM1pNMzQgMjAuNzVDMzQgMjEuOTkyNiAzMi45OTI2IDIzIDMxLjc1IDIzVjI1QzM0LjA5NzIgMjUgMzYgMjMuMDk3MiAzNiAyMC43NUgzNFpNMzEuNzUgMUMzMi45OTI2IDEgMzQgMi4wMDczNiAzNCAzLjI1SDM2QzM2IDAuOTAyNzkgMzQuMDk3MiAtMSAzMS43NSAtMVYxWk0zLjI1IC0xQzAuOTAyNzkgLTEgLTEgMC45MDI3OSAtMSAzLjI1SDFDMSAyLjAwNzM2IDIuMDA3MzYgMSAzLjI1IDFWLTFaIiBmaWxsPSIjRjZGN0Y4IiAvPgo8L3N2Zz4KICAgIA==" height="24" alt="Visa">
                        <img class="d-inline-block align-middle" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzNSIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDM1IDI0Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHJlY3Qgd2lkdGg9IjM1IiBoZWlnaHQ9IjI0IiBmaWxsPSIjRThFQUVEIiByeD0iMy4yNDgiLz4KICAgICAgICA8Zz4KICAgICAgICAgICAgPHBhdGggZmlsbD0iI0ZGNUUwMCIgZD0iTTE1LjUxOS4xMjJjMy42ODcgMCA2LjY3NiAyLjk2NyA2LjY3NiA2LjYyNyAwIDMuNjYtMi45ODkgNi42MjctNi42NzYgNi42MjctMS42NTMgMC0zLjE2Ni0uNTk2LTQuMzMyLTEuNTg0LTEuMTY0Ljk4OC0yLjY3NyAxLjU4NC00LjMzIDEuNTg0QzMuMTcgMTMuMzc2LjE4IDEwLjQwOS4xOCA2Ljc0OS4xOCAzLjA4OSAzLjE3LjEyMiA2Ljg1Ny4xMjJjMS42NTMgMCAzLjE2Ni41OTYgNC4zMzIgMS41ODNDMTIuMzUzLjcxOCAxMy44NjYuMTIyIDE1LjUxOS4xMjJ6IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg2IDUpIi8+CiAgICAgICAgICAgIDxwYXRoIGZpbGw9IiNFRDAwMDYiIGQ9Ik02Ljg1Ny4xMjJjMS42NTMgMCAzLjE2Ni41OTYgNC4zMzIgMS41ODNDOS43NTIgMi45MjEgOC44NDIgNC43MyA4Ljg0MiA2Ljc1YzAgMi4wMi45MSAzLjgyOCAyLjM0NSA1LjA0My0xLjE2NC45ODgtMi42NzcgMS41ODQtNC4zMyAxLjU4NEMzLjE3IDEzLjM3Ni4xOCAxMC40MDkuMTggNi43NDkuMTggMy4wODkgMy4xNy4xMjIgNi44NTcuMTIyeiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNiA1KSIvPgogICAgICAgICAgICA8cGF0aCBmaWxsPSIjRjlBMDAwIiBkPSJNMTUuNTE5LjEyMmMzLjY4NyAwIDYuNjc2IDIuOTY3IDYuNjc2IDYuNjI3IDAgMy42Ni0yLjk4OSA2LjYyNy02LjY3NiA2LjYyNy0xLjY1MyAwLTMuMTY2LS41OTctNC4zMzItMS41ODQgMS40MzYtMS4yMTUgMi4zNDctMy4wMjMgMi4zNDctNS4wNDNzLS45MS0zLjgyOC0yLjM0NS01LjA0NEMxMi4zNTQuNzE4IDEzLjg2Ni4xMjIgMTUuNTE5LjEyMnoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDYgNSkiLz4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPgo=" height="24" alt="Mastercard">
                        <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/jcb.9c8dde0afb56485cd18e.svg" height="24" alt="JCB">
                        <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/unionpay.9421a757c6289e8c65ec.svg" height="24" alt="UnionPay">
                    </p>
                    <p><a href="https://www.airwallex.com/docs/online-payments__test-card-numbers" target="_blank">Click here to access Airwallex test cards.</a></p>
                  <div class="card-wrapper"></div>
                  <form class="interactive-credit-card row">
                    <div class="form-group col-12">
                        <div class="input-group">
                            <input class="form-control" id="number" type="text" name="number" placeholder="Card Number"><span class="input-group-addon"><i class="icon-credit-card"></i></span>
                            <div class="invalid-tooltip"></div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <div class="input-group">
                            <input class="form-control" id="name" type="text" name="name" placeholder="Name on Card"><span class="input-group-addon"><i class="icon-user"></i></span>
                            <div class="invalid-tooltip"></div>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <div class="input-group">
                            <input class="form-control" id="expiry" type="text" name="expiry" placeholder="MM/YY"><span class="input-group-addon"><i class="icon-calendar"></i></span>
                            <div class="invalid-tooltip"></div>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <div class="input-group">
                            <input class="form-control" id="cvc" type="text" name="cvc" placeholder="CVC"><span class="input-group-addon"><i class="icon-lock"></i></span>
                            <div class="invalid-tooltip"></div>
                        </div>
                    </div>
                    <div class="form-group col-12 mt-2">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" checked id="invalidCheck3">
                            <label class="custom-control-label" for="invalidCheck3">Your billing address and shipping address are identical.</label>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="text-center paddin-top-1x mt-4">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                    <button id="pay-button" class="btn btn-primary btn-block" type="button" data-action="<?= site_url( 'payments/cards/direct-api-checkout' ) ?>"><i class="icon-credit-card"></i> Proceed to Checkout</button>
                    </div>
                    <div class="col-sm-3"></div>
                  </div>
            </div>
          </div>
        </div>

        <!-- Sidebar          -->
        <div class="col-xl-4 col-lg-5">
          <aside class="sidebar">
            <div class="padding-top-2x hidden-lg-up"></div>
            <!-- Order Summary Widget-->
            <section class="widget widget-order-summary">
              <h3 class="widget-title">Order Summary</h3>
              <table class="table">
                <tr>
                  <td>Cart Subtotal:</td>
                  <td class="text-gray-dark">$60.05</td>
                </tr>
                <tr>
                  <td>Shipping:</td>
                  <td class="text-gray-dark">$20.00</td>
                </tr>
                <tr>
                  <td></td>
                  <td class="text-lg text-gray-dark">$80.05</td>
                </tr>
              </table>
            </section>
          </aside>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-3ds" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog<?= ! $is_mobile ? ' modal-dialog-centered' : '' ?>" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">3D-Secure Authentication</h4>
                </div>
                <div class="modal-body">
                    <div id="loading" style="position: absolute;top: 40%;left: 38%;">Loading...</div>
                    <iframe id="device-iframe" src="" style="border:none;height:600px">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-failure" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog<?= ! $is_mobile ? ' modal-dialog-centered' : '' ?>" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">3D-Secure Authentication</h4>
                </div>
                <div class="modal-body">
                    <p class="mt-3">Your payment failed, but you can <b> try again with another card</b>.</p>
                    <p>Please ensure that the billing address you provided is the same one where your debit/credit card is registered.</p>
                    <div class="padding-top-1x text-center">
                    <button class="btn btn-primary" type="button" data-dismiss="modal"><i class="icon-credit-card"></i> Try Again</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
    <script src="<?= $asset_path ?>/js/vendor.min.js?v=<?= VER ?>"></script>
    <script src="<?= $asset_path ?>/js/card.min.js?v=<?= VER ?>"></script>
    <script src="<?= $asset_path ?>/js/scripts.min.js?v=<?= VER ?>"></script>
<?php if ( ENVIRONMENT == 'production' ) { ?>
    <script defer id="airwallex-fraud-api" data-order-session-id="<?= $device_id ?>" src="https://static.airwallex.com/webapp/fraud/device-fingerprint/index.js"></script>
<?php } else { ?>
    <script defer id="airwallex-fraud-api" data-order-session-id="<?= $device_id ?>" src="https://static-demo.airwallex.com/webapp/fraud/device-fingerprint/index.js"></script>
<?php } ?>
    <script>
        $( document ).ready( function()
        {
            $('#pay-button').click( function()
            {
                submitPaymentForm();
            });

            var modal = $('#modal-3ds');
            $( modal ).on( 'hidden.bs.modal', function (e)
            {
                $('#pay-button').html('<i class="icon-credit-card"></i> Place Order').prop('disabled', false);
            });

            var modal = $('#modal-failure');
            $( modal ).on( 'hidden.bs.modal', function (e)
            {
                $('#pay-button').html('<i class="icon-credit-card"></i> Place Order').prop('disabled', false);
            });
        });

        function submitPaymentForm()
        {
            $.ajax({
                url : $( '#pay-button' ).attr( 'data-action' ),
                data : {
                    'number': $('#number').val(),
                    'name': $('#name').val(),
                    'expiry': $('#expiry').val(),
                    'cvc': $('#cvc').val(),
                    'device_id': '<?= $device_id ?>',
                    '<?= $this->security->get_csrf_token_name() ?>':'<?= $this->security->get_csrf_hash() ?>'
                },
                type : 'post',
                beforeSend : function()
                {
                    removeErrorMsg();

                    $( '#pay-button' ).html('<div class="spinner-border spinner-border-sm text-white mr-2" role="status"></div>Processing...').prop('disabled', true);
                },
                success : function( data )
                {
                    // Processing Failed
                    if ( data.result == '0' && data.msg.id != undefined )
                    {
                        window.location = '/failure?id=' + data.msg.id + '&code=' + data.msg.code + '&m=direct-api';
                    }
                    else if ( data.result == '0' ) // Validation Failed
                    {
                        if ( data.msg.number != undefined && data.msg.number.length > 0 )
                        {
                            var number = $( '#number' );
                            number.siblings('.invalid-tooltip').html( '' ).html(data.msg.number);
                            number.addClass('is-invalid');
                        }

                        if ( data.msg.name != undefined && data.msg.name.length > 0 )
                        {
                            var name = $( '#name' );
                            name.siblings('.invalid-tooltip').html( '' ).html(data.msg.name);
                            name.addClass('is-invalid');
                        }

                        if ( data.msg.expiry != undefined && data.msg.expiry.length > 0 )
                        {
                            var expiry = $( '#expiry' );
                            expiry.siblings('.invalid-tooltip').html( '' ).html(data.msg.expiry);
                            expiry.addClass('is-invalid');
                        }

                        if ( data.msg.cvc != undefined && data.msg.cvc.length > 0 )
                        {
                            var cvc = $( '#cvc' );
                            cvc.siblings('.invalid-tooltip').html( '' ).html(data.msg.cvc);
                            cvc.addClass('is-invalid');
                        }

                        $('#pay-button').html('<i class="icon-credit-card"></i> Place Order').prop('disabled', false);
                    }
                    else if( data.result=='1' && data.intent != undefined )
                    {
                        if ( data.req_customer_action != '1' )
                        {
                            window.location = '/success?id=' + data.intent.id + '&m=direct-api';

                            return true;
                        }

                        var modal = $( '#modal-3ds' );
                        $( modal ).modal( 'show' );

                        $( '#device-iframe' ).attr( 'src', data.intent.next_action.url );

                        $( '#device-iframe' ).on( 'load', function()
                        {
                            $( '#loading' ).hide();
                        } );
                    }
                }
            });
        }

        function removeErrorMsg()
        {
            var number = $( '#number' );
            number.siblings('.invalid-tooltip').html( '' );
            number.removeClass('is-invalid');

            var name = $( '#name' );
            name.siblings('.invalid-tooltip').html( '' );
            name.removeClass('is-invalid');

            var expiry = $( '#expiry' );
            expiry.siblings('.invalid-tooltip').html( '' );
            expiry.removeClass('is-invalid');

            var cvc = $( '#cvc' );
            cvc.siblings('.invalid-tooltip').html( '' );
            cvc.removeClass('is-invalid');
        }
    </script>
  </body>
</html>
