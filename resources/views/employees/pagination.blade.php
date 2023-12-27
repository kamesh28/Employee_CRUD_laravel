
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    
   

</head>
<body>
    <div class="container mt-2">
        <div class="column">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Employee Details</h2>
                </div>
                <div class="pull-left mb-2">
                    <a class="btn btn-success" href="{{ route('employees.create') }}"> Create Employee</a>
                </div>            
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
        <!-- Filter Option -->
        <!-- <form action="{{ route('employees.index') }}" method="GET">
        <label for="designation">Designation:</label>
        <input type="text" name="designation" id="designation">
        <button type="submit">Filter</button>
        </form>  -->
        <div id="employeesContainer">
        <form action="{{ route('employees.index') }}" method="POST">
        @csrf
        <label for="designation">Designation:</label>
        <select id="designation" name="designation" class="form-control" onchange="this.form.submit()">
        @if ($employees->isEmpty())
            <option value="">No designations available</option>
        @else 
            <option value="">All Designations</option>
            @foreach ($employees as $employee)
                <option value="{{ $employee->designation }}" {{ request('designation') == $employee->designation ? 'selected' : '' }}>{{ $employee->designation }} </option>
            @endforeach
            
        @endif
    </select> <!--<button type="submit">Filter</button> -->
    </form>
    <div>&nbsp </div>
    <!-- <form action="{{ route('employees.index') }}" method="GET">
     ... other filters ... 
     <button type="submit">Filter</button> 
    <button type="submit"><a href="{{ route('employees.index') }}" >Clear Filters</a></button>
</form> -->

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
                            <form action="{{ route('employees.destroy',$employee->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('employees.edit',$employee->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
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

    $.ajax({
        url: '{{ route("get-employees") }}',
        type: 'GET',
        data: {
            perPage: perPage,
            page: 1 // You might want to set this to the desired initial page
        },
        success: function(response) {
            // Update the content and pagination links
            $('#employeesContainer').html(response.data);
            $('#paginationContainer').html(response.paginationLinks);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
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


<!-- Sorting JS -->


</body>
</html>
