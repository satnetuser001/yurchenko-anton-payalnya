<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\User;
use App\Services\WeatherWithCacheService;

class UserController extends Controller
{
    /**
     * Display a listing of clients.
     */
    public function index()
    {
        $context = User::paginate(15);
        return view('index', ['context' => $context]);
    }

    /**
     * Show the form for creating a client.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created client in the database.
     */
    public function store(StoreUpdateUserRequest $request)
    {
        //used Form Request for data validation
        $user = User::create([
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'email'=>$request->email,
            'password' => bcrypt($request->password),
            'phone_number'=>$request->phone_number,
            'status'=>$request->status,
            'city'=>$request->city,
        ]);
        return redirect()->route('user.show', ['user' => $user->id]);
    }

    /**
     * Display detailed information about the client.
     */
    public function show(User $user)
    {
        $weather = new WeatherWithCacheService();
        $weather = $weather->get($user->city);
        return view('show', ['user' => $user, 'weather' => $weather]);
    }

    /**
     * Show the form for editing the client.
     */
    public function edit(User $user)
    {
        return view('edit', ['user' => $user]);
    }

    /**
     * Update the client in the database.
     */
    public function update(StoreUpdateUserRequest $request, User $user)
    {
        //used Form Request for data validation
        $user->fill([
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'status'=>$request->status,
            'city'=>$request->city,
        ]);
        $user->save();
        return redirect()->route('user.show', ['user' => $user->id]);
    }

    /**
     * Remove the client from the database.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}
