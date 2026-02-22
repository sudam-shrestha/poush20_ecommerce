 <header class="border-b border-(--primary-color)/20 shadow-sm bg-white/80 backdrop-blur-sm sticky top-0 z-10">
     <div class="container mx-auto flex items-center justify-between py-3 md:py-4 flex-wrap gap-y-2">
         <!-- Logo & brand -->
         <a href="{{ route('home') }}" class="flex items-center gap-1">
             <i class="fa-solid fa-bag-shopping text-2xl"></i>
             <span class="font-bold text-xl tracking-tight text-(--primary-color)">Eco<span
                     class="text-(--secondary-color)">Cart</span></span>
         </a>

         <!-- Products link (desktop) + search + login, all in row -->
         <div class="flex items-center gap-4 md:gap-6 flex-wrap justify-end">
             <!-- Products nav -->
             <a href="#"
                 class="font-medium text-(--text-color) hover:text-(--secondary-color) transition flex items-center gap-1">
                 <i class="fa-solid fa-tag text-sm"></i>
                 <span>Products</span>
             </a>

             <!-- Search form (inline) -->
             <div class="relative hidden sm:block">
                 <form action="{{ route('products') }}" method="GET" class="flex items-center">
                     <input type="text" placeholder="Search..." name="q"
                         class="py-1.5 pl-3 pr-8 rounded-full text-sm border border-(--primary-color)/30 focus:outline-none focus:ring-2 focus:ring-(--secondary-color)/50 w-36 md:w-48 bg-white/90">
                     <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-(--primary-color)">
                         <i class="fa-solid fa-magnifying-glass"></i>
                     </button>
                 </form>
             </div>

             <!-- Login button (uses secondary as accent) -->
             @if (Auth::guard('web')->user())
                 <button id="profileButton" data-dropdown-toggle="profile"
                     class="flex items-center"
                     type="button">
                     <i class="fa-solid fa-circle-user"></i>
                     <svg class="w-4 h-4 ms-1.5 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         width="24" height="24" fill="none" viewBox="0 0 24 24">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="m19 9-7 7-7-7" />
                     </svg>
                 </button>

                 <!-- Dropdown menu -->
                 <div id="profile"
                     class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
                     <ul class="p-2 text-sm text-body font-medium" aria-labelledby="profileButton">
                         <li>
                             <a href="{{ route('carts') }}"
                                 class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Cart ({{ Auth::guard('web')->user()->carts()->count() }})</a>
                         </li>
                         <li>
                             <a href="{{ route('orders') }}"
                                 class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Orders</a>
                         </li>
                     </ul>
                 </div>
             @else
                 <a href="{{ route('login') }}"
                     class="flex items-center gap-1.5 bg-(--primary-color) text-white px-4 py-1.5 rounded-full text-sm font-medium hover:bg-(--secondary-color) transition-colors shadow-sm">
                     <i class="fa-regular fa-circle-user"></i>
                     <span>Login</span>
                 </a>
             @endif

             <!-- mobile search icon (visible only on smallest) -->
             <button class="sm:hidden text-(--primary-color) text-xl" aria-label="search">
                 <i class="fa-solid fa-magnifying-glass"></i>
             </button>
         </div>
     </div>
 </header>
