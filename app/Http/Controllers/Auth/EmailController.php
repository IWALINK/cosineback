<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class EmailController extends Controller
{
    public function generateUniqueCode()
    {
        $maxAttempts = 1000; // Adjust as needed

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            // Generate a random 4-digit code
            $code = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

            // Check if code already exists in database
            if (!EmailVerification::where('verification_code', $code)->exists()) {
                return $code;
            }
        }

        throw new \RuntimeException("Failed to generate a unique code after $maxAttempts attempts.");
    }


    public function index($email)
    {
        $code = $this->generateUniqueCode();
        $verif = new EmailVerification();
        $verif->email = $email;
        $verif->verification_code =  $code;
        $verif->verification_code_end =  $this->addMinutes();
        $verif->save();
        return  $code;
    }

    public function addMinutes()
    {
        $minutes_to_add = 30;
        $time = new \DateTime();
        $time->add(new \DateInterval('PT' . $minutes_to_add . 'M'));
        $stamp = $time->format('Y-m-d H:i:s');
        return  $stamp;
    }

    public function sendContactEmail(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string',
            'email' => 'required|email',
            'sujet' => 'required|string',
            'message' => 'required|string',
        ]);
        //
        try {
            Mail::to('Info@iwalink.ch')->queue(new ContactMail($data));

            return response()->json([
                'success' => true,
                'message' => 'Email envoyé avec succès'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi de l\'email: ' . $e->getMessage()
            ], 500);
        }
    }
}
