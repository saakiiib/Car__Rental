<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;

class FrontendController extends Controller
{

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
