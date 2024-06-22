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
                    <form action="{{ route('task-update', [$task->id]) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="user" class="form-label">User <span class="text-danger">*</span></label>
                                    <select class="form-control" id="user" name="user_id" required>
                                        <option selected disabled>Select user</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $user->id == $task->userDetails->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="due_date" class="form-label">Due Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $task->due_date }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="5" required>{{ $task->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
