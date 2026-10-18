<?php

namespace Tests\Feature;

use App\Models\Mountain;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingRoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $mountain = Mountain::create([
            'name' => 'Gunung Prau',
            'location' => 'Wonosobo, Jawa Tengah',
            'elevation' => 2565,
            'description' => 'Gunung indah dengan golden sunrise.',
            'status' => true,
        ]);

        Trip::create([
            'mountain_id' => $mountain->id,
            'name' => 'Prau Weekend Trekking',
            'duration' => '2 Hari 1 Malam',
            'price' => 350000,
            'status' => 1,
            'description' => 'Pendakian santai di Gunung Prau.',
        ]);
    }

    public function test_guest_can_access_checkout_page(): void
    {
        $response = $this->get('/checkout');

        $response->assertStatus(200);
        $response->assertViewIs('checkout.index');
    }

    public function test_customer_can_access_checkout_page(): void
    {
        $customer = User::factory()->create([
            'role' => 'user',
        ]);

        $response = $this->actingAs($customer)->get('/checkout');

        $response->assertStatus(200);
        $response->assertViewIs('checkout.index');
    }

    public function test_admin_cannot_access_checkout_page_and_is_redirected_with_warning(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@maroadventure.com',
        ]);

        $expectedMessage = "Akun Admin/Superadmin tidak dapat melakukan booking personal lewat halaman ini. Silakan gunakan menu 'Booking Manual' di Admin Panel.";

        $response = $this->actingAs($admin)->get('/checkout');

        $response->assertRedirect(route('admin.bookings.index'));
        $response->assertSessionHas('warning', $expectedMessage);
    }

    public function test_superadmin_cannot_access_checkout_page_and_is_redirected_with_warning(): void
    {
        $superadmin = User::factory()->create([
            'role' => 'superadmin',
            'email' => 'superadmin@maroadventure.com',
        ]);

        $expectedMessage = "Akun Admin/Superadmin tidak dapat melakukan booking personal lewat halaman ini. Silakan gunakan menu 'Booking Manual' di Admin Panel.";

        $response = $this->actingAs($superadmin)->get('/checkout');

        $response->assertRedirect(route('superadmin.bookings.index'));
        $response->assertSessionHas('warning', $expectedMessage);
    }

    public function test_admin_json_request_to_checkout_is_forbidden(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@maroadventure.com',
        ]);

        $expectedMessage = "Akun Admin/Superadmin tidak dapat melakukan booking personal lewat halaman ini. Silakan gunakan menu 'Booking Manual' di Admin Panel.";

        $response = $this->actingAs($admin)
            ->getJson('/checkout');

        $response->assertStatus(403);
        $response->assertJson([
            'message' => $expectedMessage,
        ]);
    }

    public function test_admin_redirected_back_to_referer_when_attempting_checkout(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@maroadventure.com',
        ]);

        $expectedMessage = "Akun Admin/Superadmin tidak dapat melakukan booking personal lewat halaman ini. Silakan gunakan menu 'Booking Manual' di Admin Panel.";

        $response = $this->actingAs($admin)
            ->from('/trips/1')
            ->get('/checkout?trip_id=1');

        $response->assertRedirect('/trips/1');
        $response->assertSessionHas('warning', $expectedMessage);
    }
}
