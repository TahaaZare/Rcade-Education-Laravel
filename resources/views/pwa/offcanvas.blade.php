<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarPanel">
    <div class="offcanvas-body">
        <!-- profile box -->
        @auth
            @php
                $user = auth()->user();
            @endphp
            <div class="profileBox">
                <div class="image-wrapper">
                    <img src="{{ asset($user->profile) }}" alt="{{ $user->username }}" class="imaged rounded">
                </div>
                <div class="in">
                    <strong aria-hidden="true">
                        {{ $user->display_name ?? $user->username }}
                    </strong>
                </div>
                <a href="#" class="close-sidebar-button" data-bs-dismiss="offcanvas">
                    <ion-icon name="close">
                        <i class="fas fa-close text-dark"></i>
                    </ion-icon>
                </a>
            </div>
        @endauth
        @guest
            <div class="profileBox">
                <div class="in">
                    <a class="text-dark" href="{{ route('loginForm') }}">
                        ورود به با شماره تماس</a>
                </div>
                <a href="#" class="close-sidebar-button" data-bs-dismiss="offcanvas">
                    <ion-icon name="close">
                        <i class="fas fa-close text-dark"></i>
                    </ion-icon>
                </a>
            </div>
        @endguest
        <!-- * profile box -->

        <ul class="listview flush transparent no-line image-listview mt-2">
            <li>
                <a href="{{ route('home') }}" class="item">
                    <div class="icon-box bg-primary">
                        <ion-icon name="home-outline">
                            <i class="fas fa-home" aria-hidden="true"></i>
                        </ion-icon>
                    </div>
                    <div class="in">
                        خانه
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('courses') }}" class="item">
                    <div class="icon-box bg-primary">
                        <ion-icon name="home-outline">
                            <i class="fas fa-user-graduate" aria-hidden="true"></i>
                        </ion-icon>
                    </div>
                    <div class="in">
                        دوره ها
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('blogs') }}" class="item">
                    <div class="icon-box bg-primary">
                        <ion-icon name="home-outline">
                            <i class="fas fa-newspaper" aria-hidden="true"></i>
                        </ion-icon>
                    </div>
                    <div class="in">
                        مقالات
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('about-us') }}" class="item">
                    <div class="icon-box bg-primary">
                        <ion-icon name="home-outline">
                            <i class="fas fa-user-friends" aria-hidden="true"></i>
                        </ion-icon>
                    </div>
                    <div class="in">
                        درباره مـا
                    </div>
                </a>
            </li>

            @auth
                @php
                    $user = auth()->user();
                @endphp
                @if ($user->user_type == 2)
                    <hr>
                    <li class="text-center">
                        <span class="badge bg-primary">
                            بخش ادمین
                        </span>
                    </li>
                    <li>
                        <a href="{{ route('admin.course.index', $user->username) }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="home-outline">
                                    <i class="fas fa-user-graduate" aria-hidden="true"></i>
                                </ion-icon>
                            </div>
                            <div class="in">
                                بخش دوره ها
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.blog.index', $user->username) }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="home-outline">
                                    <i class="fas fa-newspaper" aria-hidden="true"></i>
                                </ion-icon>
                            </div>
                            <div class="in">
                                بخش مقالات
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.faq.index', $user->username) }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="home-outline">
                                    <i class="fas fa-question" aria-hidden="true"></i>
                                </ion-icon>
                            </div>
                            <div class="in">
                                سوالات متداول
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.about.index', $user->username) }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="home-outline">
                                    <i class="fas fa-user-friends" aria-hidden="true"></i>
                                </ion-icon>
                            </div>
                            <div class="in">
                                درباره مـا
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.rule.index', $user->username) }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="home-outline">
                                    <i class="fas fa-user-friends" aria-hidden="true"></i>
                                </ion-icon>
                            </div>
                            <div class="in">
                                قوانین ثبت مدرس
                            </div>
                        </a>
                    </li>
                    <hr>
                @endif
            @endauth
        </ul>
    </div>
    @include('pwa.sidebar')
</div>
