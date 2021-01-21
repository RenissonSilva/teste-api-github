<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function welcome() {
        $response = Http::get('https://api.github.com/users/renissonsilva/events/public');
        $response = $response->json();
        $contador = 0;

        foreach($response as $res){
            if($res['type'] == 'PushEvent' && Carbon::parse($res['created_at'])->sub('3 hours')->isToday()){
                $contador++;
            }
        }

        return view('welcome',compact('contador'));
    }
}
