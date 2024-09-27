<?php
  
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Car;
use App\Models\Rental;
  
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userHome(): View
    {
        return view('user.dashboard');
    } 
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        $totalCars = Car::count();
        $totalAvailableCars = Car::where('availability', '1')->count();
        $totalRentals = Rental::count();
        $totalUsers = User::count();
        $totalEarnings = Rental::sum('total_cost');
        $activeRentals = Rental::where('is_cancelled', 0)
                       ->where('start_date', '<=', now())
                       ->where('end_date', '>=', now())
                       ->count();
        $canceledRentals = Rental::where('is_cancelled', 1)->count();
        $currentMonthEarnings = Rental::whereMonth('start_date', now()->month)
                              ->whereYear('start_date', now()->year)
                              ->sum('total_cost');
        $mostPopularCar = Car::withCount('rentals')
                            ->orderBy('rentals_count', 'desc')
                            ->first();
        $upcomingRentals = Rental::where('start_date', '>', now())
                            ->where('start_date', '<=', now()->addDays(7))
                            ->count();                                     
        return view('admin.dashboard', compact('totalCars', 'totalAvailableCars', 'totalRentals', 'totalUsers', 'totalEarnings', 'activeRentals', 'canceledRentals', 'currentMonthEarnings', 'mostPopularCar', 'upcomingRentals'));
    }

    public function userProfile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
            'address' => 'nullable|string',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        
        $user->address = $request->input('address');
        $user->save();

        return redirect()->back()->with('status', 'User updated successfully!');
    }
  
}