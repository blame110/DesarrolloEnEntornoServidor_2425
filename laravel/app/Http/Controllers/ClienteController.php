<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    /*
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
//Ruta para el borrado del cliente actual
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
//Ruta para cargar la vista de edicion del cliente seleccionado
Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
//Ruta para actualizar el cliente seleccionado
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
//Ruta para cargar la vista de insercino
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
//Ruta para insertar un nuevo cliente
Route::post('/clientes/store', [ClienteController::class, 'store'])->name('clientes.store');
*/

    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function destroy($id)
    {
        //Con find sacamos el cliente con el id que le introducimos de base de datos
        $cliente = Cliente::find($id);
        //Con el cliente recuperado lo borramos utilizando delete
        $cliente->delete();
        //Redireccionamos a la lista de clientes
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255|min:8',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:255',
            'direccion' => 'required|string|max:255|min:8'
        ]);

        //Guardamos los datos el cliente para obtener el nuevo id, sin la imagen
        $data = $request->except('imagen');

        if ($request->hasFile('imagen')) {

            //Eliminamos la imagen anterior
            if ($cliente->imagen) {
                Storage::disk('public')->delete($cliente->imagen);
            }

            //Definimos la ruta especifica para este cliente
            $carpetaCliente = 'imagenes/clientes/' . $cliente->id;

            //Guardamos la imagen en el hd y obtenemos la ruta completa
            $imagenPath = $request->file('imagen')->store($carpetaCliente, 'public');

            //Hay que añadir la ruta de la imagen a los datos que se van a 
            //insertar en bd
            $data['imagen'] = $imagenPath;
        }

        $cliente->update($data);



        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function create()
    {
        return view('clientes.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|min:8',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:255',
            'direccion' => 'required|string|max:255|min:8'
        ]);

        //Creamos el cliente para obtener el nuevo id, sin la imagen
        $cliente = Cliente::create($request->except('imagen'));

        //Si la request tiene un archivo llamado imagen
        if ($request->hasFile('imagen')) {

            //La ruta de la carpeta, unica para cada cliente
            $carpetaCliente = 'imagenes/clientes/' . $cliente->id;

            //Guardamos el archivo en el disco duro y obtenemos la ruta completa
            $imagePath = $request->file('imagen')->store($carpetaCliente, 'public');

            //Actualizamos el cliente con la nueva imagen
            $cliente->update(['imagen' => $imagePath]); //imagen = $imagePath;

        }

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }
}
