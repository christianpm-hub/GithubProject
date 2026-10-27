@extends('template.base')

@section('content')

    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="{{ route('profesor.update', $profesor) }}" method="post">
                @method('put')
                @csrf
                {{-- SIEMPRE QUE NO SEA GET SE UTILIZA CSRF --}}

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" value="{{ old('nombre', $profesor->nombre) }}" class="form-control" id="nombre"
                        name="nombre" required maxlength="100" placeholder="Introduce el nombre del profesor">
                    @error('nombre')
                        <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" value="{{ old('apellidos', $profesor->apellidos) }}" class="form-control"
                        id="apellidos" name="apellidos" required maxlength="130"
                        placeholder="Introduce los apellidos del profesor">
                    @error('apellidos')
                        <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <select class="form-select" id="especialidad" name="especialidad">
                        <option value="" @selected(old('especialidad', $profesor->especialidad) == '')>Selecciona una opción
                        </option>
                        <option value="Informática" @selected(old('especialidad', $profesor->especialidad) == 'Informática')>
                            Informática</option>
                        <option value="Matemáticas" @selected(old('especialidad', $profesor->especialidad) == 'Matemáticas')>
                            Matemáticas</option>
                        <option value="Administración" @selected(old('especialidad', $profesor->especialidad) == 'Administración')>Administración
                        </option>
                        <option value="Laboratorio" @selected(old('especialidad', $profesor->especialidad) == 'Laboratorio')>
                            Laboratorio</option>
                        <option value="otro" @selected(old('especialidad', $profesor->especialidad) == 'otro')>Otro</option>
                    </select>
                    @error('especialidad')
                        <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="falta" class="form-label">Fecha de alta</label>
                    {{-- Cambiado name a "fnac" para coincidir con la BD --}}
                    <input type="date" value="{{ old('falta', $profesor->falta) }}" class="form-control" id="falta"
                        name="falta" max="{{ now()->format('Y-m-d') }}">
                    @error('falta')
                        <div class=" alert alert-danger" role="alert" style="margin-top: 6px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="salario" class="form-label">Salario</label>
                    {{-- Cambiado name a "nacceso" para coincidir con la BD --}}

                    <input type="number" value="{{ old('salario', $profesor->salario) }}" class="form-control" id="salario"
                        name="salario" min="0" max="1000000" step="0.01" required placeholder="Introduce el salario">
                    @error('salario')
                        <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-secondary">
                    Editar profesor
                </button>

            </form>
        </div>
    </div>

@endsection