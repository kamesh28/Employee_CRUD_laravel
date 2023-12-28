
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8"> -->
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Search Employee Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- Ajax -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Employee Details</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('employees.create') }}"> Create Employeessss</a>
                </div>
               
            </div>
        </div>
        <!-- search option -->
        <div class="panel-body">
<div class="form-group">
<input type="text" class="form-controller" id="search" name="search"></input>
</div>
<!-- End search -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <!-- <th>S.No</th> -->
                    <th>Employee Name</th>
                    <th>Designation</th>
                    <th>Salary</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
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
        {!! $employees->links() !!}
    </div>
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
</body>
</html>
