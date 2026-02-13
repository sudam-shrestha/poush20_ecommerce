 <header class="border-b border-(--primary-color)/20 shadow-sm bg-white/80 backdrop-blur-sm sticky top-0 z-10">
     <div class="container mx-auto flex items-center justify-between py-3 md:py-4 flex-wrap gap-y-2">
         <!-- Logo & brand -->
         <div class="flex items-center gap-1">
             <i class="fa-solid fa-bag-shopping text-2xl"></i>
             <span class="font-bold text-xl tracking-tight text-(--primary-color)">Eco<span
                     class="text-(--secondary-color)">Cart</span></span>
         </div>

         <!-- Products link (desktop) + search + login, all in row -->
         <div class="flex items-center gap-4 md:gap-6 flex-wrap justify-end">
             <!-- Products nav -->
             <a href="#"
                 class="font-medium text-[color:var(--text-color)] hover:text-(--secondary-color) transition flex items-center gap-1">
                 <i class="fa-solid fa-tag text-sm"></i>
                 <span>Products</span>
             </a>

             <!-- Search form (inline) -->
             <div class="relative hidden sm:block">
                 <form action="#" method="GET" class="flex items-center">
                     <input type="text" placeholder="Search..."
                         class="py-1.5 pl-3 pr-8 rounded-full text-sm border border-(--primary-color)/30 focus:outline-none focus:ring-2 focus:ring-(--secondary-color)/50 w-36 md:w-48 bg-white/90">
                     <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-(--primary-color)">
                         <i class="fa-solid fa-magnifying-glass"></i>
                     </button>
                 </form>
             </div>

             <!-- Login button (uses secondary as accent) -->
             <a href="#"
                 class="flex items-center gap-1.5 bg-(--primary-color) text-white px-4 py-1.5 rounded-full text-sm font-medium hover:bg-(--secondary-color) transition-colors shadow-sm">
                 <i class="fa-regular fa-circle-user"></i>
                 <span>Login</span>
             </a>

             <!-- mobile search icon (visible only on smallest) -->
             <button class="sm:hidden text-(--primary-color) text-xl" aria-label="search">
                 <i class="fa-solid fa-magnifying-glass"></i>
             </button>
         </div>
     </div>
 </header>
