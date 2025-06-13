<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Visitor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    
    public function boot()
    {
        $this->recordVisitor();
    }

    protected function recordVisitor()
    {
        $ip = Request::ip();

    // Vérifiez si l'IP existe déjà pour aujourd'hui
        $alreadyRecorded = Visitor::where('ip_address', $ip)
            ->whereDate('created_at', Carbon::today())
            ->exists();
            if($alreadyRecorded){

                Log::info("existe ".$alreadyRecorded);
            }else{
                Log::info("n'existe pas".$alreadyRecorded);
            }

        if (!$alreadyRecorded) {
            // Enregistrez l'IP si elle n'a pas encore été enregistrée aujourd'hui
            Visitor::create(['ip_address' => $ip]);
            Log::info("enregistrement effectuer");
        }
    }
}
