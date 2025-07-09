<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Master Menu</h2>
    </x-slot>

    <div class="p-4">
        <a href="{{ route('admin.menus.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Menu
        </a>

        <ul class="mt-4 space-y-2">
            @foreach($menus as $menu)
                <li class="bg-white p-4 shadow rounded flex justify-between items-center">
                    <div>
                        <strong>{{ $menu->name }}</strong><br>
                        <span class="text-sm text-gray-600">{{ $menu->url }} | Role: {{ $menu->roles->pluck('name')->implode(', ') }}</span>
                    </div>
                    <div class="space-x-2">
                        <a href="{{ route('admin.menus.edit', $menu) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin?')" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
