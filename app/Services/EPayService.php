<?php

declare(strict_types=1);

namespace App\Services;


class EPayService
{

    public function __construct()
    {
    }

    /**
     * @param $hbp_env
     * @param $hbp_client_id
     * @param $hbp_client_secret
     * @param $hbp_terminal
     * @param $hbp_invoice_id
     * @param $hbp_amount
     * @param string $hbp_currency
     * @param $hbp_back_link
     * @param $hbp_failure_back_link
     * @param $hbp_post_link
     * @param $hbp_failure_post_link
     * @param string $hbp_language
     * @param string $hbp_description
     * @param string $hbp_account_id
     * @param string $hbp_telephone
     * @param string $hbp_email
     * @return array
     */
    public function gateway(
        $hbp_env,
        $hbp_client_id,
        $hbp_client_secret,
        $hbp_terminal,
        $hbp_invoice_id,
        $hbp_amount,
        string $hbp_currency = "KZT",
        $hbp_back_link,
        $hbp_failure_back_link,
        $hbp_post_link,
        $hbp_failure_post_link,
        string $hbp_language = "RU",
        string $hbp_description = "",
        string $hbp_account_id = "",
        string $hbp_telephone = "",
        string $hbp_email = ""
    ): array
    {
        $test_url = "https://testoauth.homebank.kz/epay2/oauth2/token";
        $prod_url = "https://epay-oauth.homebank.kz/oauth2/token";
        $test_page = "https://test-epay.homebank.kz/payform/payment-api.js";
        $prod_page = "https://epay.homebank.kz/payform/payment-api.js";

        if ($hbp_env === "test") {
            $token_api_url = $test_url;
            $pay_page = $test_page;
        } else {
            $token_api_url = $prod_url;
            $pay_page = $prod_page;
        }

        $fields = [
            'grant_type'      => 'client_credentials',
            'scope'           => 'payment usermanagement',
            'client_id'       => $hbp_client_id,
            'client_secret'   => $hbp_client_secret,
            'invoiceID'       => $hbp_invoice_id,
            'amount'          => $hbp_amount,
            'currency'        => $hbp_currency,
            'terminal'        => $hbp_terminal,
            'postLink'        => $hbp_post_link,
            'failurePostLink' => $hbp_failure_post_link
        ];

        $fields_string = http_build_query($fields);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $token_api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $result = curl_exec($ch);

        $json_result = json_decode($result, true);

        $data = [
            'status' => 500,
            'data' => ''
        ];

        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:
                    $hbp_auth = (object) $json_result;

                    $hbp_payment_object = (object) [
                        "invoiceId" => $hbp_invoice_id,
                        "backLink" => $hbp_back_link,
                        "failureBackLink" => $hbp_failure_back_link,
                        "postLink" => $hbp_post_link,
                        "failurePostLink" => $hbp_failure_post_link,
                        "language" => $hbp_language,
                        "description" => $hbp_description,
                        "accountId" => $hbp_account_id,
                        "terminal" => $hbp_terminal,
                        "amount" => $hbp_amount,
                        "currency" => $hbp_currency,
                        "auth" => $hbp_auth,
                        "phone" => $hbp_telephone,
                        "email" => $hbp_email
                    ];

                    $data = [
                        'status' => $http_code,
                        'data' => '<script src="' . $pay_page . '"></script>
<script>
    halyk.pay(' . json_encode($hbp_payment_object) . ');
</script>'
                    ];

                    break;
                default:
                    $data = [
                        'status' => $http_code,
                        'data' => 'Неожиданный код HTTP: ' . $http_code,
                    ];
            }
        }

        return $data;

    }

}
