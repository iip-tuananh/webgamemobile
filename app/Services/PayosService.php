<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class PayosService
{
    protected $baseUrl;
    protected $clientId;
    protected $apiKey;
    protected $checksumKey;
    protected $returnUrl;
    protected $cancelUrl;

    public function __construct()
    {
        $this->baseUrl = config('payos.base_url');
        $this->clientId = config('payos.client_id');
        $this->apiKey = config('payos.api_key');
        $this->checksumKey = config('payos.checksum_key');
        $this->returnUrl = !empty(config('payos.return_url')) ? config('payos.return_url') : route('orders.payment.success');
        $this->cancelUrl = !empty(config('payos.cancel_url')) ? config('payos.cancel_url') : route('orders.payment.success');
    }

    public function createPayment($amount, $orderCode, $orderId)
    {
        // Lấy thông tin thanh toán
        $client = new Client();
        $endpointGetPaymentInfo = "{$this->baseUrl}/v2/payment-requests/{$orderId}";
        $response = $client->get($endpointGetPaymentInfo, [
            'headers' => [
                'x-client-id' => $this->clientId,
                'x-api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ],
        ]);

        $paymentInfo = json_decode($response->getBody(), true);

        if ($paymentInfo) {
            if (isset($paymentInfo['data']['status']) && ($paymentInfo['data']['status'] == 'PENDING' || $paymentInfo['data']['status'] == 'EXPIRED') && count($paymentInfo['data']['transactions']) == 0) {
                $endpointCancelPayment = "{$this->baseUrl}/v2/payment-requests/{$orderId}/cancel";
                $responseCancelPayment = $client->post($endpointCancelPayment, [
                    'headers' => [
                        'x-client-id' => $this->clientId,
                        'x-api-key' => $this->apiKey,
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'cancellationReason' => 'Tạo lại thanh toán',
                    ],
                ]);

                // dd($responseCancelPayment);
                // $paymentInfoCancel = json_decode($responseCancelPayment->getBody(), true);
                // dd($paymentInfoCancel);
            } else if (isset($paymentInfo['data']['status']) && $paymentInfo['data']['status'] == 'PAID' && isset($paymentInfo['data']['transactions']) && count($paymentInfo['data']['transactions']) > 0) {
                $data = [
                    'status' => 'false',
                    'message' => 'Đơn hàng đã thanh toán thành công',
                ];
                return $data;
            }
        }

        // Tạo link thanh toán
        $endpoint = "{$this->baseUrl}/v2/payment-requests";
        $payload = [
            'amount' => $amount,
            'cancelUrl' => $this->cancelUrl,
            'description' => $orderCode,
            'orderCode' => $orderId,
            'returnUrl' => $this->returnUrl,
        ];

        $payload['signature'] = $this->generateSignature($this->checksumKey, $payload);

        // Gửi yêu cầu tạo thanh toán
        $response = $client->post($endpoint, [
            'headers' => [
                'x-client-id' => $this->clientId,
                'x-api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => $payload,
        ]);

        $data = json_decode($response->getBody(), true);

        return $data;
    }

    public static function generateSignature($checksumKey, $obj)
    {
        ksort($obj);
        $queryStrArr = [];
        foreach ($obj as $key => $value) {
            if ($value === "undefined" || $value === "null" || gettype($value) == "NULL") {
                $value = "";
            }

            if (is_array($value)) {
                $valueSortedElementObj = array_map(function ($ele) {
                    ksort($ele);
                    return $ele;
                }, $value);
                $value = json_encode($valueSortedElementObj, JSON_UNESCAPED_UNICODE);
            }
            $queryStrArr[] = $key . "=" . $value;
        }
        $queryStr = implode("&", $queryStrArr);
        $signature = hash_hmac('sha256', $queryStr, $checksumKey);
        return $signature;
    }

    // public static function generateSignature($checksumKey, $obj)
    // {
    //     $dataStr = "amount={$obj["amount"]}&cancelUrl={$obj["cancelUrl"]}&description={$obj["description"]}&orderCode={$obj["orderCode"]}&returnUrl={$obj["returnUrl"]}";
    //     $signature = hash_hmac("sha256", $dataStr, $checksumKey);
    //     return $signature;
    // }
}
