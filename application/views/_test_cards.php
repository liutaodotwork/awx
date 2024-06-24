<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
        <div class="modal fade" id="modal-test-cards" aria-hidden="true" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Test Cards</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                          <ul class="text-danger text-bold">
                                              <li>Expiration date should be any reasonable future date.</li>
                                              <li>CVC/CVV must be a 3- or 4-digit number, depending on the card type.</li>
                                              <li><a href="https://www.airwallex.com/docs/payments__test-card-numbers" target="_blank">Visit Airwallex.com to access additional test cards.</a></li>
                                          </ul>
                              <div class="table-responsive">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th width="50%%">Scenarios</th>
                                      <th>Test cards </th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td class="align-middle">
                                          <ul style="margin-bottom: 0;">
                                              <li class="text-success text-bold">Success</li>
                                              <li>Non 3DS</li>
                                          </ul>
                                        </td>

                                      <td class="align-middle">
                                         <ol style="margin-bottom: 0;">
                                             <li>4035501000000008 - Visa</li>
                                             <li>2223000010181375 - Mastercard</li>
                                             <li>370636803809394 - Amex</li>
                                             <li>3569599999097585 - JCB</li>
                                         </ol>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td class="align-middle">
                                          <ul style="margin-bottom: 0;">
                                              <li class="text-success text-bold">Success</li>
                                              <li>3DS - Challenge mode(One time password Authentication)</li>
                                          </ul>
                                        </td>

                                      <td class="align-middle">
                                         <ol style="margin-bottom: 0;">
                                             <li>4012000300000062</li>
                                             <li>4012000300000088</li>
                                         </ol>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td class="align-middle">
                                          <ul style="margin-bottom: 0;">
                                              <li class="text-success text-bold">Success</li>
                                              <li>3DS - Frictionless mode(No Authentication)</li>
                                          </ul>
                                        </td>

                                      <td class="align-middle">
                                         <ol style="margin-bottom: 0;">
                                             <li>4012000300000021</li>
                                             <li>4012000300000005</li>
                                         </ol>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td class="align-middle">
                                          <ul style="margin-bottom: 0;">
                                              <li class="text-danger text-bold">Fail</li>
                                              <li>Non 3DS</li>
                                              <li>Declined by Airwallex fraud risk engine</li>
                                          </ul>
                                        </td>

                                      <td class="align-middle">
                                         <ol style="margin-bottom: 0;">
                                             <li>4646464646464644</li>
                                         </ol>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td class="align-middle">
                                          <ul style="margin-bottom: 0;">
                                              <li class="text-danger text-bold">Fail</li>
                                              <li>Non 3DS</li>
                                              <li>Declined by the card issuer</li>
                                          </ul>
                                        </td>

                                      <td class="align-middle">
                                         <ol style="margin-bottom: 0;">
                                             <li>2223000010181375</li>
                                         </ol>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="align-middle">
                                          <ul style="margin-bottom: 0;">
                                              <li class="text-danger text-bold">Fail</li>
                                              <li>3DS - Frictionless mode(No Authentication)</li>
                                              <li>User failed 3DS authentication</li>
                                          </ul>
                                        </td>

                                      <td class="align-middle">
                                         <ol style="margin-bottom: 0;">
                                             <li>4012000300000047</li>
                                         </ol>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="align-middle">
                                          <ul style="margin-bottom: 0;">
                                              <li class="text-danger text-bold">Fail</li>
                                              <li>3DS - Challenge mode(One time password Authentication)</li>
                                              <li>User failed 3DS authentication</li>
                                          </ul>
                                        </td>

                                      <td class="align-middle">
                                         <ol style="margin-bottom: 0;">
                                             <li>4012000300000070</li>
                                         </ol>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>

                            </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
