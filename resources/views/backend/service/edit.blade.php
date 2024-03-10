<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="flex flex-col space-y-2">
                    <input type="text" placeholder="Plan Name" name="service_name"
                        class="w-full input input-bordered input-accent" value="{{ $service->service_name }}">
                    @error('service_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    <textarea class="w-full textarea  textarea-accent" placeholder="Plan details" name="service_description" rows="3">{{ $service->service_description }}</textarea>
                    @error('service_description')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    <input type="file" name="service_image" class="w-full input input-bordered input-accent">
                    @error('service_image')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror


                    <div x-data="{ packages: @json($service->packages) }" class="space-y-2">

                        <template x-for="(package, index) in packages.slice(1)" :key="index">
                            <div class="flex">
                                <input type="text" x-model="packages[index].name" name="package_name[]"
                                    :placeholder="'Package Name'" class="w-full input input-bordered input-accent">

                                <div class="w-4"></div>

                                <input type="number" x-model="packages[index].price" name="package_price[]"
                                    :placeholder="'Package Price'" class="w-full input input-bordered input-accent">

                                <button type="button" x-on:click="packages.splice(index, 1)"
                                    class="btn btn-error ml-2">Remove</button>
                            </div>
                        </template>

                        <button type="button" x-on:click="packages.push({name: '', price: ''})"
                            class="btn btn-primary">Add
                            Package</button>
                    </div>

                    @error('packages')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                </div>


                <button class="btn btn-accent mt-2 w-full" type="submit">Update Plan</button>

            </form>
        </div>
    </div>
</x-app-layout>
