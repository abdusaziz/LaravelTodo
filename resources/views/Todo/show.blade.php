@extends('layouts.app')
@section('contents')
    <div class="input-group my-3">
        <div class="alert table-dark col-sm-12 text-center" role="alert">
            <h4 class="alert-heading">Task List of <span class="text-warning">{{ $todo->name }}</span></h4>
        </div>

        <div class="col">
            <button class="btn btn-success newtask" type="button" data-toggle="modal" data-target="#exampleModal"> Create New
                &rarr;</button>
        </div>
        <div class="input-group-append col">
            @if (Session('message'))
                <div class="btn alert-success">
                    {{ session('message') }}
                </div>
            @endif



            @error('name')
                <div class="btn alert-danger">
                    <span class="text-danger"> Error:{{ $message }}</span>
                </div>
            @enderror
            @error('description')
                <div class="btn alert-danger">
                    <span class="text-danger"> Error:{{ $message }}</span>
                </div>
            @enderror

        </div>
        <div class="col">
            <a href="{{ route('todo.index') }}" class="btn btn-success newtodo">&larr; Back</a>
        </div>
    </div>

    <!-- form card login -->
    <div class="row">
    <div class="col-12">

        <table class="table table-dark">
            <tr>
                <th>ID</th>
                <th>Task name</th>
                <th class="col-sm-4">Task Description</th>
                <th>Status</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            @forelse ($tasks as $key => $task)
                <tr class="{{ $task->id }}">
                    <td><a class="badge badge-light" href="x"> {{ $key + 1 }}</a></td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td class="{{ $task->status }}">
                        @if ($task->status == 1)
                             Complete
                        @else
                            <span class="text-danger"> Pending</span>
                        @endif
                    </td>

                    <td>
                        <button class="btn btn-success edit" type="button" data-toggle="modal" data-target="#exampleModal">Edit</button>
                    </td>
                    <td>
                        <button class="btn btn-success view" type="button" data-toggle="modal" data-target="#exampleModal2">View</button>
                    </td>
                    <td>
                        <form action="{{ route('task.destroy', $task->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
            @endforelse
        </table>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Task Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" class="form" id="formLogin" action="{{ route('task.store') }}"
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

    <!-- Modal 2 -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Task: <span class="yellowText">Todo Form</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="modalDescription"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $tasks->links('vendor.pagination.bootstrap-4') }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script>
        $(".view").click(function() {
            
            var parent = $(this).parent().closest('tr');
            
            $('#exampleModalLabel2').text("Task:"+ parent.find("td:eq(1)").text());
            $('#modalDescription').text(parent.find("td:eq(2)").text());
            $('#description').val(parent.find("td:eq(2)").text());
            $("#select").val(parent.find("td:eq(3)").attr('class')).change();
            $("#name").after(putMethod);
            $('#formLogin').attr('action', '{{ route('task.store') }}' + '/' + task_id);
        });
        $(".edit").click(function() {
            var putMethod = "<input type='hidden' name='_method' value='put' id='InpMethod' />";
            var parent = $(this).parent().closest('tr');
            var task_id = parent.attr('class');

            $('#exampleModalLabel').text("Edit Task");
            $('#name').val(parent.find("td:eq(1)").text());
            $('#description').val(parent.find("td:eq(2)").text());
            $("#select").val(parent.find("td:eq(3)").attr('class')).change();
            $("#name").after(putMethod);
            $('#formLogin').attr('action', '{{ route('task.store') }}' + '/' + task_id);
        });
        $(".newtask").click(function() {
            var dataId = $(this).data("id");
            var dataName = $(this).data("name");
            $('#exampleModalLabel').text("Create New Task");
            $('#InpMethod').remove();
            $('#name').val('');
            $('#description').val('');
            $("#select").val(0).change();
            $('#formLogin').attr('action', '{{ route('task.store') }}');
        });
    </script>
@endsection
