<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Company::paginate(10);
        return view('backend.company.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'companyName' => 'required',
            'companyLogo' => 'dimensions:min_width=100,min_height=100|mimes:jpg,jpeg,png',
            'companyEmail' => 'required|regex:/(.+)@(.+)\.(.+)/i'
        ]);
        $name =$request->companyName;
        if(!is_null($request->companyEmail)){
            Mail::to($request->companyEmail)->send(new MyTestEmail());
        }
        $company = new Company;
        $company->name =$request->companyName;
        $company->email =$request->companyEmail;
        if($request->hasFile('companyLogo')){
            $image = $request->file('companyLogo');
            $filename = time().mt_rand(10,10000).'.'.$image->getClientOriginalExtension();
            Storage::disk('public')->put('companyLogo/'.$filename, File::get($image));
            $company->logo =$filename;
        }
        $company->save();
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $data = $company;
        return view('backend.company.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'companyName' => 'required',
            'companyLogo' => 'dimensions:min_width=100,min_height=100|mimes:jpg,jpeg,png',
            'companyEmail' => 'required|regex:/(.+)@(.+)\.(.+)/i'
        ]);
        $company = Company::where('id',$company->id)->first();
        $company->name = $request->companyName;
        $company->email = $request->companyEmail;
        if($request->hasFile('companyLogo')){
            $image = $request->file('companyLogo');
            $filename = time().mt_rand(10,10000).'.'.$image->getClientOriginalExtension();
            Storage::disk('public')->put($filename, File::get($image));
            $company->logo = $filename;
        }
        $company->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $exist = Employee::where('company_id',$company->id)->first();
        if(is_null($exist)){
            Company::find($company->id)->delete();
        }
        return back();
    }
}
