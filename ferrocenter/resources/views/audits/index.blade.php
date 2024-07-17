@extends('tablar::page')

@section('title')
    Auditorías
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        List
                    </div>
                    <h2 class="page-title">
                        {{ __('Auditorías') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('audits.pdf') }}" class="btn btn-secondary d-none d-sm-inline-block">
                            Exportar a PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if (config('tablar', 'display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Auditorías</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                
                                <div class="ms-auto text-muted">
                                    Buscar:
                                    <div class="ms-2 d-inline-block">
                                        <form action="{{ route('audits.index') }}" method="GET">
                                            <input type="text" name="search" class="form-control form-control-sm"
                                                aria-label="Search category" value="{{ request()->input('search') }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                 
                                        <th class="w-1">No.
                                            <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-sm text-dark icon-thick" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <polyline points="6 15 12 9 18 15" />
                                            </svg>
                                        </th>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Evento</th>
                                        <th>Modelo</th>
                                        <th>ID del Modelo</th>
                                        <th>Valores Anteriores</th>
                                        <th>Valores Nuevos</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($audits as $audit)
                                        <tr>
                                       
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $audit->id }}</td>
                                            <td>{{ optional($audit->user)->name }}</td>
                                            <td>{{ $audit->event }}</td>
                                            <td>{{ class_basename($audit->auditable_type) }}</td>
                                            <td>{{ $audit->auditable_id }}</td>
                                            <td>
                                                @foreach ($audit->old_values as $key => $value)
                                                    <strong>{{ $key }}:</strong> {{ $value }}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($audit->new_values as $key => $value)
                                                    <strong>{{ $key }}:</strong> {{ $value }}<br>
                                                @endforeach
                                            </td>
                                            <td>{{ $audit->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {{ $audits->links('tablar::pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
