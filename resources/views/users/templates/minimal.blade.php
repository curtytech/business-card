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

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
          integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Ajuste específico para mobile */
        @media (max-width: 640px) {
            .card-mobile {
                width: 95%;
                max-width: 420px; /* ajuste conforme desejar */
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-b from-slate-950 via-slate-900 to-slate-800 text-slate-100 font-sans">

<main class="mx-auto w-full sm:max-w-3xl px-2 sm:px-6 py-10">

 <div class="card-mobile sm:w-auto md:min-w-xl mx-auto overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-2xl shadow-black/40"
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

   <!-- Avatar (estático, sempre em primeiro plano) -->
<div class="-mt-12 mx-auto h-36 w-36 rounded-full border-4 border-white/50 bg-white/10 shadow-xl shadow-black/40 overflow-hidden relative z-20">
    @if($user->image)
        <img src="{{ asset('storage/' . $user->image) }}"
             alt="Foto de {{ $user->name }}"
             class="h-full w-full object-cover">
    @else
        <div class="h-full w-full bg-gradient-to-tr from-amber-400 to-yellow-300"></div>
    @endif
</div>

    <!-- Nome -->
    <h1 class="text-2xl font-bold text-white drop-shadow-md mt-3">{{ $user->name }}</h1>

    <!-- Profissão -->
    @if($user->template)
         <p class="text-base text-white/80 drop-shadow-sm mt-1">Advogado</p>
    @endif

    <!-- DIVISÓRIA SUTIL -->
    <div class="w-20 mx-auto border-b border-gray-200 my-4"></div>

  <!-- LINKS VISÍVEIS -->
<div class="flex flex-col gap-2 w-full mx-auto">

    @php
        $links = [];

        if (!empty($user->facebook)) {
            $links[] = [
                'url' => $user->facebook,
                'icon' => '<i class="fa-brands fa-facebook-f text-2xl"></i>',
                'label' => 'Facebook',
            ];
        }
        if (!empty($user->instagram)) {
            $links[] = [
                'url' => $user->instagram,
                'icon' => '<i class="fa-brands fa-instagram text-2xl"></i>',
                'label' => 'Instagram',
            ];
        }
        if (!empty($user->twitter)) {
            $links[] = [
                'url' => $user->twitter,
                'icon' => '<i class="fa-brands fa-twitter text-2xl"></i>',
                'label' => 'Twitter/X',
            ];
        }
        if (!empty($user->linkedin)) {
            $links[] = [
                'url' => $user->linkedin,
                'icon' => '<i class="fa-brands fa-linkedin-in text-2xl"></i>',
                'label' => 'LinkedIn',
            ];
        }
        if (!empty($user->whatsapp)) {
            $wa = str_starts_with($user->whatsapp, 'http')
                ? $user->whatsapp
                : 'https://wa.me/' . preg_replace('/\D+/', '', $user->whatsapp);
            $links[] = [
                'url' => $wa,
                'icon' => '<i class="fa-brands fa-whatsapp text-2xl"></i>',
                'label' => 'WhatsApp',
            ];
        }
    @endphp

    @foreach($links as $item)
        <a href="{{ $item['url'] }}" target="_blank"
           class="flex items-center gap-4 bg-white/10 backdrop-blur-sm px-4 py-3 rounded-xl border border-white/20 text-gray-100 text-lg hover:bg-white/20 hover:text-white transition">
            {!! $item['icon'] !!}
            <span>{{ $item['label'] }}</span>
        </a>
    @endforeach

</div>

    <!-- BOTÃO SALVAR CONTATO -->
    <div class="mt-8">
        <button class="w-full bg-black text-white py-4 rounded-xl font-semibold text-lg hover:bg-gray-900 transition">
            SALVAR CONTATO
        </button>
    </div>

</div>

    </div>

    <!-- Rodapé -->
    <p class="mt-6 text-center text-xs text-slate-400">
        © {{ date('Y') }} Cartão de Visitas Online
    </p>

</main>

</body>
</html>
