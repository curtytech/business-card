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
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-b from-slate-950 via-slate-900 to-slate-800 text-slate-100 font-sans">

<main class="mx-auto max-w-3xl px-6 py-10">

    <div class="md:min-w-xl overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-2xl shadow-black/40"
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

            <!-- Avatar -->
            <div class="-mt-12 mx-auto h-36 w-36 rounded-full border-4 border-white/50 bg-white/10 shadow-xl shadow-black/40 overflow-hidden z-10 animate-bounce"
                 style="animation-duration: 2s;">
                @if($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}"
                         alt="Foto de {{ $user->name }}"
                         class="h-full w-full object-cover ">
                @else
                    <div class="h-full w-full bg-gradient-to-tr from-amber-400 to-yellow-300"></div>
                @endif
            </div>

            <!-- Nome -->
            <h1 class="mt-3 text-2xl font-bold">{{ $user->name }}</h1>

            @if($user->template)
                <p class="text-sm text-slate-300">Template: {{ ucfirst($user->template) }}</p>
            @endif


            <!-- Links -->
            @php
                $links = [];

                if (!empty($user->facebook)) {
                    $links[] = [
                        'url' => $user->facebook,
                        'icon' => '<i class="fa-brands fa-facebook-f text-white"></i>',
                        'label' => 'Facebook',
                    ];
                }
                if (!empty($user->instagram)) {
                    $links[] = [
                        'url' => $user->instagram,
                        'icon' => '<i class="fa-brands fa-instagram text-white"></i>',
                        'label' => 'Instagram',
                    ];
                }
                if (!empty($user->twitter)) {
                    $links[] = [
                        'url' => $user->twitter,
                        'icon' => '<i class="fa-brands fa-twitter text-white"></i>',
                        'label' => 'Twitter/X',
                    ];
                }
                if (!empty($user->linkedin)) {
                    $links[] = [
                        'url' => $user->linkedin,
                        'icon' => '<i class="fa-brands fa-linkedin-in text-white"></i>',
                        'label' => 'LinkedIn',
                    ];
                }
                if (!empty($user->whatsapp)) {
                    $wa = str_starts_with($user->whatsapp, 'http')
                        ? $user->whatsapp
                        : 'https://wa.me/' . preg_replace('/\D+/', '', $user->whatsapp);

                    $links[] = [
                        'url'  => $wa,
                        'icon' => '<i class="fa-brands fa-whatsapp text-white"></i>',
                        'label' => 'WhatsApp',
                    ];
                }
                if (!empty($user->phone)) {
                    $links[] = [
                        'url' => 'tel:' . preg_replace('/\D+/', '', $user->phone),
                        'icon' => '<i class="fa-solid fa-phone text-white"></i>',
                        'label' => $user->phone,
                    ];
                }

                if (!empty($user->other_social_networks) && is_array($user->other_social_networks)) {
                    foreach ($user->other_social_networks as $label => $url) {
                        if (!empty($url)) {
                            $links[] = [
                                'url' => $url,
                                'icon' => '<svg class="h-4 w-4 opacity-90" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2.5 7-6-4.5-6 4.5 2.5-7L2 9h7z" /></svg>',
                                'label' => $label,
                            ];
                        }
                    }
                }

                $count = count($links);
                $cols = max(1, min(3, $count));
            @endphp

            @if($count > 0)
                <div class="mt-6"
                     style="display: grid; gap: 2rem; grid-template-columns: repeat({{ $cols }}, 62px); justify-content: center;">

                    @foreach($links as $item)
                        <a href="{{ $item['url'] }}" target="_blank" rel="noopener"
                           class="flex items-center justify-center rounded-xl border border-white/30 bg-transparent p-4
                                  hover:bg-white/10 transition"
                           style="width: 62px; height: 62px">
                            <span class="text-2xl opacity-90">{!! $item['icon'] !!}</span>
                        </a>
                    @endforeach

                </div>
            @endif


            <!-- Botão WhatsApp -->
            @php
                $whatsappLink = null;

                if (!empty($user->whatsapp)) {
                    $phone = preg_replace('/\D+/', '', $user->whatsapp);
                    $whatsappLink = "https://wa.me/{$phone}?text=" . urlencode("Olá! Gostaria de agendar um horário.");
                }
            @endphp

            @if($whatsappLink)
                <a href="{{ $whatsappLink }}" target="_blank"
                   class="mt-5 mx-auto flex items-center justify-center
                          rounded-xl border border-white/40 px-4 py-2.5
                          text-[13px] font-semibold text-white transition hover:bg-white/10"
                   style="width: 250px">
                    AGENDE UM HORÁRIO
                </a>
            @endif


            <!-- Endereço -->
        <div class="mt-6 flex flex-col items-center text-center border rounded-xl border-white/20 bg-white/5 px-4 py-3">
            <div class="flex items-center gap-2 text-lg font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M12 11.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M19 10.5c0 7.5-7 11.5-7 11.5S5 18 5 10.5a7 7 0 1114 0z" />
                </svg>
                Estrada São Francisco, 1824
            </div>
            <p class="text-slate-300 text-center">Bairro Goya (Guia de Pacobaíba)</p>
            <p class="text-slate-300 text-center">Magé – RJ • Brasil CEP: 25925-240</p>
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
