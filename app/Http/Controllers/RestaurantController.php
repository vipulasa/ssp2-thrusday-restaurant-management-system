<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    public function index()
    {
        return view('admin.restaurants.index', [
            'restaurants' => Restaurant::paginate()
        ]);
    }

    public function create()
    {
        return view('admin.restaurants.form', [
            'restaurant' => new Restaurant(),
            'cuisines' => (new Cuisine())->all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:restaurants,slug',
            'description' => 'nullable',
            'email' => 'required|email|unique:restaurants,email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'cuisine' => 'required',
            'opening_hours' => 'required'
        ]);

        // change status to bool
        $request->status = $request->status === 'on';

        // create the restaurant
        $restaurant = (new Restaurant())->create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'cuisine' => $request->cuisine,
            'opening_hours' => json_decode($request->opening_hours),
            'status' => $request->status
        ]);

        // add the logo
        if ($request->hasFile('logo')) {
            $restaurant->addMedia($request->file('logo'))->toMediaCollection('logo');
        }

        // add the gallery
        if ($request->has('gallery')) {
            // loo through the gallery
            foreach ($request->file('gallery') as $file) {
                $restaurant->addMedia($file)->toMediaCollection('gallery');
            }
        }

        return redirect()->route('admin.restaurants.index');
    }

    public function show($id)
    {
        return view('admin.restaurants.show', [
            'restaurant' => Restaurant::findOrFail($id)
        ]);
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
