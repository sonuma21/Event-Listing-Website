  <section>
      <div class="container mx-auto p-4">
          <h1 class="text-2xl font-bold mb-4">Select Your Favorite Event Categories</h1>
          <form action="{{ route('preferences.store') }}" method="POST" class="max-w-md">
              @csrf
              <div class="mb-4">
                  <label class="block text-gray-700 mb-2">Categories</label>
                  @foreach ($categories as $value => $label)
                      <div class="flex items-center mb-2">
                          <input type="checkbox" name="categories[]" value="{{ $value }}" class="mr-2"
                              {{ in_array($value, $userPreferences) ? 'checked' : '' }}>
                          <label>{{ $label }}</label>
                      </div>
                  @endforeach
                  @error('categories')
                      <p class="text-red-500 text-sm">{{ $message }}</p>
                  @enderror
              </div>
              <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                  Save and View Events
              </button>
          </form>
      </div>
  </section>
