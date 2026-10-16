<?php

namespace App\Http\Controllers;

use App\Models\Mountain;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicTripController extends Controller
{
    /**
     * Tampilkan katalog paket perjalanan wisata & pendakian.
     */
    public function index(Request $request): View
    {
        // Pastikan ada sampel paket trip jika database kosong
        if (Trip::count() === 0) {
            $mountain = Mountain::first() ?? Mountain::create([
                'name' => 'Gunung Burangrang',
                'location' => 'Bandung Barat, Jawa Barat',
                'elevation' => 2050,
                'description' => 'Gunung dengan ketinggian 2.050 MDPL di kawasan Bandung Barat yang menyajikan panorama alam dan Danau Situ Lembang.',
                'image' => null,
                'status' => true,
            ]);

            Trip::create([
                'mountain_id' => $mountain->id,
                'name' => 'Burangrang Weekend Camp & Trekking',
                'duration' => '2 Hari 1 Malam',
                'price' => 350000,
                'status' => 1,
                'description' => 'Pendakian santai dan camp di puncak Gunung Burangrang dengan pemandangan sunrise Danau Situ Lembang.',
                'image' => null,
            ]);

            Trip::create([
                'mountain_id' => $mountain->id,
                'name' => 'Burangrang One Day Sunrise Expedition',
                'duration' => '1 Hari (Sunrise)',
                'price' => 220000,
                'status' => 1,
                'description' => 'Trekking malam mengejar golden sunrise spektakuler di puncak Burangrang 2.050 MDPL.',
                'image' => null,
            ]);
        }

        $query = Trip::with('mountain')->where('status', 1);

        // Filter berdasarkan pencarian nama atau deskripsi
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('mountain', function ($mq) use ($search) {
                        $mq->where('name', 'like', "%{$search}%")
                            ->orWhere('location', 'like', "%{$search}%");
                    });
            });
        }

        // Filter berdasarkan gunung terpilih
        if ($mountainId = $request->input('mountain_id')) {
            $query->where('mountain_id', $mountainId);
        }

        // Urutkan
        $sort = $request->input('sort', 'latest');
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $trips = $query->paginate(9)->withQueryString();
        $mountains = Mountain::where('status', 1)->get();

        return view('trips.index', compact('trips', 'mountains'));
    }

    /**
     * Tampilkan detail paket perjalanan beserta rundown dan fasilitas.
     */
    public function show($id): View
    {
        $trip = Trip::with('mountain')->where('status', 1)->findOrFail($id);

        $relatedTrips = Trip::with('mountain')
            ->where('status', 1)
            ->where('id', '!=', $trip->id)
            ->take(3)
            ->get();

        return view('trips.show', compact('trip', 'relatedTrips'));
    }
}
