<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class BeerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test  */
    public function beerlist()
    {
        $response = $this->get('/api/beers');
        $response->assertStatus(200);
    }
    /** @test  */
    public function beerlistadmin()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/api/admin/beers');
        $response->dump();
        $response->assertStatus(200);
    }
}
