<?php

return [
    'base_url' => env('PAYOS_BASE_URL', 'https://api.payos.vn'),
    'client_id' => env('PAYOS_CLIENT_ID'),
    'api_key' => env('PAYOS_API_KEY'),
    'checksum_key' => env('PAYOS_CHECKSUM_KEY'),
    'return_url' => env('PAYOS_RETURN_URL'),
    'cancel_url' => env('PAYOS_CANCEL_URL'),
];