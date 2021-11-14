<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\file;
use DB;

class DocumentController extends Controller
{
    public function view() {
        $showData = file::all();
        return view('file', compact('showData'));
    }

    public function insert(Request $request) {
        $success = false;
        try {
            DB::beginTransaction();
            // saving data to database
            $file = new file();
            if($request->file('file')) {
                $filenameWithExt = $request->file('file')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('file')->getClientOriginalExtension();
                $filenameSimpan = $filename.'_'.time().'.'.$extension;
                $request->file('file')->move('storage/', $filenameSimpan);

                $file->url = $filenameSimpan;
            }
            $file->nama_file = $request->name;
            $file->save();
            DB::commit();
            $success = true;
        }  catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
            logger()->error('Problem while saving data files : '. $e->getMessage());
        }
        if($success) {
            return redirect()->route('file');
        } else {
            return back()->with('error', "Oops looks like there's problem in our server. Please try again.");
        }
    }

    public function download($url) {
        return response()->download('storage/'.$url);
    }

    public function deleteFile($id) {
        $file = file::find($id);

        $filename = $file->url;
        $filepath = public_path('storage/'.$filename);
        unlink($filepath);

        $file->delete();
        return redirect()->route('file');
    }
}