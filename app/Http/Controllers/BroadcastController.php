<?php

namespace App\Http\Controllers;

use App\Models\Identitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BroadcastController extends Controller
{
    public function index()
    {
        $anggota = Identitas::with('user')->whereNotNull('no_whatsapp')->get();
        return view('broadcast.form', compact('anggota'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'selected_numbers' => 'required|array',
        ]);

        foreach ($request->selected_numbers as $phone) {
            $this->sendWA($phone, $request->message);
        }

        return back()->with('success', 'Pesan broadcast berhasil dikirim!');
    }
    private function sendWA($phone, $message)
    {
        $token = env('FONNTE_API_TOKEN');
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/send', [
            'target' => $phone,
            'message' => $message,
            'countryCode' => '62', // opsional
        ]);

        if ($response->failed()) {
            logger("Gagal mengirim pesan ke $phone: {$response->body()}");
        }
    }

    private function formatPhone($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (substr($phone, 0, 1) === '0') {
            return '62' . substr($phone, 1);
        }
        return $phone;
    }
}
