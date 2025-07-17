@extends('layouts.admin')

@section('title', 'Manajemen Pengaduan')
@section('page-title', 'Manajemen Pengaduan Masuk')

@section('content')
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelapor</th>
                    <th>Email</th>
                    <th>Isi Pengaduan</th>
                    <th>Tanggal</th>
                    <th width="200px">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semuaPengaduan as $pengaduan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengaduan->nama_pelapor }}</td>
                    <td>{{ $pengaduan->email_pelapor }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($pengaduan->isi_pengaduan, 50) }}</td>
                    <td>{{ $pengaduan->created_at->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('admin.pengaduan.updateStatus', $pengaduan->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="input-group">
                                <select name="status" class="form-select">
                                    <option value="dikirim" {{ $pengaduan->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                <button class="btn btn-primary btn-sm" type="submit">Update</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada pengaduan yang masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
