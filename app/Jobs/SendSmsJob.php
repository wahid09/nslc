<?php

namespace App\Jobs;

use App\Services\SMSService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $phone;
    protected $message;

    public function __construct($phone, $message)
    {
        $this->phone = $phone;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SMSService $sms)
    {
        try {
            $response = $sms->sendSMS($this->phone, $this->message);

            if ($response->successful()) {
                Log::info('SMS sent successfully', ['to' => $this->phone]);
            } else {
                Log::error('SMS failed', [
                    'to' => $this->phone,
                    'response' => $response->body(),
                    'status' => $response->status()
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('SMS Exception', [
                'to' => $this->phone,
                'error' => $e->getMessage()
            ]);
        }

    }
}
