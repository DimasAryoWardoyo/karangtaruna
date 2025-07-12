@extends('layouts.app')

@section('title', 'Tentang Kami - Karang Taruna Klaten Asyik')

@section('content')
    <div class="page-content page-home">
        <div class="container py-3">
            <!-- Section Tentang Kami -->
            <div class="row align-items-center mb-3">
                <!-- Gambar -->
                <div class="col-md-6 text-center mb-4 mb-md-0" data-aos="zoom-in">
                    <img src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/aw2.svg" alt="Tentang Kami"
                        class="img-fluid" style="max-height: 400px;">
                </div>

                <!-- Konten -->
                <div class="col-md-6">
                    <h2 class="fw-bold mb-3" data-aos="fade-up">Tentang Kami</h2>
                    <p class="text-muted mb-4" data-aos="fade-up">
                        Karang Taruna <strong>Klaten Asyik</strong> adalah organisasi kepemudaan yang fokus pada
                        pengembangan
                        potensi, kreativitas, dan kontribusi sosial para pemuda di Klaten.
                    </p>

                    <div class="row g-3 mb-4">
                        <div class="col-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="p-3 border rounded d-flex align-items-start w-100">
                                <img src="https://img.icons8.com/ios-filled/50/4a90e2/idea.png" width="28"
                                    class="me-3 " alt="Kreativitas">
                                <div>
                                    <h6 class="mb-1">Kreativitas</h6>
                                    <p class="small text-muted mb-0">Mendorong inovasi dan ide baru dalam setiap kegiatan.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6"data-aos="fade-up" data-aos-delay="200">
                            <div class="p-3 border rounded d-flex align-items-start w-100">
                                <img src="https://img.icons8.com/ios-filled/50/4a90e2/like.png" width="28"
                                    class="me-3 " alt="Kepedulian">
                                <div>
                                    <h6 class="mb-1">Kepedulian</h6>
                                    <p class="small text-muted mb-0">Peduli pada masyarakat dan lingkungan sekitar.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="p-3 border rounded d-flex align-items-start w-100">
                                <img src="https://img.icons8.com/ios-filled/50/4a90e2/handshake.png" width="28"
                                    class="me-3 " alt="Kolaborasi">
                                <div>
                                    <h6 class="mb-1">Kolaborasi</h6>
                                    <p class="small text-muted mb-0">Bersinergi dengan masyarakat dan instansi lainnya.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="p-3 border rounded d-flex align-items-start w-100">
                                <img src="https://img.icons8.com/ios-filled/50/4a90e2/security-checked.png" width="28"
                                    class="me-3 " alt="Integritas">
                                <div>
                                    <h6 class="mb-1">Integritas</h6>
                                    <p class="small text-muted mb-0">Menjunjung kejujuran dan tanggung jawab dalam
                                        organisasi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Visi & Misi -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="bg-light rounded p-4 shadow-sm">
                        <h3 class="fw-bold text-center">Visi & Misi</h3>

                        <div class="mb-4">
                            <h5 class="fw-semibold">Visi</h5>
                            <p class="text-muted mb-0">
                                Menjadi organisasi kepemudaan yang aktif, inovatif, dan berdaya guna bagi masyarakat dalam
                                mewujudkan Klaten yang lebih sejahtera dan berbudaya.
                            </p>
                        </div>

                        <div>
                            <h5 class="fw-semibold">Misi</h5>
                            <ul class="text-muted">
                                <li>Mengembangkan potensi pemuda melalui pelatihan dan kegiatan produktif.</li>
                                <li>Menumbuhkan semangat gotong royong dan kepedulian sosial.</li>
                                <li>Membangun kemitraan strategis dengan berbagai pihak.</li>
                                <li>Mendorong kreativitas dan kewirausahaan pemuda.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
