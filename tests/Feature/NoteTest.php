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

        $this->get('/note')->assertStatus(200)->assertJsonCount(5);
    }

    public function testCreateNote() {
        // note 1 should fail validation
        $note1Data = [
            'title' => '',
            'note' => '',
        ];

        // note 2 should fail validation
        $note2Data = [
            'title' => 'Title no note',
            'note' => '',
        ];

        // note 3 should fail validation
        $note3Data = [
            'title' => '',
            'note' => 'Note no title',
        ];

        // note 4 should pass
        $note4Data = [
            'title' => 'title is present',
            'note' => 'note is present',
        ];

        $this->json('POST', '/note', $note1Data)->assertStatus(422);
        $this->json('POST', '/note', $note2Data)->assertStatus(422);
        $this->json('POST', '/note', $note3Data)->assertStatus(422);

        // new model returns 201; model should include the new id
        $this->json('POST', '/note', $note4Data)->assertStatus(201)->assertJson(['id' => true,]);
    }
}
