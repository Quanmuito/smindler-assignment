<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface
{
    public function index(): Collection;
    public function getById(int $id): ?Order;
    public function create(array $orderData, array $basketData): Order;
    public function delete(int $id): void;
}
