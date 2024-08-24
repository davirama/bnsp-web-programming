<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PesertaController
{
    public function dashboardpeserta(Request $request)
    {
        $user = Auth::user();
        return view('peserta.dashboard', compact('user'));
    }
    public function formpendaftaran()
    {
        $user = Auth::user();
        $provinces = DB::select('SELECT * FROM provinces');
        $cities = DB::select('SELECT * FROM cities');
        $agamas = DB::select('SELECT * FROM agama');
        return view('peserta.formpendaftaran', compact('user', 'provinces', 'cities', 'agamas'));
    }

    public function updateDataPendaftaran(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'address_ktp' => 'required|string',
            'address_now' => 'required|string',
            'kecamatan' => 'required|string|max:50',
            'province_id' => 'required|string|max:10',
            'city_id' => 'required|string|max:10',
            'telp_number' => 'required|string|max:20',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'tgl_lahir' => 'required|date',
            'kewarganegaraan' => 'required|string',
            'nama_kewarganegaraan' => 'nullable|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'province_id_lahir' => 'string|max:10',
            'city_id_lahir' => 'string|max:10',
            'negara_lahir' => 'nullable|string|max:255',
            'jenis_kelamin' => 'required|string',
            'status_menikah' => 'required|string',
            'agama_id' => 'required|string|max:10',
            'foto' => 'mimes:jpg,jpeg,png|max:2048',
            'video' => 'mimes:mp4,avi,mov|max:20480',
        ]);

        // Mendapatkan ID pengguna yang sedang login
        $user_id = Auth::user()->user_id;

        // Mendapatkan data pengguna berdasarkan ID, atau gagal jika tidak ditemukan
        $accountUser = AccountUser::where('user_id', $user_id)->firstOrFail();

        // Initialize data array
        $data = [
            'nama_lengkap' => $request->input('nama_lengkap'),
            'address_ktp' => $request->input('address_ktp'),
            'address_now' => $request->input('address_now'),
            'kecamatan' => $request->input('kecamatan'),
            'province_id' => $request->input('province_id'),
            'city_id' => $request->input('city_id'),
            'telp_number' => $request->input('telp_number'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'kewarganegaraan' => $request->input('kewarganegaraan'),
            'agama_id' => $request->input('agama_id'),
            'status_daftar' => 'Menunggu Validasi Admin',
            'message_status_daftar' => 'Data Anda Segera Divalidasi Admin',
        ];

        // Check the value of kewarganegaraan
        $kewarganegaraan = $request->input('kewarganegaraan');

        // dd($kewarganegaraan);

        // Check the value of kewarganegaraan
        $kewarganegaraan = $request->input('kewarganegaraan');

        // Check the value of kewarganegaraan
        $kewarganegaraan = $request->input('kewarganegaraan');

        if ($kewarganegaraan === 'wna') {
            $data['nama_kewarganegaraan'] = $request->input('nama_kewarganegaraan');
            $data['negara_lahir'] = $request->input('negara_lahir');
            $data['tempat_lahir'] = null; // Use null to allow database to handle it
            $data['province_id_lahir'] = null; // Use null to allow database to handle it
            $data['city_id_lahir'] = null; // Use null to allow database to handle it
        } else {
            $data['nama_kewarganegaraan'] = null;
            $data['negara_lahir'] = null;
            $data['tempat_lahir'] = $request->input('tempat_lahir');
            $data['province_id_lahir'] = $request->input('province_id_lahir');
            $data['city_id_lahir'] = $request->input('city_id_lahir');
        }

        // Handle file uploads
        if ($request->hasFile('foto')) {
            // Get old photo file name
            $oldFoto = $accountUser->foto;

            // Remove old photo file if it exists
            if ($oldFoto && Storage::exists('public/foto/' . $oldFoto)) {
                Storage::delete('public/foto/' . $oldFoto);
            }

            // Store new photo file
            $file = $request->file('foto');
            $filename = time() . '-' . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto', $filename);
            $data['foto'] = $filename;
        }

        if ($request->hasFile('video')) {
            // Get old video file name
            $oldVideo = $accountUser->video;

            // Remove old video file if it exists
            if ($oldVideo && Storage::exists('public/video/' . $oldVideo)) {
                Storage::delete('public/video/' . $oldVideo);
            }

            // Store new video file
            $file = $request->file('video');
            $filename = time() . '-' . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/video', $filename);
            $data['video'] = $filename;
        }

        // Update the account user
        $accountUser->update($data);

        return redirect('/dashboardpeserta')->with('success', 'Data updated successfully');
    }
}
