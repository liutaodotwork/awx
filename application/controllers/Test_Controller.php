<?php defined('BASEPATH') OR exit('No direct script access allowed');

require VENDORPATH . '/autoload.php';

class Test_Controller extends CI_Controller
{
    /**
     * Constructor
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
    }

    // --------------------------------------------------------------------

    /**
     * Index Page.
     */
    public function index()
    {
        $this->load->database();
        $this->load->dbutil();

        $dbs = $this->dbutil->list_databases();
        foreach ($dbs as $db)
        {
            echo $db;
        }

        if ( ! $this->dbutil->database_exists( 'database_name' ) )
        {
            echo 'does not exit';
        }
    }

    public function test_webhook()
    {

        $secret = 'whsec_6kYQBW84jOikJIVYpD_4u4r74ac-S3Yc';
        $timestamp = '1641802167432';

//x-signature: 7d3d2ee07e4c2b88da53dd78d3dd9371f5698f12f34db44957a07a2c35b9b146

$body = '{"accountId": "acct_eKJ2zdu8MkaIbah1cP3loA", "createdAt": "2022-01-10T08:09:27+0000", "data": {"object": {"amount": 67.05, "captured_amount": 67.05, "created_at": "2022-01-10T08:09:16+0000", "currency": "USD", "descriptor": "default", "id": "int_hkdmnhhn5g5yxhxwv8n", "latest_payment_attempt": {"amount": 67.05, "authentication_data": {"avs_result": "U", "cvc_code": "M", "cvc_result": "Y", "ds_data": {"cavv": "", "challenge_cancellation_reason": "", "eci": "05", "enrolled": "C", "frictionless": "N", "liability_shift_indicator": "Y", "pa_res_status": "Y", "version": "2.2.0", "xid": "TzRUOW9Eb1VXemZpMmhVa1RINTA="}, "fraud_data": {"action": "VERIFY", "score": "85"}}, "authorization_code": "005314", "captured_amount": 0, "created_at": "2022-01-10T08:09:17+0000", "id": "att_hkdmmhcsgg5yxhybqv4_hxwv8n", "payment_intent_id": "int_hkdmnhhn5g5yxhxwv8n", "payment_method": {"card": {"billing": {"address": {"city": "Cambridge", "country_code": "US", "postcode": "02139", "state": "Massachusetts", "street": "77 Massachusetts Ave"}, "email": "17610291226@163.com", "first_name": "yuan", "last_name": "jun", "phone_number": "17610291226"}, "bin": "411111", "brand": "visa", "card_type": "credit", "cvc_check": "pass", "expiry_month": "12", "expiry_year": "2028", "fingerprint": "qJSZCzNkTxFMVBPvHv2Gtj9tVz8=", "issuer_country_code": "US", "last4": "1111", "name": "yuan jun"}, "created_at": "2022-01-10T08:09:17+0000", "id": "mtd_hkdmmhcsgg5yxhybjx3", "status": "CREATED", "type": "card", "updated_at": "2022-01-10T08:09:17+0000"}, "provider_original_response_code": "00", "provider_transaction_id": "396228528441_781423940660683", "refunded_amount": 0, "settle_via": "airwallex", "status": "AUTHORIZED", "updated_at": "2022-01-10T08:09:27+0000"}, "merchant_order_id": "10633*6965", "metadata": {"shop_id": "691"}, "order": {"products": [{"code": "95903", "desc": "CKO支付失败商品", "name": "", "quantity": 1, "sku": "1000-12", "unit_price": 0, "url": "https://yuanjunshop.haoq.top/products/cko支付失败商品"}], "shipping": {"address": {"city": "Cambridge", "country_code": "US", "postcode": "02139", "state": "Massachusetts", "street": "77 Massachusetts Ave"}, "first_name": "yuan", "last_name": "jun", "shipping_method": "test"}, "type": "physical_goods"}, "request_id": "691-ebf4d1012381c08419d2e0a11d7568c7-1641802156", "status": "SUCCEEDED", "updated_at": "2022-01-10T08:09:27+0000"}}, "id": "evt_hkdmnhhn5g5yxi4e336_hxwv8n", "name": "payment_intent.succeeded", "version": "2021-08-06", "account_id": "acct_eKJ2zdu8MkaIbah1cP3loA", "created_at": "2022-01-10T08:09:27+0000"}';

// b60ed7b0a05ba671f812c2e9cdfd51cfae86983aca7235235ebad76959a27a8c 
// 110447873700e560dfabd868fb7ab7cebaa0355d11d9a721e8f01f2cac6893a7

echo "<pre>";
var_dump( hash_hmac('sha256', $timestamp.$body, $secret) );
exit();

    }

}
