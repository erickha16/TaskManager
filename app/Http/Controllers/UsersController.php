<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Se muestra una lista de los usuarios (Usado en la API).
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Crea un nuevo usuario.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        // Si la validación falla, redirigir de nuevo con los errores
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // Si la validación es exitosa, crear el usuario
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        //Redirigir al usuario a la página de inicio de sesión con un mensaje de éxito
        return redirect()->route('welcome')->with('success', 'Usuario creado exitosamente');
    }

    /**
     * Muestra un usuario específico (Usado en la API).
     */
    public function show(string $id)
    {
        //
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


/* 
    public function login(Request $request){
        try {
            // Validación mejorada
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]);

            // Buscar usuario directamente (más eficiente)
            $user = User::where('email', $validated['email'])->first();

            // Verificar credenciales
            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Credenciales inválidas'
                ], 401);
            }

            // Crear token
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user->only(['id', 'name', 'email'])
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error en el servidor',
                'error' => env('APP_DEBUG') ? $e->getMessage() : null
            ], 500);
        }
    }
 */

    // Función para autenticar al usuario
    // Esta función se encarga de autenticar al usuario utilizando el email y la contraseña proporcionados.
    public function login(Request $request){
        // Validar los datos de entrada
        // Se asegura de que el email y la contraseña sean requeridos y cumplan con los criterios especificados.
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Intentar autenticar al usuario utilizando las credenciales proporcionadas
        if (Auth::attempt($validated)) {
            // Si la autenticación es exitosa, regenerar el token de sesión
            return redirect()->route('welcome');
        }

        // Si la autenticación falla, redirigir de nuevo con un mensaje de error
        return back()->withErrors(['email' => 'The provided credentials are incorrect.']);
    }



    
     // Cierra la sesión del usuario (revoca el token actual)
    public function logout(Request $request){
        // Revocar el token actual
        Auth::logout();

        // Eliminar la sesión del usuario
        session()->invalidate();
        session()->regenerateToken();

        // Redirigir al usuario a la página de inicio de sesión
        return redirect()->route('login');
    }


}
