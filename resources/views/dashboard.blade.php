<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Hello, {{ Auth::user()->name }}!</h3>
                    <p class="mb-4">{{ __("You're logged in!") }} Your current access role is: <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs font-semibold uppercase">{{ Auth::user()->role->value }}</span></p>
                    <p class="text-sm text-gray-500">Standard users do not have access to the Admin Dashboard at `/admin/dashboard`.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
