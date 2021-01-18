@extends("layouts.app")

@section("content")
    <div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
        <div class="text-center">
            <h1 class="mb-5">{{ __("Listado de empresas") }}</h1>
            <a href="{{ route("empresas.create") }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                {{ __("Crear empresa") }}
            </a>
        </div>
    </div>

    <table class="border-separate border-2 text-center border-gray-500 mt-3" style="width: 100%">
        <thead>
        <tr>
            <th class="px-4 py-2">{{ __("Nombre") }}</th>
            <th class="px-4 py-2">{{ __("Autor") }}</th>
            <th class="px-4 py-2">{{ __("Alta") }}</th>
            <th class="px-4 py-2">{{ __("Acciones") }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($empresas as $empresa)
            <tr>
                <td class="border px-4 py-2">{{ $empresa->name }}</td>
                <td class="border px-4 py-2">{{ $empresa->user->name }}</td>
                <td class="border px-4 py-2">{{ date_format($empresa->created_at, "d/m/Y") }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route("empresas.edit", ["empresa" => $empresa]) }}" class="text-blue-400">{{ __("Editar") }}</a> |
                    <a
                        href="#"
                        class="text-red-400"
                        onclick="event.preventDefault();
                            document.getElementById('delete-empresa-{{ $empresa->id }}-form').submit();"
                    >{{ __("Eliminar") }}
                    </a>
                    <form id="delete-empresa-{{ $empresa->id }}-form" action="{{ route("empresas.destroy", ["empresa" => $empresa]) }}" method="POST" class="hidden">
                        @method("DELETE")
                        @csrf
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    <div class="bg-red-100 text-center border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <p><strong class="font-bold">{{ __("No hay empresas") }}</strong></p>
                        <span class="block sm:inline">{{ __("Todavía no hay nada que mostrar aquí") }}</span>
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    @if($empresas->count())
        <div class="mt-3">
            {{ $empresas->links() }}
        </div>
    @endif
@endsection
