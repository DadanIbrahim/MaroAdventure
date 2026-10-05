@extends('layouts.admin')

@section('title', 'Reports - Admin')
@section('page_title', 'Financial & Operational Reports')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Revenue Overview</h6>
                <select class="form-select form-select-sm w-auto border-0 bg-light">
                    <option>This Year</option>
                    <option>Last Year</option>
                </select>
            </div>
            <div class="card-body">
                <!-- Using a placeholder for chart -->
                <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 300px;">
                    <div class="text-center text-muted">
                        <i class="bi bi-bar-chart-line fs-1 mb-2 d-block"></i>
                        Revenue Chart visualization goes here.<br>
                        (Integration with Chart.js or ApexCharts recommended)
                    </div>
                </div>
                
                <div class="row mt-4 text-center">
                    <div class="col-4 border-end">
                        <div class="text-muted small">Total Revenue</div>
                        <div class="fw-bold fs-5 text-success">Rp 1.250M</div>
                    </div>
                    <div class="col-4 border-end">
                        <div class="text-muted small">Operational Cost</div>
                        <div class="fw-bold fs-5 text-danger">Rp 820M</div>
                    </div>
                    <div class="col-4">
                        <div class="text-muted small">Net Profit</div>
                        <div class="fw-bold fs-5 text-primary">Rp 430M</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Top Destinations</h6>
            </div>
            <div class="card-body">
                <!-- Placeholder for pie chart -->
                <div class="d-flex align-items-center justify-content-center bg-light rounded mb-4" style="height: 180px;">
                    <i class="bi bi-pie-chart text-muted fs-1"></i>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <i class="bi bi-circle-fill text-primary me-2 small"></i> Mount Rinjani
                    </div>
                    <span class="fw-bold">45%</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <i class="bi bi-circle-fill text-success me-2 small"></i> Mount Bromo
                    </div>
                    <span class="fw-bold">30%</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <i class="bi bi-circle-fill text-warning me-2 small"></i> Mount Semeru
                    </div>
                    <span class="fw-bold">15%</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-circle-fill text-secondary me-2 small"></i> Others
                    </div>
                    <span class="fw-bold">10%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Monthly Report Data</h6>
        <button class="btn btn-sm btn-outline-success"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Export to Excel</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="table-light">
                    <tr>
                        <th class="text-start">Month</th>
                        <th>Total Bookings</th>
                        <th>Completed Trips</th>
                        <th>Revenue</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-start fw-medium">October 2023</td>
                        <td>125</td>
                        <td>42</td>
                        <td>Rp 125.000.000</td>
                        <td><span class="badge bg-primary">In Progress</span></td>
                    </tr>
                    <tr>
                        <td class="text-start fw-medium">September 2023</td>
                        <td>210</td>
                        <td>195</td>
                        <td>Rp 250.500.000</td>
                        <td><span class="badge bg-success">Closed</span></td>
                    </tr>
                    <tr>
                        <td class="text-start fw-medium">August 2023</td>
                        <td>245</td>
                        <td>240</td>
                        <td>Rp 285.000.000</td>
                        <td><span class="badge bg-success">Closed</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
