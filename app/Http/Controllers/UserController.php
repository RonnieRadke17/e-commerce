<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtenemos los usuarios con sus roles asociados y los paginamos
        $users = User::with('role')->paginate(10);

        return view('users.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'paternal' => 'required|string|max:255',
            'maternal' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'gender' => 'required|in:M,F',
            'email' => 'required|email|unique:users,email,',
            'password' => 'nullable|min:8',
            'role_id' => 'required|exists:roles,id',
            'is_suspended' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = new User();
        $user->name = $request->name;
        $user->paternal = $request->paternal;
        $user->maternal = $request->maternal;
        $user->birthdate = $request->birthdate;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->password = base64_encode($request->password);
        $user->role_id = $request->role_id;
        $user->is_suspended = $request->is_suspended;
        $user->save();
        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');


    }

    /**
     * Display the specified resource.
     */
   public function show($encryptedId)
   {
        try {
            $id = Crypt::decryptString($encryptedId);
            $user = User::findOrFail($id);
            // Obtener los roles para el select
            $roles = Role::all(); // Asumiendo que tienes un modelo Role
            
            return view('users.show', compact('user','roles'));

        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Usuario no encontrado.');
        }
   }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $user = User::findOrFail(Crypt::decryptString($id));
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'paternal' => 'required|string|max:255',
            'maternal' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'gender' => 'required|in:M,F',
            'email' => 'required|email|unique:users,email,' . $id,//reviasr para que es .id
            'password' => 'nullable|min:8',
            'role_id' => 'required|exists:roles,id',
            'is_suspended' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);
        $user->fill($request->except('password'));
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($encryptedId)
    {
        try {
            // Desencripta el ID
            $id = Crypt::decryptString($encryptedId);
            
            // Busca y elimina el usuario
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            // En caso de error de desencriptación o usuario no encontrado
            return redirect()->route('users.index')->with('error', 'Hubo un error al eliminar el usuario.');
        }
    }
}
