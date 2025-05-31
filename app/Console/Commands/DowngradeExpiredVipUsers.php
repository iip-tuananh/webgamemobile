<?php

namespace App\Console\Commands;

use App\Jobs\DowngradeExpiredVipUsersJob;
use App\Model\Common\User;
use Illuminate\Console\Command;

class DowngradeExpiredVipUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:downgrade-vip';
    protected $description = 'Chuyển tài khoản VIP đã hết hạn thành tài khoản thường';

    public function handle()
    {
        $users = User::where('upgrade_type', User::UPGRADE_TYPE_VIP)
        ->whereNotNull('upgrade_to_date')
        ->where('upgrade_to_date', '<=', now())
        ->get();

        foreach ($users as $user) {
            dispatch(new DowngradeExpiredVipUsersJob($user));
        }
        $this->info('Đã gửi Job hạ cấp tài khoản VIP!');

    }
}
