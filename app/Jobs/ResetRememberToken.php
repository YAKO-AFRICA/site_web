<?php

namespace App\Jobs;

use App\Models\TblCustomer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ResetRememberToken implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customerId;

    public function __construct($customerId)
    {
        $this->customerId = $customerId;
    }

    public function handle()
    {
        $customer = TblCustomer::find($this->customerId);
        if ($customer) {
            $customer->remember_token = null;
            $customer->save();
        }
    }
}