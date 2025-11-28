<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Registrar - Cartão de Visitas Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Crie sua conta para montar seu cartão de visitas online.">
    <link rel="icon" href="/favicon.ico">
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
                <a href="/" class="inline-flex items-center rounded-xl bg-gradient-to-tr from-amber-400 to-yellow-300 px-4 py-2 text-sm font-semibold text-slate-950 hover:brightness-95 transition">Voltar ao início</a>
            </nav>
        </div>
    </header>

    <!-- Conteúdo -->
    <main class="mx-auto max-w-7xl px-6 pt-12 pb-20">
        <section class="mx-auto max-w-md overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-2xl shadow-black/40">
            <div class="h-24 bg-gradient-to-tr from-amber-500/40 via-yellow-400/30 to-amber-200/10"></div>
            <div class="px-5 pb-6">
                <h1 class="mt-4 text-xl font-bold text-center">Criar conta</h1>
                <p class="mt-1 text-sm text-slate-300 text-center">Preencha seus dados para começar.</p>

                @if ($errors->any())
                    <div class="mt-4 rounded-xl border border-red-500/30 bg-red-500/10 p-3 text-sm text-red-200">
                        <strong>Corrija os erros abaixo.</strong>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.store') }}" class="mt-4 grid gap-3">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-200">Nome</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}"
                               class="mt-1 w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-400"
                               placeholder="Seu nome" required autofocus>
                        <div class="mt-1 text-xs text-slate-400">
                            Slug: <span id="slugPreview" class="font-mono text-slate-300">—</span>
                        </div>
                        @error('name')
                            <div class="mt-1 text-xs text-red-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-slate-200">Link</label>
                        <input id="slug" name="slug" type="text" value="{{ old('slug') }}"
                               class="mt-1 w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-400"
                               placeholder="Seu link" required autofocus>
                               <!-- <p class="mt-1 text-xs text-slate-400">Seu Link ficará Exemplo: https://card.you.tec.br/seu_nome</p> -->
                        @error('slug')
                            <div class="mt-1 text-xs text-red-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-200">E-mail</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                               class="mt-1 w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-400"
                               placeholder="email@exemplo.com" required>
                        @error('email')
                            <div class="mt-1 text-xs text-red-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-200">Senha</label>
                        <input id="password" name="password" type="password"
                               class="mt-1 w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-400"
                               placeholder="Mínimo 8 caracteres" required>
                        @error('password')
                            <div class="mt-1 text-xs text-red-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-200">Confirmar senha</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               class="mt-1 w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-400"
                               placeholder="Repita sua senha" required>
                    </div>

                    <button type="submit"
                            class="mt-2 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-tr from-amber-400 to-yellow-300 px-4 py-2 text-sm font-semibold text-slate-950 hover:brightness-95 transition">
                        Registrar
                    </button>

                    <p class="text-center text-xs text-slate-400">Já possui conta? Clique em “Entrar”.</p>
                </form>
            </div>
        </section>
    </main>

    <script>
        const nameInput = document.getElementById('name');
        const slugPreview = document.getElementById('slugPreview');

        function makeSlug(str) {
            return (str || '')
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // remove acentos
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '') // remove símbolos
                .trim()
                .replace(/\s+/g, '-')         // espaços -> "-"
                .replace(/-+/g, '-');         // colapsa múltiplos "-"
        }

        function updatePreview() {
            slugPreview.textContent = makeSlug(nameInput.value) || '—';
        }

        nameInput.addEventListener('input', updatePreview);
        updatePreview();
    </script>

    <!-- Footer -->
    <footer class="border-t border-white/10">
        <div class="mx-auto max-w-7xl px-6 py-6 text-center text-sm text-slate-300">
            © {{ date('Y') }} Cartão de Visitas Online — todos os direitos reservados.
        </div>
    </footer>
</body>
</html>