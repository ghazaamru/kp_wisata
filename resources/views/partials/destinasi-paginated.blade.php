<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @forelse($destinations as $destination)
    <div class="col">
        <a href="{{ route('destinasi.show', $destination->id) }}" class="card h-100 shadow-sm destination-card-v2">
            @if($destination->gambar)
                <img src="{{ asset('storage/' . $destination->gambar) }}" class="card-img-top" alt="{{ $destination->nama_obyek_wisata }}">
            @else
                <img src="https://source.unsplash.com/400x300/?{{ $destination->lokasi }}" class="card-img-top" alt="{{ $destination->nama_obyek_wisata }}">
            @endif
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">{{ $destination->nama_obyek_wisata }}</h5>
                    <p class="card-text mb-0"><i class="bi bi-geo-alt"></i> {{ $destination->lokasi }}</p>
                </div>
                <i class="bi bi-chevron-right text-primary"></i>
            </div>
        </a>
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
