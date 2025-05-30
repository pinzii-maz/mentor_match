<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function redirectToDashboard()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        switch ($user->role) {
            case 'mentor':
                return redirect()->route('mentor.dashboard');
            case 'mentee':
                return redirect()->route('mentee.dashboard');
            default:
                abort(403, 'Unauthorized role');
        }
    }
}