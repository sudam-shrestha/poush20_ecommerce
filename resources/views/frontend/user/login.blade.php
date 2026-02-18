<x-frontend-layout>
    <div
        class="min-h-screen flex items-center justify-center px-5 py-12 md:py-20 bg-gradient-to-br from-gray-50 to-gray-100">

        <div class="w-full max-w-md">

            <!-- Card with subtle glass effect + gradient border -->
            <div
                class="relative bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-(--primary-color)/15 overflow-hidden">

                <!-- Top gradient accent bar -->
                <div class="h-2 bg-gradient-to-r from-(--primary-color) to-(--secondary-color)"></div>

                <div class="p-8 md:p-10">

                    <!-- Logo / Brand (simple version) -->
                    <div class="text-center mb-8">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-(--primary-color) to-(--secondary-color) text-white text-3xl font-bold shadow-lg">
                            EC
                        </div>
                        <h1 class="mt-4 text-3xl font-bold text-(--primary-color) tracking-tight">
                            Welcome back
                        </h1>
                        <p class="mt-2 text-(--text-color)/70">
                            Sign in to continue shopping
                        </p>
                    </div>

                    <!-- Only Google login option -->
                    <div class="space-y-6">

                        <a href="{{ route('google.redirect') }}"
                            class="flex items-center justify-center gap-4 w-full bg-white border border-gray-300 hover:border-(--secondary-color) hover:shadow-md text-gray-800 font-medium py-4 px-6 rounded-xl transition-all duration-200 group">
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.51h5.84c-.25 1.31-.98 2.42-2.07 3.16v2.63h3.35c1.96-1.81 3.1-4.47 3.1-7.8z"
                                    fill="#4285F4" />
                                <path
                                    d="M12 23c2.97 0 5.46-1.01 7.28-2.73l-3.35-2.63c-1.01.68-2.29 1.08-3.93 1.08-3.02 0-5.58-2.04-6.49-4.79H.96v2.67C2.77 20.39 6.62 23 12 23z"
                                    fill="#34A853" />
                                <path
                                    d="M5.51 14.21c-.23-.68-.36-1.41-.36-2.21s.13-1.53.36-2.21V7.34H.96C.35 8.85 0 10.39 0 12s.35 3.15.96 4.66l4.55-2.45z"
                                    fill="#FBBC05" />
                                <path
                                    d="M12 4.98c1.64 0 3.11.56 4.27 1.66l3.19-3.19C17.46 1.01 14.97 0 12 0 6.62 0 2.77 2.61 0.96 6.34l4.55 2.45C6.42 6.02 8.98 4.98 12 4.98z"
                                    fill="#EA4335" />
                            </svg>
                            <span class="text-base">Continue with Google</span>
                        </a>

                        <!-- Guest continue link -->
                        <a href="{{ route('products') }}"
                            class="block text-center text-(--secondary-color) hover:text-(--primary-color) font-medium transition">
                            Browse without signing in →
                        </a>

                    </div>

                </div>

                <!-- Bottom subtle footer -->
                <div
                    class="px-8 py-5 bg-(--bg-color)/40 border-t border-(--primary-color)/10 text-center text-xs text-(--text-color)/60">
                    By continuing, you agree to our
                    <a href="#" class="text-(--secondary-color) hover:underline">Terms</a> &
                    <a href="#" class="text-(--secondary-color) hover:underline">Privacy Policy</a>
                </div>

            </div>

            <!-- Extra trust signals or decoration below card -->
            <div class="mt-8 text-center text-sm text-(--text-color)/60 flex flex-wrap justify-center gap-x-6 gap-y-2">
                <span class="flex items-center gap-1.5">
                    <i class="fa-solid fa-lock text-(--secondary-color)"></i>
                    Secure login
                </span>
                <span class="flex items-center gap-1.5">
                    <i class="fa-solid fa-shield-halved text-(--secondary-color)"></i>
                    Privacy protected
                </span>
            </div>

        </div>
    </div>
</x-frontend-layout>
