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
                    <h4 class="step-title"><i class="icon-check-circle"></i>1. Cart</h4>
                </a>
                <a class="step" href="#">
                    <h4 class="step-title"><i class="icon-check-circle"></i>2. Shipping</h4>
                </a>
                <a class="step active" href="">
                    <h4 class="step-title">3. Payment</h4>
                </a>
            </div>
          <h4>Choose Payment Method</h4>
          <hr class="padding-bottom-1x">
          <div class="accordion" id="accordion" role="tablist">
            <div class="card">
              <div class="card-header" role="tab">
                <h6><a href="#card" data-toggle="collapse"><i class="icon-credit-card"></i>Pay with Credit Card</a></h6>
              </div>
              <div class="collapse show" id="card" data-parent="#accordion" role="tabpanel">
                <div class="card-body">
                    <p>We accept following cards:&nbsp;&nbsp;
                        <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/visa.745a6485.svg" height="24" alt="Cerdit Cards">
                        <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/mastercard.262f85fc.svg" height="24" alt="Cerdit Cards">
                    </p>
                    <p><a href="https://www.airwallex.com/docs/online-payments__test-card-numbers" target="_blank">Click here to find Airwallex test cards</a></p>
                  <div class="card-wrapper"></div>
                  <form class="interactive-credit-card row">
                    <input id="client-id" type="hidden" value="<?= $client_id ?>">
                    <input id="api-key" type="hidden" value="<?= $api_key ?>">
                    <div class="form-group col-12">
                        <div class="input-group">
                            <input class="form-control" id="number" type="text" name="number" placeholder="Card Number"><span class="input-group-addon"><i class="icon-credit-card"></i></span>
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
                            <label class="custom-control-label" for="invalidCheck3">Your billing address and shipping address are the same.</label>
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
                    <button id="pay-button" class="btn btn-primary btn-block" type="button" data-action="/nc-direct-api-checkout?c=<?= $client_id ?>&k=<?= $api_key ?>"><i class="icon-credit-card"></i> Pay $80.05</button>
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
                  <td class="text-gray-dark">$10.00</td>
                </tr>
                <tr>
                  <td>Estimated tax:</td>
                  <td class="text-gray-dark">$10.00</td>
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
                    <h4 class="modal-title">3D-Secure 2 Authentication</h4>
                </div>
                <div class="modal-body">
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
                $('#pay-button').html('<i class="icon-credit-card"></i> Pay $80.05').prop('disabled', false);
            });

            var modal = $('#modal-failure');
            $( modal ).on( 'hidden.bs.modal', function (e)
            {
                $('#pay-button').html('<i class="icon-credit-card"></i> Pay $80.05').prop('disabled', false);
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
                        window.location = '/failure?id=' + data.msg.id + '&c=' + $('#client-id').val() + '&k=' + $('#api-key').val() + '&m=direct-api' + '&code=' + data.msg.code;
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

                        $('#pay-button').html('<i class="icon-credit-card"></i> Pay $80.05').prop('disabled', false);
                    }
                    else if( data.result=='1' && data.intent != undefined )
                    {
                        if ( data.fingerprint == '1' )
                        {
                            // nc
                            var next_action_data = data.intent.next_action.data;
                            console.log( next_action_data );
                            var query_string = '';
                            for ( var key in next_action_data )
                            {
                                query_string += '&' + key + '=' + next_action_data[key];
                            }
                            $('#device-iframe').attr( 'src', '<?= site_url('nc-direct-api-3ds-device') ?>?url=' + data.intent.next_action.url + query_string );

                            var modal = $('#modal-3ds');
                            $(modal).modal('show');
                        }
                        else
                        {
                            window.location = '/success?id=' + data.intent.id + '&c=' + $('#client-id').val() + '&k=' + $('#api-key').val() + '&m=direct-api';
                        }
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
