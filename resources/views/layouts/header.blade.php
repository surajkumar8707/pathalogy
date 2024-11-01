<header id="luxbar" class="luxbar-fixed">
    <input type="checkbox" class="luxbar-checkbox" id="luxbar-checkbox" />
    <div class="luxbar-menu luxbar-menu-right luxbar-menu-light">
        <div class="container">
            <ul class="luxbar-navigation">
                <li class="luxbar-header">
                    <!--    <a href="#" class="luxbar-brand">LUXBAR</a> -->
                    <a href="index.html" class="luxbar-brand">
                        <img src="{{ public_asset($settings->header_image) }}" alt="" />
                    </a>
                    <label class="luxbar-hamburger luxbar-hamburger-doublespin" id="luxbar-hamburger"
                        for="luxbar-checkbox">
                        <span></span>
                    </label>
                </li>
                <li class="luxbar-item {{ isActiveRoute('front.home') }}">
                    <a href="{{ route('front.home') }}">HOME</a>
                </li>
                <li class="luxbar-item  {{ isActiveRoute('front.gallery') }}">
                    <a href="{{ route('front.gallery') }}">GALLERY</a>
                </li>

                <li class="luxbar-item  {{ isActiveRoute('front.contact') }}">
                    <a href="{{ route('front.contact') }}">CONTACT US</a>
                </li>
                <li style="margin: 0px 10px;">
                    <a class="button button-nav is-danger" href="{{ route('admin.login.form') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</header>
