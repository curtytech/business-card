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

                <!-- Nome -->
                <h1 class="mt-3 text-2xl font-bold">{{ $user->name }}</h1>

                @if($user->position)
                <p class="text-xs text-slate-300">{{ ucfirst($user->position) }}</p>
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
                'url' => $wa,
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
                'icon' => '<i class="fa-solid fa-link text-white"></i>',
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

                @if (empty($user->whatsapp))
                <!-- <a href="{{ $whatsappLink }}" target="_blank"
                    class="mt-5 mx-auto flex items-center justify-center
                          rounded-xl border border-white/40 px-4 py-2.5
                          text-[13px] font-semibold text-white transition hover:bg-white/10"
                    style="width: 250px">
                    AGENDE UM HORÁRIO
                </a> -->
                @endif


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

        <!-- Rodapé -->
        <p class="mt-6 text-center text-xs text-slate-400">
            © {{ date('Y') }} Cartão de Visitas Online
        </p>

    </main>

</body>

</html>