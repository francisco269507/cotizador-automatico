<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Quote;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Dashboard principal
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalQuotes = Quote::count();
        $recentQuotes = Quote::with('user')->latest()->take(10)->get();
        
        return view('admin.dashboard', compact('totalUsers', 'totalQuotes', 'recentQuotes'));
    }

    // Lista de usuarios
    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    // Formulario crear usuario
    public function createUser()
    {
        return view('admin.users.create');
    }

    // Guardar nuevo usuario
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:superadmin,admin,user'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role']
        ]);

        return redirect()->route('admin.users')->with('success', 'Usuario creado exitosamente');
    }

    // Formulario editar usuario
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Actualizar usuario
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:superadmin,admin,user'
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'Usuario actualizado exitosamente');
    }

    // Eliminar usuario
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        
        // No permitir que se elimine a sí mismo
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users')->with('error', 'No puedes eliminarte a ti mismo');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Usuario eliminado exitosamente');
    }

    // Lista de cotizaciones
    public function quotes()
    {
        $quotes = Quote::with('user')->latest()->paginate(15);
        return view('admin.quotes.index', compact('quotes'));
    }

    // Ver detalle de cotización
    public function showQuote($id)
    {
        $quote = Quote::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.quotes.show', compact('quote'));
    }

    // Lista de productos
    public function products()
    {
        $products = Product::latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    // Formulario editar producto
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // Actualizar producto
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|in:PEN,USD',
            'duration' => 'nullable|string|max:100',
            'billing' => 'nullable|string|max:100',
            'details' => 'nullable|string',
            'active' => 'required|boolean'
        ]);

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Producto actualizado exitosamente');
    }

    // Activar/desactivar producto
    public function toggleProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->active = !$product->active;
        $product->save();

        $status = $product->active ? 'activado' : 'desactivado';
        return redirect()->route('admin.products')->with('success', "Producto {$status} exitosamente");
    }

    // Configuración general
    public function settings()
    {
        $settings = [
            'terms' => Setting::get('terms', 'Condiciones y términos de servicio'),
            'bank_name' => Setting::get('bank_name', ''),
            'bank_account' => Setting::get('bank_account', ''),
            'bank_cci' => Setting::get('bank_cci', ''),
            'company_name' => Setting::get('company_name', 'Hyperzas'),
        ];

        return view('admin.settings', compact('settings'));
    }

    // Actualizar configuración
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'terms' => 'required|string',
            'bank_name' => 'required|string|max:255',
            'bank_account' => 'required|string|max:255',
            'bank_cci' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings')->with('success', 'Configuración actualizada exitosamente');
    }
}
