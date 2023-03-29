<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Comment;
use App\Http\Resources\Comment\ResourcesComment;

class CommentTest extends TestCase
{


    public function test_create(): void
    {
        $comment = Comment::factory()->create();
        $fake_object = new ResourcesComment($comment);
        $response = $this->postJson('/api/v1/comments', $fake_object->resolve());


        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'title' => $fake_object->resolve()['title']
            ]);
    }

    public function test_get_list(): void
    {
        
        Comment::factory()->count(2)->create();
        $response = $this->get('/api/v1/comments');
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'total' => 2,
            ]);
    }

    public function test_get_object(): void
    {

        $object = Comment::factory()->create();
        $id = $object->id;
        $response = $this->get(sprintf('/api/v1/comments/%u', $id));
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }
    public function test_update_put_object(): void
    {

        $object = Comment::factory()->create();
        $fake_object = new ResourcesComment(Comment::factory()->make());
        $id = $object->id;
        $response = $this->putJson(sprintf('/api/v1/comments/%u', $id), $fake_object->resolve());
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }

    public function test_delete_object(): void
    {

        $object = Comment::factory()->create();
        $id = $object->id;
        $response = $this->delete(sprintf('/api/v1/comments/%u', $id));
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }
}