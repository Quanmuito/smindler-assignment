<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    public function index(): Collection
    {
        return Order::all();
    }

    public function getById(int $id): ?Order
    {
        return Order::with('basket')->where('id', $id)->first();
    }

    public function create(array $orderData, array $basketData): Order
    {
        $order = Order::create($orderData);
        $order->basket()->createMany($basketData);
        $order->basket = $order->basket;
        return $order;
    }

    public function delete(int $id): void
    {
        Order::destroy($id);
    }
}
