@extends('layouts.app')

@section('title', 'Kategori: ' . $kategori->nama_kategori)

@section('content')
    <div class="page-content page-home">
        <!-- Semua Kategori -->
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>All Categories</h5>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    @foreach ($categories as $key => $cat)
                        <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ ($key + 1) * 100 }}">
                            <a href="{{ route('kategori.show', $cat->id) }}" class="component-categories d-block">
                                <div class="categories-image">
                                    <img src="{{ asset('storage/' . $cat->gambar_kategori) }}"
                                        alt="{{ $cat->nama_kategori }}" class="w-100">
                                </div>
                                <p class="categories-text">
                                    {{ $cat->nama_kategori }}
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Konten Berdasarkan Kategori -->
        <section class="store-new-products mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Konten dalam kategori: <span class="text-dark">{{ $kategori->nama_kategori }}</span></h5>
                    </div>
                </div>
                <div class="row">
                    @forelse ($kontens as $key => $konten)
                        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ ($key + 1) * 100 }}">
                            <a href="{{ route('konten.show', $konten->id) }}" class="component-products d-block">
                                <div class="products-thumbnail">
                                    <div class="products-image"
                                        style="background-image: url('{{ asset('storage/' . $konten->gambar1) }}'); background-size: cover; background-position: center; height: 200px; border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="products-text">
                                    {{ Str::limit($konten->nama_konten, 60) }}
                                </div>
                                <div class="products-price">
                                    {{ \Carbon\Carbon::parse($konten->tanggal_konten)->format('d F Y') }}
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                            <p class="text-muted">Belum ada konten untuk kategori ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
