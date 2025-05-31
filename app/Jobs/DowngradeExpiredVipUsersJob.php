<?php

namespace App\Jobs;

use App\Model\Common\User;
use App\Notifications\DowngradeVip;
use App\Notifications\DowngradeVipFailed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class DowngradeExpiredVipUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            if ($this->user->upgrade_type == User::UPGRADE_TYPE_VIP && $this->user->upgrade_to_date && $this->user->upgrade_to_date <= now()) {
                $this->user->upgrade_type = User::UPGRADE_TYPE_NORMAL;
                // $this->user->upgrade_to_date = null;
                $this->user->save();
            }
            // Gửi email thành công
            Notification::route('mail', 'vudev4897@gmail.com')
                ->notify(new DowngradeVip($this->user));

        } catch (\Exception $e) {
            // Gửi email khi lỗi
            Notification::route('mail', 'vudev4897@gmail.com')
                ->notify(new DowngradeVipFailed($e->getMessage()));

            // Ghi log
            logger()->error('Hạ cấp tài khoản VIP lỗi: ' . $e->getMessage());
        }
    }
}
