<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12 contact-area-center">
            <div class="contact-area-left">
                <div class="info-logo">
                    <a href="index">
                        <img class="logoDesktop"
                            src="{{ URL::route('resizes', array('size' => 'logoDesktop', 'imagePath' => 'frontEnd/img/logo.png')) }}" />
                        <img class="logoMobile"
                            src="{{ URL::route('resizes', array('size' => 'logoMobile', 'imagePath' => 'frontEnd/img/logo.png')) }}" />
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 contact-area-transform">
            <div class="contact-area-right">
                <ul>
                    <li><i class="fa fa-phone-square"></i>09 01 34 69 34</li>
                    <li><i class="fa fa-envelope-o"></i>info@benhvientanhung.com</li>
                </ul>
            </div>
        </div>
    </div>
</div>