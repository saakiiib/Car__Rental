<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::all();
        return view('admin.rental.index', compact('rentals'));
    }
}
