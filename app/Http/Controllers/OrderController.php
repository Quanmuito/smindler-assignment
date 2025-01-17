<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Http\Requests\CreateOrderRequest;
use App\Jobs\Subcribe;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Get all order records
     */
    public function index()
    {
        $orders = $this->orderRepository->index();
        return ApiResponse::sendResponse($orders);
    }

    /**
     * Create new order
     */
    public function create(CreateOrderRequest $request)
    {
        $orderData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
        ];

        $basketData = $request->basket;

        DB::beginTransaction();
        try {
            $order = $this->orderRepository->create($orderData, $basketData);
            foreach ($order->basket as $basket) {
                if ($basket->type === 'subscription') {
                    dispatch(new Subcribe($basket->name, $basket->price));
                }
            }

            DB::commit();
            return ApiResponse::sendResponse($order, 201, 'Order Create Successful');

        } catch(Exception $error) {
            DB::rollBack();
            return ApiResponse::sendError($error);
        }
    }

    /**
     * Get record of 1 order by id
     */
    public function show(int $id)
    {
        $order = $this->orderRepository->getById($id);
        return ApiResponse::sendResponse($order);
    }

    /**
     * Delete the order record
     */
    public function delete(int $id)
    {
        DB::beginTransaction();
        try {
            $this->orderRepository->delete($id);
            DB::commit();
            return ApiResponse::sendResponse(null, 204);

        } catch(Exception $error) {
            DB::rollBack();
            return ApiResponse::sendError($error);
        }
    }
}
