<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Stripe Checkout - Card Payment Acceptance by embedded fields</title>
        <!-- SEO Meta Tags-->
        <meta name="description" content="Checkout - Card Payment Acceptance">
        <!-- Mobile Specific Meta Tag-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
        <link rel="stylesheet" media="screen" href="<?= $asset_path ?>/css/vendor.min.css">
        <!-- Main Template Styles-->
        <link id="mainStyles" rel="stylesheet" media="screen" href="<?= $asset_path ?>/css/styles.min.css">
        <style type="text/css">
            #payment-form iframe {
                height: 46px !important
            }

            #payment-form .icon-container {
                transition: color .3s;
                background-color: transparent !important;
                color: #999;
                display: inline-block;
                position: absolute;
                top: 21px;
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

            #payment-form [id$="-error"] {
                display: none
            }

            #payment-form #cardNumber, #payment-form #expiry, #payment-form #cvc {
                border: 1px solid #e0e0e0 !important;
                border-radius: 5px !important;
                background-color: #fff !important;
                color: #505050 !important;
                font-family: "Rubik",Helvetica,Arial,sans-serif !important;
                font-size: 14px !important;
                height: 46px !important;
                -webkit-box-flex: 1;
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
            }

            #payment-form #cardNumber {
                padding-left: 12px;
                padding-top: 14px;
            }

            #payment-form #expiry, #payment-form #cvc {
                padding-left: 36px;
                padding-top: 14px;
            }

            #payment-form #cardNumber.awx-focus,
            #payment-form #expiry.awx-focus,
            #payment-form #cvc.awx-focus {
                border-color: #05f !important;
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
                    <h1>Stripe Card Payment Demo - Embedded Fields</h1>
                </div>
            </div>
        </div>
        <!-- Page Content-->
        <div class="container padding-bottom-3x mb-2">
            <form id="payment-form">
                <input type="hidden" name="amount" value="860">
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

        <div class="accordion" id="accordion" role="tablist">
            <div class="card">
                <div class="card-header" role="tab">
                    <h6><a href="#card" data-toggle="collapse" class="" aria-expanded="true">Pay With A Saved Card</a></h6>
                </div>
                <div class="collapse show" id="card" data-parent="#accordion" role="tabpanel" style="">

                <div class="card-body" style="padding-left:0;padding-right:0;padding-top:0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <td class="align-middle" width="2%" style="border-top:0;border-bottom: 1px solid #dee2e6;">
                                <div class="custom-control custom-radio mb-0" style="padding-left:2px">
                                  <input class="custom-control-input" type="radio" id="local" checked name="shipping-method">
                                  <label class="custom-control-label" for="local"></label>
                                </div>
                              </td>
                              <td class="align-middle" style="border-top:0;border-bottom: 1px solid #dee2e6;"><img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/visa.745a6485.svg" height="24" alt="Cerdit Cards"> <span class="text-gray-dark">411111******1111</span><br><span class="text-muted text-sm">Saved on: July 12, 2021</span></td>
                              <td class="align-middle" style="border-top:0;border-bottom: 1px solid #dee2e6;">Forget this card</td>
                            </tr>
                            <tr>
                              <td class="align-middle">
                                <div class="custom-control custom-radio mb-0">
                                  <input class="custom-control-input" type="radio" id="flat" name="shipping-method">
                                  <label class="custom-control-label" for="flat"></label>
                                </div>
                              </td>
                              <td class="align-middle"><img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/mastercard.262f85fc.svg" height="24" alt="Cerdit Cards"> <span class="text-gray-dark">222300******1375</span><br><span class="text-muted text-sm">Saved on: Sep. 02, 2021</span></td>
                              <td class="align-middle">Forget this card</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                    <div class="form-group col-12 text-center mt-2">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <button id="pay-button-saved-card" class="btn btn-primary btn-block" type="button" data-action="/s-checkout"><i class="icon-credit-card"></i> Pay $80.05</button>
                            </div>
                            <div class="col-sm-3"></div>
                          </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header" role="tab">
                <h6><a class="collapsed" href="#paypal" data-toggle="collapse" aria-expanded="false">Pay with A New Card</a></h6>
              </div>
              <div class="collapse" id="paypal" data-parent="#accordion" role="tabpanel" style="">
                <div class="card-body">
                    <div class="text-center modal-spinner"><div class="spinner-border text-primary m-2" role="status"></div></div>
                    <div class="awx-fields" style="display:none;">
                        <p>We accept following cards:&nbsp;&nbsp;
                            <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/visa.745a6485.svg" height="24" alt="Cerdit Cards">
                            <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/mastercard.262f85fc.svg" height="24" alt="Cerdit Cards">
                        </p>
<p><a href="https://stripe.com/docs/testing" target="_blank">Click here to find Stripe test cards</a></p>
                        <p id="error-payment" class="text-primary mb-3"></p>
                        <div class="row">
                            <div class="form-group col-12">
                                <div id="cardNumber"></div>
                            </div>
                            <div class="form-group col-6">
                                <div class="icon-container">
                                    <i class="icon-calendar"></i>
                                </div>
                                <div id="expiry"></div>
                            </div>
                            <div class="form-group col-6">
                                <div class="icon-container">
                                    <i class="icon-lock"></i>
                                </div>
                                <div id="cvc"></div>
                            </div>
                            
                            <div class="form-group col-12 mt-4">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" checked id="invalidCheck2">
                                    <label class="custom-control-label" for="invalidCheck2">Save this card for your next payment.</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" checked id="invalidCheck3">
                                    <label class="custom-control-label" for="invalidCheck3">Your billing address and shipping address are the same.</label>
                                </div>
                            </div>

                            <div class="form-group col-12 text-center paddin-top-1x">
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6">
                                        <button id="pay-button" class="btn btn-primary btn-block" disabled type="button" data-action="/s-checkout"><i class="icon-credit-card"></i> Pay $80.05</button>
                                    </div>
                                    <div class="col-sm-3"></div>
                                  </div>
                            </div>

                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

                    </div>
                    <!-- Sidebar -->
                    <div class="col-xl-4 col-lg-5 order-first order-md-last">
                        <aside class="sidebar">
                            <!-- Order Summary Widget-->
                            <section class="widget widget-order-summary widget-featured-products">
                                <h3 class="widget-title">Order Summary</h3>
                                <div class="entry">
                                    <div class="entry-thumb">
                                        <a href="/"><img src="/assets/img/shop/widget/iphone-xr-white-select-201809.png" alt="Product"></a>
                                    </div>
                                    <div class="entry-content">
                                        <h4 class="entry-title"><a href="/">iPhone XR</a></h4>
                                        <span class="entry-meta">64 GB White</span>
                                        <span class="entry-meta text-gray-dark text-right">$850 x 1</span>
                                    </div>
                                </div>
                                <hr class="mb-3">
                                <table class="table">
                                    <tr>
                                        <td>Subtotal</td>
                                        <td class="text-gray-dark">$850</td></tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="text-gray-dark">$10</td></tr>
                                    <tr>
                                        <td class="text-lg">Total</td>
                                        <td class="text-lg text-gray-dark">$860</td>
                                    </tr>
                                </table>
                            </section>
                            <div class="card mt-4 mb-5">
                                <div class="card-header"><span class="text-lg">Demo API Access</span></div>
                                <div class="card-body">
                                    <p id="error-user" class="text-primary mb-3"></p>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <div class="input-group">
                                                <input class="form-control" id="publishable-key" type="text" name="publishable-key" placeholder="Publishable Key" value="<?= $publishable_key ?>"><span class="input-group-addon"><i class="icon-lock"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="input-group">
                                                <input class="form-control" id="secret-key" type="text" name="secret-key" placeholder="Secret Key" value="<?= $secret_key ?>"><span class="input-group-addon"><i class="icon-lock"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" checked id="invalidCheck1">
                                                <label class="custom-control-label" for="invalidCheck1">I konw this demo only accepts <b>Stripe Demo Accounts</b> and the credentials will <b>NEVER</b> be saved.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="modal-failure" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog<?= ! $is_mobile ? ' modal-dialog-centered' : '' ?>" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Payment Failed</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
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
        <script src="<?= $asset_path ?>/js/vendor.min.js"></script>
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            $( document ).ready( function()
            {
                var card_is_completed = false;
                var expiry_is_completed = false;
                var cvc_is_completed = false;

                var button_text = $('#pay-button').html();

                const stripe = Stripe( $('#publishable-key').val(), {
                    apiVersion: '2020-08-27',
                });

                const elements = stripe.elements();

                const cardNumber = elements.create('cardNumber', {
                    'placeholder': 'Card Number',
                    'showIcon': true,
                    'iconStyle': 'solid',
                    'style': {
                        base: {
                          backgroundColor: '#fff',
                          iconColor: '#999',
                          color: '#505050',
                          fontSize: '14px',
                          fontWeight: '500',
                          fontSmoothing: 'antialiased',
                          ':-webkit-autofill': {
                            color: '#999999',
                            fontWeight: '400'
                          },
                          '::placeholder': {
                            color: '#999999',
                            fontWeight: '400'
                          },
                        },
                        invalid: {
                          iconColor: '#FFC7EE',
                          color: '#FFC7EE',
                        },
                      },
                });

                const cardExpiry = elements.create('cardExpiry', {
                    'placeholder': 'MM/YY',
                    'style': {
                        base: {
                          backgroundColor: '#fff',
                          iconColor: '#999',
                          color: '#505050',
                          fontSize: '14px',
                          fontWeight: '500',
                          fontSmoothing: 'antialiased',
                          ':-webkit-autofill': {
                            color: '#999999',
                            fontWeight: '400'
                          },
                          '::placeholder': {
                            color: '#999999',
                            fontWeight: '400'
                          },
                        },
                        invalid: {
                          iconColor: '#FFC7EE',
                          color: '#FFC7EE',
                        },
                      },
                });
                const cardCvc = elements.create('cardCvc', {
                    'placeholder': 'CVV',
                    'style': {
                        base: {
                          backgroundColor: '#fff',
                          iconColor: '#999',
                          color: '#505050',
                          fontSize: '14px',
                          fontWeight: '500',
                          fontSmoothing: 'antialiased',
                          ':-webkit-autofill': {
                            color: '#999999',
                            fontWeight: '400'
                          },
                          '::placeholder': {
                            color: '#999999',
                            fontWeight: '400'
                          },
                        },
                        invalid: {
                          iconColor: '#FFC7EE',
                          color: '#FFC7EE',
                        },
                      },
                });

                cardNumber.mount('#cardNumber');
                cardExpiry.mount('#expiry');
                cardCvc.mount('#cvc');

                // onReady
                cardCvc.on( 'ready', function( event ) {
                    $( '.awx-fields' ).show();
                    $( '.modal-spinner' ).remove();
                });


                // onChange
                cardNumber.on('change', function(event)
                {
                    if (event.error)
                    {
                    }

                    card_is_completed = event.complete;

                    $( '#pay-button' ).prop('disabled', !(card_is_completed && expiry_is_completed && cvc_is_completed));
                });

                cardExpiry.on('change', function(event)
                {
                    if (event.error)
                    {
                    }

                    expiry_is_completed = event.complete;

                    $( '#pay-button' ).prop('disabled', !(card_is_completed && expiry_is_completed && cvc_is_completed));
                });

                cardCvc.on('change', function(event)
                {
                    if (event.error)
                    {
                    }

                    cvc_is_completed = event.complete;

                    $( '#pay-button' ).prop('disabled', !(card_is_completed && expiry_is_completed && cvc_is_completed));
                });


                // onFocus
                cardNumber.on('focus', function(event)
                {
                    $('#cardNumber').addClass('awx-focus');
                });

                cardExpiry.on('focus', function(event)
                {
                    $('#expiry').addClass('awx-focus');
                });

                cardCvc.on('focus', function(event)
                {
                    $('#cvc').addClass('awx-focus');
                });

                cardNumber.on('blur', function(event)
                {
                    $('#cardNumber').removeClass('awx-focus');
                });

                cardExpiry.on('blur', function(event)
                {
                    $('#expiry').removeClass('awx-focus');
                });

                cardCvc.on('blur', function(event)
                {
                    $('#cvc').removeClass('awx-focus');
                });

                window.addEventListener('onFocus', (event) => {
                    $('#' + event.detail.type + ' iframe').addClass('awx-focus');
                    $('#' + event.detail.type ).siblings('.icon-container').addClass('awx-focus');
                });

                window.addEventListener('onBlur', (event) => {
                   $('#' + event.detail.type + ' iframe').removeClass('awx-focus');
                   $('#' + event.detail.type ).siblings('.icon-container').removeClass('awx-focus');
                });


                $('#pay-button').click(function(){
                    validateApiKey();
                    submitPaymentForm( stripe, elements.getElement( 'cardNumber' ) );
                });
            });

            function submitPaymentForm( stripe, cardNumber )
            {
                $.ajax({
                    url : $( '#pay-button' ).attr( 'data-action' ),
                    data : {
                        'publishable-key': $('#publishable-key').val(),
                        'secret-key': $('#secret-key').val(),
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
                            if ( data.msg.publishable_key != undefined && data.msg.publishable_key.length > 0 )
                            {
                                var clientId = $( '#publishable-key' );
                                $('#error-user').html(data.msg.publishable_key);
                                clientId.focus();
                            }

                            if ( data.msg.secret_key != undefined && data.msg.secret_key.length > 0 )
                            {
                                var apiKey = $( '#secret-key' );
                                $('#error-user').html(data.msg.secret_key);
                                apiKey.focus();
                            }

                            $('#pay-button').html('<i class="icon-credit-card"></i> Pay $80.05').prop('disabled', false);
                        }
                        else if( data.result=='1' && data.intent != undefined )
                        {
                            stripe.confirmCardPayment(
                                data.intent.client_secret,
                                {
                                    payment_method: {
                                        card: cardNumber,
                                        billing_details: {
                                            name: 'James Smith',
                                            phone: '+18888888',
                                            email: 'james@example.com',
                                            address: {
                                                country: 'US',
                                                state: 'CA',
                                                city: 'Los Angeles',
                                                postal_code: '222122',
                                                line1: 'ABC Street',
                                                line2: 'CCD Street'
                                            }
                                        },
                                    },
                                }
                            ).then(function(result){
                                if ( result.error )
                                {
                                    var modal = $('#modal-failure');

                                    $(modal).modal('show');

                                    // TODO - should consider how many attempts are allowed.
                                    $('#pay-button').html('<i class="icon-credit-card"></i> Pay $80.05').prop('disabled', false);
                                }
                                else
                                {
                                    window.location = '/s-success?id=' + data.intent.id + '&p=' + $('#publishable-key').val() + '&s=' + $('#secret-key').val();
                                }
                            });
                        }
                    }
                });
            }

            function validateApiKey( event )
            {
                var isValid     = false;
                var clientId        = $( '#publishable-key' );
                var apiKey       = $( '#secret-key' );
                var clientIdVal     = $( clientId ).val().trim();
                var apiKeyVal    = $( apiKey ).val().trim();
                var re = /\S+@\S+\.\S+/;

                if ( clientIdVal.length == 0 )
                {
                    $('#error-user').html('The Publishable Key field is required.');
                    clientId.focus();
                }
                else if ( apiKeyVal.length == 0 )
                {
                    $('#error-user').html('The Secret Key field is required.');
                    apiKey.focus();
                }
                else
                {
                    $('#error-user').html('');
                    isValid = true;
                }

                if ( ! isValid )
                {
                    event.preventDefault();
                }
            }
            
        </script>
    </body>
</html>
