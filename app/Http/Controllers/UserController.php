<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountUser;
use Dompdf\Dompdf;
use HTML2PDF;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController
{
    public function login(Request $request)
    {
        $request->validate(['email' => 'required|string', 'password' => 'required|string']);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role == "siswa") {
                return redirect('/dashboardpeserta')->with('success', 'Berhasil Login');
            }
            if ($user->role == "admin") {
                return redirect('/dashboardadmin')->with('success', 'Berhasil Login');
            }
        }
        Auth::logout();
        return redirect()->back()->withErrors(['email' => 'Gagal login, Email atau password Anda salah.']);
    }

    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the user's session
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation attacks
        $request->session()->regenerateToken();

        // Redirect the user to the login page (or any other page)
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }

    public function detailpeserta(Request $request)
    {
        $user = Auth::user();
        $provinces = DB::select('SELECT * FROM provinces');
        $cities = DB::select('SELECT * FROM cities');
        $agamas = DB::select('SELECT * FROM agama');
        return view('peserta.detail', compact('user', 'provinces', 'cities', 'agamas'));
    }


    // public function generatePDF($user_id)
    // {
    //     // Ambil data pengguna berdasarkan ID
    //     $account = AccountUser::findOrFail($user_id);

    //     // Buat view untuk PDF
    //     $pdfContent = view('peserta.formpendaftaran', compact('account'))->render();

    //     // Inisialisasi Html2Pdf
    //     $pdf = new Html2Pdf();

    //     // Set konten HTML ke Html2Pdf
    //     $pdf->writeHTML($pdfContent);

    //     // Simpan PDF ke file (Opsional, jika Anda ingin menyimpannya di server)
    //     $filePath = storage_path('app/public/user_' . $user_id . '.pdf');
    //     $pdf->output($filePath, 'F');

    //     // Atau, kirim PDF sebagai response untuk download
    //     $pdfContent = $pdf->output('', 'S');
    //     return Response::make($pdfContent, 200, [
    //         'Content-Type' => 'application/pdf',
    //         'Content-Disposition' => 'attachment; filename="formpendaftaran_' . $user_id . '.pdf"',
    //     ]);
    // }
    // public function generatePDF($user_id)
    // {
    //     $account = AccountUser::find($user_id);

    //     // Prepare data for the PDF
    //     $data = [
    //         'title' => 'Data Peserta Pendaftaran',
    //         'account' => $account,
    //         // Add other data you want to pass to the view here
    //     ];

    //     // Load the view with data
    //     $html = view('pdf.document', $data)->render();

    //     // Instantiate Dompdf
    //     $dompdf = new Dompdf();

    //     $dompdf->loadHtml($html);   

    //     // Set paper size and orientation
    //     $dompdf->setPaper('A4', 'portrait');

    //     // Render the PDF
    //     $dompdf->render();

    //     // Output the generated PDF to Browser
    //     return $dompdf->stream('document.pdf');
    // }
}
