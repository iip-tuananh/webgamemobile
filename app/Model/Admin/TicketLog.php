<?php

namespace App\Model\Admin;

use App\Model\BaseModel;

class TicketLog extends BaseModel
{
    protected $table = 'ticket_logs';
    protected $fillable = ['ticket_id', 'created_by', 'updated_by', 'type', 'message'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
