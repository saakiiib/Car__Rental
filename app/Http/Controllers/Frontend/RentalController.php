<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Rental;
use App\Mail\RentalDetailsToCustomer;
use App\Mail\RentalDetailsToAdmin;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class RentalController extends Controller
{
    public function rent($car_id)
    {
        if (!auth()->check()) {
            session()->put('url.intended', url()->previous());
            return redirect()->route('login');
        }

        $car = Car::findOrFail($car_id);
        return view('frontend.rent', compact('car'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::findOrFail($request->car_id);
        $dailyRentPrice = $car->daily_rent_price;

        $totalCost = $dailyRentPrice * (strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24);

        $rental = Rental::create([
                'user_id' => auth()->id(),
                'car_id' => $request->car_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'total_cost' => $totalCost,
            ]);

        Mail::to(auth()->user()->email)->send(new RentalDetailsToCustomer($rental));

        $adminEmail = User::where('is_type', 1)->first()->email;
        Mail::to($adminEmail)->send(new RentalDetailsToAdmin($rental));

        return redirect()->route('homepage')->with('success', 'Car rented successfully!');
    }

    public function index()
    {
        $rentals = Rental::where('user_id', auth()->id())->get();
        return view('frontend.rentals', compact('rentals'));
    }

    public function cancel($id)
    {
        $rental = Rental::findOrFail($id);
        $rental->is_cancelled = 1;
        $rental->save();
        return redirect()->back()->with('success', 'Rental cancelled successfully!');
    }
}
