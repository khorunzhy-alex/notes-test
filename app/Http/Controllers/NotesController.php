<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NoteRequest;
use App\Note;
use App\NoteImage;

class NotesController extends Controller
{
    public function index(){
        $notes = Note::all();
        return view('notes.index', compact('notes'));
    }

    public function create(){
        return view('notes.create');
    }

    public function store(NoteRequest $request){
        $note = Note::create($request->all());

        if(!empty($request->images)) {
            foreach ($request->images as $image) {
                $filename = $this->storeImage($image);
                NoteImage::create([
                    'note_id' => $note->id,
                    'image' => $filename
                ]);
            }
        }

        return redirect()->route('notes.index');
    }

    public function edit($id){
        $note = Note::findOrFail($id);
        return view('notes.edit', compact('note'));
    }

    public function update(NoteRequest $request, $id){
        $note = Note::findOrFail($id);
        $note->fill($request->all());
        $note->save();

        if(!empty($request->images)) {
            foreach ($request->images as $image) {
                $filename = $this->storeImage($image);
                NoteImage::create([
                    'note_id' => $note->id,
                    'image' => $filename
                ]);
            }
        }

        return redirect()->route('notes.index');
    }

    public function destroy($id){
        $note = Note::findOrFail($id);
        foreach ($note->images as $image) {
            if(file_exists(asset('uploads/'.$image->image))) {
                unlink(asset('uploads/'.$image->image));
            }
        }
        $note->delete();
        return redirect()->back();
    }

    public function destroyImage($id) {
        $image = NoteImage::find($id);
        if(file_exists(asset('uploads/'.$image->image))) {
            unlink(asset('uploads/'.$image->image));
        }
        $image->delete();
        return redirect()->back();
    }

    private function storeImage($image) {
        $fileName = 'image_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(base_path() . '/public/uploads', $fileName);
        return $fileName;
    }
}