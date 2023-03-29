<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Region;

use App\Http\Resources\Region\ResourcesRegion;

class RegionTest extends TestCase
{


    public function test_create(): void
    {
        $fake_object = new ResourcesRegion(Region::factory()->make());
        $response = $this->postJson('/api/v1/regions', $fake_object->resolve());

        $response
            ->assertStatus(201)
            ->assertJsonFragment($fake_object->resolve());
    }

    public function test_get_list(): void
    {

        Region::factory()->count(2)->create();
        $response = $this->get('/api/v1/regions');
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'total' => 2,
            ]);
    }

    public function test_get_object(): void
    {

        $object = Region::factory()->create();
        $id = $object->id;
        $response = $this->get(sprintf('/api/v1/regions/%u', $id));
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }

    public function test_update_put_object(): void
    {

        $object = Region::factory()->create();
        $fake_object = new ResourcesRegion(Region::factory()->make());
        $id = $object->id;
        $response = $this->putJson(sprintf('/api/v1/regions/%u', $id), $fake_object->resolve());
        $response
            ->assertStatus(200)
            ->assertJsonFragment($fake_object->resolve());
    }

    public function test_delete_object(): void
    {

        $object = Region::factory()->create();
        $id = $object->id;
        $response = $this->delete(sprintf('/api/v1/regions/%u', $id));
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }
}