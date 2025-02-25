<x-app-layout>
    <!-- HERO SECTION -->
    <section class="hero-section flex flex-col justify-center items-center text-5xl" style="background-image: url('{{ asset('storage/website_images/hero-img.jpg') }}'); height: 100dvh; width: 100%; background-attachment: fixed; background-repeat: no-repeat; background-size: cover;">
        <div class="h-full w-full flex flex-col items-center justify-center bg-gradient-to-r from-white/10 via-white/40 to-white/10 text-blue-950 rounded-lg px-10 py-5 shadow-lg gap-5">
            <h1 class="font-bold">Vault</h1>
            <p class="text-center font-semibold">Secure, Robust, Trustful <br />Warehouse</p>
        </div>
    </section>

    <section class="w-full min-h-screen bg-gray-50 pt-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center justify-center gap-8 lg:gap-12">
                <div class="w-full lg:w-1/2 flex justify-center">
                    <div class="relative w-full max-w-md aspect-w-4 aspect-h-3 rounded-lg shadow-lg overflow-hidden">
                        <img
                            src="{{ asset('storage/website_images/about-img.jpg') }}"
                            class="object-cover object-center w-full h-full"
                            alt="About Us Image" />
                    </div>
                </div>
                <div class="w-full lg:w-1/2 bg-white/90 backdrop-blur-sm rounded-lg shadow-lg p-8 lg:p-12">
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">About Us</h1>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        This warehouse is great... Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <x-nav-link href="#" class="mt-8 inline-block font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out">
                        Learn More
                    </x-nav-link>
                </div>
            </div>
        </div>
    </section>


    @if ($randomStores->isNotEmpty())
    <section class="bg-red-100">
        <h1>Best Stores</h1>
        <div>
            @foreach ($randomStores as $store)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('storage/' . $store->image) }}"
                    class="w-full h-48 object-cover"
                    alt="{{ $store->name }} Image">
                <div class="p-4">
                    <h4 class="text-xl font-bold mb-2">
                        <a href="{{ route('public.store.products', ['store' => $store->id]) }}"
                            class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ $store->name }}
                        </a>
                    </h4>
                    <p class="text-gray-600 text-sm mb-4">{{ $store->description }}</p>
                    <a href="{{ route('public.store.products', ['store' => $store->id]) }}"
                        class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition duration-300">
                        View Products
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif


    <section class="w-full py-16 bg-gradient-to-b from-gray-700 from-1%  via-gray-100 via-98% to-gray-400 to-1%">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-white mb-6">Our Services</h2>
            <hr class="bg-blue-500 h-1 w-1/5 flex mx-auto mb-12" />
            <div class="flex flex-wrap justify-center gap-6">
                <div class="bg-white rounded-lg shadow-lg p-6 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl max-w-sm w-full">
                    <div class="flex flex-col items-center">
                        <div class="flex items-center gap-5">
                            <svg class="w-16 h-16 text-blue-500 mb-4 drop-shadow-2xl" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Manage Your Store Easily</h3>
                        </div>
                        <p class="text-gray-600 text-center">Effortlessly add, update, and organize products with our simple and intuitive store management system.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl max-w-sm w-full">
                    <div class="flex flex-col items-center">
                        <div class="flex items-center gap-5">
                            <svg class="w-16 h-16 text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Robust Analytics</h3>
                        </div>
                        <p class="text-gray-600 text-center">Gain valuable insights with detailed sales reports and customer analytics to grow your business efficiently.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl max-w-sm w-full">
                    <div class="flex flex-col items-center">
                        <div class="flex items-center gap-5">
                            <svg class="w-16 h-16 text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">24/7 Support</h3>
                        </div>
                        <p class="text-gray-600 text-center">Our dedicated support team is available anytime to assist you with any issues or questions you may have.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl max-w-sm w-full">
                    <div class="flex flex-col items-center">
                        <div class="flex items-center gap-5">
                            <svg class="w-16 h-16 text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Customizable Solutions</h3>
                        </div>
                        <p class="text-gray-600 text-center">Tailor the system to fit your business needs with customizable features and integrations.</p>
                    </div>
                </div>
            </div>


        </div>
    </section>
</x-app-layout>