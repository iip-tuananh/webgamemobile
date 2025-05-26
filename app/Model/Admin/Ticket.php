<?php

namespace App\Model\Admin;

use App\Model\Common\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = ['title', 'status', 'user_id'];

    public const STATUS_NEW = 1; // Mới
    public const STATUS_PROCESSING = 2; // Đang xử lý
    public const STATUS_CLOSED = 3; // Đã đóng

    public const STATUSES = [
        [
            'id' => self::STATUS_NEW,
            'name' => 'Mới',
            'type' => 'success',
        ],
        [
            'id' => self::STATUS_PROCESSING,
            'name' => 'Đang xử lý',
            'type' => 'warning',
        ],
        [
            'id' => self::STATUS_CLOSED,
            'name' => 'Đã đóng',
            'type' => 'danger',
        ],
    ];

    public function logs()
    {
        return $this->hasMany(TicketLog::class);
    }

    public function ipProducts()
    {
        return $this->hasMany(IpProductTicket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function searchByFilter($request)
    {
        $query = self::query();
        if (!empty($request->title)) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
        if (!empty($request->status)) {
            $query->where('status', $request->status);
        }
        if (!empty($request->customer)) {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->customer . '%');
            });
        }
        $query->orderBy('created_at', 'desc');
        return $query;
    }
}
