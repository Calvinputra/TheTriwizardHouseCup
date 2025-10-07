<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class MainController extends Controller
{
    public function index()
    {
        // (opsional) kalau sudah login, langsung ke home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $houses = [
            ['name' => 'Gryffindor', 'desc' => 'Keberanian & Kepemimpinan', 'ring' => 'ring-rose-400/40',   'bg' => 'from-rose-500/25'],
            ['name' => 'Slytherin',  'desc' => 'Ambisi & Kecerdikan',       'ring' => 'ring-emerald-400/40', 'bg' => 'from-emerald-500/25'],
            ['name' => 'Ravenclaw',  'desc' => 'Kebijaksanaan & Kreativitas', 'ring' => 'ring-sky-400/40',  'bg' => 'from-sky-500/25'],
            ['name' => 'Hufflepuff', 'desc' => 'Loyalitas & Kerja Keras',   'ring' => 'ring-amber-400/40', 'bg' => 'from-amber-500/25'],
        ];
        $skills = ['Dueling', 'Charms', 'Potions', 'Quidditch'];

        return view('welcome', compact('houses', 'skills'));
    }

    public function home()
    {
        $houses = [
            ['name' => 'Gryffindor', 'desc' => 'Keberanian & Kepemimpinan', 'ring' => 'ring-rose-400/40',   'bg' => 'from-rose-500/25'],
            ['name' => 'Slytherin',  'desc' => 'Ambisi & Kecerdikan',       'ring' => 'ring-emerald-400/40', 'bg' => 'from-emerald-500/25'],
            ['name' => 'Ravenclaw',  'desc' => 'Kebijaksanaan & Kreativitas', 'ring' => 'ring-sky-400/40',  'bg' => 'from-sky-500/25'],
            ['name' => 'Hufflepuff', 'desc' => 'Loyalitas & Kerja Keras',   'ring' => 'ring-amber-400/40', 'bg' => 'from-amber-500/25'],
        ];
        $skills = ['Dueling', 'Charms', 'Potions', 'Quidditch'];
        $waLink = "https://chat.whatsapp.com/J7IrHuSPeTe45HAGKiC0Xu";
        return view('home', compact('houses', 'skills', 'waLink'));
    }

    public function login()
    {
        $houses = [
            ['name' => 'Gryffindor', 'desc' => 'Keberanian & Kepemimpinan', 'ring' => 'ring-rose-400/40',   'bg' => 'from-rose-500/25'],
            ['name' => 'Slytherin',  'desc' => 'Ambisi & Kecerdikan',       'ring' => 'ring-emerald-400/40', 'bg' => 'from-emerald-500/25'],
            ['name' => 'Ravenclaw',  'desc' => 'Kebijaksanaan & Kreativitas', 'ring' => 'ring-sky-400/40',  'bg' => 'from-sky-500/25'],
            ['name' => 'Hufflepuff', 'desc' => 'Loyalitas & Kerja Keras',   'ring' => 'ring-amber-400/40', 'bg' => 'from-amber-500/25'],
        ];
        $skills = ['Dueling', 'Charms', 'Potions', 'Quidditch'];

        return view('login', compact('houses', 'skills'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:100',
            'nickname'   => 'required|string|max:50',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|regex:/^08[0-9]{6,}$/|max:15',
            'age'        => 'required|integer|min:11|max:30',
            'motivation' => 'nullable|string|max:500',
            'consent'    => 'accepted',
        ], [
            'phone.regex'  => 'Nomor telepon harus diawali 08 dan hanya angka.',
            'email.unique' => 'Email ini sudah terdaftar.',
        ]);

        $userId = DB::table('users')->insertGetId([
            'name'       => $validated['name'],
            'nickname'   => $validated['nickname'],
            'email'      => $validated['email'],
            'phone'      => $validated['phone'],
            'age'        => $validated['age'],
            'motivation' => $validated['motivation'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Auth::loginUsingId($userId);

        return redirect()->route('home')->with('success', 'Pendaftaran berhasil! Tiket kamu sudah aktif.');
    }

    public function signin(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);
        $remember = (bool) $request->boolean('remember');

        if (Schema::hasColumn('users', 'password')) {
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $remember)) {
                $request->session()->regenerate();
                return redirect()->route('home');
            }
            if ($data['password'] === '123') {
                $user = DB::table('users')->where('email', $data['email'])->first();
                if ($user) {
                    Auth::loginUsingId($user->id, $remember);
                    $request->session()->regenerate();
                    return redirect()->route('home');
                }
            }

            return back()
                ->withErrors(['email' => 'Kredensial tidak cocok.'])
                ->onlyInput('email');
        }

        if ($data['password'] !== '123') {
            return back()
                ->withErrors(['password' => 'Password salah. Gunakan 123 untuk login'])
                ->onlyInput('email');
        }

        $user = DB::table('users')->where('email', $data['email'])->first();
        if (!$user) {
            return back()
                ->withErrors(['email' => 'Email belum terdaftar. Silakan daftar terlebih dahulu.'])
                ->onlyInput('email');
        }

        Auth::loginUsingId($user->id, $remember);
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout. Sampai jumpa di Hogwarts!');
    }
}
