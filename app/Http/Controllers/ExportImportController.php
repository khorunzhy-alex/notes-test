<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImportRequest;
use App\Note;
use SimpleXMLElement;
use File;

class ExportImportController extends Controller
{
    public function export(){
        return view('notes.export');
    }

    public function import(){
        return view('notes.import');
    }

    public function exportSubmit(Request $request){
        if($request->type == 'xml') {
            return $this->getXML();
        } else {
            return $this->getTXT();
        }
    }

    private function getXML(){
        $xml_header = '<?xml version="1.0"?>';
        $notes = Note::all();
        $content = view('export.xml', compact('xml_header','notes'));
        File::put(public_path('exports/export.xml'), $content);
        return response()->download(public_path('exports/export.xml'));
    }

    private function getTXT(){
        $note = Note::first();
        $content = view('export.txt', compact('note'));
        File::put(public_path('exports/export.txt'), $content);
        return response()->download(public_path('exports/export.txt'));
    }

    public function importSubmit(ImportRequest $request){
        $file = $request->file;
        $extension = $file->getClientOriginalExtension();
        if($extension == 'xml') {
            $this->parseAndSaveXML($file);
        } elseif($extension == 'txt') {
            $this->parseAndSaveTXT($file);
        }
        return redirect()->route('notes.index');
    }

    private function parseAndSaveXML($file){
        $contents = File::get($file);
        $xml = new SimpleXMLElement($contents);

        foreach ($xml->note as $note) {
            Note::create([
                'title' => $note->title,
                'text' => $note->text
            ]);
        }
    }

    private function parseAndSaveTXT($file){

        $handle = fopen($file, "r");
        if ($handle) {
            $title = fgets($handle); //first line is a title
            $text = '';
            while (($line = fgets($handle)) !== false) {
                $text .= $line;
            }
            fclose($handle);
        }

        Note::create([
            'title' => $title,
            'text' => html_entity_decode($text)
        ]);
    }
}