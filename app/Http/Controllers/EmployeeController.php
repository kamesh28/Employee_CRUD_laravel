<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\View;
class EmployeeController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
{
    $this->middleware('auth')->only(['index']); // This is for restrict to access in the url
}

   
    public function index(Request $request)
    {
        //Filter
     $query = Employee::query();  
    

    // Check if the 'designation' filter is provided in the request
     if ($request->filled('designation')) {
        $designation = $request->input('designation');
        $query->where('designation', $designation);
        if ($designation !== 'All Designations') {
        $query->where('designation', $designation);
         //$query->where('designation', 'like', "%$designation%");
        }
     }
     $designations = Employee::pluck('designation')->unique(); //Filter
 




     
 //Pagination as per your request
 $perPage = request('perPage', 10);
 $page = request('page', 1);

 $offset = ($page - 1) * $perPage;

 $employees = DB::table('employees')
      // Change this based on your sorting needs ->orderBy('name')
    ->offset($offset)
     ->limit($perPage)
    ->get();

     $totalRecords = DB::table('employees')->count();

     $employees = $query->sortable()->paginate($perPage); // pagination  
       
    
    return view('employees.index', compact('employees','perPage','totalRecords','offset','designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
{
    // Validate the request data
    $validated = $request->validate([
        'name' => 'required|unique:employees|max:255',
        'designation' => 'required|string|max:255',
        'salary' => 'required|numeric',
        'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'pan' => 'required|string|max:255',
        'aadhar' => 'required|numeric',
        'email' => 'required|email|unique:employees'
    ]);

    // Create a new Employee instance
    $employee = new Employee;

    // Assign values to the model properties
    $employee->name = $request->name;
    $employee->designation = $request->designation;
    $employee->salary = $request->salary;
    $employee->mobile = $request->mobile;
    $employee->pan = $request->pan;
    $employee->aadhar = $request->aadhar;
    $employee->email = $request->email;


    // Save the employee to the database
    $employee->save();

    // Return a JSON response with the created employee data
    return response()->json([
        'success' => true,
        'message' => 'Employee has been created successfully.',
        'employee' => $employee
    ]);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show',compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit_modal',compact('employee'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    
public function update(Request $request, $id)
{
    // Validate and update the employee data
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'designation' => 'required|max:255',
        'salary' => 'required|numeric',
    ]);

    $employee = Employee::findOrFail($id);
    $employee->update($validatedData);
   
       
    return response()->json([
        'success' => true,
        'message' => 'Updated successfully.',
        'employee' => $employee,
    ]);
    
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    

public function destroy($id)
{
    // Find the employee
    $employee = Employee::find($id);

    if (!$employee) {
        return response()->json(['success' => false, 'error' => 'Employee not found'], 404);
    }

    // Delete the employee
    $employee->delete();

    return response()->json(['success' => true, 'message' => 'Employee deleted successfully!!!']);
}
}

