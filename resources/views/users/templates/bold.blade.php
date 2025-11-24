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
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-b from-slate-950 via-slate-900 to-slate-800 text-slate-100 font-sans">

<main class="w-full max-w-5xl px-4 py-10">

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

    <!-- Cartão Horizontal -->
    <div class="flex flex-row w-full max-w-full overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-2xl shadow-black/40">

        <!-- Lado esquerdo: capa e avatar com aspect ratio -->
        <div class="relative w-1/3 min-w-[120px] aspect-[16/9] bg-gray-800">
            @if($user->cover_image)
                <img src="{{ asset('storage/' . $user->cover_image) }}"
                     alt="Capa de {{ $user->name }}"
                     class="absolute inset-0 w-full h-full object-cover mix-blend-luminosity">
            @else
                <div class="absolute inset-0 w-full h-full bg-gradient-to-tr from-amber-400 to-yellow-300"></div>
            @endif

            <!-- Avatar sobreposto -->
            <div class="absolute top-20 left-1/2 transform -translate-x-1/2 h-28 w-28 sm:h-36 sm:w-36 rounded-full border-4 border-white/50 bg-white/10 shadow-xl shadow-black/40 overflow-hidden">
                @if($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}"
                         alt="Foto de {{ $user->name }}"
                         class="h-full w-full object-cover">
                @else
                    <div class="h-full w-full bg-gradient-to-tr from-amber-400 to-yellow-300"></div>
                @endif
            </div>
        </div>

        <!-- Lado direito: informações e links -->
        <div class="flex-1 px-6 py-6 flex flex-col justify-between">

            <div class="mt-16 text-center sm:text-left">
                <!-- Nome -->
                <h1 class="text-2xl sm:text-3xl font-bold text-white drop-shadow-md">{{ $user->name }}</h1>

                <!-- Profissão -->
                @if($user->template)
                    <p class="text-sm sm:text-base text-white/80 drop-shadow-sm mt-1">Advogado</p>
                @endif

                <!-- Divisória sutil -->
                <div class="w-24 border-b border-gray-200 my-4"></div>

                <!-- Links visíveis -->
                <div class="flex flex-col gap-2 sm:gap-3">
                    @foreach($links as $item)
                        <a href="{{ $item['url'] }}" target="_blank"
                           class="flex items-center gap-3 sm:gap-4 bg-white/10 backdrop-blur-sm px-3 py-2 sm:px-4 sm:py-3 rounded-xl border border-white/20 text-gray-100 text-sm sm:text-lg hover:bg-white/20 hover:text-white transition">
                            {!! $item['icon'] !!}
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Botão salvar contato -->
            <div class="mt-4 sm:mt-6">
                <button class="w-full bg-black text-white py-3 sm:py-4 rounded-xl font-semibold text-sm sm:text-lg hover:bg-gray-900 transition">
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
