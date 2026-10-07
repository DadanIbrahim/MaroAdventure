@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Payment - Superadmin')
@section('page_title', 'Payment Gateway & Transactions')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="fw-bold">Payment Gateway Status</h6>
                <div class="d-flex align-items-center mt-3">
                    <div class="fs-1 text-success me-3"><i class="bi bi-shield-check"></i></div>
                    <div>
                        <h5 class="mb-0">Midtrans API</h5>
                        <p class="text-muted small mb-0">Connected and running smoothly in Production mode.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="fw-bold">Manual Transfer Verifications</h6>
                <h1 class="display-5 text-warning fw-bold mt-2 mb-0">5</h1>
                <p class="text-muted small">Awaiting manual verification by finance team.</p>
                <button class="btn btn-outline-primary btn-sm">Review Now</button>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">Recent Transactions</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Trx ID</th>
                        <th>Booking ID</th>
                        <th>Method</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-muted">#TRX-88192</td>
                        <td class="fw-medium">#BK-99201</td>
                        <td>BCA Virtual Account</td>
                        <td>Rp 5.000.000</td>
                        <td>12 Oct 2023 14:22</td>
                        <td><span class="badge bg-success">Success</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">#TRX-88193</td>
                        <td class="fw-medium">#BK-99203</td>
                        <td>Credit Card (Visa)</td>
                        <td>Rp 2.100.000</td>
                        <td>13 Oct 2023 09:15</td>
                        <td><span class="badge bg-success">Success</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">#TRX-88194</td>
                        <td class="fw-medium">#BK-99202</td>
                        <td>Mandiri Bill Payment</td>
                        <td>Rp 7.400.000</td>
                        <td>14 Oct 2023 11:30</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
