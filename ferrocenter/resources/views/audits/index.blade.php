index audits


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
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                                <div class="text-muted">
                                    Mostrar
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" value="10"
                                            size="3" aria-label="Audits count">
                                    </div>
                                    entradas
                                </div>
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
                                        <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                                aria-label="Select all audits"></th>
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
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                    aria-label="Select audit"></td>
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

        <!-- Selector de tipo de gráfico -->
        <div class="row row-deck row-cards mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Gráfica de Auditorías</h3>
                        <div class="ms-auto">
                            <select id="chartType" class="form-select">
                                <option value="bar">Barras</option>
                                <option value="pie">Circular</option>
                                <option value="line">Líneas</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="auditChart" width="400" height="200" style="max-width: 100%; height: auto;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para generar la gráfica -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('auditChart').getContext('2d');
            
            const auditData = @json($auditData);

            let chartType = document.getElementById('chartType').value;

            let auditChart = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: ['Creado', 'Actualizado', 'Eliminado'],
                    datasets: [{
                        label: 'Eventos de Auditoría',
                        data: [auditData.created, auditData.updated, auditData.deleted],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            document.getElementById('chartType').addEventListener('change', function() {
                const selectedType = this.value;
                auditChart.destroy();
                auditChart = new Chart(ctx, {
                    type: selectedType,
                    data: {
                        labels: ['Creado', 'Actualizado', 'Eliminado'],
                        datasets: [{
                            label: 'Eventos de Auditoría',
                            data: [auditData.created, auditData.updated, auditData.deleted],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 99, 132, 0.2)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
