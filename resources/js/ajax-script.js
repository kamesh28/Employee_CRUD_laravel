//create form
<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.js"></script>
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

//Edit form
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


//Delete form
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
