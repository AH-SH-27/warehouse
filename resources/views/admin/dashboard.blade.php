@section('title', 'Dashboard - ' . config('app.name', 'StockFlow'))
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Dashboard Statistics</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <div class="bg-blue-100 rounded-lg p-6 shadow-md">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-800 text-sm font-medium">Total Clients</p>
                                    <p class="text-blue-800 text-3xl font-bold">{{ $clients }}</p>
                                </div>
                                <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                        </div>
                        <div class="bg-green-100 rounded-lg p-6 shadow-md">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-green-800 text-sm font-medium">Total Vendors</p>
                                    <p class="text-green-800 text-3xl font-bold">{{ $vendors }}</p>
                                </div>
                                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        </div>
                        <div class="bg-purple-100 rounded-lg p-6 shadow-md">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-purple-800 text-sm font-medium">Total Admins</p>
                                    <p class="text-purple-800 text-3xl font-bold">{{ $admins }}</p>
                                </div>
                                <svg class="w-12 h-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                        </div>
                        <div class="bg-yellow-100 rounded-lg p-6 shadow-md">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-yellow-800 text-sm font-medium">Total Stores</p>
                                    <p class="text-yellow-800 text-3xl font-bold">{{ $stores }}</p>
                                </div>
                                <svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                        </div>
                        <div class="bg-red-100 rounded-lg p-6 shadow-md">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-red-800 text-sm font-medium">Total Products</p>
                                    <p class="text-red-800 text-3xl font-bold">{{ $products }}</p>
                                </div>
                                <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                        </div>
                        <div class="bg-indigo-100 rounded-lg p-6 shadow-md">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-indigo-800 text-sm font-medium">Total Orders</p>
                                    <p class="text-indigo-800 text-3xl font-bold">{{ $orders }}</p>
                                </div>
                                <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-white rounded-lg p-6 shadow-md">
                            <h3 class="text-xl font-semibold mb-4">Orders Summary</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">Orders Today:</span> {{ $ordersToday }}</p>
                                <p><span class="font-medium">Orders This Week:</span> {{ $ordersThisWeek }}</p>
                                <p><span class="font-medium">Orders This Month:</span> {{ $ordersThisMonth }}</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg p-6 shadow-md">
                            <h3 class="text-xl font-semibold mb-4">New This Month</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">New Stores:</span> {{ $newStoresThisMonth }}</p>
                                <p><span class="font-medium">New Clients:</span> {{ $newClientsThisMonth }}</p>
                                <p><span class="font-medium">New Vendors:</span> {{ $newVendorsThisMonth }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('admin.users') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            {{ __('Manage Users') }}
                        </a>
                        <a href="{{ route('admin.stores') }}" class="bg-violet-500 hover:bg-violet-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            {{ __('Manage Stores') }}
                        </a>
                        <a href="{{ route('admin.orders') }}" class="bg-fuchsia-500 hover:bg-fuchsia-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            {{ __('Manage Orders') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>