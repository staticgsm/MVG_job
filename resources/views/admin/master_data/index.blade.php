@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Master Data Management</h1>

    <div class="row">
        <!-- Skills Management -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Skills</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.master_data.skills.store') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Skill Name" required>
                            <input type="text" name="category" class="form-control" placeholder="Category (e.g. IT)">
                            <button class="btn btn-primary" type="submit">Add Skill</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($skills as $skill)
                                <tr>
                                    <td>{{ $skill->name }}</td>
                                    <td>{{ $skill->category ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('admin.master_data.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Delete this skill?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $skills->appends(['courses_page' => request()->courses_page])->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Education Management -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Education Courses</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.master_data.education.store') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Course Name" required>
                            <input type="text" name="type" class="form-control" placeholder="Type (e.g. Degree)">
                            <button class="btn btn-primary" type="submit">Add Course</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                <tr>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->type ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('admin.master_data.education.destroy', $course) }}" method="POST" onsubmit="return confirm('Delete this course?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $courses->appends(['skills_page' => request()->skills_page])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
