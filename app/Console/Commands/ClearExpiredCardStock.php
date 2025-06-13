<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CardStock;
use App\Models\CardStockDetail;

class ClearExpiredCardStock extends Command
{
    protected $signature = 'cardstock:clear-expired';
    protected $description = 'Hapus snapshot Card Stock dan detail yang sudah expired';

    public function handle()
    {
        $expiredCards = CardStock::whereNotNull('expired_at')
            ->where('expired_at', '<', now())
            ->delete();

        $expiredDetails = CardStockDetail::whereNotNull('expired_at')
            ->where('expired_at', '<', now())
            ->delete();

        $this->info("Expired Card Stock dan Detail telah dihapus.");
    }
}
