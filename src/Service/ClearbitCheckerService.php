<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClearbitCheckerService
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function isValidIcon(string $icon): bool
    {
        $url = "https://logo.clearbit.com/".urlencode($icon).".com";

        try {
            $response = $this->client->request('GET', $url);
            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            return false;
        }
    }
}
