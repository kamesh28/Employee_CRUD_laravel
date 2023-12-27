<!-- resources/views/employees/edit_form.blade.php -->

<div class="modal-header">
    <h5 class="modal-title">Edit Employee</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form id="editEmployeeForm" method="POST" action="{{ route('employees.update', $employee->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}">
        </div>

        <div class="form-group">
            <label for="designation">Designation</label>
            <input type="text" class="form-control" id="designation" name="designation" value="{{ $employee->designation }}">
        </div>

        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="text" class="form-control" id="salary" name="salary" value="{{ $employee->salary }}">
        </div>

        <div class="modal-message">
                    <!-- Message Alert -->
        </div>
        <!-- Add other fields as needed -->

        <button type="button" id="updateEmployeeButton" class="btn btn-primary">Update</button>
    </form>
    <div id="editEmployeeMessage" class="mt-3"></div>
</div>

<script>
    $(document).ready(function () {
        // Function to handle edit form submission
        $('#updateEmployeeButton').on('click', function (e) {
            e.preventDefault();

            // Serialize form data
            var formData = $('#editEmployeeForm').serialize();
            var employeeId = {{ $employee->id }};

            // Make an AJAX request to update the database
            $.ajax({
                url: "{{ route('employees.update', $employee->id) }}",
                type: "PUT",
                data: formData,
                success: function (response) {
                    // Handle success, close the modal, or update UI as needed
                    console.log("Employee updated successfully:", response);
                    $('#editEmployeeModal .modal-message').html('<div class="alert alert-success">' + response.message + '</div>');
                    // Optional: You can close the modal or perform other actions here
                    setTimeout(function () {
                        $('#editEmployeeModal').modal('hide');
                    }, 2000)
                    location.reload(2000);
                    
                },
                error: function (error) {
                    console.error("Error updating employee:", error.responseText);
                }
            });
        });
    });
</script>
