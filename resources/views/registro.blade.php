@extends('layout')

@section('content')

<div class="max-w-md mx-auto min-h-screen bg-white shadow-lg overflow-hidden border-x border-gray-100 pb-24">
    <div class="bg-blue-600 text-white px-6 pt-10 pb-6 rounded-b-3xl">
        <p class="text-sm opacity-80">Registrar atendimento</p>
        <h1 class="text-2xl font-bold mt-1">Novo Registro</h1>
    </div>

    @if($errors->any())
        <div style="background-color: #fee2e2; border: 1px solid #fecaca; color: #dc2626; padding: 10px; margin: 10px 0; border-radius: 5px;">
            <strong>Ops! Verifique os erros abaixo:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/registro" method="POST" class="p-6 space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Escola</label>

            <select name="school_id" required class="w-full rounded-2xl bg-slate-100 border-0 px-4 py-4 outline-none cursor-pointer">
                <option value="">Selecione uma escola...</option>

                @foreach($schools as $school)
                    <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>
                        {{ $school->name }}
                    </option>
                @endforeach
            </select>

            @error('school_id')
            <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Perfil</label>
            <select name="profile" class="w-full rounded-2xl bg-slate-100 border-0 px-4 py-4 outline-none" required>
                <option value="">Selecione</option>
                <option value = "Diretor" {{old ('profile') == 'Diretor' ? 'selected' : ''}}>Diretor</option>
                <option value = "Secretaria" {{old ('profile') == 'Secretaria' ? 'selected' : ''}}>Secretaria</option>
                <option value = "Professor" {{old ('profile') == 'Professor' ? 'selected' : ''}}>Professor</option>
            </select>

            @error('profile') <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Módulo</label>
            <select name="module" class="w-full rounded-2xl bg-slate-100 border-0 px-4 py-4 outline-none" required>
                <option value="">Selecione</option>
                <option value="Notas" {{old ('module') == 'Notas' ? 'selected' : ''}}>Notas</option>
                <option value="Boletim" {{old ('module') == 'Boletim' ? 'selected' : ''}}>Boletim</option>
                <option value="Frequência" {{old ('module') == 'Frequência' ? 'selected' : ''}}>Frequência</option>
            </select>
            @error('module') <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Descrição</label>
            <textarea name="description" rows="4" class="w-full rounded-2xl bg-slate-100 border-0 px-4 py-4 outline-none" placeholder="Descreva o atendimento" required>{{ old('description') }}</textarea>
            @error('description') <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-2xl">
            Salvar
        </button>
    </form>


</div>
@endsection
