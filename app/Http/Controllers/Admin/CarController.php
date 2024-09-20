<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('admin.car.index', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'car_type' => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric|min:0',
            'availability' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $car = new Car();
        $car->name = $request->name;
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->car_type = $request->car_type;
        $car->daily_rent_price = $request->daily_rent_price;
        $car->availability = $request->availability;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $randomFileName = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            $imageName = $randomFileName . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/car'), $imageName);
            $car->image = '/images/car/' . $imageName;
        }

        $car->save();

        return response()->json(['status' => 300, 'message' => 'Car created successfully!']);
    }

    public function edit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = Car::where($where)->get()->first();
        return response()->json($info);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'car_type' => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric|min:0',
            'availability' => 'required|boolean',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $car = Car::find($request->codeid);
        $car->name = $request->name;
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->car_type = $request->car_type;
        $car->daily_rent_price = $request->daily_rent_price;
        $car->availability = $request->availability;

        if ($request->hasFile('image')) {
            if ($car->image) {
                $oldImagePath = public_path($car->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $randomFileName = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            $imageName = $randomFileName . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/car'), $imageName);
            $car->image = '/images/car/' . $imageName;
        }

        $car->save();

        return response()->json(['status' => 300, 'message' => 'Car updated successfully!']);
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        if ($car->image) {
            $oldImagePath = public_path($car->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $car->delete();

        return response()->json(['status' => 303, 'message' => 'Car deleted successfully!']);
    }



}
