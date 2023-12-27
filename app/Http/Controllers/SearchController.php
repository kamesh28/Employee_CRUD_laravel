<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class SearchController extends Controller
{
    public function index()
{
    return view('search.search'); //Added
}

public function search(Request $request)
{
if($request->ajax())
{
$output="";
$designations=DB::table('employees')->where('designation','LIKE','%'.$request->search."%")->get(); 
if($designations)
{
// This is for search option
foreach ($designations as $key => $designation) {
    $output .= '<tr>'.
        // '<td>'.$designation->id.'</td>'.
        '<td>'.$designation->name.'</td>'.
        '<td>'.$designation->designation.'</td>'.
        '<td>'.$designation->salary.'</td>'.
        '<td>'.
            '<form action="' . route('employees.destroy', $designation->id) . '" method="POST">'.
                '<a class="btn btn-primary" href="' . route('employees.edit', $designation->id) . '">Edit</a>'.
                '<input type="hidden" name="_method" value="DELETE">'.
                csrf_field().
                '<button type="submit" class="btn btn-danger">Delete</button>'.
            '</form>'.
        '</td>'.
    '</tr>';
}

}
return Response($output);
   }
   }
}



