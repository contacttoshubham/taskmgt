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
                    @if(Session::has('message'))
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Assigned User</th>
                                <th>Title</th>
                                <th>Due Date</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ ucwords($task->userDetails->name) }}</td>
                                    <td>{{ ucfirst($task->title) }}</td>
                                    <td>{{ date('d-M-Y', strtotime($task->due_date)) }}</td>
                                    <td>{{ ucfirst($task->description) }}</td>
                                    <td>{{ ucwords($task->status) }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('task-edit', [$task->id]) }}" class="btn btn-warning">Edit</a>
                                            <a href="{{ route('delete-task', [$task->id]) }}" class="btn btn-danger">Delete</a>
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
</x-app-layout>
