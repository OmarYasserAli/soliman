<!-- User profile -->
<div class="user-profile">
    <!-- User profile image -->
    <div class="profile-img"> <img src="{{ url('favicon.png') }}" alt="Hello " /> </div>
    <!-- User profile text-->
    <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-animation="false" data-animation="false" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
        Hello {{auth()->user()->fname}} <span class="caret"></span></a>
        <div class="dropdown-menu">
            <a href="#" class="dropdown-item logout-hand" onclick=""><i class="fa fa-power-off"></i> Logout</a>

        </div>
    </div>
</div>
<!-- End User profile text-->
