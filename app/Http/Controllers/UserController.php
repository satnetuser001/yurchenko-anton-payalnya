<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $context = User::paginate(15);
        return view('index', ['context' => $context]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateUserRequest $request)
    {
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
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    //public function update(Request $request, User $user)
    public function update(StoreUpdateUserRequest $request, User $user)
    {
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
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}
