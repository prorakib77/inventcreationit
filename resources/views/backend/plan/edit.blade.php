<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Plan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <form action="{{ route('plan.update', $plan) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="flex flex-col space-y-2">


                    <input type="text" placeholder="Plan Name" name="plan_name"
                        class="w-full input input-bordered input-accent"
                        value="{{ old('plan_name', $plan->plan_name) }}" />

                    @error('plan_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    <textarea class="w-full textarea  textarea-accent" placeholder="Plan details" name="plan_description" rows="3">{{ old('plan_description', $plan->plan_description) }}</textarea>
                    @error('plan_description')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    <input type="number" placeholder="Plan Price" name="plan_price"
                        class="w-full input input-bordered input-accent"
                        value="{{ old('plan_price', $plan->plan_price) }}" />
                    @error('plan_price')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror


                <div x-data="{ items: @js(old('plan_items', $plan->planItems->pluck('plan_item_name'))) }" class="space-y-2">
                    <template x-for="(item, index) in items" :key="index">
                        <div class="flex">
                            <input type="text" x-model="items[index]" name="plan_items[]" :placeholder="'Plan Item '"
                                class="w-full input input-bordered input-accent" :value="item">
                            <button type="button" x-on:click="items.splice(index, 1)"
                                    class="btn btn-error ml-2">Remove</button>
                        </div>
                    </template>
                    <button type="button" x-on:click="items.push('')" class="btn btn-primary">Add Plan Item</button>
                </div>
                @error('plan_items')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                <button class="btn btn-accent mt-2 w-full" type="submit">Update Plan</button>
            </form>
        </div>
    </div>
</x-app-layout>
