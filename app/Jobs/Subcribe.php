<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Exception;

class Subcribe implements ShouldQueue
{
    use Queueable;

    protected string $productName;
    protected float $price;

    /**
     * Create a new job instance.
     */
    public function __construct(string $productName, float $price)
    {
        $this->productName = $productName;
        $this->price = $price;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $url = 'https://very-slow-api.com/orders';

        $headers = [
            'Content-Type' => 'application/json'
        ];

        $body = [
            'ProductName' => $this->productName,
            'Price' => $this->price,
            'Timestamp' => date('Y-m-d H:i:s'),
        ];

        try {
            $client = new Client();
            $request = new Request('POST', $url, $headers, json_encode($body));
            $client->send($request);
        } catch (Exception $error) {

        }
    }
}
