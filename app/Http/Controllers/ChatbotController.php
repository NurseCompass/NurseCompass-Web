<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('study-assistant');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        try {
            $response = Http::timeout(60)->post('http://127.0.0.1:5001/api/chat', [
                'user_message' => $request->message
            ]);

            if ($response->successful()) {
                return response()->json([
                    'reply' => $response->json()['reply']
                ]);
            } else {
                return response()->json([
                    'reply' => 'AI Server Error: Python responded with status ' . $response->status()
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'reply' => 'Connection Error Details: ' . $e->getMessage()
            ], 500);
        }
    }
}