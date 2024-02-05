<div class="col-md-12 mt-5 mb-2">
    <h1>SEO Tools</h1>
</div>

{{-- TWITTER TITLE AND DESCRIPTION --}}
<div class="col-md-12">
    <x-input title="Meta Title" name="meta_title" id="meta_title" arval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('meta_title', 'ar') : '' !!}" enval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('meta_title', 'en') : '' !!}" />
</div>

<div class="col-md-12">
    <x-input title="Meta Description" name="meta_description" id="meta_description" arval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('meta_description', 'ar') : '' !!}" enval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('meta_description', 'en') : '' !!}" />
</div>

<div class="col-md-12">
    <hr>
</div>


{{-- OPEN GRAPH INPUTS --}}
<div class="col-md-12">
    <x-input title="Open Graph Type" name="og_type" id="og_type" arval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('og_type', 'ar') : '' !!}" enval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('og_type', 'en') : '' !!}" />
</div>

<div class="col-md-12">
    <x-input title="Open Graph Title" name="og_title" id="og_title" arval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('og_title', 'ar') : '' !!}" enval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('og_title', 'en') : '' !!}" />
</div>

<div class="col-md-12">
    <x-input title="Open Graph URL" name="og_url" id="og_url" arval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('og_url', 'ar') : '' !!}" enval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('og_url', 'en') : '' !!}" />
</div>

<div class="col-md-12">
    <x-input title="Open Graph Description" name="og_description" id="og_description" arval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('og_description', 'ar') : '' !!}" enval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('og_description', 'en') : '' !!}" />
    {{-- <x-textarea title="Open Graph Description" name="og_description" id="og_description" arval="{!! @$result->breif->ar !!}" enval="{!! @$result->breif->en !!}" /> --}}
</div>

<div class="col-md-12">
    <x-image title="Open Graph Image" name="og_image" id="og_image" val="{!! !empty($img=@$result->seotool->og_image) ? $img : '' !!}" />
</div>


<div class="col-md-12">
    <hr>
</div>


{{-- TWITTER INPUTS --}}
<div class="col-md-12">
    <x-input title="Twitter Card" name="twitter_card" id="twitter_card" arval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('twitter_card', 'ar') : '' !!}" enval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('twitter_card', 'en') : '' !!}" />
</div>

<div class="col-md-12">
    <x-input title="Twitter Title" name="twitter_title" id="twitter_title" arval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('twitter_title', 'ar') : '' !!}" enval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('twitter_title', 'en') : '' !!}" />
</div>

<div class="col-md-12">
    <span class="text-info">Please add @ prefix before twitter site</span>
    <x-input title="Twitter Site" name="twitter_site" id="twitter_site" arval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('twitter_site', 'ar') : '' !!}" enval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('twitter_site', 'en') : '' !!}" />
</div>

<div class="col-md-12">
    <x-input title="Twitter Description" name="twitter_description" id="twitter_description" arval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('twitter_description', 'ar') : '' !!}" enval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('twitter_description', 'en') : '' !!}" />
</div>

<div class="col-md-12">
    <x-image title="Twitter Image" name="twitter_image" id="twitter_image" val="{!! !empty($img=@$result->seotool->twitter_image) ? $img : '' !!}" />
</div>

<div class="col-md-12">
    <x-input title="Twitter Image Alt" name="twitter_image_alt" id="twitter_image_alt" arval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('twitter_image_alt', 'ar') : '' !!}" enval="{!! isset($result) && isset($result->seotool) ? @$result->seotool->getSeoToolAttributeValue('twitter_image_alt', 'en') : '' !!}" />
</div>


<div class="col-md-12 my-5"></div>
