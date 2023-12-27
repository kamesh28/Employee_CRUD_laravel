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
        <div class="modal-content">
        <div class="modal-header">
                <div><h4 class="modal-title" id="myModalLabel">Edit Employee Details</h4> </div>  
        </div>
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
                        <input type="text" name="designation" class="form-control" placeholder="Designation" value="{{ $employee->designation }}">
                        @error('designation')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
            </div>
            <div class="modal-body">
                        <strong>Salary:</strong>
                        <input type="number" name="salary" value="{{ $employee->salary }}" class="form-control" placeholder="Salary">
                        @error('salary')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

            </div>
            <div class="modal-message">
                    <!-- Message Alert -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        
        </div>
        </div>


</body>
</html>



