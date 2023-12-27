// validation.js

$(document).ready(function () {
    $("#employeeForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                // Add other validation rules as needed
            },
            designation: {
                required: true,
                // Add other validation rules as needed
            },
            salary: {
                required: true,
                number: true,
                // Add other validation rules as needed
            },
            mobile: {
                required: true,
                minlength: 10,
                maxlength: 10,
                digits: true,
                // Add other validation rules as needed
            },
            pan: {
                required: true,
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
        messages: {
            // Customize error messages if needed
            name: {
                required: "Name is required",
                maxlength: "Name cannot be more than 20 characters"
            },

            designation: {
                required: "Designation is required",
                //maxlength: "Name cannot be more than 20 characters"
            },
            salary: {
                required: "Salary",
                //maxlength: "Name cannot be more than 20 characters"
            },
            mobile: {
                required: "Mobile number is required",
                maxlength: "Not more than 10 digits"
            },
            pan: {
                required: "PAN number is required",
                //maxlength: "Not more than 10 digits"
            },
            aadhar: {
                required: "Aadhar number is required",
                maxlength: "Not more than 12 digits"
            },
            email: {
                required: "Email is required",
                email: "Email must be a valid email address",
                maxlength: "Email cannot be more than 30 characters",
            },
        },
        submitHandler: function (form) {
            // Add any custom logic to be executed on form submission
            form.submit();
        },
    });
});
