<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index()
    {
        return view('index');
    }

    // public function submit(Request $request)
    // {
    //     $userInput = $request->input('userInput');
    //     // Use ChatGPT to generate a response
    //     $answer = chatgpt($userInput);
    //     return view('index', ['response' => $answer]);
    // }

    public function submit(Request $request)
    {
        $userInput = $request->input('userInput');

        // Customize the prompt to suit your needs, incorporating user input
        $prompt = "Customer review: $userInput\nReply:";

        // Use ChatGPT to generate a response
        $answer = $this->chatgpt($prompt);

        return view('index', ['response' => $answer]);
    }

    private function chatgpt($prompt)
    {
        // Use your custom ChatGPT function to generate a response
        $fullAnswer = chatgpt($prompt);

        // Limit the response to 100 words or less
        $answer = $this->truncateWords($fullAnswer, 50);

        return $answer;
    }

    private function truncateWords($text, $maxWords)
    {
        $words = explode(' ', $text);
        $truncatedWords = array_slice($words, 0, $maxWords);
        $truncatedText = implode(' ', $truncatedWords);

        return $truncatedText;
    }







}
