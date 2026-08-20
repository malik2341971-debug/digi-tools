<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-red-500">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Hello, {{ Auth::user()->name }}!</h3>
                    <p class="mb-4">Welcome to the administration panel. You have access to this page because your role is: <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-semibold uppercase">{{ Auth::user()->role->value }}</span></p>
                    
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <h4 class="font-semibold text-gray-700">Total Users</h4>
                            <p class="text-3xl font-extrabold mt-2 text-gray-900">2</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <h4 class="font-semibold text-gray-700">Database</h4>
                            <p class="text-lg font-bold mt-2 text-green-600">SQLite (Connected)</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <h4 class="font-semibold text-gray-700">Access Level</h4>
                            <p class="text-lg font-bold mt-2 text-red-600">Full Administrator</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
