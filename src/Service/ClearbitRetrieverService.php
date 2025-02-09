<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class ClearbitRetrieverService
{
    private HttpClientInterface $client;
    private LoggerInterface $logger;

    public function __construct(HttpClientInterface $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    public function retrieveClearbitLogo(string $icon): ?string
    {
        $icon = strtolower($icon);
        $url = "https://logo.clearbit.com/".urlencode($icon).".com";

        try {
            $response = $this->client->request('GET', $url);
            if ($response->getStatusCode() === 200) {
                return $url;
            }
        } catch (\Exception $e) {
            $this->logger->error('Error fetching icon URL', ['exception' => $e]);
        }

        return null;
    }
}
