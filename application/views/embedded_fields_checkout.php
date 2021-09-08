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
            #payment-form iframe {
                height: 46px !important
            }

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

            #payment-form [id$="-error"] {
                display: none
            }

            #payment-form iframe {
                border: 1px solid #e0e0e0 !important;
                border-radius: 5px !important;
                background-color: #fff !important;
                color: #505050 !important;
                font-family: "Rubik",Helvetica,Arial,sans-serif !important;
                font-size: 14px !important;
                height: 46px !important
            }

            #payment-form iframe.awx-focus {
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
                    <h1>Airwallex Card Payment Demo - Embedded Fields</h1>
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
                                <h4 class="step-title"><i class="icon-check-circle"></i>1. Address</h4>
                            </a>
                            <a class="step" href="#">
                                <h4 class="step-title"><i class="icon-check-circle"></i>2. Shipping</h4>
                            </a>
                            <a class="step active" href="">
                                <h4 class="step-title">3. Payment</h4>
                            </a>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header"><span class="text-lg">Pay With A Saved Card</span></div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                      <tbody>
                                        <tr>
                                          <td class="align-middle">
                                            <div class="custom-control custom-radio mb-0">
                                              <input class="custom-control-input" type="radio" id="local" checked name="shipping-method">
                                              <label class="custom-control-label" for="local"></label>
                                            </div>
                                          </td>
                                          <td class="align-middle"><span class="text-gray-dark">Local Shipping</span><br><span class="text-muted text-sm">All Addresses(default zone), United States &amp; Canada</span></td>
                                          <td class="align-middle">up to one week</td>
                                        </tr>
                                        <tr>
                                          <td class="align-middle">
                                            <div class="custom-control custom-radio mb-0">
                                              <input class="custom-control-input" type="radio" id="flat" name="shipping-method">
                                              <label class="custom-control-label" for="flat"></label>
                                            </div>
                                          </td>
                                          <td class="align-middle"><span class="text-gray-darkm">Flat Rate</span><br><span class="text-muted text-sm">All Addresses(default zone)</span></td>
                                          <td class="align-middle">5 - 7 days</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>

                                <div class="form-group col-12 text-center mt-2">
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <button id="pay-button" class="btn btn-primary btn-block" type="button" data-action="/embedded-fields-checkout"><i class="icon-credit-card"></i> Pay $80.05</button>
                                        </div>
                                        <div class="col-sm-3"></div>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header"><span class="text-lg">Pay With A New Card</span></div>
                            <div class="card-body">
                                <div class="text-center modal-spinner"><div class="spinner-border text-primary m-2" role="status"></div></div>
                                <div class="awx-fields" style="display:none;">
                                    <p>We accept following cards:&nbsp;&nbsp;
                                        <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/visa.745a6485.svg" height="24" alt="Cerdit Cards">
                                        <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/mastercard.262f85fc.svg" height="24" alt="Cerdit Cards">
                                    </p>
<p><a href="https://www.airwallex.com/docs/online-payments__test-card-numbers" target="_blank">Click here to find Airwallex test cards</a></p>
                                    <p id="error-payment" class="text-primary mb-3"></p>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <div class="icon-container">
                                                <i class="icon-credit-card"></i>
                                            </div>
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
                                                    <button id="pay-button" class="btn btn-primary btn-block" disabled type="button" data-action="/embedded-fields-checkout"><i class="icon-credit-card"></i> Pay $80.05</button>
                                                </div>
                                                <div class="col-sm-3"></div>
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
                                                <input class="form-control" id="client-id" type="text" name="client-id" placeholder="Client ID" value="<?= $client_id ?>"><span class="input-group-addon"><i class="icon-lock"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="input-group">
                                                <input class="form-control" id="api-key" type="text" name="api-key" placeholder="API Key" value="<?= $api_key ?>"><span class="input-group-addon"><i class="icon-lock"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="input-group">
                                                <input class="form-control" id="customer-id" type="text" name="customer-id" placeholder="Current Customer ID" value="<?= $customer_id ?>"><span class="input-group-addon"><i class="icon-user"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" checked id="invalidCheck1">
                                                <label class="custom-control-label" for="invalidCheck1">I konw this demo only accepts <b>Airwallex Demo Accounts</b> and the credentials will <b>NEVER</b> be saved.</label>
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
        <script src="https://checkout.airwallex.com/assets/bundle.0.2.22.min.js"></script>

        <script>
            $( document ).ready( function()
            {
                var card_is_completed = false;
                var expiry_is_completed = false;
                var cvc_is_completed = false;

                var button_text = $('#pay-button').html();

                try {
                    // STEP #2: Initialize the Airwallex global context for event communication
                    Airwallex.init({
                        env: 'demo', // Setup which Airwallex env('staging' | 'demo' | 'prod') to integrate with
                        origin: window.location.origin, // Setup your event target to receive the browser events message
                    });

                    // STEP #4: Create split card elements
                    const cardNumber = Airwallex.createElement('cardNumber', {
                        'placeholder': 'Card Number',
                        'autoCapture': true
                    });
                    const expiry = Airwallex.createElement('expiry', {
                        'placeholder': 'MM/YY'
                    });
                    const cvc = Airwallex.createElement('cvc', {
                        'placeholder': 'CVV'
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

                window.addEventListener('onBlur', (event) => {
                   $('#' + event.detail.type + ' iframe').removeClass('awx-focus');
                   $('#' + event.detail.type ).siblings('.icon-container').removeClass('awx-focus');
                });

                window.addEventListener('onChange', (event) => {
                    if( 'cardNumber' == event.detail.type  ) card_is_completed = event.detail.complete;
                    if( 'expiry' == event.detail.type ) expiry_is_completed = event.detail.complete;
                    if( 'cvc' == event.detail.type ) cvc_is_completed = event.detail.complete;

                    $( '#pay-button' ).prop('disabled', !(card_is_completed && expiry_is_completed && cvc_is_completed));
                });

                $('#pay-button').click(function(){
                    validateApiKey();
                    submitPaymentForm();
                });
            });

            function submitPaymentForm()
            {
                $.ajax({
                    url : $( '#pay-button' ).attr( 'data-action' ),
                    data : {
                        'client-id': $('#client-id').val(),
                        'api-key': $('#api-key').val(),
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
                            if ( data.msg.client_id != undefined && data.msg.client_id.length > 0 )
                            {
                                var clientId = $( '#client-id' );
                                $('#error-user').html(data.msg.client_id);
                                clientId.focus();
                            }

                            if ( data.msg.api_key != undefined && data.msg.api_key.length > 0 )
                            {
                                var apiKey = $( '#api-key' );
                                $('#error-user').html(data.msg.api_key);
                                apiKey.focus();
                            }

                            if ( data.msg.token != undefined && data.msg.token.length > 0 )
                            {
                                var clientId = $( '#client-id' );
                                $('#error-user').html(data.msg.token);
                                clientId.focus();
                            }

                            $('#pay-button').html('<i class="icon-credit-card"></i> Pay $80.05').prop('disabled', false);
                        }
                        else if ( data.result=='1' && data.redirection != undefined )
                        {

                        }
                        else if( data.result=='1' && data.intent != undefined )
                        {
                            if ( data.customer != undefined )
                            {
                                Airwallex.createPaymentConsent({
                                    "intent_id": data.intent.id,
                                    "client_secret": data.intent.client_secret,
                                    "element": Airwallex.getElement("cardNumber"),
                                    "customer_id": data.customer.id,
                                    "currency": 'USD',
                                    "next_triggered_by": "customer",
                                    "merchant_trigger_reason": "unscheduled",
                                    "requires_cvc": false,
                                    "billing": {
                                        "first_name": "Steve",
                                        "last_name": "Gates",
                                        "phone_number": "+187631283",
                                        "address": {
                                            "country_code": "US",
                                            "state": "AK",
                                            "city": "Akhiok",
                                            "street": "Street No. 4",
                                            "postcode": "99654"
                                        }
                                    }
                                }).then((response) => {
                                    window.location = '/success?id=' + data.intent.id + '&c=' + $('#client-id').val() + '&k=' + $('#api-key').val();
                                }).catch((response) => {
                                    console.log( response.original_code );
                                
                                    var modal = $('#modal-failure');

                                    $(modal).modal('show');

                                    $('#pay-button').html('<i class="icon-credit-card"></i> Pay $80.05').prop('disabled', false);
                                });
                            }

                            // Save the card


                            // Do not save the card or use a saved card.
                            /*
                            Airwallex.confirmPaymentIntent({
                                element: Airwallex.getElement('cardNumber'),
                                id: data.intent.id,
                                client_secret: data.intent.client_secret,
                                payment_method: {
                                    "billing": {
                                        "first_name": "Steve",
                                        "last_name": "Gates",
                                        "phone_number": "+187631283",
                                        "address": {
                                            "country_code": "US",
                                            "state": "AK",
                                            "city": "Akhiok",
                                            "street": "Street No. 4",
                                            "postcode": "99654"
                                        }
                                    },
                                    "card": {
                                        //"name": $('#name-on-card').val()
                                    }
                                }
                            })
                            .then((response) => {
                                // Handle successful responses
                                window.location = '/success?id=' + data.intent.id + '&c=' + $('#client-id').val() + '&k=' + $('#api-key').val();

                            })
                            .catch((response) => {
                                // Handle error responses
                                console.log( response.original_code );
                            
                                var modal = $('#modal-failure');

                                $(modal).modal('show');

                                $('#pay-button').html('<i class="icon-credit-card"></i> Pay $80.05').prop('disabled', false);
                            });*/
                        }
                    }
                });
            }

            function validateApiKey( event )
            {
                var isValid     = false;
                var clientId        = $( '#client-id' );
                var apiKey       = $( '#api-key' );
                var clientIdVal     = $( clientId ).val().trim();
                var apiKeyVal    = $( apiKey ).val().trim();
                var re = /\S+@\S+\.\S+/;

                if ( clientIdVal.length == 0 )
                {
                    $('#error-user').html('The Client Id field is required.');
                    clientId.focus();
                }
                else if ( apiKeyVal.length == 0 )
                {
                    $('#error-user').html('The Api Key field is required.');
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
