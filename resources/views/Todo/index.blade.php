@extends('layouts.app')
@section('content')
    <div class="input-group row">
        {{-- Page title --}}
        <div class="alert table-dark col-sm-12 text-center" role="alert">
            <h4 class="alert bg-black text-white">Page : <span class="text-warning">Todo List</span></h4>
        </div>

        {{-- Create new Todo button --}}
        <div class="col">
            <button class="btn btn-success newtodo mb-2" type="button" data-toggle="modal" data-target="#todoModal"> 
                Create New &rarr;
            </button>
        </div>

        {{-- Success or error message show area --}}
        <div class="input-group-append col">

            @if (Session('message'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            @error('name')
                <div class="alert alert-danger">
                    <span class="text-danger"> Error:{{ $message }}</span>
                </div>
            @enderror

        </div>

    </div>

    {{-- Table area start --}}
    <div class="row">
        <div class="col-12">

            <table class="table table-striped table-dark shadow col-12">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Task Remain</th>
                    <th>Completion %</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                {{-- Table data loop start --}}
                @php
                    $counter = ($todos->currentPage() - 1) * $todos->perPage() + 1;
                @endphp

                @forelse ($todos as $key => $todo)
                    <tr>
                        <td><a class="badge badge-light" href="x"> {{ $counter }}</a></td>
                        <td>{{ $todo->name }}</td>
                        <td>{{ $todo->remaining_count }}</td>
                        <td>
                            @if ($todo->task_count > 0)
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ round(($todo->completed_count / $todo->task_count) * 100, 0) }}%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                {{ $todo->completed_count }}/{{ $todo->task_count }}
                                ({{ round(($todo->completed_count / $todo->task_count) * 100, 0) }}%)
                            @endif    
                        </td>    
                        <td>
                            <button class="btn btn-success rename" type="button" data-toggle="modal" data-target="#todoModal" data-id="{{ $todo->id }}">
                                Rename 
                            </button>
                        </td>
                        <td>
                            <a href="{{ route('todo.show', $todo->id) }}" class="btn btn-primary">View</a>
                        </td>
                        <td>
                            <form action="{{ route('todo.destroy', $todo->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>

                    @php
                        $counter++;
                    @endphp

                @empty
                <tr><td colspan="7" class="text-warning">No Data Found</td></tr>
                @endforelse
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $todos->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    {{-- Table area end --}}

    <!-- Create or Edit Modal Start -->
    <div class="modal fade" id="todoModal" tabindex="-1" aria-labelledby="todoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="todoModalLabel">Todo Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" class="form" id="formTodo" action="{{ route('todo.store') }}"
                        method="POST" role="form">
                        @csrf
                        <div class="form-group">
                            <label for="uname1">Name</label>
                            <input class="form-control" id="name" name="name" required="" type="text">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
  
    <script>
        // Rename Todo item
        $(".rename").click(function() {
            var putMethod = "<input type='hidden' name='_method' value='put' id='InpMethod' />";
            var parent = $(this).parent().closest('tr');
            var dataId = $(this).data("id");

            $('#todoModalLabel').text("Rename Todo Item");
            $('#name').val(parent.find("td:eq(1)").text());
            $("#name").after(putMethod);
            $('#formTodo').attr('action', '{{ route('todo.store') }}' + '/' + dataId);
        });
        
        // New Todo item
        $(".newtodo").click(function() {
            var dataId = $(this).data("id");

            $('#todoModalLabel').text("Create New Todo Item");
            $('#InpMethod').remove();
            $('#name').val('');
            $('#formTodo').attr('action', '{{ route('todo.store') }}');
        });

        // Name input field focus
        $('#todoModal').on('shown.bs.modal', function() {
            $('#name').focus();
        })
    </script>
@endsection
