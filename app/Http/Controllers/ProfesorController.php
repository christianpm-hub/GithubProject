<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use \Exception;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfesorController extends Controller
{
    private const RULES = [
        'nombre' => 'required|string|max:100|min:2',
        'apellidos' => 'required|string|max:130|min:3',
        'fnac' => 'nullable|date|before_or_equal:today',
        'nacceso' => 'nullable|numeric|gte:0|lte:10|decimal:0,2',
        'genero' => 'nullable|in:masculino,femenino,otro'

    ];

    private const MESSAGES = [
        // Nombre
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.string' => 'El nombre debe ser una cadena de texto.',
        'nombre.max' => 'El nombre no puede superar los 100 caracteres.',
        'nombre.min' => 'El nombre debe tener al menos 2 caracteres.',

        // Apellidos
        'apellidos.required' => 'Los apellidos son obligatorios.',
        'apellidos.string' => 'Los apellidos deben ser una cadena de texto.',
        'apellidos.max' => 'Los apellidos no pueden superar los 130 caracteres.',
        'apellidos.min' => 'Los apellidos deben tener al menos 3 caracteres.',

        // Fecha de nacimiento
        'fnac.date' => 'La fecha de nacimiento debe ser una fecha válida.',
        'fnac.before_or_equal' => 'La fecha de nacimiento no puede ser posterior a hoy.',

        // Nota de acceso
        'nacceso.numeric' => 'La nota de acceso debe ser un valor numérico.',
        'nacceso.gte' => 'La nota de acceso no puede ser inferior a 0.',
        'nacceso.lte' => 'La nota de acceso no puede ser superior a 10.',
        'nacceso.decimal' => 'La nota de acceso debe tener como máximo 2 decimales.',

        // Género
        'genero.in' => 'El género debe ser masculino, femenino u otro.',
    ];
    public function create(): View
    {
        return view('profesor.create', []);
    }

    public function destroy(Profesor $profesor): RedirectResponse
    { 
        try {
            $profesor->delete();
            } catch (Exception $e) {
            return back()->withErrors(['error' => 'Error al borrar el profesor',]);
        }
        return redirect()->route('profesor.index')->with(['success' => 'Se ha borrado el profesor correctamente']);
    }

    public function edit(Profesor $profesor): View
    {
        return view('profesor.edit', ['profesor' => $profesor]);
    }

    public function index(): View
    {
        //$profesor = 'select * from profesor';
        $profesores = Profesor::all();
        //dd($profesor);
        return view('profesor.index', ['profesores' => $profesores]);
    }

    public function show(Profesor $profesor): View
    {
        //dd($profesor);

        return view('profesor.show', ['profesor' => $profesor]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), self::RULES, self::MESSAGES);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $profesor = new Profesor($request->all());
        try {
            $profesor->save();
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors([
                'error' => 'Clave única duplicada.',
                //'nombre'     => 'Este campo forma parte de la clave única.', 
                //'apellidos'  => 'Este campo también forma parte de la clave única.',
            ]);
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Error al crear el profesor',]);
        }
        /*session(['success' => 'Se ha creado el alumno correctamente']);*/
        return redirect()->route('profesor.index')->with(['success' => 'Se ha creado el profesor correctamente']);
    }

    public function update(Request $request, Profesor $profesor): RedirectResponse
    {
        $validator = Validator::make($request->all(), self::RULES, self::MESSAGES);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        try {
            $profesor->update($request->all());
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors(['error' => 'Clave única duplicada.',]);
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Error al editar el profesor',]);
        }
        return redirect()->route('profesor.index');
    }
}
