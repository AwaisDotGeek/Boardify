<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class AddVerificationCodeColumn extends Command
{
    protected $signature = 'db:add-verification-code-column';
    protected $description = 'Add verification_code column to users table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if (!Schema::hasColumn('users', 'verification_code')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('verification_code')->nullable();
            });

            $this->info('Column `verification_code` added to `users` table.');
        } else {
            $this->info('Column `verification_code` already exists in `users` table.');
        }
    }
}
