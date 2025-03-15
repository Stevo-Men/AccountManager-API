<?php

namespace Models\Profile\Entities;

use Models\Core\Entity;

class Transaction extends Entity
{
    public int $id;
    public string $userId;
    public string $name;
    public float $price;
    public int $quantity;
    public string $createdAt;

}