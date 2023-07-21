<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Employee::paginate(10);
        return view('backend.employee.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('backend.employee.create',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'selectCompany' => 'required',
            'lastname' => 'required',
            'firstname' => 'required'
        ]);
        $employee = new Employee;
        $employee->first_name =$request->firstname;
        $employee->last_name =$request->lastname;
        $employee->company_id =$request->selectCompany;
        $employee->email =$request->emailAddress;
        $employee->phone =$request->phone;
        $employee->save();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $data = $employee;
        $companies = Company::all();
        return view('backend.employee.edit',compact('data','companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'selectCompany' => 'required',
            'lastname' => 'required',
            'firstname' => 'required'
        ]);
        $employee = Employee::where('id',$employee->id)->first();
        $employee->first_name =$request->firstname;
        $employee->last_name =$request->lastname;
        $employee->company_id =$request->selectCompany;
        $employee->email =$request->emailAddress;
        $employee->phone =$request->phone;
        $employee->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        Employee::find($employee->id)->delete();
        return back();
    }
}
