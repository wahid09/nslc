<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

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
    public function handle()
    {
        $response = Http::post('https://gpcmp.grameenphone.com/ecmapigw/webresources/ecmapigw.v2', [
            'username' => 'ITDAHQAdmin_3753',
            'password' => 'ITdte@2020',
            'apicode' => '1',
            'cli' => 'IT DTE',
            'countrycode' => '880',
            'msisdn' => $this->phone,
            'messagetype' => '1',
            'message' => $this->message,
            'messageid' => '0'
        ]);
        if ($response->successful()) {
            \Log::info('SMS sent successfully', ['to' => $this->phone]);
        } else {
            \Log::error('SMS failed', [
                'to' => $this->phone,
                'response' => $response->body(),
                'status' => $response->status()
            ]);
        }
    }
}
