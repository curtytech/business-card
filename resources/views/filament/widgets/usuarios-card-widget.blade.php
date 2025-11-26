<x-filament::section>
    <div class="flex items-center gap-3">
        <div class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-tr from-red-400 to-yellow-300 shadow-lg">
            <span class="flex items-center justify-center h-8 w-8 rounded-full bg-primary-600">
                <x-filament::icon icon="heroicon-o-user" class="h-5 w-5 text-white" />
            </span>
        </div>
        <div>
            <h2 class="text-lg font-bold">Editar meu cartão de visitas online</h2>
            <p class="text-sm text-slate-500">Atualize suas informações, fotos e cores do seu cartão.</p>
        </div>
    </div>
    <div class="mt-4 flex items-center gap-2 mt-2">
        <x-filament::button tag="a" href="/admin/users/{{ auth()->user()->id }}/edit">Editar Cartão</x-filament::button>
        <x-filament::button tag="a" href="{{ route('users.show', ['user' => auth()->user()->slug]) }}" color="gray">Ver minha página</x-filament::button>
    </div>
</x-filament::section>