<?php

namespace Models\Profile\Entities;

use Models\Core\Entity;

class Token extends Entity
{
    public ?int $userId = null;
    public string $token;
    public string $createdAt;

    public static function mapToToken(object $row): Token
    {
        $token = new Token();
        $token->userId = $row->userId;
        $token->token = $row->token;
        $token->createdAt = $row->createdAt;

        return $token;
    }
}