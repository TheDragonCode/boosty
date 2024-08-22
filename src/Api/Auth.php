<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Api;

use DragonCode\Boosty\Data\AccessTokenData;
use Spatie\LaravelData\Data;

class Auth extends Api
{
    public function refresh(string $refreshToken, string $clientId): Data|AccessTokenData
    {
        return $this->client->request()
            ->post('accessToken', [
                'grant_type'    => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id'     => $clientId,
            ])
            ->throw()
            ->toData(AccessTokenData::class);
    }

    public function isAuthenticated(): bool
    {
        return $this->client->request(false)
            ->post('notification/settings')
            ->successful();
    }

    public function isNotAuthenticated(): bool
    {
        return ! $this->isAuthenticated();
    }
}
