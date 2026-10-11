@extends('layouts.app')

@section('title', 'My Booking - Maro Adventure')

@section('content')
<div class="bg-light pb-5" style="min-height: 100vh; padding-top: 100px;">
    <div class="container py-4">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                @include('dashboard.partials.sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="ps-lg-4">
                    
                    <!-- Header Section -->
                    <div class="mb-4">
                        <h2 class="fw-bold mb-1" style="color: var(--color-dark);">My Booking</h2>
                        <p class="text-muted">Daftar perjalanan yang pernah dan sedang diikuti.</p>
                    </div>

                    <!-- Search and Filters -->
                    <div class="d-flex flex-column flex-md-row gap-3 mb-4">
                        <div class="flex-grow-1 position-relative">
                            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                            <input type="text" id="searchBooking" class="form-control rounded-pill ps-5 py-2 border-0 shadow-sm" placeholder="Search booking (nama trip, kode)...">
                        </div>
                        <div class="d-flex gap-2 overflow-auto pb-2 pb-md-0 hide-scroll">
                            <button class="btn btn-secondary rounded-pill px-4 text-nowrap filter-btn" data-filter="all">All</button>
                            <button class="btn btn-outline-secondary rounded-pill px-4 text-nowrap filter-btn" data-filter="upcoming">Upcoming</button>
                            <button class="btn btn-outline-secondary rounded-pill px-4 text-nowrap filter-btn" data-filter="completed">Completed</button>
                            <button class="btn btn-outline-secondary rounded-pill px-4 text-nowrap filter-btn" data-filter="canceled">Canceled</button>
                        </div>
                    </div>

                    <!-- Bookings List -->
                    <div class="d-flex flex-column gap-3" id="bookingListContainer">
                        
                        @forelse($bookings as $booking)
                            @php
                                $cardStatus = 'upcoming';
                                if ($booking->status === 'cancelled') {
                                    $cardStatus = 'canceled';
                                } elseif ($booking->status === 'completed') {
                                    $cardStatus = 'completed';
                                }
                            @endphp

                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden booking-card" data-status="{{ $cardStatus }}">
                                <div class="card-body p-0 d-flex flex-column flex-md-row">
                                    
                                    <!-- Trip Thumbnail -->
                                    <div class="bg-light d-flex align-items-center justify-content-center text-center overflow-hidden position-relative" style="min-width: 150px; max-width: 150px; border-right: 1px solid #f3f4f6;">
                                        @if($booking->trip && $booking->trip->image)
                                            <img 
                                                src="{{ asset('storage/' . $booking->trip->image) }}" 
                                                alt="{{ $booking->trip->name }}" 
                                                class="w-100 h-100 object-fit-cover"
                                                style="min-height: 120px;"
                                            >
                                        @else
                                            <div class="p-4">
                                                <i class="bi bi-image text-muted fs-3"></i>
                                                <div class="small text-muted mt-2 fw-medium text-uppercase tracking-wide">TRIP</div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Trip Info -->
                                    <div class="p-4 flex-grow-1 d-flex flex-column justify-content-center">
                                        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                            <span class="badge bg-light text-muted border font-monospace px-2 py-1" style="font-size: 0.75rem;">
                                                {{ $booking->booking_code }}
                                            </span>
                                            @if($booking->trip && $booking->trip->mountain)
                                                <span class="badge bg-primary-subtle text-primary fw-medium" style="font-size: 0.75rem;">
                                                    <i class="bi bi-geo-alt-fill me-1"></i> {{ $booking->trip->mountain->name }}
                                                </span>
                                            @endif
                                        </div>

                                        <h5 class="fw-bold mb-1 text-dark">
                                            {{ $booking->trip->name ?? 'Trip Petualangan' }}
                                        </h5>

                                        <p class="text-muted small mb-2">
                                            <i class="bi bi-calendar3 me-1"></i> {{ date('d M Y', strtotime($booking->booking_date)) }} 
                                            &bull; <i class="bi bi-people me-1"></i> {{ $booking->participants }} participant
                                        </p>

                                        <p class="fw-bold mb-0 text-primary">
                                            {{ $booking->formatted_price }}
                                        </p>
                                    </div>

                                    <!-- Status & Action Buttons -->
                                    <div class="p-4 d-flex flex-column align-items-end justify-content-center border-start-md border-light" style="min-width: 200px;">
                                        
                                        <!-- Payment Badge -->
                                        @if($booking->payment_status === 'paid')
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 mb-1">
                                                <i class="bi bi-check-circle-fill me-1"></i> Lunas
                                            </span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2 mb-1">
                                                <i class="bi bi-clock-history me-1"></i> Menunggu Bayar
                                            </span>
                                        @endif

                                        <!-- Booking Status Badge -->
                                        @if($booking->status === 'confirmed')
                                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-3">
                                                Confirmed
                                            </span>
                                        @elseif($booking->status === 'completed')
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2 mb-3">
                                                Completed
                                            </span>
                                        @elseif($booking->status === 'cancelled')
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 mb-3">
                                                Canceled
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2 mb-3">
                                                Pending
                                            </span>
                                        @endif

                                        <div class="d-flex flex-column align-items-end gap-2">
                                            <a href="{{ route('dashboard.bookings.show', $booking->id) }}" class="text-dark fw-bold text-decoration-none small">
                                                View details <i class="bi bi-arrow-right ms-1"></i>
                                            </a>

                                            @if($booking->payment_status !== 'paid' && $booking->status !== 'cancelled')
                                                <a href="{{ route('checkout.payment', ['booking_code' => $booking->booking_code]) }}" class="btn btn-sm btn-primary rounded-pill px-3 text-nowrap shadow-sm">
                                                    <i class="bi bi-credit-card me-1"></i> Bayar Sekarang
                                                </a>
                                            @endif
                                        </div>

                                    </div>

                                </div>
                            </div>

                        @empty
                            <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary mx-auto mb-3" style="width: 70px; height: 70px;">
                                    <i class="bi bi-compass fs-2"></i>
                                </div>
                                <h5 class="fw-bold mb-1">Belum Ada Pesanan Perjalanan</h5>
                                <p class="text-muted small mb-4">Kamu belum memiliki riwayat atau rencana pendakian bersama Maro Adventure.</p>
                                <div>
                                    <a href="{{ route('checkout.index') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold">
                                        <i class="bi bi-plus-circle me-1"></i> Mulai Pesan Trip
                                    </a>
                                </div>
                            </div>
                        @endforelse

                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>

<style>
    /* Utility to hide scrollbar for filter pills on mobile */
    .hide-scroll::-webkit-scrollbar {
        display: none;
    }
    .hide-scroll {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    @media (min-width: 768px) {
        .border-start-md {
            border-left: 1px solid #f3f4f6;
        }
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.booking-card');
    const searchInput = document.getElementById('searchBooking');

    function filterBookings(filterValue, searchTerm) {
        cards.forEach(card => {
            const status = card.getAttribute('data-status');
            const cardText = card.innerText.toLowerCase();
            
            const matchFilter = (filterValue === 'all' || status === filterValue);
            const matchSearch = searchTerm ? cardText.includes(searchTerm.toLowerCase()) : true;

            if (matchFilter && matchSearch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => {
                b.classList.remove('btn-secondary');
                b.classList.add('btn-outline-secondary');
            });
            this.classList.remove('btn-outline-secondary');
            this.classList.add('btn-secondary');
            
            const filterValue = this.getAttribute('data-filter');
            const searchTerm = searchInput ? searchInput.value : '';
            filterBookings(filterValue, searchTerm);
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const activeBtn = document.querySelector('.filter-btn.btn-secondary');
            const filterValue = activeBtn ? activeBtn.getAttribute('data-filter') : 'all';
            filterBookings(filterValue, this.value);
        });
    }
});
</script>
@endpush
@endsection
