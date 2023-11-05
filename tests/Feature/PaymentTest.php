<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();

        $token = JWTAuth::fromUser($user->refresh());

        $this->withHeader('Authorization', 'Bearer' . $token);
    }
    /**
     * check the app api is active and accessible or not
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * get a specific payment by unique_id
     */
    public function test_get_specific_payment(): void
    {
        $payment = Payment::factory(1)->create();
        $response = $this->getJson('/api/v1/payments/' . $payment[0]->unique_id);

        $response->assertStatus(200);
        $response->assertSee(__('payment.messages.found_successfull'));
    }

    /**
     * get a specific payment by unique_id and approve it
     */
    public function test_aprove_specific_payment(): void
    {
        $payment = Payment::factory(1)->create();
        $response = $this->patch('/api/v1/payments/' . $payment[0]->unique_id . '/approve');

        $response->assertStatus(200);
        $response->assertSee(__('payment.messages.approve_successfull'));
    }
}
