<div class="mb-4">
    <label for="name" class="block text-gray-700">Nombre de la Marca:</label>
    <input type="text" name="name" id="name" class="form-input mt-1 block w-full" value="{{ old('name', $brand->name ?? '') }}" required>
    @error('name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="category_id" class="block text-gray-700">Categoría:</label>
    <select name="category_id" id="category_id" class="form-select mt-1 block w-full" required>
        <option value="">Seleccione una categoría</option>
        @foreach($categories as $category)
            <option value="{{ Crypt::encryptString($category->id) }}" 
                {{ old('category_id', $brand->category_id ?? '') == Crypt::encryptString($category->id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
