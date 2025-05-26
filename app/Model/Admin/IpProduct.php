<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Model\Common\User;
use Illuminate\Support\Facades\Auth;

class IpProduct extends Model
{
    protected $table = 'ip_products';
    protected $fillable = [];

    public const STATUS_INACTIVE = 1; // Chưa kích hoạt
    public const STATUS_ACTIVE = 2; // Đang hoạt động
    public const STATUS_EXPIRED = 3; // Đã hết hạn
    public const STATUS_CLOSED = 4; // Đóng
    public const STATUES = [
        [
            'id' => self::STATUS_INACTIVE,
            'name' => 'Chưa kích hoạt',
            'type' => 'danger',
        ],
        [
            'id' => self::STATUS_ACTIVE,
            'name' => 'Đang hoạt động',
            'type' => 'success',
        ],
        [
            'id' => self::STATUS_EXPIRED,
            'name' => 'Đã hết hạn',
            'type' => 'warning',
        ],
        [
            'id' => self::STATUS_CLOSED,
            'name' => 'Đóng',
            'type' => 'danger',
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

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function logs()
    {
        return $this->hasMany(IpProductLog::class, 'ip_product_id');
    }

    public function tickets()
    {
        return $this->hasMany(IpProductTicket::class, 'ip_product_id');
    }

    public function canEdit()
    {
        return \Auth::user()->is_super_admin;
    }

    public function canDelete()
    {
        return \Auth::user()->is_super_admin;
    }

    public static function searchByFilter($request)
    {
        $data = self::query();
        if (!Auth::user()->is_customer) {
        } else {
            $data->where('user_id', Auth::user()->id);
        }

        if (!empty($request->customer_id)) {
            $data->where('user_id', $request->customer_id);
        }

        if (!empty($request->status)) {
            $data->where('status', $request->status);
        }

        if (!empty($request->payment_status)) {
            $data->where('payment_status', $request->payment_status);
        }
        if (!empty($request->ip)) {
            $data->where('ip', 'like', '%' . $request->ip . '%');
        }

        if (!empty($request->product_pdf_ids)) {
            if (!is_array($request->product_pdf_ids)) $product_pdf_ids = explode(',', $request->product_pdf_ids);
            else $product_pdf_ids = $request->product_pdf_ids;
            $data->whereIn('id', $product_pdf_ids);
        }

        if (!empty($request->plan)) {
            $data->whereHas('product', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->plan . '%');
            });
        }

        if (!empty($request->location)) {
            $data->whereHas('product', function ($query) use ($request) {
                $query->where('origin', 'like', '%' . $request->location . '%');
            });
        }

        if (!empty($request->start_date)) {
            $data->where('start_date', '>=', $request->start_date);
        }

        if (!empty($request->end_date)) {
            $data->where('end_date', '<', addDay($request->end_date));
        }

        if (empty($request->order_by)) {
            $data->orderBy('id', 'desc');
        }

        return $data;
    }

    public static function getForSelect()
    {
        if (Auth::user()->is_customer) {
            return self::where('status', self::STATUS_ACTIVE)->where('user_id', Auth::user()->id)->get();
        }
        return self::where('status', self::STATUS_ACTIVE)->get();
    }
}
