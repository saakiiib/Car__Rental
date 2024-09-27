<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function rentals()
    {
        return view('frontend.rentals');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $brand = $request->input('brand');
        $model = $request->input('model');
    
        $cars = Car::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('brand', 'like', "%{$search}%")
                ->orWhere('model', 'like', "%{$search}%");
        })
        ->when($brand, function ($query) use ($brand) {
            $query->where('brand', $brand);
        })
        ->when($model, function ($query) use ($model) {
            $query->where('model', $model);
        })
        ->paginate(10);
    
        return view('frontend.index', compact('cars'));
    }

    public function dashboard()
    {
        if (Auth::check()) {
            $user = auth()->user();

            if ($user->is_type == '1') {
                return redirect()->route('admin.dashboard');
            }else {
                return redirect()->route('user.dashboard');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
