<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Http\Resources\User\ResourcesUser;

class UserTest extends TestCase
{


    public function test_create(): void
    {
        $fake_object = new ResourcesUser(User::factory()->make());  
        $response = $this->postJson('/api/v1/users', array_merge($fake_object->resolve(), ['password'=>'pass']));

        $response
            ->assertStatus(201)
            ->assertJsonFragment(['name' => $fake_object->resolve()['name']]);
    }

    public function test_get_list(): void
    {

        User::factory()->count(2)->create();
        $response = $this->get('/api/v1/users');
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'total' => 2,
            ]);
    }

    public function test_get_object(): void
    {

        $object = User::factory()->create();
        $id = $object->id;
        $response = $this->get(sprintf('/api/v1/users/%u', $id));
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }

    public function test_update_put_object(): void
    {

        $object = User::factory()->create();
        $fake_object = new ResourcesUser(User::factory()->make());  
        $id = $object->id;
        $response = $this->putJson(sprintf('/api/v1/users/%u', $id), array_merge($fake_object->resolve(), ['password'=>'pass']));
        $response
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $fake_object->resolve()['name']]);
    }

    public function test_delete_object(): void
    {

        $object = User::factory()->create();
        $id = $object->id;
        $response = $this->delete(sprintf('/api/v1/users/%u', $id));
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }
}