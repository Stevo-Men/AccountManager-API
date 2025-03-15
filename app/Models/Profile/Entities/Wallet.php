<?php

namespace Models\Profile\Entities;

use Models\Core\Entity;

class Wallet extends Entity
{
    public string $id;
    public float $balance;
    public float $amountSpent;
}