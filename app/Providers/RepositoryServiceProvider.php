<?php

namespace App\Providers;

use App\Interfaces\Auth\IVerificationRepository;
use App\Interfaces\Billings\IGiveawayRepository;
use App\Interfaces\Billings\VTU\IAirtimeDataRepository;
use App\Interfaces\IReferralRepository;
use App\Interfaces\IUserProfileRepository;
use App\Interfaces\IUserRepository;
use App\Interfaces\Transactions\ITransactionRepository;
use App\Repository\Auth\VerificationRepository;
use App\Repository\Billings\GiveawayRepository;
use App\Repository\Billings\VTU\AirtimeDataRepository;
use App\Repository\ReferralRepository;
use App\Repository\Transactions\TransactionRepository;
use App\Repository\UserProfileRepository;
use App\Repository\UserRepository;
use App\Services\Apis\MonnifyApiService;
use App\Services\Apis\VTU\GsubzApiService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(IVerificationRepository::class, VerificationRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IUserProfileRepository::class, UserProfileRepository::class);
        $this->app->bind(IReferralRepository::class, ReferralRepository::class);
        $this->app->bind(ITransactionRepository::class, TransactionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}