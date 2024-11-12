
<!-- Nombre -->
<div class="mb-4">
    <label for="name" class="text-gray-600 font-semibold">Nombre:</label>
    <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" class="w-full border-gray-300 rounded-lg" />
    @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Apellido Paterno -->
<div class="mb-4">
    <label for="paternal" class="text-gray-600 font-semibold">Apellido Paterno:</label>
    <input type="text" name="paternal" id="paternal" value="{{ old('paternal', $user->paternal ?? '') }}" class="w-full border-gray-300 rounded-lg" />
    @error('paternal')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Apellido Materno -->
<div class="mb-4">
    <label for="maternal" class="text-gray-600 font-semibold">Apellido Materno:</label>
    <input type="text" name="maternal" id="maternal" value="{{ old('maternal', $user->maternal ?? '') }}" class="w-full border-gray-300 rounded-lg" />
    @error('maternal')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Fecha de Nacimiento -->
<div class="mb-4">
    <label for="birthdate" class="text-gray-600 font-semibold">Fecha de Nacimiento:</label>
    <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate', $user->birthdate ?? '') }}" class="w-full border-gray-300 rounded-lg" />
    @error('birthdate')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Género -->
<div class="mb-4">
    <label for="gender" class="text-gray-600 font-semibold">Género:</label>
    <select name="gender" id="gender" class="w-full border-gray-300 rounded-lg">
        <option value="M" {{ old('gender', $user->gender ?? '') == 'M' ? 'selected' : '' }}>Hombre</option>
        <option value="F" {{ old('gender', $user->gender ?? '') == 'F' ? 'selected' : '' }}>Mujer</option>
    </select>
    @error('gender')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Email -->
<div class="mb-4">
    <label for="email" class="text-gray-600 font-semibold">Email:</label>
    <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" class="w-full border-gray-300 rounded-lg" />
    @error('email')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Contraseña -->
<div class="mb-4">
    <label for="password" class="text-gray-600 font-semibold">Contraseña:</label>
    <div class="relative">
        <input type="password" name="password" id="password" class="w-full border-gray-300 rounded-lg pr-10" />
        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 px-3 text-gray-500">
            <i id="password-icon" class="fas fa-eye"></i>
        </button>
    </div>
    @error('password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Rol -->
<div class="mb-4">
    <label for="role_id" class="text-gray-600 font-semibold">Rol:</label>
    <select name="role_id" id="role_id" class="w-full border-gray-300 rounded-lg">
        @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id ?? '') == $role->id ? 'selected' : '' }}>
                {{ $role->name }}
            </option>
        @endforeach
    </select>
    @error('role_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Estatus de Suspensión -->
<div class="mb-4">
    <label for="is_suspended" class="text-gray-600 font-semibold">Estatus:</label>
    <select name="is_suspended" id="is_suspended" class="w-full border-gray-300 rounded-lg">
        <option value="0" {{ old('is_suspended', $user->is_suspended ?? '') == 0 ? 'selected' : '' }}>Activo</option>
        <option value="1" {{ old('is_suspended', $user->is_suspended ?? '') == 1 ? 'selected' : '' }}>Suspendido</option>
    </select>
    @error('is_suspended')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById("password");
        const icon = document.getElementById("password-icon");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.replace("fa-eye", "fa-eye-slash");
        } else {
            passwordInput.type = "password";
            icon.classList.replace("fa-eye-slash", "fa-eye");
        }
    }
</script>
