<!-- ======= Footer ======= -->
<footer>
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-content">
                        <div class="footer-head">
                            <div class="footer-logo">
                                <h2 style="font-weight: 400"><span>RALKA</span> JEWELRY</h2>
                            </div>
                            <p>Silahkan Kunjungi Media Sosial Kami Untuk Informasi Terbaru.</p>
                            <div class="footer-icons">
                                <ul>
                                    <li>
                                        <a target="_blank" href="{{ $company->wa ?? '#' }}"><i class="bi bi-whatsapp"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ $company->facebook ?? '#' }}"><i class="bi bi-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ $company->instagram ?? '#' }}"><i class="bi bi-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ $company->tiktok ?? '#' }}"><i class="bi bi-tiktok"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{ $company->tokopedia ?? '#' }}"><i class="bi bi-shop"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end single footer -->
                <div class="col-md-6">
                    <div class="footer-content">
                        <div class="footer-head">
                            <h4>informasi</h4>
                            <p>
                                Hubungi kami jika ada pertanyaan.
                            </p>
                            <div class="footer-contacts">
                                <p><span>Tel:</span> {{ $company->phone1 }}</p>
                                <p><span>Email:</span> {{ $company->email }}</p>
                                <p><span>Alamat:</span> {{ $company->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end single footer -->
            </div>
        </div>
    </div>
    <div class="footer-area-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="copyright text-center">
                        <p>
                            &copy; Copyright <strong>Ralka Jewelry</strong>. All Rights Reserved
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer><!-- End  Footer -->
