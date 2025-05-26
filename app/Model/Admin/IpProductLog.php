<?php

namespace App\Model\Admin;

use App\Model\Common\User;
use Illuminate\Database\Eloquent\Model;

class IpProductLog extends Model
{
    protected $table = 'ip_product_logs';
    protected $fillable = [];

    public const TYPE_REGISTER = 1;
    public const TYPE_EXTEND = 2;
    public const TYPES = [
        [
            'id' => self::TYPE_REGISTER,
            'name' => 'Đăng ký',
            'type' => 'success',
        ],
        [
            'id' => self::TYPE_EXTEND,
            'name' => 'Gia hạn',
            'type' => 'warning',
        ],
    ];

    public const PAYMENT_STATUS_PAID = 1;
    public const PAYMENT_STATUS_UNPAID = 2;
    public const PAYMENT_STATUSES = [
        [
            'id' => self::PAYMENT_STATUS_PAID,
            'name' => 'Đã thanh toán',
            'type' => 'success',
        ],
        [
            'id' => self::PAYMENT_STATUS_UNPAID,
            'name' => 'Chưa thanh toán',
            'type' => 'danger',
        ],
    ];

    public function ipProduct()
    {
        return $this->belongsTo(IpProduct::class, 'ip_product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
