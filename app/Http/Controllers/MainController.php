<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller{

    public function index(){
        $houses = [
            ['name' => 'Gryffindor', 'desc' => 'Keberanian & Kepemimpinan', 'ring' => 'ring-rose-400/40',   'bg' => 'from-rose-500/25'],
            ['name' => 'Slytherin',  'desc' => 'Ambisi & Kecerdikan',       'ring' => 'ring-emerald-400/40', 'bg' => 'from-emerald-500/25'],
            ['name' => 'Ravenclaw',  'desc' => 'Kebijaksanaan & Kreativitas', 'ring' => 'ring-sky-400/40',  'bg' => 'from-sky-500/25'],
            ['name' => 'Hufflepuff', 'desc' => 'Loyalitas & Kerja Keras',   'ring' => 'ring-amber-400/40', 'bg' => 'from-amber-500/25'],
        ];
        $skills = ['Dueling','Charms','Potions','Quidditch'];

        return view('welcome', [
            'houses' => $houses,
            'skills' => $skills,
        ]);
    }

    public function login(){

    }

    public function register() {

    }
    

}