<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Providers\RouteServiceProvider;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_check_if_auth_user_can_make_a_transaction()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->post('/store-transaction',[
            'receiver_id' => '1',
            'transaction_type' => 'debit',
            'actual_amount' => 10.5,
            'converted_amount' => 11.25,
            'conversion_rate' => .088,
            'transaction_description' => 'Description',
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME); //wallet dashboard
    }
}
