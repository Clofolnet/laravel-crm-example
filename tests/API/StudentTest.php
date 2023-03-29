<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Resources\Student\ResourcesStudent;
use App\Models\Student;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class StudentTest extends TestCase
{


    public function test_create(): void
    {
        Storage::fake('protected_storage');

        $passport_document = UploadedFile::fake()->create('test.pdf', 200, 'application/pdf');
        $IELTS_document = UploadedFile::fake()->create('test.pdf', 200, 'application/pdf');


        $comment = Student::factory()->create();
        $fake_object = new ResourcesStudent($comment);
        $response = $this->postJson('/api/v1/students', array_merge($fake_object->resolve(), [
            'passport_document' => $passport_document,
            'IELTS_document' => $IELTS_document,
        ]));

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => $fake_object->resolve()['name']
            ]);
    }

    public function test_get_list(): void
    {

        Student::factory()->count(2)->create();
        $response = $this->get('/api/v1/students');
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'total' => 2,
            ]);
    }

    public function test_get_object(): void
    {

        $object = Student::factory()->create();
        $id = $object->id;
        $response = $this->get(sprintf('/api/v1/students/%u', $id));
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }
    public function test_update_put_object(): void
    {

        Storage::fake('protected_storage');

        $passport_document = UploadedFile::fake()->create('test.pdf', 200, 'application/pdf');
        $IELTS_document = UploadedFile::fake()->create('test.pdf', 200, 'application/pdf');

        $object = Student::factory()->create();
        $fake_object = new ResourcesStudent(Student::factory()->make());
        $id = $object->id;
        $response = $this->putJson(sprintf('/api/v1/students/%u', $id), array_merge($fake_object->resolve(), [
            'passport_document' => $passport_document,
            'IELTS_document' => $IELTS_document,
        ]));
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }

    public function test_delete_object(): void
    {

        $object = Student::factory()->create();
        $id = $object->id;
        $response = $this->delete(sprintf('/api/v1/students/%u', $id));
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }
}