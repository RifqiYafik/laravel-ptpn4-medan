<?php

namespace App\Http\Controllers;

use App\Models\Penempatan;
use Illuminate\Http\Request;
use App\Models\Asal_Sekolah;
use App\Models\Siswa;



class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = Siswa::orderBy('nama_siswa', 'asc')->get();
        return view ('siswa.index', compact('siswas'));
    }

public function view_pdf(){



    $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']); // Set orientasi ke mode landscape

    // Menetapkan judul dokumen
    $imagePath = asset('image/logo-ptpn.jpeg');
    $logoData = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($imagePath));
    $mpdf->SetTitle('Daftar Siswa PKL');


    // Header dengan logo PTPN4
    $imagePath = asset('image/logo-ptpn.jpeg');
    $logoData = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($imagePath));
    $currentDate = date("j F Y");
    $htmlHeader = '<table width="100%">
                        <tr>
                            <td width="50%">
                                <img src="' . $logoData . '" alt="PTPN4 Logo" style="max-width: 250px;">
                            </td>
                            <td width="50%" style="text-align: right; vertical-align: middle; font-size: 12pt;">
                                ' . $currentDate . '
                            </td>
                        </tr>
                    </table>';
    $mpdf->SetHTMLHeader($htmlHeader);

    $mpdf->SetHTMLFooter('');

    // Ambil data siswa dari database
    $siswas = Siswa::orderBy('nama_siswa', 'asc')->get();

    // Loop melalui setiap data siswa
    $i = 0; // Inisialisasi variabel counter baris
    foreach ($siswas as $siswa) {
        // Memulai halaman baru setiap 7 baris data
        if ($i % 7 == 0) {
            $mpdf->AddPage();
            // View PDF untuk setiap halaman baru
        $html = '<h1 style="text-align: center; padding-top: 5rem">Daftar Siswa PKL</h1>';
        $html .= '<table border="1" style="width: 100%; border-collapse: collapse; text-align: center; table-layout: fixed;">
                    <thead style="position: sticky; top: 0; background-color: #0D9276; color: #ffffff; z-index: 100;">
                      <tr style="background-color: #0D9276; color: #ffffff;">
                            <th style="padding: 10px; width: 10%;">Nama Siswa</th>
                            <th style="padding: 10px; width: 10%;">NISN</th>
                            <th style="padding: 10px; width: 10%;">Tempat Lahir</th>
                            <th style="padding: 10px; width: 10%;">Tanggal Lahir</th>
                            <th style="padding: 10px; width: 10%;">Jenis Kelamin</th>
                            <th style="padding: 10px; width: 10%;">Alamat</th>
                            <th style="padding: 10px; width: 10%;">Asal Sekolah</th>
                            <th style="padding: 10px; width: 10%;">Penempatan</th>
                            <th style="padding: 10px; width: 10%;">Tanggal Masuk</th>
                            <th style="padding: 10px; width: 10%;">Tanggal Keluar</th>
                            <th style="padding: 10px; width: 10%;">Telepon</th>
                        </tr>
                    </thead>
                    <tbody>';
    }

    // Tambahkan data ke HTML untuk setiap set
    $html .= '<tr style="background-color: ' . ($i % 2 == 0 ? '#ffffff' : '#ffffff') . ';">
                <td style="padding: 10px; width: 10%;">' . $siswa->nama_siswa . '</td>
                <td style="padding: 10px; width: 10%;">' . $siswa->id_siswa . '</td>
                <td style="padding: 10px; width: 10%;">' . $siswa->tmpt_lahir . '</td>
                <td style="padding: 10px; width: 10%;">' . date('d-m-Y', strtotime($siswa->tgl_lahir)) . '</td>
                <td style="padding: 10px; width: 10%;">' . $siswa->jenis_kelamin . '</td>
                <td style="padding: 10px; width: 10%;">' . $siswa->alamat . '</td>
                <td style="padding: 10px; width: 10%;">' . $siswa->asal_sekolah->nama_sekolah . '</td>
                <td style="padding: 10px; width: 10%;">' . $siswa->penempatan->name . '</td>
                <td style="padding: 10px; width: 10%;">' . date('d-m-Y', strtotime($siswa->tgl_masuk)) . '</td>
                <td style="padding: 10px; width: 10%;">' . date('d-m-Y', strtotime($siswa->tgl_keluar)) . '</td>
                <td style="padding: 10px; width: 10%;">0' . $siswa->no_hp . '</td>
            </tr>';
        $i++;

        // Tambahkan penutup tabel dan reset counter setelah 8 baris data
        if ($i % 7 == 0 || $i == count($siswas)) {
            $html .= '</tbody></table>';
            // Tambahkan HTML ke mPDF
            $mpdf->WriteHTML($html);
        }
    }

    // Output PDF
    $mpdf->Output('Daftar Siswa PKL.pdf', \Mpdf\Output\Destination::INLINE);
}

// public function laporan_pdf()
// {
//     $siswas = Siswa::orderBy('nama_siswa', 'asc')->get();

//          $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']); // Set orientasi ke mode landscape
//         $mpdf->SetTitle('Laporan Siswa');

//         // Menggunakan view() untuk memanggil blade template
//         $html = view('laporan_pdf', compact('siswas'))->render();

//         // Menambahkan HTML ke mPDF
//         $mpdf->WriteHTML($html);

//         // Output laporan PDF
//         $mpdf->Output('laporan_siswa.pdf', 'D');
// }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());


        $this->validate($request, [
            'nama_siswa'=>'required',
            'id_siswa'=>'required|max:10',
            'tmpt_lahir'=>'required',
            'tgl_lahir'=>'required',
            'jenis_kelamin'=>'required',
            'alamat'=>'required',
            'asal_sekolah' => 'required',
            'penempatan' => 'required',
            'tgl_masuk'=>'required',
            'tgl_keluar'=>'required',
            'no_hp'=>'required|string',
            'image'=>'image|mimes:png,jpeg,jpg,svg'
        ]);


        // // -------------Hosting Settings-------------------  // //
        // Jika tidak ada file gambar yang diunggah, gunakan foto default sesuai jenis kelamin
        // if (!$request->hasFile('image')) {
        //     $jenisKelamin = $request->get('jenis_kelamin');
        //     $name = ($jenisKelamin == 'l') ? 'pria.jpeg' : 'wanita.jpeg';
        // } else {
        //     // Jika ada file gambar yang diunggah, proses seperti biasa
        //     $image = $request->file('image');
        //     $name = time() . '.' . $image->getClientOriginalExtension();
        //     $absolutePath = '/home/ptpntest/public_html/image';
        //     $destinationPath = $absolutePath;
        //     $image->move($destinationPath, $name);
        // }

        // // -------------Lokal Host Settings-------------------  // //
        if (!$request->hasFile('image')) {
            $jenisKelamin = $request->get('jenis_kelamin');
            $name = ($jenisKelamin == 'l') ? 'default.png' : 'default2.png';
        } else {
            // Jika ada file gambar yang diunggah, proses seperti biasa
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/image');
            $image->move($destinationPath, $name);
        }


        Siswa::create([
            'nama_siswa' => $request->get('nama_siswa'),
            'id_siswa' => $request->get('id_siswa'),
            'tmpt_lahir' => $request->get('tmpt_lahir'),
            'tgl_lahir' => $request->get('tgl_lahir'),
            'jenis_kelamin' => $request->get('jenis_kelamin'),
            'alamat' => $request->get('alamat'),
            'sekolah_id' => $request->get('asal_sekolah'),
            'penempatan_id' => $request->get('penempatan'),
            'tgl_masuk' => $request->get('tgl_masuk'),
            'tgl_keluar' => $request->get('tgl_keluar'),
            'no_hp' => $request->get('no_hp'),
            'image' => $name
        ]);


        return redirect()->back()->with('message', 'Siswa Berhasil Di Tambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::find($id);
        $asal_sekolahs = Asal_Sekolah::all();
        $penempatans = Penempatan::all();

        return view('siswa.edit', compact('siswa', 'asal_sekolahs', 'penempatans'));
        // return view('siswa.edit', compact('siswas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $this->validate($request, [
            'nama_siswa'=>'required',
            'id_siswa'=>'required|max:10',
            'tmpt_lahir'=>'required',
            'tgl_lahir'=>'required',
            'jenis_kelamin'=>'required',
            'alamat'=>'required',
            'asal_sekolah'=>'required',
            'penempatan'=>'required',
            'tgl_masuk'=>'required|date',
            'tgl_keluar'=>'required',
            'no_hp'=>'required',
            'image'=>'image|mimes:png,jpeg,jpg,svg'
        ]);


        $siswa = Siswa::find($id);
        $name = $siswa->image;
        // // -------------Hosting Settings-------------------  // //
        // if($request->hasFile('image')){
            //     $image = $request->file('image');
            //     $name = time().'.'.$image->getClientOriginalExtension();
            //     $absolutePath = '/home/ptpntest/public_html/image';
            //     $destinationPath = $absolutePath;
            //     $image->move($destinationPath,$name);
            // }

        // // -------------LOCAL HOST Settings-------------------  // //
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/image');
            $image->move($destinationPath,$name);
        }

        $siswa->nama_siswa = $request->get('nama_siswa');
        $siswa->id_siswa = $request->get('id_siswa');
        $siswa->tmpt_lahir = $request->get('tmpt_lahir');
        $siswa->tgl_lahir = $request->get('tgl_lahir');
        $siswa->jenis_kelamin = $request->get('jenis_kelamin');
        $siswa->alamat = $request->get('alamat');
        $siswa->sekolah_id = $request->get('asal_sekolah');
        $siswa->penempatan_id = $request->get('penempatan');
        $siswa->tgl_masuk = $request->get('tgl_masuk');
        $siswa->tgl_keluar = $request->get('tgl_keluar');
        $siswa->no_hp = $request->get('no_hp');
        $siswa->image = $name;
        $siswa->save();

        return redirect()->route('siswa.index')->with('message','Data Siswa Berhasil Di Update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();
        return redirect()->route('siswa.index')->with('message', 'Siswa berhasil dihapus');
    }

    public function listSiswa(){
      $penempatans = Penempatan::with('siswas')->get();
      return view('index', compact('penempatans'));
  }

  public function detailSiswa($id){
    $siswa = Siswa::find($id);
    return view('detail', compact('siswa'));
}

}
