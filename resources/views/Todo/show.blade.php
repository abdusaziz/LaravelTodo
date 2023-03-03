@extends('layouts.app')
@section('content')
    <div class="input-group">
        {{-- Page title --}}
        <div class="alert table-dark col-sm-12 text-center" role="alert">
            <h4 class="alert bg-black text-white">Task List of <span class="text-warning">{{ $todo->name }}</span></h4>
        </div>

        {{-- Create new Task button --}}
        <div class="col">
            <button class="btn btn-success newtask mb-2" type="button" data-toggle="modal" data-target="#createEditModal">
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

            @error('description')
                <div class="alert alert-danger">
                    <span class="text-danger"> Error:{{ $message }}</span>
                </div>
            @enderror

        </div>

        {{-- Back button --}}
        <div class="col text-end">
            <a href="{{ route('todo.index') }}" class="btn btn-success tx-auto newtodo">&larr; Back</a>
        </div>
    </div>

    {{-- Table area start --}}
    <div class="row">
        <div class="col-12">

            <table class="table table-dark">
                <tr>
                    <th>SL</th>
                    <th>Task name</th>
                    <th class="col-sm-4">Task Description</th>
                    <th>Status</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                {{-- Table data looping start --}}
                @php
                    $counter = ($tasks->currentPage() - 1) * $tasks->perPage() + 1;
                @endphp

                @forelse ($tasks as $key => $task)
                    <tr class="{{ $task->id }}">
                        <td><span class="badge badge-light"> {{ $counter }}</span></td>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->description }}</td>
                        <td class="{{ $task->status }}">
                            @if ($task->status == 1)
                            <span class="text-white">Complete</span>
                            @else
                                <span class="text-danger"> Pending</span>
                            @endif
                        </td>

                        <td>
                            <button class="btn btn-success edit" type="button" data-toggle="modal"
                                data-target="#createEditModal">Edit</button>
                        </td>
                        <td>
                            <button class="btn btn-primary view" type="button" data-toggle="modal"
                                data-target="#viewModal">View</button>
                        </td>
                        <td>
                            <form action="{{ route('task.destroy', $task->id) }}" method="post">
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
    </div>
    <div class="d-flex justify-content-center">
        {{ $tasks->links('vendor.pagination.bootstrap-4') }}
    </div>
    {{-- Table area end --}}

    <!-- Create or Edit Modal Start -->
    <div class="modal fade" id="createEditModal" tabindex="-1" aria-labelledby="createEditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEditModalLabel">Task Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" class="form" id="formCreateEdit" action="{{ route('task.store') }}"
                        method="POST" role="form">
                        @csrf
                        <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                        <div class="form-group">
                            <label for="uname1">Name</label>
                            <input class="form-control" id="name" name="name" required="" type="text">
                        </div>
                        <div class="form-group">
                            <label for="uname1">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="uname1">Status</label>
                            <select class="form-control" name="status" id="select">
                                <option value="1">Complete</option>
                                <option value="0">Panding</option>
                            </select>
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

    <!-- Modal Show -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalTaskname" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalTaskname">Task: <span class="yellowText">Todo Form</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="viewModalDescription"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // View task modal
        $(".view").click(function() {
            var parent = $(this).parent().closest('tr');

            $('#viewModalTaskname').text("Task:" + parent.find("td:eq(1)").text());
            $('#viewModalDescription').text(parent.find("td:eq(2)").text());
        });
        
        // Edit task modal
        $(".edit").click(function() {
            var putMethod = "<input type='hidden' name='_method' value='put' id='InpMethod' />";
            var parent = $(this).parent().closest('tr');
            var task_id = parent.attr('class');

            $('#createEditModalLabel').text("Edit Task");
            $('#name').val(parent.find("td:eq(1)").text());
            $('#description').val(parent.find("td:eq(2)").text());
            $("#select").val(parent.find("td:eq(3)").attr('class')).change();
            $("#name").after(putMethod);
            $('#formCreateEdit').attr('action', '{{ route('task.store') }}' + '/' + task_id);
        });

        // Create new task modal
        $(".newtask").click(function() {
            var dataId = $(this).data("id");
            var dataName = $(this).data("name");

            $('#createEditModalLabel').text("Create New Task");
            $('#InpMethod').remove();
            $('#name').val('');
            $('#description').val('');
            $("#select").val(0).change();
            $('#formCreateEdit').attr('action', '{{ route('task.store') }}');
        });
    </script>
@endsection
