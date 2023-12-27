@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- Ajax -->
    <!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.js"></script> -->
    <script src="https://code.jquery.com/jquery-migrate-3.6.4.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    
      <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    
 <!-- Include other scripts if needed -->
 <script type="text/javascript" src="{{ URL::asset('js/validation.js') }}"></script>
</head>
<body>
    <div class="container mt-2">
        <div class="column">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Employee Details</h2>
                </div>
                <div style="text-align:left; margin-top:10%">
                    <button id="btnShow" class="btn btn-success">Create Employee</button>
                </div>
            </div>
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
                <div class="modal-body">
                    
                        <strong>Mobile No:</strong>
                        <input type="text" name="mobile" class="form-control" id="fieldSelectorId" placeholder="Mobile Number">
                        <p style="color:red;">Please enter 10 digit mobile number*</p>
                        @error('mobile')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    
                </div>
                <div class="modal-body">
                    
                        <strong>PAN No:</strong>
                        <input type="text" name="pan" class="form-control" placeholder="PAN Number" id = "panId">
                        @error('pan')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    
                </div>
                <div class="modal-body">
                    
                        <strong>Aadhar No:</strong>
                        <input type="text" name="aadhar" class="form-control" id="aadharSelectorId"placeholder="Aadhar Number" minlength="12" maxlength="12">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                        <!-- <td>{{ $employee->id }}</td> -->
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

    <!-- starting Edit Modal -->
   <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Content will be loaded here via AJAX -->
        </div>
    </div>
</div>   
    
   <!-- End Edit Modal -->

   <!-- Delete Modal -->

    <!-- Modal confirmation -->
    
    <div class="modal fade" id="deleteEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="deleteEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="deleteModalBody">
                    <p>Are you sure you want to delete this employee?</p>
                    <p><strong>Employee Name:</strong> <span id="employeeName"></span></p>
                    <p><strong>Employee ID:</strong> <span id="employeeId"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- Add an ID to the delete button for easy targeting in JavaScript -->
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
success:function(data){
$('tbody').html(data);
}
});
})
</script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
<!-- AJAX JS create form -->
<script type="text/javascript">
                        $(document).ready(function () {
                        $("#btnShow").click(function () {
                        $('#SampleModal').modal('show');
                        });
                        });
                        $("#btnSave").click(function () {
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
<!-- Edit AJAX JS -->
<script type="text/javascript">
    // Function to open the edit modal
function openEditModal(id) {
    $.ajax({
        url: "/employees/" + id + "/edit",
        type: "GET",
        success: function (data) {
            $('#editEmployeeModal .modal-content').html(data);
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

</script>
<!-- End Edit AJAX -->
<!-- Delete AJAX -->
 <script>
   $(document).ready(function () {
        // Function to open the delete modal
        function openDeleteModal(id, name) {
            // Set employee name and ID in the modal
            $('#employeeName').text(name);
            $('#employeeId').text(id);
            // Show the delete confirmation modal
            $('#deleteEmployeeModal').modal('show');

            // Attach a click event to the delete button within the modal
            $('#confirmDeleteButton').one('click', function () {
                // Close the modal
                $('#deleteEmployeeModal').modal('show');
                
                // Proceed with the deletion
                $.ajax({
                    url:"/employees/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        // Check if the deletion was successful (adjust based on your server response)
                        console.log(response);

                    if (response.success) {
                    // Update the modal content to show a success message
                    $('#deleteEmployeeModal .modal-message').html('<div class="alert alert-success">' + response.message + '</div>');

                    // Optional: You can close the modal or perform other actions here
                    setTimeout(function () {
                    $('#deleteEmployeeModal').modal('hide');
                    }, 20000)
                    location.reload(1000000000000);
                    } else {
                    // Display an error message in the console
                    console.error("Error deleting employee:", response.error || 'Unknown error');
                    }
                    },
                    error: function (error) {
                        console.error(error.responseText);
                    }
                });
            });
        }

        // Function to handle successful deletion
        

        // Trigger the delete modal when the "Delete" button is clicked
        $("table").on("click", ".btnDelete", function () {
            var employeeId = $(this).data('employee-id');
            var employeeName = $(this).data('employee-name');
            openDeleteModal(employeeId, employeeName);
        });
    });
   
 </script>
 <!-- End Delete AJAX -->
 

</body>
</html>