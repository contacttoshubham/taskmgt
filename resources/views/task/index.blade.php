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
                    <form id="add_task">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" >
                            <span class="error_title"></span>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="user" class="form-label">User <span class="text-danger">*</span></label>
                                    <select class="form-control" id="user_id" name="user" required>
                                        <option selected disabled>Select user</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error_user_id"></span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="due_date" class="form-label">Due Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" required>
                                    <span class="error_due_date"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                            <span class="error_description"></span>
                        </div>
                        <button type="button" id="save" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#save').on('click', function() {
                let token = $('meta[name="csrf-token"]').attr('content');
                let title = $('#title').val();
                let due_date = $('#due_date').val();
                let description = $('#description').val();
                let user_id = $('#user_id').val();
                $('.text-danger').text('');
                if(title != '' || description != '' || due_date != '' || user_id != '') {
                    $.ajax({
                        url: 'add-task',
                        method: 'POST',
                        data: {
                            "_token": token,
                            "title": title,
                            "due_date": due_date,
                            "description": description,
                            "user_id": user_id
                        },
                        success: function(response) {
                            if(response.status == 200) {
                                alert(response.message);
                            }
                            $('#add_task').trigger("reset");
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;

                                $.each(errors, function(key, value) {
                                    $('.error_' + key).text(value.join(', '));
                                });
                            } else {
                                alert('An error occurred: ' + error);
                            }
                        }
                    });
                } else {
                    alert('Please fill all required fields');
                }
            });
        });
    </script>
</x-app-layout>
