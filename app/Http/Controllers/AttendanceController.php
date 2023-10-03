<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => [
                'required',
                Rule::in(['present', 'absent']),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->route('attendance.index')
            ->withErrors($validator)
                ->withInput();
        }

        // Create a new attendance record
        $attendance = new Attendance();
        $attendance->user_id = auth()->user()->id; // Assuming you have user authentication
        $attendance->date = now(); // Set the date to the current date
        $attendance->status = $request->input('status');
        $attendance->save();

        return redirect()->route('attendance.index')
        ->with('success', 'Attendance marked successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
