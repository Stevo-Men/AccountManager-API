<?php

namespace Models\Profile\Entities;

use Models\Core\Entity;

class Token extends Entity
{
    public int $id;
    public string $token;
    public string $createdAt;

    public static function mapToToken(\stdClass $row): Token
    {
        $token = new Token();
        $token->id = $row->id;
        $token->token = $row->token;
        $token->createdAt = $row->createdAt;

        return $token;
    }
}