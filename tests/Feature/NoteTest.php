<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

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

        // note 4 should fail validation
        $note4Data = [
            'title' => Str::random(10),
            'note' => 'note is present',
        ];

        $note5Data = [
            'title' => 'title is present',
            'note' => 'note is present'
        ];

        $this->json('POST', '/note', $note1Data)->assertStatus(422);
        $this->json('POST', '/note', $note2Data)->assertStatus(422);
        $this->json('POST', '/note', $note3Data)->assertStatus(422);
        $this->json('POST', '/note', $note3Data)->assertStatus(422);

        // new model returns 201; model should include the new id
        $this->json('POST', '/note', $note5Data)->assertStatus(201)->assertJson(['id' => true,]);
    }

    public function testEditNoteTitle() {
        $note = factory(Note::class)->create();

        // should fail, id in uri does not match any notes
        $title1Data = [
            'title' => 'note does not exist'
        ];

        // title 2 data should fail validation
        $title2Data = [
            'title' => Str::random(51)
        ];

        // title 3 data should fail validation
        $title3Data = [
            'title' => ''
        ];

        // title 4 data should pass
        $title4Data = [
            'title' => 'edited title'
        ];

        // fails as note does not exist
        $this->json('put', '/note/7/title', $title1Data)->assertStatus(404);

        $this->json('put', '/note/' . $note->id . '/title', $title2Data)->assertStatus(422);
        $this->json('put', '/note/' . $note->id . '/title', $title3Data)->assertStatus(422);

        $this->json('put', '/note/' . $note->id . '/title', $title4Data)->assertStatus(200)->assertJson(['title' => 'edited title']);
    }

    public function testEditNoteNote() {
        $note = factory(Note::class)->create();

        // should fail, id in uri does not match any notes
        $note1Data = [
            'note' => 'note does not exist'
        ];

        // note 2 data should fail validation
        $note2Data = [
            'note' => ''
        ];

        // note 3 data should pass
        $note3Data = [
            'note' => 'edited note'
        ];
        
        $this->json('put', '/note/7/note', $note1Data)->assertStatus(404);

        $this->json('put', '/note/' . $note->id . '/note', $note2Data)->assertStatus(422);

        $this->json('put', '/note/' . $note->id . '/note', $note3Data)->assertStatus(200)->assertJson(['note' => 'edited note']);
    }

    public function testNoteDelete() {
        $note = factory(Note::class)->create();

        // this is a note that does not exist
        $this->json('delete', '/note/7')->assertStatus(404);

        $this->json('delete', '/note/' . $note->id)->assertStatus(200);
    }

    public function testGetNote() {
        // note does not exist
        $this->json('get', '/note/1')->assertStatus(404);

        $note = factory(Note::class)->create();

        $this->json('get', '/note/' . $note->id)->assertStatus(200)->assertJson(['id' => $note->id]);
    }
}
