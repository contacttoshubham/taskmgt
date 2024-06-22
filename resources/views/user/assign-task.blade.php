<x-app-layout>
    <x-slot name="header">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('task') }}">
                    <span class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Task') }}</span>
                </a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('task-list') }}">
                    <span class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Task List') }}</span>
                </a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('assign-task') }}">
                    <span class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Assign Task') }}</span>
                </a></li>
        </ul>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (Session::has('message'))
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($taskDetails as $taskDetail)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ ucfirst($taskDetail->title) }}</td>
                                    <td>{{ ucfirst($taskDetail->description) }}</td>
                                    <td>{{ date('d-M-Y', strtotime($taskDetail->due_date)) }}</td>
                                    <td>{{ ucwords($taskDetail->status) }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#myModal" onclick="changeStatus('{{$taskDetail->id}}', '{{$taskDetail->status}}')">Change Status</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Change task status</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <input type="hidden" id="task_id" />

                    <label id="status" for="task_status">Select Status</label>
                    <select class="form-control" id="task_status" name="status">
                        <option value="pending">Pending</option>
                        <option value="progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                    <br/>
                    <button type="button" class="btn btn-primary" id="save">Update Status</button>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
<script>
    function changeStatus(id, status) {
        $('#task_id').val(id);
        $('#task_status').val(status);
    }

    $(document).ready(function () {
        $('#save').on('click', function() {
            let token = $('meta[name="csrf-token"]').attr('content');
            let id = $('#task_id').val();
            let status = $('#task_status').val();
            $.ajax({
                url: 'assign-task-update',
                method: 'POST',
                data: {
                    "_token": token,
                    "id": id,
                    "status": status
                },
                success: function(response) {
                    if(response.status == 200) {
                        alert(response.message);
                        $('#myModal').modal('hide');
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    });
</script>
</x-app-layout>
