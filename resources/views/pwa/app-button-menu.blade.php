  <!-- App Bottom Menu -->
  <div class="appBottomMenu">
      @guest
          <a href="{{ route('home') }}" class="item ">
              <div class="col">
                  <ion-icon name="home-outline">
                      <i class="fas fa-home " aria-hidden="true"></i>
                  </ion-icon>
              </div>
          </a>

          @if (request()->segment(1) == 'courses')
              <a href="{{ route('courses') }}" class="item active" data-bs-toggle="tooltip" data-bs-placement="top"
                  title="" data-bs-original-title="دوره های آنلاین">
                  <div class="col">
                      <ion-icon name="layers-outline">
                          <i class="fas fa-user-graduate" aria-hidden="true"></i>
                      </ion-icon>
                  </div>
              </a>
          @else
              <a href="{{ route('courses') }}" class="item " data-bs-toggle="tooltip" data-bs-placement="top"
                  title="" data-bs-original-title="دوره های آنلاین">
                  <div class="col">
                      <ion-icon name="layers-outline">
                          <i class="fas fa-user-graduate" aria-hidden="true"></i>
                      </ion-icon>
                  </div>
              </a>
          @endif



          @if (request()->segment(1) == 'blogs')
              <a href="{{ route('blogs') }}" class="item active" data-bs-toggle="tooltip" data-bs-placement="top"
                  title="" data-bs-original-title="مقالات">
                  <div class="col">
                      <ion-icon name="layers-outline">
                          <i class="fas fa-newspaper" aria-hidden="true"></i>
                      </ion-icon>
                  </div>
              </a>
          @else
              <a href="{{ route('blogs') }}" class="item " data-bs-toggle="tooltip" data-bs-placement="top" title=""
                  data-bs-original-title="مقالات">
                  <div class="col">
                      <ion-icon name="layers-outline">
                          <i class="fas fa-newspaper" aria-hidden="true"></i>
                      </ion-icon>
                  </div>
              </a>
          @endif

      @endguest
      @auth
          @if (request()->segment(1) == '' || request()->segment(1) == '/')
              <a href="{{ route('home') }}" class="item active" data-bs-toggle="tooltip" data-bs-placement="top"
                  title="" data-bs-original-title="خانه">
                  <div class="col">
                      <ion-icon name="home-outline">
                          <i class="fas fa-home " aria-hidden="true"></i>
                      </ion-icon>
                  </div>
              </a>
          @else
              <a href="{{ route('home') }}" class="item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                  data-bs-original-title="خانه">
                  <div class="col">
                      <ion-icon name="home-outline">
                          <i class="fas fa-home " aria-hidden="true"></i>
                      </ion-icon>
                  </div>
              </a>
          @endif


          @if (request()->segment(1) == 'courses')
              <a href="{{ route('courses') }}" class="item active" data-bs-toggle="tooltip" data-bs-placement="top"
                  title="" data-bs-original-title="دوره های آنلاین">
                  <div class="col">
                      <ion-icon name="layers-outline">
                          <i class="fas fa-user-graduate" aria-hidden="true"></i>
                      </ion-icon>
                  </div>
              </a>
          @else
              <a href="{{ route('courses') }}" class="item " data-bs-toggle="tooltip" data-bs-placement="top"
                  title="" data-bs-original-title="دوره های آنلاین">
                  <div class="col">
                      <ion-icon name="layers-outline">
                          <i class="fas fa-user-graduate" aria-hidden="true"></i>
                      </ion-icon>
                  </div>
              </a>
          @endif



          @if (request()->segment(1) == 'blogs')
              <a href="{{ route('blogs') }}" class="item active" data-bs-toggle="tooltip" data-bs-placement="top"
                  title="" data-bs-original-title="مقالات">
                  <div class="col">
                      <ion-icon name="layers-outline">
                          <i class="fas fa-newspaper" aria-hidden="true"></i>
                      </ion-icon>
                  </div>
              </a>
          @else
              <a href="{{ route('blogs') }}" class="item " data-bs-toggle="tooltip" data-bs-placement="top"
                  title="" data-bs-original-title="مقالات">
                  <div class="col">
                      <ion-icon name="layers-outline">
                          <i class="fas fa-newspaper" aria-hidden="true"></i>
                      </ion-icon>
                  </div>
              </a>
          @endif



          <a href="#sidebarPanel" class="item" data-bs-toggle="offcanvas">
              <div class="col">
                  <ion-icon name="menu-outline">
                      <i class="fas fa-user " aria-hidden="true"></i>
                  </ion-icon>
              </div>
          </a>
      @endauth
  </div>
  <!-- * App Bottom Menu -->
