<?php

namespace App\Http\Controllers;

use App\Http\Resources\Person\PersonCollection;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PersonCollection(Person::with(['users.admins', 'owners'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $people)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $people)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $people)
    {
        //
    }
}
