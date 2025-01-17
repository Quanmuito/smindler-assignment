<?php

namespace Tests\Feature;

use App\Models\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * Test get all orders
     */
    public function test_get_all_orders(): void
    {
        $response = $this->json('get', 'api/orders');

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'success',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'first_name',
                        'last_name',
                        'address',
                        'created_at',
                        'updated_at',
                        'basket' => [
                            '*' => [
                                'id',
                                'name',
                                'type',
                                'price',
                                'order_id',
                                'created_at',
                                'updated_at',
                            ]
                        ]
                    ]
                ]
            ]
        );
    }

    /**
     * Test get 1 order
     */
    public function test_get_one_order(): void
    {
        $order = Order::first();
        $response = $this->json('get', 'api/orders/' . $order->id);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'success',
                'message',
                'data' => [
                    'id',
                    'first_name',
                    'last_name',
                    'address',
                    'created_at',
                    'updated_at',
                    'basket' => [
                        '*' => [
                            'id',
                            'name',
                            'type',
                            'price',
                            'order_id',
                            'created_at',
                            'updated_at',
                        ]
                    ]
                ]
            ]
        );
    }

    /**
     * Test delete order
     */
    public function test_delete_order(): void
    {
        $order = Order::first();
        $response = $this->json('delete', 'api/orders/' . $order->id);

        $response->assertStatus(204);
    }

    /**
     * Test create new order
     */
    public function test_create_new_order(): void
    {
        $payload = [
            'first_name' => 'Alan',
            'last_name' => 'Turing',
            'address' => '123 Enigma Ave, Bletchley Park, UK',
            'basket' => [
                [
                    'name' => 'Smindle ElePHPant plushie',
                    'type' => 'unit',
                    'price' => 295.45,
                ],
                [
                    'name' => 'Syntax & Chill',
                    'type' => 'subscription',
                    'price' => 175.00,
                ]
            ]
        ];

        $response = $this->json('post', 'api/orders', $payload);

        $response->assertStatus(201);
        $response->assertJsonStructure(
            [
                'success',
                'message',
                'data' => [
                    'id',
                    'first_name',
                    'last_name',
                    'address',
                    'created_at',
                    'updated_at',
                    'basket' => [
                        '*' => [
                            'id',
                            'name',
                            'type',
                            'price',
                            'order_id',
                            'created_at',
                            'updated_at',
                        ]
                    ]
                ]
            ]
        );
        $this->assertDatabaseHas('orders', [
            'first_name' => 'Alan',
            'last_name' => 'Turing',
            'address' => '123 Enigma Ave, Bletchley Park, UK'
        ]);
    }

    /**
     * Test create new order fail validation
     */
    public function test_create_new_order_fail(): void
    {
        $payload = [
            'first_name' => 'Alan',
            'address' => '123 Enigma Ave, Bletchley Park, UK',
            'basket' => [
                [
                    'name' => 'Smindle ElePHPant plushie',
                    'price' => 295.45,
                ],
                [
                    'type' => 'subscription',
                    'price' => 175.00,
                ]
            ]
        ];

        $response = $this->json('post', 'api/orders', $payload);

        $response->assertStatus(400);
        $response->assertJsonStructure(
            [
                'success',
                'message',
                'data' => [
                    'last_name',
                    'basket.1.name',
                    'basket.0.type',
                ]
            ]
        );
    }
}
