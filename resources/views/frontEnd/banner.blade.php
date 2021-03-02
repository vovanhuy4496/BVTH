<?php
    use App\Models\AdBannerMain;
    $mainSlider = AdBannerMain::where('status', 1)->orderBy('sort')->get();
?>
@if (!$mainSlider->isEmpty())
<section id="featured">
    <!-- Slider -->
    <div id="main-slider" class="flexslider">
        <ul class="slides">
            @foreach($mainSlider as $item)
            <li>
                <img
                    src="{{ URL::route('resizes', array('size' => 'bannerMain', 'imagePath' => 'BVTH/bannerMain/'.$item->image_file_name)) }}" />
            </li>
            @endforeach
        </ul>
    </div>
    <!-- end slider -->
</section>
@endif