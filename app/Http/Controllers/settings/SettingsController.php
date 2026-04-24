<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\settings\UpdatePasswordRequest;
use App\Http\Requests\settings\UpdateSystemRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('settings.settings');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        Alert::toast('Password berhasil diperbarui.', 'success');
        return back()->with('active_tab', 'keamanan');
    }

    public function updateSystem(UpdateSystemRequest $request)
    {
        Setting::updateOrCreate(
            ['key' => 'app_name'],
            ['value' => $request->app_name]
        );

        Alert::toast('Preferensi sistem berhasil disimpan.', 'success');
        return back()->with('active_tab', 'sistem');
    }
}
