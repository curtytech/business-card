<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $user->name }} — Cartão de Visitas</title>
    <meta name="description" content="Cartão de visitas online de {{ $user->name }} com links e contatos.">
    <link rel="icon" href="/favicon.ico">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-b from-slate-950 via-slate-900 to-slate-800 text-slate-100 font-sans">
    <main class="mx-auto max-w-3xl px-6 py-10">
        <div
            class="overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-2xl shadow-black/40"
            style="--primary: {{ $user->primary_color ?: '#f59e0b' }}; --secondary: {{ $user->secondary_color ?: '#eab308' }};"
        >
            <!-- Capa -->
            <div
                class="h-40 sm:h-48"
                style="background:
                    radial-gradient(600px 140px at 20% 0%, color-mix(in oklab, var(--primary) 45%, transparent), transparent 60%),
                    radial-gradient(600px 140px at 80% 0%, color-mix(in oklab, var(--secondary) 40%, transparent), transparent 60%),
                    linear-gradient(135deg, #0b1224, #111827 60%, #1f2937);"
            >
                @if($user->cover_image)
                    <img
                        src="{{ asset('storage/' . $user->cover_image) }}"
                        alt="Capa de {{ $user->name }}"
                        class="h-full w-full object-cover mix-blend-luminosity"
                    >
                @endif
            </div>

            <!-- Corpo -->
            <div class="px-5 pb-6 text-center">
                <div class="-mt-12 mx-auto h-24 w-24 rounded-full border border-white/20 bg-white/10 shadow-xl shadow-black/40 overflow-hidden">
                    @if($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}" alt="Foto de {{ $user->name }}" class="h-full w-full object-cover">
                    @else
                        <div class="h-full w-full bg-gradient-to-tr from-amber-400 to-yellow-300"></div>
                    @endif
                </div>

                <h1 class="mt-3 text-xl font-bold">{{ $user->name }}</h1>
                @if($user->template)
                    <p class="text-xs text-slate-300">Template: {{ ucfirst($user->template) }}</p>
                @endif

                <!-- Links -->
                <div class="mt-5 grid gap-2">
                    @if($user->facebook)
                        <a href="{{ $user->facebook }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10 transition">
                            <svg class="h-4 w-4 opacity-90" viewBox="0 0 24 24" fill="currentColor"><path d="M13 3h4a1 1 0 011 1v3h-4v3h4l-1 4h-3v7h-4v-7H8v-4h3V7a4 4 0 014-4z"/></svg>
                            Facebook
                        </a>
                    @endif

                    @if($user->instagram)
                        <a href="{{ $user->instagram }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10 transition">
                            <svg class="h-4 w-4 opacity-90" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm5 4a5 5 0 100 10 5 5 0 000-10zm6-1a1 1 0 100 2 1 1 0 000-2z"/></svg>
                            Instagram
                        </a>
                    @endif

                    @if($user->twitter)
                        <a href="{{ $user->twitter }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10 transition">
                            <svg class="h-4 w-4 opacity-90" viewBox="0 0 24 24" fill="currentColor"><path d="M22 5.8a7.5 7.5 0 01-2.2.6A3.8 3.8 0 0021.4 4a7.6 7.6 0 01-2.4.9 3.8 3.8 0 00-6.6 3.5A10.8 10.8 0 013 5a3.8 3.8 0 001.2 5A3.7 3.7 0 013 9.3v.1a3.8 3.8 0 003 3.7 3.8 3.8 0 01-1.7.1 3.8 3.8 0 003.6 2.7A7.6 7.6 0 013 18a10.7 10.7 0 005.8 1.7c7 0 10.8-5.9 10.8-11v-.5A7.8 7.8 0 0022 5.8z"/></svg>
                            Twitter/X
                        </a>
                    @endif

                    @if($user->linkedin)
                        <a href="{{ $user->linkedin }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10 transition">
                            <svg class="h-4 w-4 opacity-90" viewBox="0 0 24 24" fill="currentColor"><path d="M6 9h3v9H6zM7.5 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3zM11 9h3v1.5c.6-1.1 2.2-2 3.8-2 3 0 4.2 1.8 4.2 5.1V18h-3v-3.7c0-1.7-.6-2.6-2-2.6-1.4 0-2.2.9-2.2 2.6V18H11z"/></svg>
                            LinkedIn
                        </a>
                    @endif

                    @if($user->whatsapp)
                        <a href="{{ str_starts_with($user->whatsapp, 'http') ? $user->whatsapp : 'https://wa.me/' . preg_replace('/\D+/', '', $user->whatsapp) }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10 transition">
                            <svg class="h-4 w-4 opacity-90" viewBox="0 0 24 24" fill="currentColor"><path d="M20 3a9 9 0 00-15 10l-2 6 6-2a9 9 0 0011-14zM7 17l1.7-.6a7 7 0 11.6-10.6A7 7 0 017 17z"/></svg>
                            WhatsApp
                        </a>
                    @endif

                    @if($user->phone)
                        <a href="tel:{{ preg_replace('/\D+/', '', $user->phone) }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10 transition">
                            <svg class="h-4 w-4 opacity-90" viewBox="0 0 24 24" fill="currentColor"><path d="M6.6 10.8a15 15 0 006.6 6.6l2.2-2.2a1 1 0 011.1-.2 11.7 11.7 0 003.7.6 1 1 0 011 1v3.5a1 1 0 01-1 1A18.5 18.5 0 013 5a1 1 0 011-1h3.5a1 1 0 011 1 11.7 11.7 0 00.6 3.7 1 1 0 01-.2 1.1l-2.3 2z"/></svg>
                            {{ $user->phone }}
                        </a>
                    @endif
                </div>

                <!-- Endereço -->
                @if($user->address || $user->city || $user->state || $user->country || $user->zipcode)
                    <div class="mt-5 text-xs text-slate-300">
                        {{ $user->address }} {{ $user->number ? ', ' . $user->number : '' }}
                        {{ $user->neighborhood ? ' — ' . $user->neighborhood : '' }}<br>
                        {{ $user->city }}{{ $user->state ? ' - ' . $user->state : '' }}<br>
                        {{ $user->country }} {{ $user->zipcode ? ' • CEP: ' . $user->zipcode : '' }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Rodapé simples -->
        <p class="mt-6 text-center text-xs text-slate-400">
            © {{ date('Y') }} Cartão de Visitas Online
        </p>
    </main>
</body>
</html>