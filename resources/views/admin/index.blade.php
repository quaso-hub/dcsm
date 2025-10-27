@extends('admin.layouts.master')
@section('title', 'Dashboard')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <style>
        :root {
            --transition: all 0.3s ease-in-out;
        }

        .dashboard-welcome {
            animation: fadeInDown 0.6s ease both;
            border-left: 5px solid var(--bs-primary);
            background-color: var(--bs-card-bg);
            color: var(--bs-body-color);
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dashboard-card {
            background-color: var(--bs-card-bg);
            transition: var(--transition);
            border-radius: 0.75rem;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .dashboard-icon {
            font-size: 2rem;
            padding: 12px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .dashboard-card:hover .dashboard-icon {
            background: rgba(0, 0, 0, 0.1);
        }

        .chart-card canvas {
            height: 280px !important;
        }

        .recent-table thead {
            background-color: var(--bs-secondary-bg);
            color: var(--bs-body-color);
        }

        .recent-table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .badge {
            font-size: 0.75rem;
        }

        .value-text {
            transition: 0.3s ease;
        }

        .value-text:hover {
            transform: scale(1.08);
        }


    </style>
@endsection

@section('breadcrumb-title')
    <h3>Dashboard</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid">

        {{-- Welcome Message --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="p-4 rounded dashboard-welcome shadow-sm">
                    <h4 class="mb-1 fw-bold">Hi {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}, welcome
                        back!</h4>
                    <small>Today is: {{ now()->isoFormat('dddd, D MMMM Y') }}</small>
                </div>
            </div>
        </div>

        {{-- Statistic Cards --}}
        <div class="row">
            @foreach ([['Total Users', $totalUsers, 'fa-users', 'primary'], ['Total Orders', $totalOrders, 'fa-shopping-cart', 'secondary'], ['Total Sales', '$' . number_format($totalSales, 2), 'fa-dollar-sign', 'success'], ['Orders This Week', $ordersThisWeek, 'fa-calendar-day', 'warning'], ['Pending Orders', $pendingOrders, 'fa-hourglass-half', 'danger'], ['Avg Order Value', '$' . number_format($avgOrderValue, 2), 'fa-chart-line', 'info']] as [$title, $value, $icon, $color])
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card dashboard-card shadow-sm border-0 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-uppercase text-muted">{{ $title }}</small>
                                <div class="h5 fw-bold text-{{ $color }} value-text">{{ $value }}</div>
                            </div>
                            <div class="dashboard-icon text-{{ $color }}">
                                <i class="fas {{ $icon }}"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Chart + Recent Orders --}}
        <div class="row mt-4">
            {{-- Orders Chart --}}
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm chart-card">
                    <div class="card-header bg-transparent fw-bold">📈 Orders This Week</div>
                    <div class="card-body">
                        <canvas id="weeklyOrdersChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Recent Orders Table --}}
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent fw-bold">🧾 Recent Orders</div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 recent-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentOrders as $order)
                                        <tr>
                                            <td class="fw-semibold">{{ $order->order_number }}</td>
                                            <td>{{ optional($order->user)->first_name }}
                                                {{ optional($order->user)->last_name }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $order->status === 'pending' ? 'warning' : 'success' }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>${{ number_format($order->total_amount, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-3">No recent orders</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>


        const ctx = document.getElementById('weeklyOrdersChart').getContext('2d');

        const isDark = document.body.classList.contains('dark-only');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($orderDays) !!},
                datasets: [{
                    label: 'Orders',
                    data: {!! json_encode($orderCounts) !!},
                    borderColor: isDark ? '#ffffff' : '#7366ff',
                    backgroundColor: isDark ? 'rgba(255,255,255,0.05)' : 'rgba(115,102,255,0.1)',
                    pointBackgroundColor: isDark ? '#ffffff' : '#7366ff',
                    pointBorderColor: isDark ? '#ffffff' : '#7366ff',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: isDark ? '#fff' : '#000' // legend text color
                        }
                    },
                    tooltip: {
                        backgroundColor: isDark ? '#333' : '#eee',
                        titleColor: isDark ? '#fff' : '#000',
                        bodyColor: isDark ? '#eee' : '#333'
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: isDark ? '#fff' : '#000'
                        },
                        grid: {
                            color: isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)'
                        }
                    },
                    y: {
                        ticks: {
                            color: isDark ? '#fff' : '#000'
                        },
                        grid: {
                            color: isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


@endsection
