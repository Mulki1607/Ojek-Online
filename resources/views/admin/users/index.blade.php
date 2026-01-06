@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Manajemen User
        </h2>
        <p class="text-sm text-gray-400 mt-1">
            Kelola status akun pengguna aplikasi
        </p>
    </div>

    {{-- FLASH --}}
    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20
                    text-green-400 text-sm
                    px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-slate-900/70 backdrop-blur
                border border-white/10
                rounded-2xl overflow-x-auto">

        <table class="w-full text-sm">

            {{-- HEAD --}}
            <thead class="bg-white/5 text-gray-300 uppercase text-xs">
                <tr>
                    <th class="px-5 py-4 text-left">ID</th>
                    <th class="px-5 py-4 text-left">Nama</th>
                    <th class="px-5 py-4 text-left">Email</th>
                    <th class="px-5 py-4 text-left">Status</th>
                    <th class="px-5 py-4 text-left">Aksi</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody class="divide-y divide-white/10">

                @foreach($users as $user)
                <tr class="hover:bg-white/5 transition">

                    <td class="px-5 py-4 text-gray-400">
                        #{{ $user->id }}
                    </td>

                    <td class="px-5 py-4 text-white font-medium">
                        {{ $user->nama ?? $user->name }}
                    </td>

                    <td class="px-5 py-4 text-gray-400">
                        {{ $user->email }}
                    </td>

                    <td class="px-5 py-4">
                        @if($user->status === 'aktif')
                            <span class="px-3 py-1 rounded-full text-xs
                                         bg-green-500/20 text-green-400">
                                AKTIF
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs
                                         bg-red-500/20 text-red-400">
                                NONAKTIF
                            </span>
                        @endif
                    </td>

                    <td class="px-5 py-4">
                        <form method="POST"
                              action="{{ route('admin.users.toggle', $user->id) }}">
                            @csrf

                            <button
                                class="px-4 py-2 rounded-xl text-xs font-semibold transition
                                {{ $user->status === 'aktif'
                                    ? 'bg-red-600 hover:bg-red-700 text-white'
                                    : 'bg-green-600 hover:bg-green-700 text-white' }}">
                                {{ $user->status === 'aktif'
                                    ? 'Nonaktifkan'
                                    : 'Aktifkan' }}
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>
@endsection