//Search option JS


//create form This is important for Adding JS files Here
$(document).ready(function () {
    $("#btnShow").click(function () {
    $('#SampleModal').modal('show');
    });
    });

    $("#btnSave").click(function () {
    var formData = $("#employeeForm").serialize();
    // Submit the form via Ajax
    $.ajax({
    url: employeesStoreRoute,//"{{ route('employees.store') }}",
    type: "POST",
    data: formData,
    success: function (response) {
    // Handle the success response
    console.log(response);
    // Check if the response has errors
    if (response.errors) {
        // Display errors in the modal
        displayErrorsInModal(response.errors);
    } else {
        // Update the modal body with the success message
        $('#SampleModal .modal-message').html('<div class="alert alert-success">' + response.message + '</div>');
        
        // Optionally, close the modal
        setTimeout(function () {
            $('#SampleModal').modal('hide');
        }, 100); // Close the modal after 2 seconds (adjust as needed)
    }
},    
error: function (error) {
    // Handle the error response
    console.error(error.responseText);
    }
});
});
 
// Function to display errors below each corresponding input field
function displayErrorsInForm(errors) {
    // Remove existing error messages
    $('.alert.alert-danger').remove();

    // Iterate through the errors and append them below each input field
    $.each(errors, function (field, messages) {
        var errorMessage = "<div class='alert alert-danger mt-1 mb-1'>" + messages[0] + "</div>";
        $('[name="' + field + '"]').after(errorMessage);
    });
}
//^\d{3}-?\d{3}-?\d{4}$/g.test(value

$.validator.addMethod("validateMobile", function (value, element) {
    if ( /^[6789]\d{9,9}$/.test(value)) {
        return true;
    } else {
        return false;
    };
}, "Invalid phone number");
jQuery("#fieldSelectorId").keypress(function (e) {
    var length = jQuery(this).val().length;
    if(length > 9) {
       return false;
  } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
       return false;
  } else if((length == 0) && (e.which == 48 && e.which < 53)) {
       return false;
  }
 });

 $.validator.addMethod("panCard", function (value, element) {
    // PAN card format: ABCDE1234F
    // A: Alphabetic character, E: Numeric character, F: Alphabetic character
    return /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
}, "Please enter a valid PAN card number EX:ABCDE1234F.");

 
 jQuery(document).ready(function () {
    jQuery("#aadharSelectorId").keypress(function (e) {
       var length = jQuery(this).val().length;
    
     if(length > 11) {
          return false;
     } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          return false;
     } else if((length == 0) && (e.which == 48)) {
          return false;
     }
    });
  });


$("#employeeForm").validate({

    
        rules: {
            name: {
                required: true,
                maxlength: 4,
                minlength: 4,
                pattern: /^[A-Za-z]+$/,
                //lettersOnly:true,
                // Add other validation rules as needed
            },
            designation: {
                required: true,
                minlength: 4,
                maxlength: 4,
                pattern: /^[A-Za-z]+$/,
                // Add other validation rules as needed
            },
            salary: {
                required: true,
                digits: true,
                // Add other validation rules as needed
            },
            mobile: {
                required:true,
                validateMobile:true,
                minlength:10,
                maxlength:10,
                             
                // Add other validation rules as needed
            },
            pan: {
                required: true,
                panCard: true,
                maxlength:10,
    
                // Add other validation rules as needed
            },
            aadhar: {
                required: true,
                minlength: 12,
                maxlength: 12,
                digits: true,
                // Add other validation rules as needed
            },
            email: {
                required: true,
                email: true,
                
                // Add other validation rules as needed
            },
        },

        highlight: function (element) {
            // Customize the styling for the element when it has an error
            $(element).addClass("error-highlight");
        },
    
        unhighlight: function (element) {
            // Customize the styling for the element when it is successfully validated
            $(element).removeClass("error-highlight");
        },
       
        messages: {
            // Customize error messages if needed
            name: {
                required: "Please specify your name",
                maxlength: "Name should be 4 characters",
                minlength: "Minimum 4 characters required",
                pattern: "Only letters are allowed ",
                
            },

            designation: {
                required: "Designation is required",
                maxlength: "Designation must be 4 characters",
                minlength: "4 characters must",
                pattern: "Only letters are allowed ",
            },
            salary: {
                required: "Salary is required",
                number: "Enter only Numeric digits"
            },
            mobile: {
                required: "Please enter valid Mobile number",
                maxlength: "Enter valid 10 digit Mobile number",
                maxlength: "Not more than 10 digits",
                validateMobile:"Please enter valid Mobile number"
            },
            pan: {
                required: "PAN number is required.",
                //panCard: "Invalid Format of PAN number",
                maxlength:"PAN number not more than 10 characters",
                
            },
            aadhar: {
                required: "Aadhar number required 12 digits",
                minlength:"Please enter 12 digits Aadhar number"
                //maxlength: "Not more than 12 digits"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address",
                maxlength: "Email cannot be more than 20 characters",
            },
        },
        submitHandler: function (form) {
            // Add any custom logic to be executed on form submission
            form.submit();
        },
    });
   
     


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
           // alert(id);
            $('#deleteEmployeeModal').modal('show');
            
            // Proceed with the deletion
            $.ajax({
                url:"/employees/" + id,
                type: "DELETE",
                headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
                // data: {
                //     _token: "{{ csrf_token() }}"
                // },

                success: function (response) {
                    // Check if the deletion was successful (adjust based on your server response)
                    console.log(response);

                if (response.success) {
                // Update the modal content to show a success message
                $('#deleteEmployeeModal .modal-message').html('<div class="alert alert-success">' + response.message + '</div>');

                // Optional: You can close the modal or perform other actions here
                setTimeout(function () {
                $('#deleteEmployeeModal').modal('hide');
                }, 2000)
                location.reload(1000000);
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
