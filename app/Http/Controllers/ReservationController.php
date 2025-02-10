<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $this->authorize('isClient');
        // ...existing code...
    }

    public function store(Request $request)
    {
        $this->authorize('isClient');
        // ...existing code...
    }
}
