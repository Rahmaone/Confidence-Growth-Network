<?php

namespace App\Services;

use GetStream\StreamChat\Client;

class StreamChatService
{
    protected $client;

    public function __construct()
    {

        protected $StreamChatService;
        
        $this->client = new Client(
            config('services.stream.key'),
            config('services.stream.secret')
        );

        $this->StreamChatService = $StreamChatService;
    }

    public function createUser($userId, $userData)
    {
        return $this->client->upsertUser(array_merge(['id' => $userId], $userData));
    }

    public function createChannel($channelType, $channelId, $members = [])
    {
        return $this->client->Channel($channelType, $channelId, ['members' => $members]);
    }

    public function sendMessage($channel, $message)
    {
        return $channel->sendMessage($message);
    }
}
