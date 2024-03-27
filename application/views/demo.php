<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <title>模拟订单付款请求</title>
    <link href="~/css/style.css" rel="stylesheet" />
    <script src="https://checkout.airwallex.com/assets/elements.bundle.min.js"></script>
    <script src="~/js/jquery-1.8.3.min.js"></script>
    <style type="text/css">
        .lineDv{
            margin-top: 20px;
            margin-left: 100px;
        }
    </style>
</head>
<body>
    <div id="dvOrderInfo">
        <div class="lineDv">
            <label>订单号<label style="color:red">*</label>: </label><input type="text" id="txtXwOrderNum" style="width:200px" />
        </div>
        <div class="lineDv">
            <label>需付金额<label style="color:red">*</label>: </label><input type="number" id="txtAmount" style="width:200px" />
        </div>
        <div class="lineDv">
            <label>币种<label style="color:red">*</label>: </label><input type="text" id="txtCurrency" style="width:200px" value="USD" />
        </div>
        <br /><br /><label>以下信息是填客户的信息, 用于风控</label><br />
        <div class="lineDv">
            <label>客户 姓<label style="color:red">*</label>: </label><input type="text" id="txtLastName" style="width:200px" value="Zhang" />
        </div>
        <div class="lineDv">
            <label>客户 名<label style="color:red">*</label>: </label><input type="text" id="txtFirstName" style="width:200px" value="Sanfeng" />
        </div>
        <div class="lineDv">
            <label>客户 Email<label style="color:red">*</label>: </label><input type="text" id="txtEmail" style="width:200px" value="heytrip@airwallex.com" />
        </div>
        <div class="lineDv">
            <label>客户 ID: </label><input type="text" id="txtUID" style="width:200px" value="" />
        </div>
        <div class="lineDv">
            <label>客户 手机号码: </label><input type="text" id="txtPhone" style="width:200px" />
        </div>
    </div>
    <br />
    <br />
    <br />
    <div id="dvAirwallexPayment">
        <p id="loading">Loading...</p>
        <div id="element">
            <div class="field-container">
                <div>Card number</div>
                <div id="cardNumber"></div>
                <img style="width:30px" src="~/img/AMEX.png" />
                <img style="width:30px" src="~/img/JCB.png" />
                <img style="width:30px" src="~/img/mastercard.png" />
                <img style="width:30px" src="~/img/mastro.png" />
                <img style="width:30px" src="~/img/UnionPay.png" />
                <img style="width:30px" src="~/img/visa.png" />
                <p id="cardNumber-error" style="color: red;"></p>
            </div>
            <div class="field-container">
                <div>Expiry</div>
                <div id="expiry"></div>
                <p id="expiry-error" style="color: red;"></p>
            </div>
            <div class="field-container">
                <div>Cvc</div>
                <div id="cvc"></div>
                <p id="cvc-error" style="color: red;"></p>
            </div>
            <!-- STEP #3b: Add a submit button to trigger the payment request -->
            <button id="submit">Submit</button>
        </div>
        <p id="error"></p>
        <p id="success">Payment Successful!</p>
    </div>
    <script type="text/javascript">
        let cardNumberElementInstance = null;
        try {
            // STEP #2: Initialize the Airwallex global context for event communication
            Airwallex.init({
                env: "demo", // Setup which Airwallex env('staging' | 'demo' | 'prod') to integrate with
                origin: window.location.origin, // Setup your event target to receive the browser events message
                fonts: [
                    // Customizes the font for the payment elements
                    {
                        src:
                            "https://checkout.airwallex.com/fonts/CircularXXWeb/CircularXXWeb-Regular.woff2",
                        family: "AxLLCircular",
                        weight: 400
                    }
                ]
            });

            // STEP #4: Create split card elements
            const cardNumber = Airwallex.createElement("cardNumber");
            const expiry = Airwallex.createElement("expiry");
            const cvc = Airwallex.createElement("cvc");
            cardNumberElementInstance = cardNumber;

            // STEP #5: Mount split card elements
            cardNumber.mount("cardNumber"); // This 'cardNumber' id MUST MATCH the id on your cardNumber empty container created in Step 3
            expiry.mount("expiry"); // Same as above
            cvc.mount("cvc"); // Same as above
        } catch (error) {
            document.getElementById("loading").style.display = "none"; // Example: hide loading state
            document.getElementById("error").style.display = "block"; // Example: show error
            document.getElementById("error").innerHTML = error.message; // Example: set error message
            console.error("There was an error", error);
        }

        // STEP #6a: Add a button handler to trigger the payment request
        document.getElementById("submit").addEventListener("click", () => {

            if ($.trim($("#txtSource").val()) == "") {
                alert("订单号 必填项");
                return;
            }
            if ($.trim($("#txtAmount").val()) == "") {
                alert("需付金额 必填项");
                return;
            }
            if ($.trim($("#txtCurrency").val()) == "") {
                alert("币种 必填项");
                return;
            }

            if ($.trim($("#txtLastName").val()) == "") {
                alert("客户 姓 必填项");
                return;
            }
            if ($.trim($("#txtFirstName").val()) == "") {
                alert("客户 名 必填项");
                return;
            }
            if ($.trim($("#txtEmail").val()) == "") {
                alert("客户 Email 必填项");
                return;
            }

            // STEP #4: Froze the page in case shopper change again
            document.getElementById("loading").style.display = "block";
            document.getElementById("submit").disabled = true;

            $.ajax({
                type: "post",
                url: "Home/SubmitPayment",
                dataType: "json",
                data:
                {
                    XwOrderNum: $.trim($("#txtXwOrderNum").val()),
                    Amount: $.trim($("#txtAmount").val()),
                    Currency: $.trim($("#txtCurrency").val()),
                    LastName: $.trim($("#txtLastName").val()),
                    FirstName: $.trim($("#txtFirstName").val()),
                    Email: $.trim($("#txtEmail").val()),
                    UID: $.trim($("#txtUID").val()),
                    Phone: $.trim($("#txtPhone").val()),
                },
                success: function (resultObj) {
                    if (resultObj.code == 0) {
                        // STEP #5: Send request to your backend to get customer id and customer client secret
                        const customerId = resultObj.customer_id;//$("#cus_id").val();
                        const customerClientSecret = resultObj.customer_client_secret;//$("#cus_client_secret").val();


                        // STEP #6: call createPaymentMethod function with customer id and customer client secret
                        Airwallex.createPaymentMethod(customerClientSecret, {
                            element: cardNumberElementInstance,
                            customer_id: customerId
                        }).then((response) => {
                            // STEP #7: Get card info and call third party fraud provider
                            window.alert(JSON.stringify(response));

                            // STEP #8a: If it is a fraud checkout show fraud popup
                            var isFraud = false;
                            if (isFraud) {
                                alert("输出校验结果提醒");
                                return;
                            }

                            // STEP #8b: If no fraud, continue to create intent
                            const intentId = resultObj.payment_intent_id;//$("#intent_id").val();
                            const intentClientSecret = resultObj.client_secret;//$("#client_secret").val();

                            // STEP #9: Call createPaymentConsent function with intent_id and payment_method_id
                            //return Airwallex.createPaymentConsent({
                            //    element: cardNumberElementInstance,
                            //    intent_id: intentId,
                            //    client_secret: intentClientSecret,
                            //    customer_id: customerId,
                            //    next_triggered_by: "customer",
                            //    payment_method_id: response.id
                            //});

                            return Airwallex.confirmPaymentIntentWithSavedCard({
                                element: cvcElement,
                                intent_id: intentId,
                                client_secret: intentClientSecret,
                                customer_id: customerId,
                                methodId: response.id,
                                card: {
                                    // true 授权成功马上请款   false 授权成功不立刻请款
                                    // 一般7天内肯定是可以的，超过7天有可能发卡行那边会释放掉
                                    auto_capture: false
                                }
                            });

                        }).then((response) => {
                            window.alert(JSON.stringify(response));

                            // 重新请求一次确认已付款成功
                            $.ajax({
                                type: "post",
                                url: "Home/CheckPayment",
                                dataType: "json",
                                data:
                                {
                                    data_GUID: resultObj.data_GUID//$("#data_GUID").val()
                                },
                                success: function (f) {
                                    // SUCCEEDED=请款成功   REQUIRES_CAPTURE=已冻结等待我们请款
                                    if (resultObj.code == 0 && (resultObj.status == "REQUIRES_CAPTURE" || resultObj.status == "SUCCEEDED")) {
                                        //STEP10: Display payment status
                                        document.getElementById("error").style.display = "none";
                                        document.getElementById("success").style.display = "block";
                                        document.getElementById("loading").style.display = "none";
                                        document.getElementById("submit").disabled = false;
                                    }
                                    else {
                                        alert('付款失败')
                                    }
                                }
                            })

                        }).catch((response) => {

                            document.getElementById("error").style.display = "block"; // Example: show error block
                            document.getElementById("error").innerHTML = response.message; // Example: set error message
                            document.getElementById("loading").style.display = "none";
                            document.getElementById("submit").disabled = false;
                        });




                        //$("#intent_id").val(f.payment_intent_id);
                        //$("#client_secret").val(f.client_secret);
                        //$("#cus_id").val(f.customer_id);
                        //$("#cus_client_secret").val(f.customer_client_secret);
                        //$("#data_GUID").val(f.data_GUID);

                        //$("#dvOrderInfo").hide();
                        //$("#dvAirwallexPayment").show();
                    }
                    else {
                        alert(resultObj.err_msg)
                    }
                }
            })
        });

        // Set up local variable to check all elements are mounted
        const elementsReady = {
            cardNumber: false,
            expiry: false,
            cvc: false
        };
        // STEP #7: Add an event listener to ensure the element is mounted
        const cardNumberElement = document.getElementById("cardNumber");
        const expiryElement = document.getElementById("expiry");
        const cvcElement = document.getElementById("cvc");
        const domElementArray = [cardNumberElement, expiryElement, cvcElement];

        domElementArray.forEach((element) => {
            element.addEventListener("onReady", (event) => {
                /*
              ... Handle event
               */
                const { type } = event.detail;
                if (elementsReady.hasOwnProperty(type)) {
                    elementsReady[type] = true; // Set element ready state
                }

                if (!Object.values(elementsReady).includes(false)) {
                    document.getElementById("loading").style.display = "none"; // Example: hide loading state when element is mounted
                    document.getElementById("element").style.display = "block"; // Example: show element when mounted
                }
            });
        });

        // Set up local variable to validate element inputs
        const elementsCompleted = {
            cardNumber: false,
            expiry: false,
            cvc: false
        };

        domElementArray.forEach((element) => {
            element.addEventListener("onChange", (event) => {
                /*
             ... Handle event
               */
                const { type, complete } = event.detail;
                if (elementsCompleted.hasOwnProperty(type)) {
                    elementsCompleted[type] = complete; // Set element completion state
                }

                // Check if all elements are completed, and set submit button disabled state
                const allElementsCompleted = !Object.values(
                    elementsCompleted
                ).includes(false);
                document.getElementById("submit").disabled = !allElementsCompleted;
            });
        });

        // STEP #9: Add an event listener to get input focus status
        domElementArray.forEach((element) => {
            element.addEventListener("onFocus", (event) => {
                // Customize your input focus style by listen onFocus event
                const element = document.getElementById(type + "-error");
                if (element) {
                    element.innerHTML = ""; // Example: clear input error message
                }
            });
        });

        // STEP #10: Add an event listener to show input error message when finish typing
        domElementArray.forEach((element) => {
            element.addEventListener("onBlur", (event) => {
                const { error, type } = event.detail;
                const element = document.getElementById(type + "-error");
                if (element && error) {
                    element.innerHTML = error.message || JSON.stringify(error); // Example: set input error message
                }
            });
        });
        // STEP #9: Add an event listener to handle events when there is an error
        domElementArray.forEach((element) => {
            element.addEventListener("onBlur", (event) => {
                /*
               ... Handle event on error
             */
                const { error } = event.detail;
                document.getElementById("error").style.display = "block"; // Example: show error block
                document.getElementById("error").innerHTML = error.message; // Example: set error message
                console.error("There was an error", event.detail.error);
            });
        });

        function submit(btnObj) {
            if ($.trim($("#txtSource").val()) == "") {
                alert("订单渠道标识 必填项");
                return;
            }
            if ($.trim($("#txtXwOrderNum").val()) == "") {
                alert("订单渠道标识 必填项");
                return;
            }
            if ($.trim($("#txtSource").val()) == "") {
                alert("Xw订单号 必填项");
                return;
            }
            if ($.trim($("#txtAmount").val()) == "") {
                alert("需付金额 必填项");
                return;
            }
            if ($.trim($("#txtCurrency").val()) == "") {
                alert("币种 必填项");
                return;
            }

            if ($.trim($("#txtLastName").val()) == "") {
                alert("客户 姓 必填项");
                return;
            }
            if ($.trim($("#txtFirstName").val()) == "") {
                alert("客户 名 必填项");
                return;
            }
            if ($.trim($("#txtEmail").val()) == "") {
                alert("客户 Email 必填项");
                return;
            }

            $(btnObj).attr('disabled', true);

            $.ajax({
                type: "post",
                url: "Home/SubmitPayment",
                dataType: "json",
                data:
                {
                    ProviderType: $("#selProviderType").val(),
                    UseFrom: $("#selUseFrom").val(),
                    Source: $.trim($("#txtSource").val()),
                    XwOrderNum: $.trim($("#txtXwOrderNum").val()),
                    Amount: $.trim($("#txtAmount").val()),
                    Currency: $.trim($("#txtCurrency").val()),
                    LastName: $.trim($("#txtLastName").val()),
                    FirstName: $.trim($("#txtFirstName").val()),
                    Email: $.trim($("#txtEmail").val()),
                    UID: $.trim($("#txtUID").val()),
                    Phone: $.trim($("#txtPhone").val()),
                },
                success: function (f) {
                    if (f.code == 0) {
                        $("#intent_id").val(f.payment_intent_id);
                        $("#client_secret").val(f.client_secret);
                        $("#cus_id").val(f.customer_id);
                        $("#cus_client_secret").val(f.customer_client_secret);
                        $("#data_GUID").val(f.data_GUID);

                        $("#dvOrderInfo").hide();
                        $("#dvAirwallexPayment").show();
                    }
                    else{
                        alert(f.err_msg)
                    }
                }
            })
        }
    </script>
</body>
</html>
