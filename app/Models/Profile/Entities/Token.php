<?php

namespace Models\Profile\Entities;

use Models\Core\Entity;

class Token extends Entity
{
    public int $id;
    public string $token;
    public string $createdAt;
}