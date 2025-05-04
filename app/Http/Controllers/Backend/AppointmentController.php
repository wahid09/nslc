<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('appointment-index');
        $appointments = Appointment::all();
        return view('backend.appointment.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('appointment-create');
        return view('backend.appointment.from');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('appointment-create');
        $this->validate($request, [
            'name_bn'=>'required',
            'description_bn'=>'required',
        ]);
        $appointments = Appointment::create([
            'name_bn'=>$request->name_bn,
            'description_bn'=>$request->description_bn,
            'status'=>$request->filled('status')
        ]);
        notify()->success("Appointment Added", "Success");
        return redirect()->route('app.appointments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        Gate::authorize('appointment-update');
        return view('backend.appointment.from', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        Gate::authorize('appointment-update');
        $this->validate($request, [
            'name_bn'=>'required',
            'description_bn'=>'required',
        ]);
        $appointment->update([
            'name_bn'=>$request->name_bn,
            'description_bn'=>$request->description_bn,
            'status'=>$request->filled('status')
        ]);
        notify()->success("Appointment Update", "Success");
        return redirect()->route('app.appointments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        Gate::authorize('appointment-delete');
        $appointment->delete();
        notify()->success("Appointment Delete", "Success");
        return redirect()->route('app.appointments.index');
    }
}
