
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"></link>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"></link> -->
    <!-- Ajax -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
 
</head>
<body>
    <div class="container mt-2">
        <div class="column">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Employee Details</h2>
                </div>
                <!-- <div class="pull-left mb-2">
                    <a class="btn btn-success" href="{{ route('employees.create') }}"> Create Employee</a>
                </div>             -->
                <div style="text-align:left; margin-top:10%">
                    <button id="btnShow" class="btn btn-success">Create Employee</button>
                </div>
                        
                <!-- Start -->
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
                        <input type="text" name="name" class="form-control" placeholder="Employee Name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
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
                <div class="modal-message">
                    <!-- Message Alert -->
                   </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <div>&nbsp; </div>
    <!-- End of Ajax -->
            </div>
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
         <!-- End -->

        <table class="table table-bordered">
            <thead>
                 <!-- <tr>
                    <th>S.No</th>
                    <th>Employee Name</th>
                    <th>Designation</th>
                    <th>Salary</th>
                    <th width="280px">Action</th>
                </tr>  -->
                <tr>
            <!-- <th width="80px">@sortablelink('id')</th>  -->
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
                        <!-- <td>{{ $employee->id }}</td> -->
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->designation }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>
                            <!-- <form action="{{ route('employees.destroy',$employee->id) }}" method="GET">
                                <a class="btn btn-primary" href="{{ route('employees.edit',$employee->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form> -->
                            <!-- <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-primary" href="{{ route('employees.edit', $employee->id) }}">Edit</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                            </form> -->
                            <!-- <div style="text-align:left; margin-top:10%">
                            <button id="btnEdit" class="btn btn-primary">Edit</button>
                            <button id="btnDelete" class="btn btn-danger">Delete</button>
                            </div> -->        
                                    <button class="btn btn-primary btnEdit"   data-employee-id="{{ $employee->id }}">Edit</button>
                                    <button class="btn btn-danger btnDelete"  data-employee-id="{{ $employee->id }}">Delete</button>
                                     


                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        </div>
       
<!-- Pagination per pages -->

<!-- <div>
    <form method="POST" action="{{ url('/employees') }}" onchange="updateContent()">
        @csrf
        <label for="perPage">Items per pages:</label>
        <select name="perPage" id="perPage" onchange="this.form.submit()">
            <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option> 
            <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
            <option value="200" {{ request('perPage') == 200 ? 'selected' : '' }}>200</option>
           
        </select>
    </form>
</div>  -->
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
       //var currentPage = window.location.search.match(/pages=(\d+)/);

       var url = '{{ url("/employees") }}';
       //window.history.pushState({ perPage: perPage }, null, url + '?perPage=' + perPage);

        window.location.href = '{{ url("/employees") }}?perPage=' + perPage;
       
        //history.replaceState(null, null, url);
        //history.replaceState({}, null, '{{ url("/employees") }}?perPage=' + perPage + (currentPage ? '&pages=' + currentPage[1] : ''));
        
    
    }
</script> 
</div>

<!-- Pagination links with sorting information -->
<!-- {!! $employees->appends(request()->query())->links() !!} -->

          {!! $employees->links() !!} 
         
        <!-- <p>
             Displaying {{$employees->count()}} of {{ $employees->total() }} employee(s).
        </p>
        -->
    </div>

   <!-- Edit Modal -->
   
   <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-message">
                    <!-- Message Alert -->
            </div>
    </div> 
</div>
        </div>
        <!--66666  -->

        <form id="editEmployeeForm" method="POST" action="{{ route('employees.update', $employee->id) }}">
        @csrf
        @method('PUT')
                <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <h4 class="modal-title" id="myModalLabel">Edit Employee Details</h4>
                    </div>
                <!-- <div class="modal-title">Add Employee</div> -->
                <div class="modal-body">
                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <strong>Employee Name:</strong>
                        <input type="text" name="name" value="{{ $employee->name }}" class="form-control"
                            placeholder="Employee name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror      
                </div>
                <div class="modal-body">
        

                        <strong>Designation:</strong>
                        <input type="text" name="name" value="{{ $employee->designation }}" class="form-control"
                            placeholder="Employee name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror      
                
                </div>
                <div class="modal-body">
        
                        <strong>Salary:</strong>
                        <input type="text" name="name" value="{{ $employee->salary }}" class="form-control"
                            placeholder="Employee name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror      
                
            </div>
                <div class="modal-message">
                    <!-- Message Alert -->
                   </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Closes</button>
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>
        
    


<!-- End -->
<!-- Delete Modal -->
<form id="deleteEmployeeForm" method="POST" action="{{ route('employees.destroy', $employee->id) }}">
@csrf
<div class="modal fade" id="deleteEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="deleteEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Content will be loaded here -->
            <div class="modal" id="deleteConfirmationModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this employee?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="confirmDeleteButton" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>
</form>
<!-- End of  Delete -->
<!-- Start of confirmmodal delete -->
<!-- Add this HTML code for the confirmation modal at the end of your HTML file -->



<!-- End -->

<!-- Java scipt and Ajax for Search option -->
<script type="text/javascript">
$('#search').on('keyup',function(){
$value=$(this).val();
$.ajax({
type : 'get',
url : '{{URL::to('search')}}',
data:{'search':$value},
success:function(data){
$('tbody').html(data);
}
});
})
</script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
<!-- End search option JS-->
<!-- Filter -->
<script type="text/javascript">
$('#designation').on('change',function(){
$value=$(this).val();
$.ajax({
type : 'get',
url : '{{URL::to('filter')}}',
data:{'filter':$value},
success:function(data){
$('tbody').html(data);
}
});
})
</script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
<!-- Pagination JS -->

<!-- <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> -->

<!-- <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js "></script>  -->
<!-- <script>
let table = new DataTable('#myTable');
</script> -->


<!-- AJAX JS create form -->
<script type="text/javascript">
                        $(document).ready(function () {
                        $("#btnShow").click(function () {
                        $('#SampleModal').modal('show');
                        });
                        });
                        $("#btnSave").click(function () {
                            // Validate form fields
                        if (!validateForm()) {
                        return;
                        }
                        var formData = $("#employeeForm").serialize();
                        // Submit the form via Ajax
                    $.ajax({
                        url: "{{ route('employees.store') }}",
                        type: "POST",
                        data: formData,
                        success: function (response) {
                        // Handle the success response
                        console.log(response);
                        // Update the modal body with the success message
                        $('#SampleModal .modal-message').html('<div class="alert alert-success">' + response.message + '</div>');
                        // Optionally, close the modal
                        setTimeout(function () {
                        $('#SampleModal').modal('hide');
                    }, 2000); // Close the modal after 2 seconds (adjust as needed)
                    },
                    error: function (error) {
                    // Handle the error response
                    console.error(error.responseText);
                }
            });
        });

        function validateForm() {
            var valid = true;

            // Check each input field for empty value
            $("#employeeForm input").each(function () {
                if (!$(this).val().trim()) {
                    // Display an alert or handle validation error as needed
                    alert("Please enter all the details.");
                    valid = false;
                    return false; // Stop the loop on the first empty field
                }
            });

            return valid;
        }
       
        </script>

<!-- Edit or Delete -->
<script type="text/javascript">
    $(document).ready(function () {
        // Function to open the edit modal
        var formData = {};
        function openEditModal(id) {
            //$('#editEmployeeModal .modal-content').empty();
            $.ajax({
                url: "/employees/" + id + "/edit", // Adjust the URL based on your route configuration
                type: "GET",
                success: function (data) {
                    // Populate the edit modal with the retrieved data
                    $('#editEmployeeModal .modal-content').html(data);
                    // Show the modal
                    $('#editEmployeeModal').modal('show');
                },
                error: function (error) {
                    console.error(error.responseText);
                }
            });
        }

        // Trigger the edit modal when the "Edit" button is clicked
        $("table").on("click", ".btnEdit", function () {
            var employeeId = $(this).data('employee-id');
            openEditModal(employeeId);
        });
        
        // Function to handle edit form submission
$('#editEmployeeForm').submit(function (e) {
    e.preventDefault();

    // Serialize form data
    var formData = $(this).serialize();
    console.log(formData); // Use console.log instead of alert for better debugging
    var employeeId = $(this).find('input[name="employee_id"]').val();

    // Make sure the employeeId is correct
    console.log('Employee ID:', employeeId);

    // Make an AJAX request to update the database
    $.ajax({
        url: "/employees/" + employeeId,
        type: "PUT",
        data: formData,
        success: function (response) {
            // Your success handling logic
            console.log('Success:', response);
            $('#editEmployeeModal .modal-message').html('<div class="alert alert-success">' + response.message + '</div>');
            // Use response.employee to get the updated employee information
            $('#editEmployeeModal .modal-content #employee-id').text(response.employee.id);
            $('#editEmployeeModal .modal-content #employee-name').text(response.employee.name);
            $('#editEmployeeModal .modal-content #employee-designation').text(response.employee.designation);
            $('#editEmployeeModal .modal-content #employee-salary').text(response.employee.salary);

            setTimeout(function () {
                $('#editEmployeeModal').modal('hide');
            }, 2000); // Close the modal after 2 seconds (adjust as needed)
        },
        error: function (error) {
            // Your error handling logic
            console.error("Error updating employee:", error.responseText);
        }
    });
});

//Delete Ajax JS
// Function to open the delete modal
function openDeleteModal(id) {
    $.ajax({
        url: "/employees/" + id + "/delete",              
        type: "DELETE",
        success: function (data) {
            $('#deleteEmployeeModal .modal-content').html(data);
            // Show the modal
            $('#deleteEmployeeModal').modal('show');
        },
        error: function (error) {
            console.error(error.responseText);
        }
    });
}

// Trigger the delete modal when the "Delete" button is clicked
$("table").on("click", ".btnDelete", function () {
    var employeeId = $(this).data('employee-id');
    openDeleteModal(employeeId);
});

// Function to handle delete form submission
$('#deleteEmployeeForm').submit(function (e) {
    e.preventDefault();
    // Display a confirmation dialog before proceeding with deletion
    $('#deleteConfirmationModal').modal('show');
});

// Handle the delete confirmation
$('#confirmDeleteButton').click(function () {
    // Serialize form data
    var formData = $('#deleteEmployeeForm').serialize();
    // Make an AJAX request to delete the employee
    $.ajax({
        url: $('#deleteEmployeeForm').attr('action'),
        type: "DELETE",
        data: formData,
        success: function (response) {
            // Handle success, close the modals, or update UI as needed
            console.log("Employee deleted successfully:", response);
            // Close the delete and confirmation modals
            $('#deleteEmployeeModal').modal('hide');
            $('#deleteConfirmationModal').modal('hide');
            // Optionally, refresh the page or update UI
        },
        error: function (error) {
            console.error("Error deleting employee:", error.responseText);
            // Handle error, show error message, etc.
        }
    });
});



       
        

                
    });

    

        
     
    
</script>
        
 
</body>
</html>