<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="widget">
                    <h5 class="widgetheading">BỆNH VIỆN ĐA KHOA TÂN HƯNG</h5>
                    <address>
                        Địa chỉ: 871 Trần Xuân Soạn, P. Tân Hưng, Quận 7, Tp.HCM
                    </address>
                    <p>
                        <i class="icon-phone"></i> Điện thoại: (+84) 28 3776 0648 <br>
                        <i class="icon-envelope-alt"></i> info@benhvientanhung.com
                    </p>
                </div>
            </div>
            @if (!$footerSlider->isEmpty())
            <div class="col-md-6">
                <div class="widget">
                    <h5 class="widgetheading">LIÊN KẾT HỢP TÁC</h5>
                    <div id="owl-footer" class="owl-carousel owl-theme">
                        @foreach($footerSlider as $item)
                        <div class="item">
                            <img
                                src="{{ URL::route('resizes', array('size' => 'bannerFooter', 'imagePath' => 'BVTH/bannerFooter/'.$item->image_file_name)) }}" />
                        </div>
                        @endforeach
                        <!-- <div class="item">
                            <img src="http://www.benhvientanhung.com/res/partner/benh-vien-cho-ray-2.png"
                                alt="benh-vien-cho-ray-2.png">
                        </div> -->
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div id="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="copyright">
                        <p>
                            <span>&copy; TAN HUNG HOSPITAL. </span> <a
                                href="http://daihuynhquang.com.vn/gioi-thieu.html" target="_blank">Thiết kế web</a> by
                            Đại Huỳnh Quang Computer
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="social-network">
                        <li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                        </li>
                        <li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>