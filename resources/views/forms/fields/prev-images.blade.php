<div class="flex flex-wrap gap-2">
    @php
        $images = json_decode($getState(), true) ?? [];
    @endphp

    @forelse($images as $img)
        <img src="{{ asset('storage/' . $img['path']) }}" alt="{{ $img['filename'] }}"
            class="h-24 w-24 object-cover rounded-md shadow">

    @empty
        <p class="text-gray-500 text-sm">No images available.</p>
    @endforelse
</div>
