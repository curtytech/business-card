<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $user->name }}</title>
    <meta name="description" content="Cartão de visitas online de {{ $user->name }} com links e contatos.">
    <link rel="icon" href="/favicon.ico">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" crossorigin="anonymous" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-b from-slate-950 via-slate-900 to-slate-800 text-slate-100 font-sans">

    <!-- O main agora centraliza o card verticalmente -->
    <main class="flex-grow flex items-center justify-center px-6 py-10">
        <div class="w-full max-w-3xl overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-2xl shadow-black/40"
             style="--primary: {{ $user->primary_color ?: '#f59e0b' }}; --secondary: {{ $user->secondary_color ?: '#eab308' }};">
             
            <!-- Capa -->
            <div class="h-40 sm:h-48"
                 style="background:
                    radial-gradient(600px 140px at 20% 0%, color-mix(in oklab, var(--primary) 45%, transparent), transparent 60%),
                    radial-gradient(600px 140px at 80% 0%, color-mix(in oklab, var(--secondary) 40%, transparent), transparent 60%),
                    linear-gradient(135deg, #0b1224, #111827 60%, #1f2937);">
                @if($user->cover_image)
                    <img src="{{ asset('storage/' . $user->cover_image) }}"
                         alt="Capa de {{ $user->name }}"
                         class="h-full w-full object-cover mix-blend-luminosity">
                @endif
            </div>

            <!-- Corpo -->
            <div class="px-5 pb-6 text-center">
                <div class="-mt-12 mx-auto h-24 w-24 rounded-full border-4 border-white/50 bg-white/10 shadow-xl shadow-black/40 overflow-hidden z-10 animate-bounce"
                     style="animation-duration: 2s;">
                    @if($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}"
                             alt="Foto de {{ $user->name }}"
                             class="h-full w-full object-cover">
                    @else
                        <div class="h-full w-full bg-gradient-to-tr from-amber-400 to-yellow-300"></div>
                    @endif
                </div>

                <h1 class="mt-3 text-xl font-bold">{{ $user->name }}</h1>
                @if($user->position)
                    <p class="text-xs text-slate-300">{{ ucfirst($user->position) }}</p>
                @endif

                <!-- Links -->
                <div class="mt-5 grid gap-2">
                    @if($user->facebook)
                        <a href="{{ $user->facebook }}" target="_blank" rel="noopener"
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10 transition">
                            <i class="fa-brands fa-facebook-f text-white"></i>
                            Facebook
                        </a>
                    @endif

                    @if($user->instagram)
                        <a href="{{ $user->instagram }}" target="_blank" rel="noopener"
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10 transition">
                            <i class="fa-brands fa-instagram text-white"></i>
                            Instagram
                        </a>
                    @endif

                    @if($user->twitter)
                        <a href="{{ $user->twitter }}" target="_blank" rel="noopener"
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10 transition">
                            <i class="fa-brands fa-twitter text-white"></i>
                            Twitter/X
                        </a>
                    @endif

                    @if($user->linkedin)
                        <a href="{{ $user->linkedin }}" target="_blank" rel="noopener"
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10 transition">
                            <i class="fa-brands fa-linkedin-in text-white"></i>
                            LinkedIn
                        </a>
                    @endif

                    @if($user->whatsapp)
                        <a href="{{ str_starts_with($user->whatsapp, 'http') ? $user->whatsapp : 'https://wa.me/' . preg_replace('/\D+/', '', $user->whatsapp) }}"
                           target="_blank" rel="noopener"
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10 transition">
                            <i class="fa-brands fa-whatsapp text-white"></i>
                            WhatsApp
                        </a>
                    @endif

                    @if($user->phone)
                        <a href="tel:{{ preg_replace('/\D+/', '', $user->phone) }}"
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10 transition">
                            <i class="fa-solid fa-phone text-white"></i>
                            {{ $user->phone }}
                        </a>
                    @endif

                    @if(!empty($user->other_social_networks) && is_array($user->other_social_networks))
                        @foreach($user->other_social_networks as $label => $url)
                            @if(!empty($url))
                                <a href="{{ $url }}" target="_blank" rel="noopener"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10 transition">
                                    <i class="fa-solid fa-link text-white"></i>
                                    {{ $label }}
                                </a>
                            @endif
                        @endforeach
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
    </main>

    <!-- Rodapé agora fica logo abaixo do card -->
    <p class="pb-4 text-center text-xs text-slate-400">
        © {{ date('Y') }} Cartão de Visitas Online
    </p>
</body>
</html>
