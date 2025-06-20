<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $filterResults = [];
        $selectedType = '';
        $checkResult = session('checkResult');
        
        return view('welcome', compact('filterResults', 'selectedType', 'checkResult'));
    }

    public function checkFile(Request $request)
    {
        $request->validate([
            'check_file' => 'required|file|mimes:pdf,docx|max:5120'
        ]);

        $file = $request->file('check_file');
        $fileHash = hash_file('sha256', $file->getRealPath());
        $existingFile = Document::where('file_hash', $fileHash)->first();

        return back()
            ->with('checkResult', [
                'exists' => $existingFile ? true : false,
                'file_info' => $existingFile
            ])
            ->withInput();
    }

    public function filterFiles(Request $request)
    {
        $request->validate([
            'filter_type' => 'required|in:pdf,docx'
        ]);

        $selectedType = $request->filter_type;
        $filterResults = Document::where('file_type', $selectedType)
                              ->orderBy('created_at', 'desc')
                              ->get();

        return view('welcome', [
            'filterResults' => $filterResults,
            'selectedType' => $selectedType,
            'checkResult' => session('checkResult')
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf,docx|max:5120'
        ]);

        $file = $request->file('document');
        $fileHash = hash_file('sha256', $file->getRealPath());

        Document::create([
            'name' => $file->getClientOriginalName(),
            'path' => $file->store('documents'),
            'file_type' => $file->getClientOriginalExtension(),
            'file_hash' => $fileHash
        ]);

        return back()->with('success', 'تم رفع الملف بنجاح!');
    }
}