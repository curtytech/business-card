<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cartão de Visitas Online</title>
    <meta name="description" content="Crie seu cartão de visitas online com links personalizados — moderno, comercial e fácil de compartilhar.">
    <link rel="icon" href="/favicon.ico">

    <!-- Fonte: Instrument Sans -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-b from-slate-950 via-slate-900 to-slate-800 text-slate-100 font-sans selection:bg-amber-400 selection:text-slate-950">
    <!-- Glow decorativo -->
    <div class="pointer-events-none fixed inset-0 -z-10">
        <div class="absolute left-1/2 top-[-10%] h-[40rem] w-[40rem] -translate-x-1/2 rounded-full bg-amber-400/10 blur-3xl"></div>
        <div class="absolute right-[-10%] bottom-[-10%] h-[30rem] w-[30rem] rounded-full bg-yellow-300/10 blur-2xl"></div>
    </div>

    <!-- Header -->
    <header class="sticky top-0 z-20 border-b border-white/10 backdrop-blur-md">
        <div class="mx-auto max-w-7xl px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tr from-amber-400 to-yellow-300 shadow-lg shadow-amber-400/20">
                    <i class="fa-solid fa-id-card text-black"></i>
                </span>
                <span class="text-lg font-bold tracking-tight">Cartão de Visitas Online</span>
            </a>
            <nav class="flex items-center gap-2">
                <a href="/admin/login" class="inline-flex items-center rounded-xl px-4 py-2 text-sm font-semibold text-slate-100 ring-1 ring-white/15 hover:ring-white/25 transition">Entrar</a>
                <a href="/admin" class="inline-flex items-center rounded-xl bg-gradient-to-tr from-amber-400 to-yellow-300 px-4 py-2 text-sm font-semibold text-slate-950 hover:brightness-95 transition">Criar meu cartão</a>
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="mx-auto max-w-7xl px-6 pt-16 pb-8 text-center animate-pulse">
        <h1 class="mx-auto max-w-4xl text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight">
            <span class="bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-300 bg-clip-text text-transparent">
                Seu cartão de visitas online, moderno e comercial
            </span>
        </h1>
        <p class="mx-auto mt-4 max-w-3xl text-base sm:text-lg text-slate-300">
            Centralize seus links, redes sociais, contato e endereço em um único cartão de visitas online,
            com personalização de cores, imagem e capa — similar ao Linktree, com foco no seu negócio.
        </p>
        <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
            <a href="/admin" class="inline-flex items-center rounded-xl bg-gradient-to-tr from-amber-400 to-yellow-300 px-5 py-3 text-sm font-semibold text-slate-950 hover:brightness-95 transition">Começar agora</a>
            <a href="#preview" class="inline-flex items-center rounded-xl px-5 py-3 text-sm font-semibold text-slate-100 ring-1 ring-white/15 hover:ring-white/25 transition">Ver exemplo</a>
        </div>
    </section>

    <!-- Features -->
    <section class="mx-auto max-w-7xl px-6 py-10">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="group rounded-2xl border border-white/10 bg-white/5 p-5 shadow-xl shadow-black/30 hover:bg-white/7 transition">
                <div class="mb-3 inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-400/20 text-amber-300">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2l3 7h7l-5.5 4 2.5 7-6-4.5-6 4.5 2.5-7L2 9h7z" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold">Links Personalizados</h3>
                <p class="mt-1 text-sm text-slate-300">Adicione e organize seus links de negócios e redes sociais.</p>
            </div>

            <div class="group rounded-2xl border border-white/10 bg-white/5 p-5 shadow-xl shadow-black/30 hover:bg-white/7 transition">
                <div class="mb-3 inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-400/20 text-amber-300">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 3a9 9 0 100 18 9 9 0 000-18zm-1 13l-4-4 1.41-1.41L11 12.17l4.59-4.58L17 9z" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold">Imagem e Capa</h3>
                <p class="mt-1 text-sm text-slate-300">Use foto de perfil e capa para destacar sua marca.</p>
            </div>

            <div class="group rounded-2xl border border-white/10 bg-white/5 p-5 shadow-xl shadow-black/30 hover:bg-white/7 transition">
                <div class="mb-3 inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-400/20 text-amber-300">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 3h14a2 2 0 012 2v4H3V5a2 2 0 012-2zm-2 8h18v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6z" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold">Cores do Cartão</h3>
                <p class="mt-1 text-sm text-slate-300">Defina cor primária e secundária para combinar com seu visual.</p>
            </div>

            <div class="group rounded-2xl border border-white/10 bg-white/5 p-5 shadow-xl shadow-black/30 hover:bg-white/7 transition">
                <div class="mb-3 inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-400/20 text-amber-300">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21 8V7l-3 2-2-1-4 3-3-2-4 3v6h16V8z" />
                        <path d="M5 8l7-5 7 5" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold">Contato e Endereço</h3>
                <p class="mt-1 text-sm text-slate-300">Telefone, endereço, cidade, estado, país e CEP.</p>
            </div>

            <div class="group rounded-2xl border border-white/10 bg-white/5 p-5 shadow-xl shadow-black/30 hover:bg-white/7 transition">
                <div class="mb-3 inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-400/20 text-amber-300">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-5 0-9 2.5-9 5.5V22h18v-2.5C21 16.5 17 14 12 14z" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold">Redes Sociais</h3>
                <p class="mt-1 text-sm text-slate-300">Facebook, Instagram, Twitter/X, LinkedIn e WhatsApp.</p>
            </div>

            <div class="group rounded-2xl border border-white/10 bg-white/5 p-5 shadow-xl shadow-black/30 hover:bg-white/7 transition">
                <div class="mb-3 inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-400/20 text-amber-300">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M4 6h16v12H4z" />
                        <path d="M9 6v12" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold">Templates</h3>
                <p class="mt-1 text-sm text-slate-300">Escolha entre Padrão, Moderno e Clássico.</p>
            </div>
        </div>
    </section>

    <!-- Preview do Cartão -->
    <section id="preview" class="mx-auto max-w-7xl px-6 pb-20">
        <div class="mx-auto max-w-md overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-2xl shadow-black/40">
            <div
                class="h-40 sm:h-48"
                style="background:
                    radial-gradient(600px 140px at 20% 0%, color-mix(in oklab, var(--primary) 45%, transparent), transparent 60%),
                    radial-gradient(600px 140px at 80% 0%, color-mix(in oklab, var(--secondary) 40%, transparent), transparent 60%),
                    linear-gradient(135deg, #0b1224, #111827 60%, #1f2937);">
                <img
                    src="{{ asset('img/tecnology.jpg') }}"
                    alt="Capa"
                    class="h-full w-full object-cover mix-blend-luminosity">
            </div>

            <div class="px-5 pb-5 text-center">
                <div class="-mt-10 mx-auto h-20 w-20 rounded-full border border-white/20 animate-bounce">
                     <img
                    src="{{ asset('img/IProf.jpg') }}"
                    alt="Capa"
                    class="h-full w-full rounded-full object-cover mix-blend-luminosity">
                </div>
                <h4 class="mt-3 text-lg font-bold">Phelipe Curty</h4>
                <p class="text-sm text-slate-300">Desenvolvedor</p>

                <div class="mt-4 grid gap-2">
                    <a href="https://phelipecurty.vercel.app" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10 hover:-translate-y-0.5 transition">
                        <i class="fa-solid fa-globe text-white"></i>
                        Site Oficial
                    </a>
                    <a href="https://www.instagram.com/phelipecurty" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10 hover:-translate-y-0.5 transition">
                        <i class="fa-solid fa-globe text-white"></i>
                        Instagram
                    </a>
                    <a href="https://www.linkedin.com/in/phelipecurty/" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10 hover:-translate-y-0.5 transition">
                        <i class="fa-brands fa-linkedin text-black"></i>
                        LinkedIn
                    </a>
                    <a href="#" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10 hover:-translate-y-0.5 transition">
                        <i class="fa-brands fa-whatsapp text-black"></i>
                        WhatsApp
                    </a>
                </div>

                <p class="mt-3 text-xs text-slate-400">Exemplo ilustrativo de cartão com links</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-white/10">
        <div class="mx-auto max-w-7xl px-6 py-6 text-center text-sm text-slate-300">
            © {{ date('Y') }} -
            <a href="https://phelipecurty.vercel.app" target="_blank">Phelipe Curty
            </a>
        </div>
    </footer>
</body>

</html>