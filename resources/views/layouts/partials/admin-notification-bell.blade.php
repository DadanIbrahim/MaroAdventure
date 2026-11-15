@php
    $isSuperadmin = request()->routeIs('superadmin.*');
    $readAllRoute = route($isSuperadmin ? 'superadmin.bookings.mark-all-read' : 'admin.bookings.mark-all-read');
    $allBookingsRoute = route($isSuperadmin ? 'superadmin.bookings.index' : 'admin.bookings.index');
    $unreadCount = $unreadBookingsCount ?? 0;
    $bookingsList = $notificationBookings ?? collect();
@endphp

<div class="dropdown">
    <button class="btn btn-link p-0 position-relative text-decoration-none border-0" 
            type="button" 
            id="adminNotificationDropdown" 
            data-bs-toggle="dropdown" 
            aria-expanded="false" 
            title="Notifikasi Pemesanan">
        <i class="bi bi-bell fs-5 text-secondary"></i>
        @if($unreadCount > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-white" style="font-size: 0.65rem; padding: 0.25em 0.5em;">
                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                <span class="visually-hidden">notifikasi belum dibaca</span>
            </span>
        @endif
    </button>

    <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 py-0 mt-2" 
         aria-labelledby="adminNotificationDropdown" 
         style="width: 360px; max-width: 92vw; border-radius: 12px; overflow: hidden; z-index: 1050;">
        
        <!-- Dropdown Header -->
        <div class="p-3 bg-light border-bottom d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="bi bi-bell-fill text-primary"></i> Notifikasi Pemesanan
                </h6>
                <small class="text-muted" style="font-size: 0.78rem;">
                    @if($unreadCount > 0)
                        <span class="text-danger fw-semibold">{{ $unreadCount }}</span> pesanan baru belum dibaca
                    @else
                        Semua pemesanan sudah dibaca
                    @endif
                </small>
            </div>
            @if($unreadCount > 0)
                <form action="{{ $readAllRoute }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-link text-decoration-none p-0 text-primary small fw-semibold" style="font-size: 0.75rem;" title="Tandai semua sudah dibaca">
                        Tandai dibaca
                    </button>
                </form>
            @endif
        </div>

        <!-- Notification Items List -->
        <div class="notification-items-container" style="max-height: 360px; overflow-y: auto;">
            @forelse($bookingsList as $booking)
                @php
                    $isUnread = !$booking->is_read;
                    $itemReadRoute = route($isSuperadmin ? 'superadmin.bookings.read' : 'admin.bookings.read', $booking->id);
                @endphp
                <a href="{{ $itemReadRoute }}" 
                   class="d-flex align-items-start gap-3 p-3 text-decoration-none border-bottom notification-item-row" 
                   style="background-color: {{ $isUnread ? '#f0f7ff' : '#ffffff' }}; transition: background-color 0.15s ease;">
                    
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 {{ $isUnread ? 'bg-primary text-white shadow-sm' : 'bg-light text-secondary border' }}" 
                         style="width: 38px; height: 38px;">
                        <i class="bi bi-ticket-detailed fs-6"></i>
                    </div>

                    <div class="flex-grow-1 min-w-0">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-dark text-truncate small" style="max-width: 170px;">
                                {{ $booking->customer_name }}
                            </span>
                            <span class="badge {{ $booking->status === 'pending' ? 'bg-warning text-dark' : ($booking->status === 'confirmed' ? 'bg-primary' : 'bg-secondary') }}" style="font-size: 0.65rem;">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        <div class="text-muted small text-truncate mb-1" style="font-size: 0.78rem;">
                            <i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $booking->trip ? $booking->trip->name : 'Trip #'.$booking->trip_id }}
                        </div>
                        <div class="d-flex justify-content-between align-items-center text-muted" style="font-size: 0.72rem;">
                            <span class="text-success fw-bold">{{ $booking->formatted_price }} ({{ $booking->participants }} pax)</span>
                            <span>{{ $booking->created_at ? $booking->created_at->diffForHumans() : '-' }}</span>
                        </div>
                    </div>

                    @if($isUnread)
                        <span class="rounded-circle bg-primary flex-shrink-0 mt-2" style="width: 8px; height: 8px;" title="Belum dibaca"></span>
                    @endif
                </a>
            @empty
                <div class="p-4 text-center text-muted">
                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary opacity-50"></i>
                    <p class="mb-0 small fw-medium">Belum ada data pemesanan.</p>
                    <small class="text-muted" style="font-size: 0.75rem;">Setiap pemesanan baru dari pelanggan akan muncul di sini.</small>
                </div>
            @endforelse
        </div>

        <!-- Dropdown Footer -->
        <div class="p-2 bg-light text-center border-top">
            <a href="{{ $allBookingsRoute }}" class="btn btn-sm btn-link text-decoration-none fw-semibold text-primary w-100 py-1" style="font-size: 0.82rem;">
                Lihat Semua Pemesanan <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>
