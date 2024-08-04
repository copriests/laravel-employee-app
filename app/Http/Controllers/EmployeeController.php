<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{

    protected $employee;

    public function __construct(){
        $this->employee = new Employee();
    }


    public function index()
    {
       $response ['employees'] = $this->employee ->all();
       return view ('pages.index')->with($response);
    }


   
    public function store(Request $request)
    {
        //dd($request->all());

        $this->employee->create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response['employee']= $this->employee->find($id);
        return view('pages.edit')->with($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = $this->employee->find($id);
        
        $employee->update(array_merge($employee->toArray(), $request->toArray()));
        return redirect('employee');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the employee by ID
        $employee = $this->employee->find($id);

        // Check if employee exists
     if (!$employee) {
        return redirect('employee')->with('error', 'Employee not found.');
     }

        // Delete the employee
        $employee->delete();

        // Redirect to the employee list with a success message
        return redirect('employee')->with('success', 'Employee deleted successfully.');
    }
}