<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class IpProductTicket extends Model
{
    protected $table = 'ip_product_tickets';
    protected $fillable = ['ticket_id', 'ip_product_id'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function ipProduct()
    {
        return $this->belongsTo(IpProduct::class, 'ip_product_id', 'id');
    }
}
