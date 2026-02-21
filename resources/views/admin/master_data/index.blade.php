@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-700">Master Data Management</h1>
            <p class="text-muted small mb-0">Define and manage system taxonomies for skills and education.</p>
        </div>
        <div class="d-flex gap-2">
            <div class="badge bg-soft-primary text-primary px-3 py-2 border">
                <i class="bi bi-info-circle me-1"></i> Data managed here reflects site-wide
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Skills Dictionary -->
        <div class="col-xl-6 mb-4">
            <div class="card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-base-color"><i class="bi bi-gear-wide-connected me-2"></i>Skills Dictionary</h6>
                </div>
                <div class="card-body p-0">
                    <!-- Add Skill Form -->
                    <div class="p-4 bg-light-soft border-bottom">
                        <form action="{{ route('admin.master_data.skills.store') }}" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Skill Name (e.g. Laravel)" required>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="category" class="form-control form-control-sm" placeholder="Category (e.g. Backend)">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-base-color btn-sm w-100" type="submit">
                                        <i class="bi bi-plus-lg me-1"></i>Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Skills Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted small text-uppercase fw-600">
                                <tr>
                                    <th class="ps-4">Skill Title</th>
                                    <th>Category</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($skills as $skill)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-700 text-dark">{{ $skill->name }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-soft-info text-info border-soft-info fs-11">
                                            {{ $skill->category ?? 'General' }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <form action="{{ route('admin.master_data.skills.destroy', $skill) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this skill from the dictionary?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-white btn-sm px-2 border shadow-sm-hover" title="Delete">
                                                <i class="bi bi-trash-fill text-danger small"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted small italic">No skills defined yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($skills->hasPages())
                    <div class="card-footer bg-white border-0 py-3 mt-auto">
                        <div class="pagination-wrapper">
                            {{ $skills->appends(['courses_page' => request()->courses_page])->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Education Courses -->
        <div class="col-xl-6 mb-4">
            <div class="card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-base-color"><i class="bi bi-mortarboard-fill me-2"></i>Education Courses</h6>
                </div>
                <div class="card-body p-0">
                    <!-- Add Course Form -->
                    <div class="p-4 bg-light-soft border-bottom">
                        <form action="{{ route('admin.master_data.education.store') }}" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Course Name (e.g. MBA)" required>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="type" class="form-control form-control-sm" placeholder="Qualification Type">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-base-color btn-sm w-100" type="submit">
                                        <i class="bi bi-plus-lg me-1"></i>Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Education Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted small text-uppercase fw-600">
                                <tr>
                                    <th class="ps-4">Course Name</th>
                                    <th>Qualification</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($courses as $course)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-700 text-dark">{{ $course->name }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-soft-secondary text-secondary border fs-11">
                                            {{ $course->type ?? 'Diploma' }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <form action="{{ route('admin.master_data.education.destroy', $course) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this course from the list?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-white btn-sm px-2 border shadow-sm-hover" title="Delete">
                                                <i class="bi bi-trash-fill text-danger small"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted small italic">No courses added yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($courses->hasPages())
                    <div class="card-footer bg-white border-0 py-3 mt-auto">
                        <div class="pagination-wrapper">
                            {{ $courses->appends(['skills_page' => request()->skills_page])->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .fw-700 { font-weight: 700; }
    .fw-600 { font-weight: 600; }
    .fs-11 { font-size: 11px; }
    .fs-14 { font-size: 14px; }
    .text-base-color { color: #ef7f1a !important; }
    .bg-light-soft { background-color: #f8f9fb; }
    .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); }
    .border-soft-info { border: 1px solid rgba(13, 202, 240, 0.2); }
    .btn-white { background: #fff; border: 1px solid #eee; }
    .btn-white:hover { background: #f8f9fa; }
    .shadow-sm-hover:hover { box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important; }
    
    /* Ensure pagination alignment and icon sizing */
    .pagination-wrapper .pagination { margin-bottom: 0; justify-content: flex-end; }
    .pagination-wrapper .page-link { font-size: 13px; padding: 0.4rem 0.8rem; border-color: #eee; color: #666; }
    .pagination-wrapper .page-item.active .page-link { background-color: #ef7f1a; border-color: #ef7f1a; color: #fff; }
    
    /* Constraint for any wayward SVGs in pagination */
    .pagination-wrapper svg { width: 1.25rem; height: 1.25rem; }
</style>
@endsection
