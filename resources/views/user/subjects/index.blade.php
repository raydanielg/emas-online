@extends('adminlte::page')

@section('title', 'Subjects')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-success font-weight-bold mb-0">Subjects</h1>
            <small class="text-muted">Subjects list</small>
        </div>
        <div class="d-flex">
            <a href="{{ route('user.subjects.import') }}" class="btn btn-dark shadow-sm mr-2">
                <i class="fas fa-file-import mr-1"></i> Import Subjects
            </a>
            <a href="{{ route('user.subjects.assign') }}" class="btn btn-warning shadow-sm text-dark font-weight-bold">
                <i class="fas fa-link mr-1"></i> Assign to Classes
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $kpis['total_subjects'] ?? 0 }}</h3>
                    <p>Total Subjects</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $kpis['school_subjects'] ?? 0 }}</h3>
                    <p>Subjects Used (Your School)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark font-weight-bold">Subject List</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Code</th>
                                    <th>Subject Name</th>
                                    <th>Category</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subjects as $subject)
                                    <tr>
                                        <td><span class="badge badge-info shadow-sm">{{ $subject->code }}</span></td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->category }}</td>
                                        <td class="text-right">
                                            <form action="{{ route('user.subjects.remove', $subject) }}" method="POST" id="remove-form-{{ $subject->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger shadow-sm" onclick="confirmRemoveSubject('{{ $subject->id }}', '{{ $subject->name }}')">
                                                    <i class="fas fa-trash-alt mr-1"></i> Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted">
                                            <i class="fas fa-book-open fa-3x mb-3"></i>
                                            <p class="mb-0">No subjects found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="small text-muted mb-2 mb-md-0">
                            Showing <strong>{{ $subjects->firstItem() ?? 0 }}</strong> to <strong>{{ $subjects->lastItem() ?? 0 }}</strong> of <strong>{{ $subjects->total() }}</strong>
                        </div>
                        <div class="mb-0">
                            {{ $subjects->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            @if(session('success'))
                Swal.fire({
                    title: 'Imekamilika!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    timer: 3000,
                    showConfirmButton: false,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            @endif
        });

        function confirmRemoveSubject(id, name) {
            Swal.fire({
                title: 'Remove ' + name + '?',
                text: "Somo hili litaondolewa kwenye orodha ya shule kwa sasa na siku zijazo. Hata hivyo, litabaki kwenye rekodi za kihistoria (matokeo ya nyuma na archive). Je, unaendelea?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ndiyo, ondoa!',
                cancelButtonText: 'Ghairi'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('remove-form-' + id).submit();
                }
            })
        }
    </script>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        .card-success.card-outline { border-top: 3px solid #28a745; }
        .bg-warning { background-color: #ffc107 !important; }
    </style>
@stop
