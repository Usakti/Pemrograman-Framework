<?php
namespace App\Http\Controllers;

use DB;
use PDF;
use App\Mahasiswa;
use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class LatihController extends Controller {

    public function index() {
        $showData = Mahasiswa::all();

        $jmlmhs = Mahasiswa::all()->count();

        //Persiapan data untuk chart
        $categories = [];
        $categories = ["Teknik Informatika", "Sistem Informasi"];

        if ($jmlmhs >= 1) {
            //$i = 0;
            //foreach($showData as $data) {
            for ($i = 0; $i <= 1; $i++) {
                //$categories[] = $data->jurusan;
                $jumlah[] = Mahasiswa::where('jurusan', $categories[$i])->count();
            }
        } else {
            $jumlah = [0, 0];
        }

        return view('tambahdata', compact('showData', 'categories', 'jumlah'));
    }

    public function addData(Request $request) {
        $success = false;
        try {
            DB::beginTransaction();
            // saving data to database
            $mahasiswa = new Mahasiswa();
            $mahasiswa->nama_mahasiswa = $request->name;
            $mahasiswa->jurusan = $request->jurusan;
            $mahasiswa->email = $request->email;
            $mahasiswa->save();
            DB::commit();
            $success = true;
        }  catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
            logger()->error('Problem while saving data mahasiswa : '. $e->getMessage());
        }
        if($success) {
            return redirect()->route('index');
        } else {
            return back()->with('error', "Oops looks like there's problem in our server. Please try again.");
        }
    }
    public function showViewUpdateData($id) {
        $dataMahasiswa = Mahasiswa::where('id', $id)->get();
        return view('updatedata', compact('dataMahasiswa'));
    }
    public function updateData(Request $request) {
        $update = Mahasiswa::where('id', $request->id)->update([
            'nama_mahasiswa' => $request->name,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ]);
        return redirect()->route('index')->with('success', "Updated Data");
    }
    public function deleteData($id) {
        Mahasiswa::where('id', $id)->delete();
        return redirect()->route('index');
    }

    public function downloadPDF() {
        $showData = Mahasiswa::all();
        $pdf = PDF::loadView('datapdf', compact('showData'));
        return $pdf->download('mahasiswa.pdf');
    }

    public function exportExcel() {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    public function importExcel(Request $request) {
        $file = $request->file('file');
        $namafile = $file->getClientOriginalName();
        $file->move('data-import', $namafile);

        Excel::import(new MahasiswaImport, public_path('data-import/'.$namafile));
        return redirect()->route('index');
    }
}
