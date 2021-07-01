<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Checkout - Smooth CKO Flow</title>
        <!-- SEO Meta Tags-->
        <meta name="description" content="Checkout - Smooth CKO Flow">
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
                padding-left: 37px
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

            #payment-form [id$="-error"] {
                display: none
            }

            #payment-form .frame {
                opacity: 0
            }

            #payment-form #cardNumber iframe .MuiInputBase-input {
                border: 1px solid #e0e0e0 !important;
                border-radius: 5px !important;
                background-color: #fff !important;
                color: #505050 !important;
                font-family: "Rubik",Helvetica,Arial,sans-serif !important;
                font-size: 14px !important;
                height: 46px !important
            }

            #payment-form .frame--activated.frame--focus {
                border-color: #F03B2D !important;
                outline: none !important;
                background-color: rgba(240,59,45,0.02) !important;
                color: #505050 !important;
                box-shadow: none !important
            }

            #payment-form .frame--activated.frame--invalid {
                border: solid 1px #d96830;
                box-shadow: 0 2px 5px 0 rgba(217,104,48,0.15)
            }

            #payment-form .error-message {
                display: block;
                color: #c9501c;
                font-size: 0.9rem;
                margin: 8px 0 0 1px;
                font-weight: 300
            }

            #payment-form .success-payment-message {
                color: #13395e;
                line-height: 1.4
            }

            #payment-form .token {
                color: #b35e14;
                font-size: 0.9rem;
                font-family: monospace
            }

            #payment-form _:-ms-fullscreen,#payment-form :root .icon-container {
                display: block
            }

            #payment-form _:-ms-fullscreen,#payment-form :root .icon-container img {
                top: 50%;
                -ms-transform: translateY(-50%);
                position: absolute
            }

            #payment-form _:-ms-fullscreen,#payment-form #icon-card-number,#payment-form _:-ms-fullscreen,#payment-form #icon-expiry-date,#payment-form _:-ms-fullscreen,#payment-form #icon-cvv {
                left: 7px
            }

            #payment-form #checkout-frames-card-number::-ms-clear {
                display: none
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
                    <h1>Card Payment Demo</h1>
                </div>
            </div>
        </div>
        <!-- Page Content-->
        <div class="container padding-bottom-3x mb-2">
            <form id="payment-form">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <input type="hidden" id="cko-token" name="cko-token" value="">
                <input type="hidden" name="amount" value="860">
                <div class="row">
                    <!-- Checkout Adress-->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card mb-4">
                            <div class="card-header"><span class="text-lg">Demo API Access</span></div>
                            <div class="card-body">
                                <p id="error-user" class="text-primary mb-3"></p>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <div class="input-group">
                                            <input class="form-control" id="client-id" type="text" name="client-id" placeholder="Client ID"><span class="input-group-addon"><i class="icon-lock"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="input-group">
                                            <input class="form-control" id="api-key" type="text" name="api-key" placeholder="API Key"><span class="input-group-addon"><i class="icon-lock"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" checked id="invalidCheck2">
                                            <label class="custom-control-label" for="invalidCheck2">I am aware that this demo only accepts Airwallex Demo Accounts and the credentials will never be saved.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header"><span class="text-lg">Payment Details</span></div>
                            <div class="card-body">
                                <div class="text-center modal-spinner"><div class="spinner-border text-primary m-2" role="status"></div></div>
                                <div class="awx-fields" style="display:none;">
                                    <p>We accept following cards:&nbsp;&nbsp;
                                        <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/visa.745a6485.svg" height="24" alt="Cerdit Cards">
                                        <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/mastercard.262f85fc.svg" height="24" alt="Cerdit Cards">
                                        
                                </p>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center paddin-top-1x mt-4">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <button id="pay-button" class="btn btn-primary btn-block" disabled type="button" data-action="/checkout">Pay 860£</button>
                                </div>
                                <div class="col-sm-3"></div>
                              </div>
                        </div>
                    </div>
                    <!-- Sidebar -->
                    <div class="col-xl-4 col-lg-5 order-first order-md-last">
                        <aside class="sidebar">
                            <!-- Order Summary Widget-->
                            <section class="widget widget-order-summary widget-featured-products">
                                <h3 class="widget-title">Summary</h3>
                                <div class="entry">
                                    <div class="entry-thumb">
                                        <a href="/"><img src="/assets/img/shop/widget/iphone-xr-white-select-201809.png" alt="Product"></a>
                                    </div>
                                    <div class="entry-content">
                                        <h4 class="entry-title"><a href="/">iPhone XR</a></h4>
                                        <span class="entry-meta">64 GB White</span>
                                        <span class="entry-meta text-gray-dark text-right">850£ x 1</span>
                                    </div>
                                </div>
                                <hr class="mb-3">
                                <table class="table">
                                    <tr>
                                        <td>Subtotal</td>
                                        <td class="text-gray-dark">850£</td></tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="text-gray-dark">10£</td></tr>
                                    <tr>
                                        <td class="text-lg">Total</td>
                                        <td class="text-lg text-gray-dark">860£</td>
                                    </tr>
                                </table>
                            </section>
                        </aside>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="modal-3ds" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog<?= ! $is_mobile ? ' modal-dialog-centered' : '' ?>" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">3D-Secure 2 Authentication</h5>
                    </div>
                    <div class="modal-body">
                        <iframe src="" style="border:none;height:450px"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= $asset_path ?>/js/vendor.min.js"></script>
        <script src="https://checkout.airwallex.com/assets/bundle.0.2.22.min.js"></script>
        <script>
            $( document ).ready( function()
            {
                try {
                    // STEP #2: Initialize the Airwallex global context for event communication
                    Airwallex.init({
                        env: 'demo', // Setup which Airwallex env('staging' | 'demo' | 'prod') to integrate with
                        origin: window.location.origin, // Setup your event target to receive the browser events message
                    
                    });

                    // STEP #4: Create split card elements
                    const cardNumber = Airwallex.createElement('cardNumber');
                    const expiry = Airwallex.createElement('expiry');
                    const cvc = Airwallex.createElement('cvc');

                    // STEP #5: Mount split card elements
                    cardNumber.mount('cardNumber'); // This 'cardNumber' id MUST MATCH the id on your cardNumber empty container created in Step 3
                    expiry.mount('expiry'); // Same as above
                    cvc.mount('cvc'); // Same as above

                    $( '.awx-fields' ).show();
                    $( '.modal-spinner' ).remove();
                } catch (error) {
                    //document.getElementById('loading').style.display = 'none'; // Example: hide loading state
                    //document.getElementById('error').style.display = 'block'; // Example: show error
                    //document.getElementById('error').innerHTML = error.message; // Example: set error message
                    console.error('There was an error', error);
                }

            });

            function getErrorMessage(element)
            {
                var errors =
                {
                    "card-number": "Please enter a valid card number",
                    "expiry-date": "Please enter a valid expiry date",
                    "cvv": "Please enter a valid cvv code",
                };

                return errors[element];
            }

            function submitPaymentForm()
            {
                $.ajax({
                    url : $( '#pay-button' ).attr( 'data-action' ),
                    data : $( '#payment-form' ).serialize(),
                    type : 'post',
                    beforeSend : function()
                    {
                        $( '#pay-button' ).html('<div class="spinner-border spinner-border-sm text-white mr-2" role="status"></div>Checking Out...');
                    },
                    success : function( data )
                    {
                        if ( data.result == '0' )
                        {
                            if ( data.msg.name != undefined && data.msg.name.length > 0 )
                            {
                                var formName = $( '#name' );
                                $('#error-user').html(data.msg.name);
                                formName.focus();
                            }

                            if ( data.msg.email != undefined && data.msg.email.length > 0 )
                            {
                                var formEmail = $( '#email' );
                                $('#error-user').html(data.msg.email);
                                formEmail.focus();
                            }

                            if ( data.msg.email != undefined && data.msg.email.length > 0 )
                            {
                                var formEmail = $( '#email' );
                                $('#error-user').html(data.msg.email);
                                formEmail.focus();
                            }

                            $('#pay-button').prop('disabled', false);
                        }
                        else if (data.result=='1')
                        {
                            var modal = $('#modal-3ds');
                            $( modal ).on('shown.bs.modal',function()
                            {
                                $( modal ).find('iframe').attr('src',data.redirection)
                            });

                            $(modal).modal('show');
                        }
                    }
                });
            }

            function validateNameAndEmail( event )
            {
                var isValid     = false;
                var name        = $( '#name' );
                var email       = $( '#email' );
                var nameVal     = $( name ).val().trim();
                var emailVal    = $( email ).val().trim();
                var re = /\S+@\S+\.\S+/;

                if ( nameVal.length == 0 )
                {
                    $('#error-user').html('The Name field is required.');
                    name.focus();
                }
                else if ( emailVal.length == 0 )
                {
                    $('#error-user').html('The Email field is required.');
                    email.focus();
                }
                else if ( ! re.test( emailVal ) )
                {
                    $('#error-user').html('The Email field must contain a valid email address.');
                    email.focus();
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
