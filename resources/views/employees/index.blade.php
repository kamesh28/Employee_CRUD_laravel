
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/additional-methods.min.js')}}"></script>
    
 <!-- Include other scripts if needed -->
 
</head>
<style>
    /* Add the error and valid styles here if you don't have them in a separate CSS file */
    .error {
        color: red;
    }

    /* Additional styles for error messages if needed */
    .error-message {
        font-size: 12px;
    }

    .error-highlight {
    border: 1px solid red;
    }

    .valid {
    border: 2x solid green;
    }
</style>
<body>
    <div class="container mt-2">
        <div class="column">
            <div class="col-lg-6 margin-tb">
                <div class="pull-left">
                    <h2>Employee Details</h2>
                </div>
                <div style="text-align:left; margin-top:10%">
                    <button id="btnShow" class="btn btn-success">Create Employee</button>
                 </div>
            </div>
            <!-- Logout -->
            <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
          <!-- <a class="navbar-brand" href="#">User Sign Up/Login Form</a> -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                @guest
                <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                @else    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            >Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                        </ul>
                    </li>
                @endguest
            </ul>
          </div>
        </div>
    </nav> 
             <!-- End -->
            
            <!-- Create Employee Modal -->

              <form id="employeeForm" action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="SampleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <h4 class="modal-title" id="myModalLabel">Add Employee Details</h4>
                    </div>
                <!-- <div class="modal-title">Add Employee</div> -->
                <div class="modal-body">
                    
                        <strong>Employee Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Employee Name" required>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1" id ="errorMessages">{{ $message }}</div>
                        @enderror
                   </div>
                <div class="modal-body">
                   
                        <strong>Employee Designation:</strong>
                        <input type="text" name="designation" class="form-control" placeholder="Designation">
                        @error('designation')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    
                </div>
                <div class="modal-body">
                    
                        <strong>Salary:</strong>
                        <input type="number" name="salary" class="form-control" placeholder="Salary">
                        @error('salary')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    
                </div>
                <div class="modal-body">
                <strong>Mobile No:</strong>
                <input type="text" name="mobile" class="form-control"  placeholder="Mobile Number" id ="fieldSelectorId" pattern="[6-9]{1}[0-9]{9}" >
                <!-- <p style="color:red;">Please enter 10 digit mobile number*</p> -->
                @error('mobile')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
                </div>

                <div class="modal-body">
                <strong>PAN No:</strong>
                <input type="text" name="pan" class="form-control" placeholder="PAN Number" pattern="[A-Z]{5}\d{4}[A-Z]{1}" id="pan" >
                @error('pan')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
                </div>


                <div class="modal-body">
                    
                        <strong>Aadhar No:</strong>
                        <input type="text" name="aadhar" class="form-control" placeholder="Aadhar Number" id = "aadharSelectorId" >
                        @error('aadhar')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    
                </div>
                <div class="modal-body">
                    
                        <strong>Email Id:</strong>
                        <input type="text" name="email" class="form-control" placeholder="Email Id">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    
                </div>
                <div class="modal-message">
                    <!-- Message Alert -->
                   </div>
                   <div class="errorMessages" id ="errorMessages">
                    <!-- Message Alert --> 
                   </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <div>&nbsp; </div>
    <!-- End of Create Ajax -->
    <!-- Search and Dropdown -->
    <div class="panel-body">
            <div class="form-group">
           <input type="text" class="form-controller" id="search" name="search" placeholder = "Search by Designation"></input>
          </div>
          @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        </div>
        <div>
        <form action="{{ route('employees.index') }}" method="GET">
        @csrf
        <label for="designation">Designation:</label>
        <select id="designation" name="designation" class="form-control" onchange="this.form.submit()">
            <option value="">All Designations</option>
            @foreach ($designations as $designation)
                <option value="{{ $designation }}" {{ request('designation') == $designation ? 'selected' : '' }}>{{ $designation }} </option>
            @endforeach
            </select> 
        </form></div>
        <div>&nbsp</div>
         <!-- End Search and Dropdown -->

        <table class="table table-bordered">
            <thead>
            <tr>
            
            <th class="sortable" data-column="name">@sortablelink('name')</th>
            <th class="sortable" data-column="designation">@sortablelink('designation')</th>
            <th class="sortable" data-column="salary">@sortablelink('salary')</th>
            <th width="280px">Action</th>
        </tr>
          
            </thead>
            <tbody>
            @if ($employees->count() == 0)
            <tr>
            <td colspan="5">No employees to display.</td>
            </tr>
            @endif
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->designation }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>
                        </div>      
                            <button class="btn btn-primary btnEdit"   data-employee-id="{{ $employee->id }}">Edit</button>
                            <button class="btn btn-danger btnDelete"  data-employee-id="{{ $employee->id}}" data-employee-name="{{ $employee->name}}">Delete</button>
                        </div>     
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        </div>
<!-- Pagination per pages -->
<div>
    <form id="perPageForm" method="POST" action="{{ url('/employees') }}" onchange="updateContent()">
        @csrf
        <label for="perPage">Items per pages:</label>
        <select name="perPage" id="perPage" onchange="updateContent()">
            <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
            <!-- Add more options as needed -->
        </select>
    </form>
</div>
<div id="paginationContainer">
    @php
        $currentPage = request('pages', 1);
        $totalPages = ceil($totalRecords / $perPage);
        $startRange = $offset + 1;
        $endRange = min($offset + $perPage, $totalRecords);
    @endphp

    <p>Displaying {{ $startRange }} to {{ $endRange }} of {{ $totalRecords }} records.</p>
    <script>
    function updateContent() {
       var perPage = $('#perPage').val();
       var url = '{{ url("/employees") }}';
       window.location.href = '{{ url("/employees") }}?perPage=' + perPage;
    }
</script> 
</div>
<!-- Pagination links with sorting information -->
<!-- {!! $employees->appends(request()->query())->links() !!} -->

          {!! $employees->links() !!} 
</div>

    <!-- starting Edit Modal -->
   <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Content will be loaded here via AJAX -->
        </div>
    </div>
</div>   
<!-- End Edit Modal -->

   <!-- Modal confirmation -->
   <div class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteEmployeeModalLabel" aria-hidden="true">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEmployeeModalLabel">Delete Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="deleteModalBody">
                <p>Are you sure you want to delete this employee?</p>
                <p><strong>Employee Name:</strong> <span id="employeeName"></span></p>
                <p><strong>Employee ID:</strong> <span id="employeeId"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
            <div class="modal-message">
                <!-- Message Alert -->
            </div>
        </div>
    </div>
</div>
<!-- End of  Delete -->



<!-- Java scipt and Ajax for Search option -->
<script type="text/javascript">
$('#search').on('keyup',function(){
$value=$(this).val();
$.ajax({
type : 'get',
url : '{{URL::to('search')}}',
data:{'search':$value},
headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
success:function(data){
$('tbody').html(data);
}
});
})
</script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
<!-- Adding JS Files Here -->
<script src="{{ asset('js/ajax-script.js') }}"></script>
<!-- Save the data in database below url and add in ajax-script.js -->
<script>
    var employeesStoreRoute = "{{ route('employees.store') }}";
</script>
 <!-- Check validation All Fields at a time-->
 <script>
    $("#btnSave").click(function () {
    $("#employeeForm").valid(); 
});
</script>
<!-- Disable Back Button -->
<script>
    window.onload = function () {
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    };
</script>
<!-- <script>
    window.onload = function () {
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
            window.onpopstate = function () {
                window.history.pushState(null, null, window.location.href);
            };
        }
    };
</script> -->

 </body>
</html>

