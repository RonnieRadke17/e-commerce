<!-- resources/views/categories/form.blade.php -->

<div class="mb-4">
    <label for="name" class="block text-gray-700">Nombre:</label>
    <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}" 
           class="w-full border-gray-300 rounded p-2 @error('name') border-red-500 @enderror">
    @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="description" class="block text-gray-700">Descripción:</label>
    <textarea name="description" id="description" rows="3" 
              class="w-full border-gray-300 rounded p-2 @error('description') border-red-500 @enderror">{{ old('description', $category->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
