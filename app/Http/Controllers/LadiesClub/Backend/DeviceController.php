<?php

namespace App\Http\Controllers\LadiesClub\Backend;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    public function index(){
        $devices = DB::table('devices')
            ->select('id', 'device_name', 'device_number', 'device_ip', 'status')->get();
        return view('backend.device.index', [
            'devices' => $devices
        ]);
    }
    public function create(){
        return view('backend.device.form');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'device_name' => 'required|string|max:255',
            'device_number' => 'required',
            'device_ip' => 'required',
            'status' => 'nullable'
        ]);

        // If validation passes, the code below will execute
        Device::create([
            'device_name' => $request->get('device_name'),
            'device_number' => $request->get('device_number'),
            'device_ip' => $request->get('device_ip'),
            'status' => ($request->get('device_name')) ? 1 : 0,
        ]);

        return redirect()->route('app.device.index')->with('success', 'User created successfully!');
    }
    public function edit($id){
        $device = Device::findOrfail($id);
        return view('backend.device.form', [
            'device' => $device
        ]);
    }
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'device_name' => 'required|string|max:255',
            'device_number' => 'required',
            'device_ip' => 'required',
            'status' => 'nullable'
        ]);

        $device = Device::findOrfail($id);
        $device->update([
            'device_name' => $request->get('device_name'),
            'device_number' => $request->get('device_number'),
            'device_ip' => $request->get('device_ip'),
            'status' => ($request->get('device_name')) ? 1 : 0,
        ]);

        return redirect()->route('app.device.index')->with('success', 'User created successfully!');
    }

}
