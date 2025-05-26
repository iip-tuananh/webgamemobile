<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/pdf.css') }}" type="text/css" />
</head>

<body>
    <table style="width: 100%; border: none;">
        <tr>
            <!-- Cột hình ảnh -->
            <td style="width: 40%; text-align: center; vertical-align: top; border:none;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('site/images/logo.png'))) }}"
                    alt="logo" style="width: 80%; height: auto; margin-bottom: 40px;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('site/images/qr_code.png'))) }}"
                    alt="qr_code" style="width: 80%; height: auto;">
            </td>

            <!-- Cột thông tin -->
            <td style="width: 60%; vertical-align: top; border:none;">
                <table style="width: 100%; border: none; font-size: 12px;">
                    <tr>
                        <td style="vertical-align: top; border: none; text-align: right; width: 40%;">Địa chỉ:</td>
                        <td style="vertical-align: top; border: none; text-align: left; width: 60%;">2208 The Two, Gamuda, Trần
                            Phú, Hoàng Mai, Hà Nội </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; border: none; text-align: right; width: 40%;">Website:</td>
                        <td style="vertical-align: top; border: none; text-align: left; width: 60%;">https://vpsvnn.com </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; border: none; text-align: right; width: 40%;">Điện thoại - Zalo:</td>
                        <td style="vertical-align: top; border: none; text-align: left; width: 60%;">0987 836022</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; border: none; text-align: right; width: 40%;">Email:</td>
                        <td style="vertical-align: top; border: none; text-align: left; width: 60%;">lamvanhieu@live.com</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; border: none; text-align: right; width: 40%; font-weight: bold;">Số tài khoản:</td>
                        <td style="vertical-align: top; border: none; text-align: left; width: 60%; font-weight: bold;">TCB - 19026716988015</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; border: none; text-align: right; width: 40%; font-weight: bold;">Chủ tài khoản:</td>
                        <td style="vertical-align: top; border: none; text-align: left; width: 60%; font-weight: bold;">Lâm Văn Hiếu</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <h4 style="text-transform:uppercase; text-align: center"><b>HÓA ĐƠN</b>
    <br>
    <span style="font-size: 12px; font-style: italic; font-weight: 500">(Không Thuế)</span>
    </h4>
    <p style="text-align: center; ">Ngày: {{ formatDate(\Carbon\Carbon::now()) }}</p>
    <hr style="border: 1px solid black;">
    <div>
        <p style="font-size: 14px"><span style="font-weight: bold;">Khách Hàng:</span> {{ $customer ? $customer->name : '......................................' }} <span style="font-size: 12px; font-style: italic;">(khi thanh toán vui lòng ghi tên KH)</span></p>
        <p style="font-size: 14px"><span>Địa chỉ:</span> ..............................................</p>
        <p style="font-size: 14px"><span>Dịch vụ:</span> VPS</p>
    </div>
    <table class="table table-bordered pdf" style="font-size: 14px;">
        <thead>
            <tr>
                <th style="border: 1px solid black;">Khách hàng</th>
                <th style="border: 1px solid black;">Ngày mua</th>
                <th style="border: 1px solid black;">Ngày hết hạn</th>
                <th style="border: 1px solid black;">IP</th>
                <th style="border: 1px solid black;">Giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $item)
            <tr>
                <td style="border: 1px solid black;">{{ Str::limit($item->user->name, 50) }}</td>
                <td style="border: 1px solid black;">{{ formatDate($item->start_date) }}</td>
                <td style="border: 1px solid black;">{{ formatDate($item->end_date) }}</td>
                <td style="border: 1px solid black;">{{ $item->ip }}</td>
                <td style="border: 1px solid black; text-align: right;">{{ formatCurrency($item->product->sell_price) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" style="text-align: right; font-weight: bold; border: 1px solid black;">Tổng cộng</td>
                <td style="text-align: right; font-weight: bold; border: 1px solid black;">{{ formatCurrency($data->sum('product.sell_price')) }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <h5 style="text-align: center">Cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của chúng tôi. </h5>
    <p style="text-align: center; font-size: 14px;">Nếu bạn có bất kỳ câu hỏi nào liên quan đến thông tin này, vui lòng liên hệ với chúng tôi tại
        lamvanhieu@live.com</p>
</body>
<style>
    body {
        font-family: DejaVu Sans;
    }

    .pdf {
        border-collapse: collapse;
        width: 100%;
    }

    .pdf td,
    .pdf th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .pdf tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .pdf tr:hover {
        background-color: #ddd;
    }

    .pdf th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #f9b703;
        color: black;
        text-align: center;
    }

    .text-center {
        text-align: center;
    }

    td,
    th {
        border: 1px solid black;
        padding: 5px 8px !important;
    }

    table {
        border-collapse: collapse;
    }

    .no-border td {
        border: none !important;
    }

    @media print {
        .d-print-none {
            display: none !important;
        }

        .block {
            page-break-inside: avoid;
        }
    }

    /* // barcode */

    .barcode {
        text-align: center;
    }

    .mb-2 {
        margin-bottom: 0.5rem !important;
    }

    .border {
        border: 1px solid #e9ecef !important;
    }

    .p-2 {
        padding: 0.5rem !important;
    }

    .d-flex {
        display: flex !important;
    }

    .promo-group-item-name {
        width: 300px;
    }

    .ml-2 {
        margin-left: 0.5rem !important;
    }

    .align-items-center {
        align-items: center;
    }

    th {
        text-align: center;
        vertical-align: middle;
        font-weight: bold;
    }

    td>p {
        padding: 0;
        margin: 0;
    }
</style>

</html>