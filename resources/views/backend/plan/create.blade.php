<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Plan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <form action="{{ route('plan.create') }}" method="POST">
            @csrf


            <input type="text" placeholder="Plan Name" name="plan_name" class="w-full max-w-xs input input-bordered input-accent" />
            <input type="number" placeholder="Plan Price" name="plan_Price" class="w-full max-w-xs input input-bordered input-accent" />
            <input type="text" placeholder="Plan Name" name="plan_Price" class="w-full max-w-xs input input-bordered input-accent" />


            <button type="submit">Add</button>
            
            </form>
        </div>
    </div>
</x-app-layout>