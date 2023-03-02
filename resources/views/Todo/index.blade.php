@extends('layouts.app')
@section('contents')
    <div class="input-group my-3 row">
        
        <div class="alert table-dark col-sm-12 text-center" role="alert">
            <h4 class="alert-heading">Task List of <span class="text-warning">Todo List</span></h4>
        </div>

        <div class="col">
            <button class="btn btn-success newtodo" type="button" data-toggle="modal" data-target="#exampleModal"> Create New
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
        </div>
    </div>
    
    <div class="row">

        <table class="table table-striped table-dark shadow">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Task Remain</th>
                <th>Completion %</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
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
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            {{ $todo->completed_count }}/{{ $todo->task_count }}
                            ({{ round(($todo->completed_count / $todo->task_count) * 100, 0) }}%)
                        @endif

                    </td>

                    <td>
                        <button class="btn btn-success rename" type="button" data-toggle="modal"
                            data-target="#exampleModal" data-id="{{ $todo->id }}" data-name="{{ $todo->name }}">
                            Rename </button>
                    </td>
                    <td><a href="{{ route('todo.show', $todo->id) }}" class="btn btn-success">View</a></td>
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
            @endforelse
        </table>
        <div class="d-flex justify-content-center">
            {{ $todos->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Todo Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" class="form" id="formLogin" action="{{ route('todo.store') }}"
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
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script>
        $(".rename").click(function() {
            var putMethod = "<input type='hidden' name='_method' value='put' id='InpMethod' />";
            var dataId = $(this).data("id");
            var dataName = $(this).data("name"); +
            $('#exampleModalLabel').text("Rename Todo Item");
            $('#name').val(dataName);
            $("#name").after(putMethod);
            $('#formLogin').attr('action', '{{ route('todo.store') }}' + '/' + dataId);
        });
        $(".newtodo").click(function() {
            var dataId = $(this).data("id");
            var dataName = $(this).data("name");
            $('#exampleModalLabel').text("Create New Todo Item");
            $('#InpMethod').remove();
            $('#name').val('');
            $('#formLogin').attr('action', '{{ route('todo.store') }}');
        });
        $('#exampleModal').on('shown.bs.modal', function() {
            $('#name').focus();
        })
    </script>
@endsection
