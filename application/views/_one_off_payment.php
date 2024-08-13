<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
    <div class="card-header" role="tab">
        <h6><a class="" href="#newcard" data-toggle="collapse" aria-expanded="true">Pay with a New Card</a></h6>
    </div>
    <div class="collapse show" id="newcard" data-parent="#accordion" role="tabpanel" style="">
        <div class="card-body">
            <div class="text-center modal-spinner">
                <div class="spinner-border text-primary m-2" role="status"></div>
            </div>
            <div class="awx-fields" style="display:none;">
                <p>We accept following cards <a href="#" data-toggle="modal" data-target="#modal-test-cards"><i class="icon-credit-card"></i> Find a test card</a><br/><br/>
                    <img class="d-inline-block align-middle" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzUiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAzNSAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxwYXRoIGQ9Ik0wIDMuMjVDMCAxLjQ1NTA4IDEuNDU1MDcgMCAzLjI1IDBIMzEuNzVDMzMuNTQ0OSAwIDM1IDEuNDU1MDcgMzUgMy4yNVYyMC43NUMzNSAyMi41NDQ5IDMzLjU0NDkgMjQgMzEuNzUgMjRIMy4yNUMxLjQ1NTA3IDI0IDAgMjIuNTQ0OSAwIDIwLjc1VjMuMjVaIiBmaWxsPSJ3aGl0ZSIgLz4KICAgIDxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBkPSJNMTAuNzUwMyAxNi41NjhIOC40MTM2Mkw2LjY2MTM5IDkuODY4OTZDNi41NzgyMiA5LjU2MDggNi40MDE2MyA5LjI4ODM3IDYuMTQxODcgOS4xNTk5OEM1LjQ5MzYxIDguODM3MyA0Ljc3OTI4IDguNTgwNTEgNCA4LjQ1MDk5VjguMTkzMDhINy43NjQyMkM4LjI4Mzc0IDguMTkzMDggOC42NzMzOCA4LjU4MDUxIDguNzM4MzIgOS4wMzA0Nkw5LjY0NzQ3IDEzLjg2MjdMMTEuOTgzIDguMTkzMDhIMTQuMjU0OEwxMC43NTAzIDE2LjU2OFpNMTUuNTUzMyAxNi41NjhIMTMuMzQ2NUwxNS4xNjM3IDguMTkzMDhIMTcuMzcwNUwxNS41NTMzIDE2LjU2OFpNMjAuMjI1NyAxMC41MTMzQzIwLjI5MDYgMTAuMDYyMiAyMC42ODAzIDkuODA0MjcgMjEuMTM0OSA5LjgwNDI3QzIxLjg0OTIgOS43Mzk1MiAyMi42MjczIDkuODY5MDMgMjMuMjc2NyAxMC4xOTA2TDIzLjY2NjQgOC4zODc0M0MyMy4wMTcgOC4xMjk1MSAyMi4zMDI2IDggMjEuNjU0NCA4QzE5LjUxMjUgOCAxNy45NTM5IDkuMTYwMDUgMTcuOTUzOSAxMC43NzAxQzE3Ljk1MzkgMTEuOTk0OSAxOS4wNTc5IDEyLjYzOCAxOS44MzcyIDEzLjAyNTRDMjAuNjgwMyAxMy40MTE3IDIxLjAwNSAxMy42Njk2IDIwLjk0IDE0LjA1NTlDMjAuOTQgMTQuNjM1NCAyMC4yOTA2IDE0Ljg5MzMgMTkuNjQyNCAxNC44OTMzQzE4Ljg2MzEgMTQuODkzMyAxOC4wODM4IDE0LjcwMDIgMTcuMzcwNiAxNC4zNzc1TDE2Ljk4MSAxNi4xODE4QzE3Ljc2MDMgMTYuNTAzMyAxOC42MDMzIDE2LjYzMjggMTkuMzgyNiAxNi42MzI4QzIxLjc4NDIgMTYuNjk2NSAyMy4yNzY3IDE1LjUzNzUgMjMuMjc2NyAxMy43OThDMjMuMjc2NyAxMS42MDc0IDIwLjIyNTcgMTEuNDc5IDIwLjIyNTcgMTAuNTEzM1pNMzEgMTYuNTY4TDI5LjI0NzggOC4xOTMwOEgyNy4zNjU3QzI2Ljk3NiA4LjE5MzA4IDI2LjU4NjQgOC40NTA5OSAyNi40NTY1IDguODM3M0wyMy4yMTE4IDE2LjU2OEgyNS40ODM2TDI1LjkzNyAxNS4zNDQzSDI4LjcyODNMMjguOTg4IDE2LjU2OEgzMVpNMjcuNjkwNCAxMC40NDg3TDI4LjMzODYgMTMuNjA1MUgyNi41MjE1TDI3LjY5MDQgMTAuNDQ4N1oiIGZpbGw9IiMyMjREQkEiIC8+CiAgICA8cGF0aCBkPSJNMy4yNSAxSDMxLjc1Vi0xSDMuMjVWMVpNMzQgMy4yNVYyMC43NUgzNlYzLjI1SDM0Wk0zMS43NSAyM0gzLjI1VjI1SDMxLjc1VjIzWk0xIDIwLjc1VjMuMjVILTFWMjAuNzVIMVpNMy4yNSAyM0MyLjAwNzM2IDIzIDEgMjEuOTkyNiAxIDIwLjc1SC0xQy0xIDIzLjA5NzIgMC45MDI3ODkgMjUgMy4yNSAyNVYyM1pNMzQgMjAuNzVDMzQgMjEuOTkyNiAzMi45OTI2IDIzIDMxLjc1IDIzVjI1QzM0LjA5NzIgMjUgMzYgMjMuMDk3MiAzNiAyMC43NUgzNFpNMzEuNzUgMUMzMi45OTI2IDEgMzQgMi4wMDczNiAzNCAzLjI1SDM2QzM2IDAuOTAyNzkgMzQuMDk3MiAtMSAzMS43NSAtMVYxWk0zLjI1IC0xQzAuOTAyNzkgLTEgLTEgMC45MDI3OSAtMSAzLjI1SDFDMSAyLjAwNzM2IDIuMDA3MzYgMSAzLjI1IDFWLTFaIiBmaWxsPSIjRjZGN0Y4IiAvPgo8L3N2Zz4KICAgIA==" height="24" alt="Visa">
                    <img class="d-inline-block align-middle" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzNSIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDM1IDI0Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHJlY3Qgd2lkdGg9IjM1IiBoZWlnaHQ9IjI0IiBmaWxsPSIjRThFQUVEIiByeD0iMy4yNDgiLz4KICAgICAgICA8Zz4KICAgICAgICAgICAgPHBhdGggZmlsbD0iI0ZGNUUwMCIgZD0iTTE1LjUxOS4xMjJjMy42ODcgMCA2LjY3NiAyLjk2NyA2LjY3NiA2LjYyNyAwIDMuNjYtMi45ODkgNi42MjctNi42NzYgNi42MjctMS42NTMgMC0zLjE2Ni0uNTk2LTQuMzMyLTEuNTg0LTEuMTY0Ljk4OC0yLjY3NyAxLjU4NC00LjMzIDEuNTg0QzMuMTcgMTMuMzc2LjE4IDEwLjQwOS4xOCA2Ljc0OS4xOCAzLjA4OSAzLjE3LjEyMiA2Ljg1Ny4xMjJjMS42NTMgMCAzLjE2Ni41OTYgNC4zMzIgMS41ODNDMTIuMzUzLjcxOCAxMy44NjYuMTIyIDE1LjUxOS4xMjJ6IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg2IDUpIi8+CiAgICAgICAgICAgIDxwYXRoIGZpbGw9IiNFRDAwMDYiIGQ9Ik02Ljg1Ny4xMjJjMS42NTMgMCAzLjE2Ni41OTYgNC4zMzIgMS41ODNDOS43NTIgMi45MjEgOC44NDIgNC43MyA4Ljg0MiA2Ljc1YzAgMi4wMi45MSAzLjgyOCAyLjM0NSA1LjA0My0xLjE2NC45ODgtMi42NzcgMS41ODQtNC4zMyAxLjU4NEMzLjE3IDEzLjM3Ni4xOCAxMC40MDkuMTggNi43NDkuMTggMy4wODkgMy4xNy4xMjIgNi44NTcuMTIyeiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNiA1KSIvPgogICAgICAgICAgICA8cGF0aCBmaWxsPSIjRjlBMDAwIiBkPSJNMTUuNTE5LjEyMmMzLjY4NyAwIDYuNjc2IDIuOTY3IDYuNjc2IDYuNjI3IDAgMy42Ni0yLjk4OSA2LjYyNy02LjY3NiA2LjYyNy0xLjY1MyAwLTMuMTY2LS41OTctNC4zMzItMS41ODQgMS40MzYtMS4yMTUgMi4zNDctMy4wMjMgMi4zNDctNS4wNDNzLS45MS0zLjgyOC0yLjM0NS01LjA0NEMxMi4zNTQuNzE4IDEzLjg2Ni4xMjIgMTUuNTE5LjEyMnoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDYgNSkiLz4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPgo=" height="24" alt="Mastercard">
                    <img class="d-inline-block align-middle" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzUiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAzNSAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjM1IiBoZWlnaHQ9IjI0IiByeD0iMy4yNDgxMiIgZmlsbD0iI0U4RUFFRCIvPgo8cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZD0iTTE3LjE3MyAxNy4xNTdDMTUuOTg5NiAxOC4xODUyIDE0LjQ1NDUgMTguODA2IDEyLjc3NzEgMTguODA2QzkuMDM0MjEgMTguODA2IDYgMTUuNzE1NCA2IDExLjkwM0M2IDguMDkwNTcgOS4wMzQyMSA1IDEyLjc3NzEgNUMxNC40NTQ1IDUgMTUuOTg5NiA1LjYyMDczIDE3LjE3MyA2LjY0ODk5QzE4LjM1NjQgNS42MjA3MyAxOS44OTE1IDUgMjEuNTY4OSA1QzI1LjMxMTggNSAyOC4zNDYgOC4wOTA1NyAyOC4zNDYgMTEuOTAzQzI4LjM0NiAxNS43MTU0IDI1LjMxMTggMTguODA2IDIxLjU2ODkgMTguODA2QzE5Ljg5MTUgMTguODA2IDE4LjM1NjQgMTguMTg1MiAxNy4xNzMgMTcuMTU3WiIgZmlsbD0iIzczNzVDRiIvPgo8cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZD0iTTE3LjE3MyA2LjY0ODk5QzE1LjcxNTggNy45MTUxMyAxNC43OTE4IDkuNzk5MTUgMTQuNzkxOCAxMS45MDNDMTQuNzkxOCAxNC4wMDY4IDE1LjcxNTggMTUuODkwOCAxNy4xNzMgMTcuMTU3QzE1Ljk4OTYgMTguMTg1MiAxNC40NTQ1IDE4LjgwNiAxMi43NzcxIDE4LjgwNkM5LjAzNDIxIDE4LjgwNiA2IDE1LjcxNTQgNiAxMS45MDNDNiA4LjA5MDU3IDkuMDM0MjEgNSAxMi43NzcxIDVDMTQuNDU0NSA1IDE1Ljk4OTYgNS42MjA3MyAxNy4xNzMgNi42NDg5OVoiIGZpbGw9IiNFRDAwMDYiLz4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNy4xNzMgMTcuMTU3QzE4LjYzMDIgMTUuODkwOCAxOS41NTQyIDE0LjAwNjggMTkuNTU0MiAxMS45MDNDMTkuNTU0MiA5Ljc5OTE0IDE4LjYzMDIgNy45MTUxMiAxNy4xNzMgNi42NDg5OUMxOC4zNTY0IDUuNjIwNzMgMTkuODkxNSA1IDIxLjU2ODkgNUMyNS4zMTE4IDUgMjguMzQ2IDguMDkwNTcgMjguMzQ2IDExLjkwM0MyOC4zNDYgMTUuNzE1NCAyNS4zMTE4IDE4LjgwNiAyMS41Njg5IDE4LjgwNkMxOS44OTE1IDE4LjgwNiAxOC4zNTY0IDE4LjE4NTIgMTcuMTczIDE3LjE1N1oiIGZpbGw9IiMwMEEyRTUiLz4KPC9zdmc+Cg==" height="24" alt="Maestro">
                    <img class="d-inline-block align-middle" src="https://checkout-demo.airwallex.com/static/media/amex.f6c1eb25db0f19a0aada.svg" height="24" alt="Amex">
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
                    <div class="form-group col-12 text-center paddin-top-1x">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <button id="pay-button" class="btn btn-primary btn-block" disabled type="button" data-action="<?= site_url( 'payments/cards/embedded-fields' ) ?>"><i class="icon-credit-card"></i> Pay $80.05</button>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
