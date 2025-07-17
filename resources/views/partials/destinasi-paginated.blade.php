{{-- File ini hanya berisi bagian yang akan di-refresh --}}
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @forelse($destinations as $destination)
    <div class="col">
        <div class="card h-100 shadow-sm border-0">
            @if($destination->gambar)
                <img src="{{ asset('storage/' . $destination->gambar) }}" class="card-img-top" alt="{{ $destination->nama_obyek_wisata }}">
            @else
                <img src="https://source.unsplash.com/400x300/?{{ $destination->lokasi }}" class="card-img-top" alt="{{ $destination->nama_obyek_wisata }}">
            @endif
            <div class="card-body">
                <h5 class="card-title fw-bold">{{ $destination->nama_obyek_wisata }}</h5>
                <p class="card-text text-muted"><i class="bi bi-geo-alt"></i> {{ $destination->lokasi }}</p>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="{{ route('destinasi.show', $destination->id) }}" class="btn btn-outline-primary w-100">Lihat Detail</a>
            </div>
        </div>
    </div>
    @empty
        <div class="col-12">
            <p class="text-center text-muted">Belum ada destinasi wisata yang ditambahkan.</p>
        </div>
    @endforelse
</div>

<!-- Link pagination -->
<div class="mt-4 d-flex justify-content-center">
    {{ $destinations->links() }}
</div>
