<?php

namespace App\Console\Commands;

use App\Services\TokenGenerator\TokenService;
use Illuminate\Console\Command;

class GenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new token';
    /**
     * @var TokenService
     */
    private $tokenService;

    /**
     * Create a new command instance.
     *
     * @param TokenService $tokenService
     */
    public function __construct(TokenService $tokenService)
    {
        parent::__construct();
        $this->tokenService = $tokenService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws \Throwable
     */
    public function handle()
    {
        $token = $this->tokenService->createToken();
        $this->info('Token: '. $token->token);
    }
}
