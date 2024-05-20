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
                    <!-- Checkout Adress-->
                    <div class="col-12">

        <div class="accordion" id="accordion" role="tablist">
            <div class="card">
              <div class="card-header" role="tab">
                <h6><a class="" href="#newcard" data-toggle="collapse" aria-expanded="true">Pay with Card</a></h6>
              </div>
              <div class="collapse show" id="newcard" data-parent="#accordion" role="tabpanel" style="">
                <div class="card-body">
                    <div class="text-center modal-spinner"><div class="spinner-border text-primary m-2" role="status"></div></div>
                    <div class="awx-fields" style="display:none;">
                        <p>We accept following cards<br/><br/>
                        <img class="d-inline-block align-middle" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzUiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAzNSAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxwYXRoIGQ9Ik0wIDMuMjVDMCAxLjQ1NTA4IDEuNDU1MDcgMCAzLjI1IDBIMzEuNzVDMzMuNTQ0OSAwIDM1IDEuNDU1MDcgMzUgMy4yNVYyMC43NUMzNSAyMi41NDQ5IDMzLjU0NDkgMjQgMzEuNzUgMjRIMy4yNUMxLjQ1NTA3IDI0IDAgMjIuNTQ0OSAwIDIwLjc1VjMuMjVaIiBmaWxsPSJ3aGl0ZSIgLz4KICAgIDxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBkPSJNMTAuNzUwMyAxNi41NjhIOC40MTM2Mkw2LjY2MTM5IDkuODY4OTZDNi41NzgyMiA5LjU2MDggNi40MDE2MyA5LjI4ODM3IDYuMTQxODcgOS4xNTk5OEM1LjQ5MzYxIDguODM3MyA0Ljc3OTI4IDguNTgwNTEgNCA4LjQ1MDk5VjguMTkzMDhINy43NjQyMkM4LjI4Mzc0IDguMTkzMDggOC42NzMzOCA4LjU4MDUxIDguNzM4MzIgOS4wMzA0Nkw5LjY0NzQ3IDEzLjg2MjdMMTEuOTgzIDguMTkzMDhIMTQuMjU0OEwxMC43NTAzIDE2LjU2OFpNMTUuNTUzMyAxNi41NjhIMTMuMzQ2NUwxNS4xNjM3IDguMTkzMDhIMTcuMzcwNUwxNS41NTMzIDE2LjU2OFpNMjAuMjI1NyAxMC41MTMzQzIwLjI5MDYgMTAuMDYyMiAyMC42ODAzIDkuODA0MjcgMjEuMTM0OSA5LjgwNDI3QzIxLjg0OTIgOS43Mzk1MiAyMi42MjczIDkuODY5MDMgMjMuMjc2NyAxMC4xOTA2TDIzLjY2NjQgOC4zODc0M0MyMy4wMTcgOC4xMjk1MSAyMi4zMDI2IDggMjEuNjU0NCA4QzE5LjUxMjUgOCAxNy45NTM5IDkuMTYwMDUgMTcuOTUzOSAxMC43NzAxQzE3Ljk1MzkgMTEuOTk0OSAxOS4wNTc5IDEyLjYzOCAxOS44MzcyIDEzLjAyNTRDMjAuNjgwMyAxMy40MTE3IDIxLjAwNSAxMy42Njk2IDIwLjk0IDE0LjA1NTlDMjAuOTQgMTQuNjM1NCAyMC4yOTA2IDE0Ljg5MzMgMTkuNjQyNCAxNC44OTMzQzE4Ljg2MzEgMTQuODkzMyAxOC4wODM4IDE0LjcwMDIgMTcuMzcwNiAxNC4zNzc1TDE2Ljk4MSAxNi4xODE4QzE3Ljc2MDMgMTYuNTAzMyAxOC42MDMzIDE2LjYzMjggMTkuMzgyNiAxNi42MzI4QzIxLjc4NDIgMTYuNjk2NSAyMy4yNzY3IDE1LjUzNzUgMjMuMjc2NyAxMy43OThDMjMuMjc2NyAxMS42MDc0IDIwLjIyNTcgMTEuNDc5IDIwLjIyNTcgMTAuNTEzM1pNMzEgMTYuNTY4TDI5LjI0NzggOC4xOTMwOEgyNy4zNjU3QzI2Ljk3NiA4LjE5MzA4IDI2LjU4NjQgOC40NTA5OSAyNi40NTY1IDguODM3M0wyMy4yMTE4IDE2LjU2OEgyNS40ODM2TDI1LjkzNyAxNS4zNDQzSDI4LjcyODNMMjguOTg4IDE2LjU2OEgzMVpNMjcuNjkwNCAxMC40NDg3TDI4LjMzODYgMTMuNjA1MUgyNi41MjE1TDI3LjY5MDQgMTAuNDQ4N1oiIGZpbGw9IiMyMjREQkEiIC8+CiAgICA8cGF0aCBkPSJNMy4yNSAxSDMxLjc1Vi0xSDMuMjVWMVpNMzQgMy4yNVYyMC43NUgzNlYzLjI1SDM0Wk0zMS43NSAyM0gzLjI1VjI1SDMxLjc1VjIzWk0xIDIwLjc1VjMuMjVILTFWMjAuNzVIMVpNMy4yNSAyM0MyLjAwNzM2IDIzIDEgMjEuOTkyNiAxIDIwLjc1SC0xQy0xIDIzLjA5NzIgMC45MDI3ODkgMjUgMy4yNSAyNVYyM1pNMzQgMjAuNzVDMzQgMjEuOTkyNiAzMi45OTI2IDIzIDMxLjc1IDIzVjI1QzM0LjA5NzIgMjUgMzYgMjMuMDk3MiAzNiAyMC43NUgzNFpNMzEuNzUgMUMzMi45OTI2IDEgMzQgMi4wMDczNiAzNCAzLjI1SDM2QzM2IDAuOTAyNzkgMzQuMDk3MiAtMSAzMS43NSAtMVYxWk0zLjI1IC0xQzAuOTAyNzkgLTEgLTEgMC45MDI3OSAtMSAzLjI1SDFDMSAyLjAwNzM2IDIuMDA3MzYgMSAzLjI1IDFWLTFaIiBmaWxsPSIjRjZGN0Y4IiAvPgo8L3N2Zz4KICAgIA==" height="24" alt="Visa">
                        <img class="d-inline-block align-middle" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzNSIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDM1IDI0Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHJlY3Qgd2lkdGg9IjM1IiBoZWlnaHQ9IjI0IiBmaWxsPSIjRThFQUVEIiByeD0iMy4yNDgiLz4KICAgICAgICA8Zz4KICAgICAgICAgICAgPHBhdGggZmlsbD0iI0ZGNUUwMCIgZD0iTTE1LjUxOS4xMjJjMy42ODcgMCA2LjY3NiAyLjk2NyA2LjY3NiA2LjYyNyAwIDMuNjYtMi45ODkgNi42MjctNi42NzYgNi42MjctMS42NTMgMC0zLjE2Ni0uNTk2LTQuMzMyLTEuNTg0LTEuMTY0Ljk4OC0yLjY3NyAxLjU4NC00LjMzIDEuNTg0QzMuMTcgMTMuMzc2LjE4IDEwLjQwOS4xOCA2Ljc0OS4xOCAzLjA4OSAzLjE3LjEyMiA2Ljg1Ny4xMjJjMS42NTMgMCAzLjE2Ni41OTYgNC4zMzIgMS41ODNDMTIuMzUzLjcxOCAxMy44NjYuMTIyIDE1LjUxOS4xMjJ6IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg2IDUpIi8+CiAgICAgICAgICAgIDxwYXRoIGZpbGw9IiNFRDAwMDYiIGQ9Ik02Ljg1Ny4xMjJjMS42NTMgMCAzLjE2Ni41OTYgNC4zMzIgMS41ODNDOS43NTIgMi45MjEgOC44NDIgNC43MyA4Ljg0MiA2Ljc1YzAgMi4wMi45MSAzLjgyOCAyLjM0NSA1LjA0My0xLjE2NC45ODgtMi42NzcgMS41ODQtNC4zMyAxLjU4NEMzLjE3IDEzLjM3Ni4xOCAxMC40MDkuMTggNi43NDkuMTggMy4wODkgMy4xNy4xMjIgNi44NTcuMTIyeiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNiA1KSIvPgogICAgICAgICAgICA8cGF0aCBmaWxsPSIjRjlBMDAwIiBkPSJNMTUuNTE5LjEyMmMzLjY4NyAwIDYuNjc2IDIuOTY3IDYuNjc2IDYuNjI3IDAgMy42Ni0yLjk4OSA2LjYyNy02LjY3NiA2LjYyNy0xLjY1MyAwLTMuMTY2LS41OTctNC4zMzItMS41ODQgMS40MzYtMS4yMTUgMi4zNDctMy4wMjMgMi4zNDctNS4wNDNzLS45MS0zLjgyOC0yLjM0NS01LjA0NEMxMi4zNTQuNzE4IDEzLjg2Ni4xMjIgMTUuNTE5LjEyMnoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDYgNSkiLz4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPgo=" height="24" alt="Mastercard">
                        <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/amex.f6c1eb25db0f19a0aada.svg" height="24" alt="JCB">
                        <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/jcb.9c8dde0afb56485cd18e.svg" height="24" alt="JCB">
                        <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/unionpay.9421a757c6289e8c65ec.svg" height="24" alt="UnionPay">
                        <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/diners.e7ac1a6d6dc9664b8202.svg" height="24" alt="Diners Club">
                        <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/discover.7f4c984384f28909560f.svg" height="24" alt="Discover">
                        </p>
                        <p id="error-payment" class="text-primary mb-3"></p>
                        <div class="row">

                            <div class="form-group col-12">
                                <div class="icon-container">
                                    <i class="icon-credit-card"></i>
                                </div>
                                <div id="cardNumber"></div>
                                <div class="cardNumber-invalid-tooltip invalid-tooltip"></div>
                            </div>
                            <div class="form-group col-6">
                                <div class="icon-container">
                                    <i class="icon-calendar"></i>
                                </div>
                                <div id="expiry"></div>
                                <div class="expiry-invalid-tooltip invalid-tooltip"></div>
                            </div>
                            <div class="form-group col-6">
                                <div class="icon-container">
                                    <i class="icon-lock"></i>
                                </div>
                                <div id="cvc"></div>
                                <div class="cvc-invalid-tooltip invalid-tooltip"></div>
                            </div>

                            <div class="form-group col-6">
                              <label for="msg-lang" style="padding-left: 0;">Select Error Message Language</label>
                              <select class="form-control" id="msg-lang">
                                  <option value="en" <?= ( $lang == 'en' ) ? 'selected ' : '' ?>>English</option>
                                  <option value="zh" <?= ( $lang == 'zh' ) ? 'selected ' : '' ?>>Simplified Chinese</option>
                                  <option value="zh-HK" <?= ( $lang == 'zh-HK' ) ? 'selected ' : '' ?>>Traditional Chinese</option>
                                  <option value="ja" <?= ( $lang == 'ja' ) ? 'selected ' : '' ?>>Japanese</option>
                                  <option value="ko" <?= ( $lang == 'ko' ) ? 'selected ' : '' ?>>Korean</option>
                              </select>
                            </div>
                            <div class="form-group col-6"></div>



                            <div class="form-group col-12 text-center paddin-top-1x">
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6">
                                        <button id="pay-button" class="btn btn-primary btn-block" disabled type="button" data-action="<?= site_url( 'payments/cards/embedded-fields' ) ?>"><i class="icon-credit-card"></i> Pay $80.59</button>
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
                        locale: '<?= $lang ?>'
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

                window.addEventListener('onChange', (event) => {
                    if( 'cardNumber' == event.detail.type  ) card_is_completed = event.detail.complete;
                    if( 'expiry' == event.detail.type ) expiry_is_completed = event.detail.complete;
                    if( 'cvc' == event.detail.type ) cvc_is_completed = event.detail.complete;

                    $( '#pay-button' ).prop('disabled', !(card_is_completed && expiry_is_completed && cvc_is_completed));
                });

                $('#pay-button').click(function(){
                    submitPaymentForm();
                });


                $('#msg-lang').change(function()
                {
                    var selectedLanguage = $(this).val();
                    if (selectedLanguage)
                    {
                        updateLanguageInUrl(selectedLanguage);
                    }
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
                            $('#pay-button').html('<i class="icon-credit-card"></i> Pay $80.59').prop('disabled', false);
                        }
                        else if( data.result=='1' && data.intent != undefined )
                        {

                            // Do not save the card or use a saved card.
                            Airwallex.confirmPaymentIntent({
                                element: Airwallex.getElement('cardNumber'),
                                id: data.intent.id,
                                client_secret: data.intent.client_secret,
                            })
                            .then((response) => {
                                // Handle successful responses
                                window.location = '/success?m=card-embedded-fields&id=' + data.intent.id;

                            })
                            .catch((response) => {
                                // Handle error responses
                                console.log( response );
                            
                                var modal = $('#modal-failure');

                                $(modal).modal('show');

                                $('#pay-button').html('<i class="icon-credit-card"></i> Pay $80.59').prop('disabled', false);

                            });
                        }
                    }
                });
            }

            function updateLanguageInUrl(lang)
            {
                const url = new URL(window.location.href);
                url.searchParams.set('lang', lang);
                window.location.href = url.toString();
            }

        </script>
    </body>
</html>
