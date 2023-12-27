<!-- resources/views/employees/delete.blade.php -->

<div class="modal-header">
    <h5 class="modal-title">Delete Employee</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
<form id="deleteEmployeeForm" method="POST" action="{{ route('employees.destroy', $employee->id) }}">
        @csrf
        @method('DELETE')
    <p>Are you sure you want to delete this employee?</p>
    <p><strong>Employee Name:</strong> {{ $employee->name }}</p>
    <p><strong>Employee ID:</strong> {{ $employee->id }}</p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <!-- Add an ID to the delete button for easy targeting in JavaScript -->
    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
</div>

<script>
      $('#confirmDeleteButton').click(function () {
        // Serialize form data
        var formData = $('#deleteEmployeeForm').serialize();
        var employeeId = {{ $employee->id }};
        // Make an AJAX request to delete the employee
        $.ajax({
            url: "{{ route('employees.destroy', $employee->id) }}", //"{{ route('employees.destroy', $employee->id) }}",
            type: "DELETE",
            data: {
                    _token: "{{ csrf_token() }}"
                },
            success: function (response) {
                // Handle success, close the modals, or update UI as needed
                console.log("Employee deleted successfully:", response);
                // Close the delete and confirmation modals
                $('#deleteEmployeeModal').modal('hide');
                // Optionally, refresh the page or update UI
            },
            error: function (error) {
                console.error("Error deleting employee:", error.responseText);
                // Handle error, show error message, etc.
            }
        });
    });
    </script>


<!-- resources/views/employees/delete.blade.php -->

<!-- ... (previous content) -->


