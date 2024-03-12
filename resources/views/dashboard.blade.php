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
                    <a href="{{ route('single_order') }}" class="btn btn-outline btn-primary">Single Order</a>
                    <a href="{{ route('plan_order.all') }}" class="btn btn-outline btn-secondary">Plan Order</a>
                    <a href="{{ route('trail_order') }}" class="btn btn-outline btn-accent">Trail Order</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
