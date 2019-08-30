<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Note;

use Log;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetAllNotes()
    {
        $notes = factory(Note::class, 5)->create();

        $response = $this->get('/note');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }
}
