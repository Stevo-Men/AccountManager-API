<?php

namespace Models\Profile\Brokers;

use Models\Profile\Entities\Token;
use Zephyrus\Database\DatabaseBroker;

class TokenBroker extends DatabaseBroker
{
    public function saveToken(Token $token): ?Token
    {
        return $this->query("INSERT INTO token(userId,token,createdat) 
                                               VALUES (?, ?, NOW())", [
            $token->userId,
            $token->token
        ]);
    }

    public function update(Token $token)
    {
        $this->query("UPDATE product 
                               SET token = ?, createat = NOW()
                             WHERE id = ?", [
            $token->token,
            $token->id

        ]);
    }

    public function findValidTokenByValue(string $tokenValue): ?Token
    {
        $row = $this->selectSingle(
            "SELECT userid, token, createdat AS \"createdAt\"
         FROM token
         WHERE token = ?
         LIMIT 1",
            [$tokenValue]
        );

        return $row ? Token::mapToToken($row) : null;
    }

}