<?php
  
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
  
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
        return view('admin.dashboard');
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