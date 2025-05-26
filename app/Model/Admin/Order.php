<?php

namespace App\Model\Admin;

use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['id', 'customer_name', 'customer_address',
        'customer_email', 'customer_phone', 'customer_required', 'payment_method', 'created_at', 'updated_at', 'code', 'discount_code', 'discount_value', 'total_before_discount', 'total_after_discount'];

    protected $appends = ['total_price'];

    // Trạng thái đơn hàng
    public const DANG_TAO = 0;
    public const MOI = 10;
    public const DUYET = 20;
    public const THANH_CONG = 30;
    public const HUY = 40;

    // Loại đơn hàng
    public const TYPE_RENEW = 1;
    public const TYPE_NEW = 0;

    // Trạng thái thanh toán
    public const UNPAID = 0;
    public const PAID = 1;

    // Phương thức thanh toán
    public const PAYMENT_METHODS = [1=> 'Thanh toán khi nhận hàng - COD', 0 => 'Chuyển khoản ngân hàng'];

    public const STATUSES = [
        [
            'id' => self::DANG_TAO,
            'name' => 'Đang tạo',
            'type' => 'danger'
        ],
        [
            'id' => self::MOI,
            'name' => 'Mới',
            'type' => 'warning'
        ],
        [
            'id' => self::DUYET,
            'name' => 'Đã duyệt',
            'type' => 'success'
        ],
        [
            'id' => self::THANH_CONG,
            'name' => 'Thành công',
            'type' => 'success'
        ],
        [
            'id' => self::HUY,
            'name' => 'Hủy',
            'type' => 'danger'
        ],
    ];

    public const TYPES = [
        [
            'id' => self::TYPE_NEW,
            'name' => 'Đơn hàng mới',
            'type' => 'success'
        ],
        [
            'id' => self::TYPE_RENEW,
            'name' => 'Đơn hàng gia hạn',
            'type' => 'success'
        ],
    ];

    public const PAYMENT_STATUSES = [
        [
            'id' => self::UNPAID,
            'name' => 'Chưa thanh toán',
            'type' => 'danger'
        ],
        [
            'id' => self::PAID,
            'name' => 'Đã thanh toán',
            'type' => 'success'
        ],
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function canCancel() {
        return $this->status == self::DANG_TAO && (\Auth::user()->email == $this->customer_email || \Auth::user()->id == $this->user_id);
    }

    public function canPay() {
        return ($this->status == self::DANG_TAO || ($this->status != self::DANG_TAO && $this->payment_status == self::UNPAID)) && (\Auth::user()->email == $this->customer_email || \Auth::user()->id == $this->user_id);
    }

    public function canDelete() {
        return ($this->status == self::DANG_TAO || $this->status == self::HUY) && (\Auth::user()->email == $this->customer_email || \Auth::user()->id == $this->user_id);
    }

    public function getTotalPriceAttribute()
    {
        if ($this->total_after_discount > 0) {
            return $this->total_after_discount;
        }

        return $this->details->sum(function ($detail) {
            return $detail->price * $detail->qty;
        }) - $this->discount_value;
    }

    public static function searchByFilter($request)
    {
        $result = self::query();
        if (!Auth::user()->is_customer) {
            $result = $result->whereNotIn('status', [self::DANG_TAO, self::HUY]);
        } else {
            $result = $result->where('user_id', Auth::user()->id)->orWhere('customer_email', Auth::user()->email);
        }

        if (!empty($request->code)) {
            $result = $result->where('code', 'like', '%' . $request->code . '%');
        }

        if (!empty($request->employee_email)) {
            $result = $result->where('customer_email', $request->employee_email);
        }

        if (!empty($request->startDate)) {
            $result = $result->where('created_at', '>=', $request->startDate);
        }

        if (!empty($request->endDate)) {
            $result = $result->where('created_at', '<', addDay($request->endDate));
        }

        if (!empty($request->status)) {
            $result = $result->where('status', $request->status);
        }

        if (!empty($request->type) || (isset($request->type) && $request->type == 0)) {
            $result = $result->where('type', $request->type);
        }

        if (!empty($request->customer_name)) {
            $result = $result->where('customer_name', 'like', '%' . $request->customer_name . '%');
        }

        if (!empty($request->customer_phone)) {
            $result = $result->where('customer_phone', 'like', '%' . $request->customer_phone . '%');
        }

        $result = $result->orderBy('created_at', 'desc')->get();
        return $result;
    }

    public static function getTableList($data)
    {
        $rows = '';

        foreach ($data as $index => $item) {
            $details = $item->details;
            $status = array_find_el(self::STATUSES, function($el) use ($item) {
                return $el['id'] == $item->status;
            })['name'];
            $rows .= '<tr style="font-size: 16px;">';
            $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black; text-align: center" ><b>' . ($index + 1) . '</b></td>';
            $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black;" ><b>' . str_replace('&', ' &amp; ', $item->code) . '</b></td>';
            $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black;" ><b>' . str_replace('&', ' &amp; ', $item->customer_name) . '</b></td>';
            $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black;" ><b>' . str_replace('&', ' &amp; ', $item->customer_phone) . '</b></td>';
            $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black;" ><b>' . str_replace('&', ' &amp; ', $item->customer_email) . '</b></td>';
            $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black;" ><b>' . str_replace('&', ' &amp; ', $item->customer_address) . '</b></td>';
            $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black;" ><b>' . str_replace('&', ' &amp; ', $status) . '</b></td>';
            $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black;"><b></b></td>';
            $rows .= '</tr>';
            foreach ($details as $detail) {
                $rows .= '<tr style="font-size: 14px;">';
                $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black; height: 40px;" ></td>';
                $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black; height: 40px;" >' . (isset($detail->product) ? str_replace('&', ' &amp; ', $detail->product->name) : '') . '</td>';
                $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black; height: 40px;" ></td>';
                $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black; height: 40px; text-align: center" >' . formatCurrency($detail->qty) . '</td>';
                $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black; height: 40px; text-align: right" >' . formatCurrency($detail->price) . '</td>';
                $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black; height: 40px; text-align: right" >' . formatCurrency($detail->price * $detail->qty) . '</td>';
                $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black; height: 40px;" ></td>';
                $rows .= '<td style="vertical-align: center; word-wrap: break-word; border:1px solid black; height: 40px;" ></td>';
                $rows .= '</tr>';
            }
        }

        $table = '<table style="width: 100%">
            <thead>
                <tr style="background-color: #0000000d;">
                    <td style="vertical-align: center; word-wrap: break-word; text-align: center; border: 1px solid black; width: 70px"><b>STT</b></td>
                    <td style="vertical-align: center; word-wrap: break-word; text-align: center; border: 1px solid black; width: 400px"><b>Tên hàng hóa</b></td>
                    <td style="vertical-align: center; word-wrap: break-word; text-align: center; border: 1px solid black; width: 240px"><b>Phân loại</b></td>
                    <td style="vertical-align: center; word-wrap: break-word; text-align: center; border: 1px solid black; width: 120px"><b>Số lượng</b></td>
                    <td style="vertical-align: center; word-wrap: break-word; text-align: center; border: 1px solid black; width: 180px"><b>Đơn giá</b></td>
                    <td style="vertical-align: center; word-wrap: break-word; text-align: center; border: 1px solid black; width: 280px"><b>Thành tiền</b></td>
                    <td style="vertical-align: center; word-wrap: break-word; text-align: center; border: 1px solid black; width: 180px"><b>Trạng thái</b></td>
                    <td style="vertical-align: center; word-wrap: break-word; text-align: center; border: 1px solid black; width: 280px"><b>Ghi chú</b></td>
                </tr>
            </thead>
            <tbody>'
            . $rows .
            '</tbody>
        </table>';

        return $table;
    }

    public function updateIpProduct($payment_status = false, $extend = false)
    {
        if ($payment_status) $payment_status = IpProduct::PAYMENT_STATUS_PAID;
        else $payment_status = IpProduct::PAYMENT_STATUS_UNPAID;
        foreach ($this->details as $detail) {
            $ip_product_no_user = IpProduct::query()->where('product_id', $detail->product_id)->whereNull('user_id')->orderBy('id', 'asc')->get();
            if ($ip_product_no_user->count() < $detail->qty) {
                $lack_count = $detail->qty - $ip_product_no_user->count();
                for ($i = 1; $i <= $lack_count; $i++) {
                    $new_ip_product = new IpProduct();
                    $new_ip_product->ip = null;
                    $new_ip_product->product_id = $detail->product_id;
                    $new_ip_product->status = IpProduct::STATUS_ACTIVE;
                    $new_ip_product->payment_status = $payment_status;
                    $new_ip_product->user_id = $this->user_id;
                    $new_ip_product->start_date = \Carbon\Carbon::now();
                    $new_ip_product->end_date = \Carbon\Carbon::now()->addDays(30);
                    $new_ip_product->username = 'user';
                    $new_ip_product->password = '123456';
                    $new_ip_product->save();

                    $log = new IpProductLog();
                    $log->ip_product_id = $new_ip_product->id;
                    $log->type = $extend ? IpProductLog::TYPE_EXTEND : IpProductLog::TYPE_REGISTER;
                    $log->user_id = $new_ip_product->user_id;
                    $log->payment_status = $payment_status;
                    $log->start_date = $new_ip_product->start_date;
                    $log->end_date = $new_ip_product->end_date;
                    $log->object_id = $this->id;
                    $log->object_type = get_class($this);
                    $log->save();
                }

                $ip_product_no_user->each(function ($ip_product) use ($payment_status, $extend) {
                    $ip_product->status = IpProduct::STATUS_ACTIVE;
                    $ip_product->payment_status = $payment_status;
                    $ip_product->user_id = $this->user_id;
                    $ip_product->start_date = \Carbon\Carbon::now();
                    $ip_product->end_date = \Carbon\Carbon::now()->addDays(30);
                    $ip_product->save();

                    $log = new IpProductLog();
                    $log->ip_product_id = $ip_product->id;
                    $log->type = $extend ? IpProductLog::TYPE_EXTEND : IpProductLog::TYPE_REGISTER;
                    $log->user_id = $ip_product->user_id;
                    $log->payment_status = $payment_status;
                    $log->start_date = $ip_product->start_date;
                    $log->end_date = $ip_product->end_date;
                    $log->object_id = $this->id;
                    $log->object_type = get_class($this);
                    $log->save();
                });
            } else {
                $ip_product_no_user->take($detail->qty)->each(function ($ip_product) use ($payment_status, $extend) {
                    $ip_product->status = IpProduct::STATUS_ACTIVE;
                    $ip_product->payment_status = $payment_status;
                    $ip_product->user_id = $this->user_id;
                    $ip_product->start_date = \Carbon\Carbon::now();
                    $ip_product->end_date = \Carbon\Carbon::now()->addDays(30);
                    $ip_product->save();

                    $log = new IpProductLog();
                    $log->ip_product_id = $ip_product->id;
                    $log->type = $extend ? IpProductLog::TYPE_EXTEND : IpProductLog::TYPE_REGISTER;
                    $log->user_id = $ip_product->user_id;
                    $log->payment_status = $payment_status;
                    $log->start_date = $ip_product->start_date;
                    $log->end_date = $ip_product->end_date;
                    $log->object_id = $this->id;
                    $log->object_type = get_class($this);
                    $log->save();
                });
            }
        }
    }
}
