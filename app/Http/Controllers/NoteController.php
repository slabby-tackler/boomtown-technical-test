<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Note::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50',
            'note' => 'required|string',
        ]);

        $note = new Note();
        $note->title = $request->title;
        $note->note = $request->note;
        
        $note->save();

        return $note;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource title in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTitle(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50'
        ]);

        $note = Note::findOrFail($id);
        $note->title = $request->title;
        $note->save();

        return $note;
    }

    /**
     * Update the specified resource note in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateNote(Request $request, $id)
    {
        $this->validate($request, [
            'note' => 'required|string'
        ]);

        $note = Note::findOrFail($id);
        $note->note = $request->note;
        $note->save();

        return $note;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
