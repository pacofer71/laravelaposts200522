<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <form class="py-2 px-4 border rounded-2xl shadow-2xl bg-gray-200 w-1/2 mx-auto"
            action="{{ route('contacto.procesar') }}" method="POST">
            @csrf
            <x-jet-label for="email">Email de Contacto</x-jet-label>
            <x-jet-input type="email" value="{{auth()->user()->email}}" id="email" class="w-full" readonly />
            <x-jet-label for="contenido" class='mt-2'>Déjenos sus comentarios</x-jet-label>
            <textarea class="form-control w-full" name="contenido" id="contenido"></textarea>
            @error('contenido')
            <p class="my-2 text-red-700 text-sm">**** {{$message}}</p>
            @enderror
            <div class="mt-2 flex flex-row-reverse">

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-fw fa-paper-plane"></i>Enviar</button>
                <button type="reset"  class="mr-2 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-fw fa-broom"></i>Limpiar</button>
            </div>


        </form>
    </div>
</x-app-layout>
