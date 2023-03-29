<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Major;
use App\Http\Resources\Major\ResourcesMajor;

class MajorTest extends TestCase
{


    public function test_create(): void
    {
        $fake_object = new ResourcesMajor(Major::factory()->make());
        $response = $this->postJson('/api/v1/majors', $fake_object->resolve());

        $response
            ->assertStatus(201)
            ->assertJsonFragment($fake_object->resolve());
    }

    public function test_get_list(): void
    {
        Major::factory()->count(2)->create();
        $response = $this->get('/api/v1/majors');
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'total' => 2,
            ]);
    }

    public function test_get_object(): void
    {

        $object = Major::factory()->create();
        $id = $object->id;
        $response = $this->get(sprintf('/api/v1/majors/%u', $id));
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }
    public function test_update_put_object(): void
    {

        $object = Major::factory()->create();
        $fake_object = new ResourcesMajor(Major::factory()->make());
        $id = $object->id;
        $response = $this->putJson(sprintf('/api/v1/majors/%u', $id), $fake_object->resolve());
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }

    public function test_delete_object(): void
    {

        $object = Major::factory()->create();
        $id = $object->id;
        $response = $this->delete(sprintf('/api/v1/majors/%u', $id));
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }
}