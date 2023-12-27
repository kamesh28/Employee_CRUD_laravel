<div class="modal-body">
<form id="deleteEmployeeForm" method="POST" action="{{ route('employees.destroy', $employee->id) }}">
    @csrf
    <!-- Modal confirmation -->
    <div class="modal fade" id="deleteEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="deleteEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this employee from Modal?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDeleteButton" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

<script>
// Function to handle delete form submission
$('#confirmDeleteButton').click(function () {
            // Serialize form data
            var formData = $('#deleteEmployeeForm').serialize();
            // Make an AJAX request to delete the employee
            $.ajax({
                url: "{{ route('employees.destroy', $employee->id) }}",
                type: "DELETE",
                data: formData,
                headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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


