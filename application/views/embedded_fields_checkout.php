<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Airwallex Checkout - Card Payment Acceptance by embedded fields</title>
        <!-- SEO Meta Tags-->
        <meta name="description" content="Checkout - Card Payment Acceptance">
        <!-- Mobile Specific Meta Tag-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
        <link rel="stylesheet" media="screen" href="<?= $asset_path ?>/css/vendor.min.css">
        <!-- Main Template Styles-->
        <link id="mainStyles" rel="stylesheet" media="screen" href="<?= $asset_path ?>/css/styles.min.css">
        <style type="text/css">
            #payment-form #cardNumber iframe,#payment-form #expiry iframe,#payment-form #cvc iframe {
                -webkit-box-flex: 1;
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
                padding-left: 37px;
                padding-top: 8px;
                padding-right: 13px;
            }
            #payment-form .icon-container {
                transition: color .3s;
                background-color: transparent !important;
                color: #999;
                display: inline-block;
                position: absolute;
                top: 48%;
                margin-top: 2px;
                -webkit-transform: translateY(-50%);
                -ms-transform: translateY(-50%);
                transform: translateY(-50%);
                font-size: 1.1em;
                left: 30px
            }
            #payment-form .icon-container.awx-focus {
                color: #05f;
            }
            #payment-form .icon-container.awx-error {
                color: #dc3545;
            }
            #payment-form [id$="-error"] {
                display: none
            }
            #payment-form iframe {
                border: 1px solid #e0e0e0 !important;
                border-radius: 5px !important;
                background-color: #fff !important;
                color: #505050 !important;
                height: 46px !important
            }
            #payment-form iframe.awx-focus {
                border-color: #05f !important;
                outline: none !important;
                background-color: rgba(0,85,255,0.02) !important;
                color: #505050 !important;
                box-shadow: none !important
            }
            #payment-form iframe.awx-error {
                border-color: #dc3545 !important;
                outline: none !important;
                background-color: rgba(0,85,255,0.02) !important;
                color: #505050 !important;
                box-shadow: none !important
            }
        </style>
        <!-- Modernizr-->
        <script src="<?= $asset_path ?>/js/modernizr.min.js"></script>
    </head>
    <!-- Body-->
    <body>
        <!-- Page Title-->
        <div class="page-title">
            <div class="container">
                <div class="column">
                    <h1>Airwallex Card Payment Embedded Fields Demo</h1>
                </div>
            </div>
        </div>
        <!-- Page Content-->
        <div class="container padding-bottom-3x mb-2">
        <form id="payment-form">
            <input type="hidden" name="amount" value="860">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <h6 class="widget-title">Checkout Flows</h6>
                    <nav class="list-group padding-bottom-3x settings-flow">
                        <a class="list-group-item <?= ( $flow == '1' ) ? 'active ' : '' ?>" href="#" data-val="1">1. One-off Payment</a>
                        <a class="list-group-item <?= ( $flow == '2' ) ? 'active ' : '' ?>" href="#" data-val="2">2. Pay and Save Card</a>
                        <a class="list-group-item <?= ( $flow == '3' ) ? 'active ' : '' ?>" href="#" data-val="3">3. Save Card Without Payment</a>
                        <a class="list-group-item <?= ( $flow == '4' ) ? 'active ' : '' ?>" href="#" data-val="4">Subscription</a>
                        <a class="list-group-item <?= ( $flow == '5' ) ? 'active ' : '' ?>" href="#" data-val="5">Subscription With a Payment</a>
                    </nav>
                </div>
                <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                    <h5 class="widget-title"><?php
                        switch ( $flow )
                        {
                            case '2':
                                echo 'Save Card Details During a Payment';
                                break;
                            case '3':
                                echo 'Save Card Details Without a Payment';
                                break;
                            case '4':
                                echo 'Subscription';
                                break;
                            case '5':
                                echo 'Subscription With a Payment';
                                break;
                            default:
                            case '1':
                                echo 'One-off Payment';
                                break;
                        }
                    ?></h5>
                    <div class="accordion padding-bottom-1x" id="accordion" role="tablist">

<!-- One off payment -->
<?php if ( $flow == '1' ) { ?>
        <?=  $this->load->view( '_one_off_payment', [], TRUE ); ?>
<?php } ?>
<!-- End of One off payment -->

<!-- Save card during a payment -->
<?php if ( $flow == '2' ) { ?>
        <?=  $this->load->view( '_save_card_during_payment', [], TRUE ); ?>
<?php } ?>
<!-- End of Save card during a payment -->


                    </div>
                </div>
        </form>
        </div>
        <?=  $this->load->view( '_test_cards', [], TRUE ); ?>
        <div class="modal fade" id="modal-failure" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
            <div class="modal-dialog<?= ! $is_mobile ? ' modal-dialog-centered' : '' ?>" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Payment Failed</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <p> <strong>Error Message:</strong> <span id="auth-error-msg"></span></p>
                        <p> <strong>Original Code:</strong> <span id="auth-error-code"></span></p>
                        <div class="padding-top-1x text-center">
                            <button class="btn btn-primary" type="button" data-dismiss="modal"><i class="icon-credit-card"></i> Try Again</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= $asset_path ?>/js/vendor.min.js"></script>
        <script src="https://checkout.airwallex.com/assets/elements.bundle.min.js"></script>
        <script>
            $(document).ready(function()
            {
                var card_is_completed   = false;
                var expiry_is_completed = false;
                var cvc_is_completed    = false;
            
                var button_text = $('#pay-button').html();
            
                try {
                    // STEP #2: Initialize the Airwallex global context for event communication
                    Airwallex.init({
                        env: 'demo', // Setup which Airwallex env('staging' | 'demo' | 'prod') to integrate with
                        origin: window.location.origin, // Setup your event target to receive the browser events message
                        locale: 'en'
                    });
            
                    // STEP #4: Create split card elements
                    const cardNumber = Airwallex.createElement('cardNumber', {
                        'placeholder': 'Card Number',
                        'autoCapture': true,
                        'allowedCardNetworks': [ 'visa', 'mastercard', 'amex', 'maestro', 'unionpay', 'jcb', 'diners', 'discover' ],
                        'style' : {
                            'base' : {
                                'color': '#505050',
                                'font-family': '-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"',
                                'font-size': '0.9rem'
                            }
                        }
                    });
                    const expiry = Airwallex.createElement('expiry', {
                        'placeholder': 'MM/YY',
                        'style' : {
                            'base' : {
                                'color': '#505050',
                                'font-family': '-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"',
                                'font-size': '0.9rem'
                            }
                        }
                    });
                    const cvc = Airwallex.createElement('cvc', {
                        'placeholder': 'CVC/CVV',
                        'style' : {
                            'base' : {
                                'color': '#505050',
                                'font-family': '-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"',
                                'font-size': '0.9rem'
                            }
                        }
                    });
            
                    // STEP #5: Mount split card elements
                    cardNumber.mount('cardNumber'); // This 'cardNumber' id MUST MATCH the id on your cardNumber empty container created in Step 3
                    expiry.mount('expiry'); // Same as above
                    cvc.mount('cvc'); // Same as above
                } catch (error) {
            
                }
            
            
                window.addEventListener('onReady', (event) => {
                    if( 'cvc' == event.detail.type)
                    {
                        $( '.awx-fields' ).show();
                        $( '.modal-spinner' ).remove();
                    }
                });
            
            
                window.addEventListener('onFocus', (event) => {
                    $('#' + event.detail.type + ' iframe').addClass('awx-focus');
                    $('#' + event.detail.type ).siblings('.icon-container').addClass('awx-focus');
                });
            
            
                //
                window.addEventListener('onBlur', (event) => {
            
                   console.log( event );
            
                   let errDom = '';
            
                   switch ( event.detail.type )
                   {
                   case 'cardNumber':
                       errDom = 'cardNumber';
                       break;
                   case 'expiry':
                       errDom = 'expiry';
                       break;
                   case 'cvc':
                       errDom = 'cvc';
                       break;
                   }
            
            
                   if (event && event.detail && event.detail.error && event.detail.error.message && event.detail.error.message.trim() !== "")
                   {
                       $('#' + event.detail.type + ' iframe').removeClass('awx-focus').addClass('awx-error');
                       $('#' + event.detail.type ).siblings('.icon-container').removeClass('awx-focus').addClass('awx-error');
            
                       $('.' + errDom + '-invalid-tooltip').html( '' ).html(event.detail.error.message).show();
                   }
                   else
                   {
                       $('#' + event.detail.type + ' iframe').removeClass('awx-error');
                       $('#' + event.detail.type ).siblings('.icon-container').removeClass('awx-error');
            
                       $('.' + errDom + '-invalid-tooltip').html( '' ).hide();
                   }
            
            
                   $('#' + event.detail.type + ' iframe').removeClass('awx-focus');
                   $('#' + event.detail.type ).siblings('.icon-container').removeClass('awx-focus');
                });
            
            
                //
                window.addEventListener('onChange', (event) => {
                    if( 'cardNumber' == event.detail.type  ) card_is_completed = event.detail.complete;
                    if( 'expiry' == event.detail.type ) expiry_is_completed = event.detail.complete;
                    if( 'cvc' == event.detail.type ) cvc_is_completed = event.detail.complete;
            
                    $( '#pay-button' ).prop('disabled', !(card_is_completed && expiry_is_completed && cvc_is_completed));
                });
            
            
                //
                $('#pay-button').click(function(){
                    submitPaymentForm();
                });
            
            
                $('.settings-flow a').click(function()
                {
                    updateInUrl($(this).attr('data-val'), 'flow');
                });
            
            });
            
            function submitPaymentForm()
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
                        if ( data.result == '0' )
                        {
                            $('#pay-button').html('<i class="icon-credit-card"></i> Pay $80.05').prop('disabled', false);
                        }
                        else if( data.result=='1' && data.intent != undefined )
                        {
            
                            // Do not save the card or use a saved card.
                            Airwallex.confirmPaymentIntent({
                                element: Airwallex.getElement('cardNumber'),
                                id: data.intent.id,
                                client_secret: data.intent.client_secret,
                                payment_method: {
                                    "billing": {
                                        "first_name": "Steve",
                                        "last_name": "Gates",
                                        "address": {
                                            "country_code": "US",
                                            "state": "AK",
                                            "city": "Akhiok",
                                            "postcode": "99654",
                                            "street": "Street No. 1"
                                        }
                                    }
                                }
                            })
                            .then((response) => {
                                // Handle successful responses
                                window.location = '/success?m=card-embedded-fields&id=' + data.intent.id;
            
                            })
                            .catch((response) => {
                                // Handle error responses
                                console.log( response );
                            
                                var modal = $('#modal-failure');
            
                                $( '#auth-error-msg' ).html( response.message );
            
                                if (response.original_code)
                                {
                                    $( '#auth-error-code' ).html( response.original_code );
                                }
                                else
                                {
                                    $( '#auth-error-code' ).html( 'N/A' );
                                }
            
                                $(modal).modal('show');
            
                                $('#pay-button').html('<i class="icon-credit-card"></i> Pay $80.05').prop('disabled', false);
            
                            });
                        }
                    }
                });
            }
            
            function updateInUrl(val, key)
            {
                const url = new URL(window.location.href);
                url.searchParams.set(key, val);
                window.location.href = url.toString();
            }
            
        </script>
    </body>
</html>
