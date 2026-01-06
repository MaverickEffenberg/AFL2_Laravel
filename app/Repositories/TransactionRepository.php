<?php

namespace App\Repositories;

use App\Models\Sale;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function createTransaction(array $data)
    {
        return Sale::create($data);
    }
}
