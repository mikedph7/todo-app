<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    const TODO_TITLE = 'Test Case Todo';

    /**
     * A basic feature test example.
     */
    public function test_can_create_a_todo()
    {
        $todoTitle = ['title' => self::TODO_TITLE];
        $response = $this->post('/todos/store', $todoTitle);
        $response->assertStatus(302);

        $this->assertDatabaseHas('todos', $todoTitle);
    }

    public function test_can_update_a_todo()
    {
        $todo = Todo::where('title', self::TODO_TITLE)->first();
        $response = $this->put('/todos/update/'.$todo->id, [
            'title' => $todo->title,
            'is_completed' => 1
        ]);


        $response->assertStatus(302);
        $this->assertTrue((bool) $todo->fresh()->is_completed);
    }

    public function test_can_delete_a_todo()
    {
        $todo = Todo::where('title', self::TODO_TITLE)->first();
        $this->delete('/todos/delete/'.$todo->id);

        $this->assertDatabaseMissing('todos', ['title' => self::TODO_TITLE]);
    }

}
