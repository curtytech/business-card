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
        <div id="businessCardCapture" class="w-full max-w-3xl overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-2xl shadow-black/40"
            style="--primary: {{ $user->primary_color ?: '#f59e0b' }}; --secondary: {{ $user->secondary_color ?: '#eab308' }};">

            <!-- Capa -->
            <div class="h-40 sm:h-48"
                style="background:
                    radial-gradient(600px 140px at 20% 0%, color-mix(in oklab, var(--primary) 45%, transparent), transparent 60%),
                    radial-gradient(600px 140px at 80% 0%, color-mix(in oklab, var(--secondary) 40%, transparent), transparent 60%),
                    linear-gradient(135deg, #0b1224, #111827 60%, #1f2937);">
                @if($user->cover_image)
                <img src="{{ asset('storage/' . $user->cover_image) }}"
                    crossorigin="anonymous"
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
                        crossorigin="anonymous"
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

                @if (!empty($user->description))
                <section class="mt-5 grid">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-2 shadow-xl shadow-black/30 prose prose-invert">
                        {!! $user->description !!}
                    </div>
                </section>
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

                    <div class="mt-2 grid gap-2 sm:grid-cols-2">
                        <button id="downloadImageBtn" type="button"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10 hover:-translate-y-0.5 transition">
                            <i class="fa-solid fa-image text-white"></i>
                            Baixar imagem
                        </button>

                        <button id="downloadVideoBtn" type="button"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10 hover:-translate-y-0.5 transition">
                            <i class="fa-solid fa-film text-white"></i>
                            Baixar video curto
                        </button>

                        <button id="shareStoryBtn" type="button"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10 hover:-translate-y-0.5 transition">
                            <i class="fa-solid fa-share-nodes text-white"></i>
                            Compartilhar story
                        </button>

                        <button id="copyLinkBtn" type="button"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10 hover:-translate-y-0.5 transition">
                            <i class="fa-solid fa-link text-white"></i>
                            Copiar link
                        </button>
                    </div>

                    <p id="shareFeedback" class="text-xs text-slate-300"></p>

                    @guest
                    <a href="/" class=" cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10 hover:-translate-y-0.5 transition">
                        <span class=" animate-bounce inline-flex items-center justify-center gap-2">
                            <i class="fa-solid fa-id-card text-white"></i>
                            Crie seu cartão agora mesmo!
                        </span>
                    </a>
                    @endguest
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

    <script src="https://cdn.jsdelivr.net/npm/html-to-image@1.11.11/dist/html-to-image.min.js"></script>
    <script>
        const cardEl = document.getElementById('businessCardCapture');
        const downloadImageBtn = document.getElementById('downloadImageBtn');
        const downloadVideoBtn = document.getElementById('downloadVideoBtn');
        const shareStoryBtn = document.getElementById('shareStoryBtn');
        const copyLinkBtn = document.getElementById('copyLinkBtn');
        const shareFeedback = document.getElementById('shareFeedback');
        const actionButtons = [downloadImageBtn, downloadVideoBtn, shareStoryBtn, copyLinkBtn].filter(Boolean);
        const baseFileName = '{{ \Illuminate\Support\Str::slug($user->name ?: "cartao") }}';

        function setFeedback(message, isError = false) {
            if (!shareFeedback) {
                return;
            }

            shareFeedback.textContent = message;
            shareFeedback.className = isError ? 'text-xs text-red-300' : 'text-xs text-slate-300';
        }

        function setBusy(isBusy, message = 'Processando...') {
            actionButtons.forEach((button) => {
                button.disabled = isBusy;
                button.classList.toggle('opacity-60', isBusy);
                button.classList.toggle('cursor-not-allowed', isBusy);
            });

            setFeedback(isBusy ? message : '');
        }

        function blobFromCanvas(canvas, type, quality) {
            return new Promise((resolve) => {
                canvas.toBlob((blob) => {
                    if (blob) {
                        resolve(blob);
                        return;
                    }

                    const dataUrl = canvas.toDataURL(type, quality);
                    const base64 = dataUrl.split(',')[1];
                    const byteString = atob(base64);
                    const array = new Uint8Array(byteString.length);

                    for (let i = 0; i < byteString.length; i++) {
                        array[i] = byteString.charCodeAt(i);
                    }

                    resolve(new Blob([array], { type }));
                }, type, quality);
            });
        }

        async function captureCardCanvas() {
            if (typeof htmlToImage === 'undefined') {
                throw new Error('Biblioteca de captura indisponivel.');
            }

            if (!cardEl) {
                throw new Error('Cartao nao encontrado para captura.');
            }

            return htmlToImage.toCanvas(cardEl, {
                cacheBust: true,
                includeQueryParams: true,
                pixelRatio: Math.min(window.devicePixelRatio || 1, 2),
                backgroundColor: '#020617',
            });
        }

        function roundRect(ctx, x, y, width, height, radius) {
            const safeRadius = Math.min(radius, width / 2, height / 2);

            ctx.beginPath();
            ctx.moveTo(x + safeRadius, y);
            ctx.lineTo(x + width - safeRadius, y);
            ctx.quadraticCurveTo(x + width, y, x + width, y + safeRadius);
            ctx.lineTo(x + width, y + height - safeRadius);
            ctx.quadraticCurveTo(x + width, y + height, x + width - safeRadius, y + height);
            ctx.lineTo(x + safeRadius, y + height);
            ctx.quadraticCurveTo(x, y + height, x, y + height - safeRadius);
            ctx.lineTo(x, y + safeRadius);
            ctx.quadraticCurveTo(x, y, x + safeRadius, y);
            ctx.closePath();
        }

        function drawStoryScene(ctx, canvas, cardSource, zoom = 1) {
            const gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
            gradient.addColorStop(0, '#020617');
            gradient.addColorStop(0.55, '#0f172a');
            gradient.addColorStop(1, '#1e293b');
            ctx.fillStyle = gradient;
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.fillStyle = 'rgba(245, 158, 11, 0.14)';
            ctx.beginPath();
            ctx.arc(180, 220, 180, 0, Math.PI * 2);
            ctx.fill();

            ctx.fillStyle = 'rgba(234, 179, 8, 0.12)';
            ctx.beginPath();
            ctx.arc(920, 1640, 220, 0, Math.PI * 2);
            ctx.fill();

            const maxWidth = 860;
            const maxHeight = 1280;
            const scale = Math.min(maxWidth / cardSource.width, maxHeight / cardSource.height);
            const width = cardSource.width * scale * zoom;
            const height = cardSource.height * scale * zoom;
            const x = (canvas.width - width) / 2;
            const y = (canvas.height - height) / 2;

            ctx.save();
            ctx.shadowColor = 'rgba(15, 23, 42, 0.45)';
            ctx.shadowBlur = 70;
            ctx.shadowOffsetY = 28;
            ctx.fillStyle = 'rgba(255, 255, 255, 0.06)';
            roundRect(ctx, x, y, width, height, 42);
            ctx.fill();
            ctx.restore();

            ctx.save();
            roundRect(ctx, x, y, width, height, 42);
            ctx.clip();
            ctx.drawImage(cardSource, x, y, width, height);
            ctx.restore();

            ctx.fillStyle = 'rgba(255, 255, 255, 0.92)';
            ctx.font = '700 42px Instrument Sans, Arial, sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText('Compartilhe meu cartao digital', canvas.width / 2, 132);

            ctx.fillStyle = 'rgba(226, 232, 240, 0.95)';
            ctx.font = '500 28px Instrument Sans, Arial, sans-serif';
            ctx.fillText(window.location.host, canvas.width / 2, 1800);
        }

        function buildStoryCanvas(cardCanvas) {
            const canvas = document.createElement('canvas');
            canvas.width = 1080;
            canvas.height = 1920;

            const ctx = canvas.getContext('2d');
            drawStoryScene(ctx, canvas, cardCanvas);

            return canvas;
        }

        async function createStoryImageBlob() {
            const cardCanvas = await captureCardCanvas();
            const storyCanvas = buildStoryCanvas(cardCanvas);

            return blobFromCanvas(storyCanvas, 'image/png', 1);
        }

        async function createStoryVideoBlob() {
            if (typeof MediaRecorder === 'undefined') {
                throw new Error('Seu navegador nao suporta gravacao de video.');
            }

            const cardCanvas = await captureCardCanvas();
            const storyCanvas = buildStoryCanvas(cardCanvas);
            const stream = storyCanvas.captureStream(30);

            const mimeType = [
                'video/webm;codecs=vp9',
                'video/webm;codecs=vp8',
                'video/webm',
            ].find((type) => MediaRecorder.isTypeSupported(type));

            if (!mimeType) {
                throw new Error('Seu navegador nao suporta exportacao de video.');
            }

            const context = storyCanvas.getContext('2d');
            const duration = 5000;
            const start = performance.now();
            const cardImage = new Image();
            cardImage.src = cardCanvas.toDataURL('image/png');

            await new Promise((resolve, reject) => {
                cardImage.onload = resolve;
                cardImage.onerror = reject;
            });

            const chunks = [];
            const recorder = new MediaRecorder(stream, {
                mimeType,
                videoBitsPerSecond: 4_000_000,
            });

            recorder.ondataavailable = (event) => {
                if (event.data.size > 0) {
                    chunks.push(event.data);
                }
            };

            const stopPromise = new Promise((resolve) => {
                recorder.onstop = () => resolve(new Blob(chunks, { type: mimeType }));
            });

            function drawFrame(now) {
                const progress = Math.min((now - start) / duration, 1);
                const zoom = 1 + (progress * 0.06);

                context.clearRect(0, 0, storyCanvas.width, storyCanvas.height);
                drawStoryScene(context, storyCanvas, cardImage, zoom);

                if (progress < 1) {
                    requestAnimationFrame(drawFrame);
                } else {
                    recorder.stop();
                }
            }

            recorder.start(250);
            requestAnimationFrame(drawFrame);

            return stopPromise;
        }

        function downloadBlob(blob, filename) {
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            link.remove();
            URL.revokeObjectURL(url);
        }

        async function shareFile(blob, filename, title, text) {
            if (!navigator.share) {
                throw new Error('Compartilhamento de arquivos indisponivel neste navegador.');
            }

            const file = new File([blob], filename, { type: blob.type });
            const shareData = {
                files: [file],
                title,
                text,
            };

            if (navigator.canShare && !navigator.canShare(shareData)) {
                throw new Error('Seu navegador nao aceitou este arquivo para compartilhamento.');
            }

            await navigator.share(shareData);
        }

        downloadImageBtn?.addEventListener('click', async () => {
            try {
                setBusy(true, 'Gerando imagem para story...');
                const blob = await createStoryImageBlob();
                downloadBlob(blob, `${baseFileName}-story.png`);
                setFeedback('Imagem gerada com sucesso.');
            } catch (error) {
                setFeedback(error.message || 'Nao foi possivel gerar a imagem.', true);
            } finally {
                setBusy(false);
            }
        });

        downloadVideoBtn?.addEventListener('click', async () => {
            try {
                setBusy(true, 'Gerando video curto...');
                const blob = await createStoryVideoBlob();
                downloadBlob(blob, `${baseFileName}-story.webm`);
                setFeedback('Video curto gerado com sucesso.');
            } catch (error) {
                setFeedback(error.message || 'Nao foi possivel gerar o video.', true);
            } finally {
                setBusy(false);
            }
        });

        shareStoryBtn?.addEventListener('click', async () => {
            try {
                setBusy(true, 'Preparando story para compartilhamento...');
                const blob = await createStoryImageBlob();
                await shareFile(
                    blob,
                    `${baseFileName}-story.png`,
                    'Meu cartao digital',
                    'Compartilhe este cartao no Instagram, Facebook ou WhatsApp.'
                );
                setFeedback('Story enviado para a tela de compartilhamento.');
            } catch (error) {
                if (error.name === 'AbortError') {
                    setFeedback('Compartilhamento cancelado.');
                } else {
                    setFeedback('Nao foi possivel compartilhar. A imagem foi baixada como alternativa.', true);

                    try {
                        const fallbackBlob = await createStoryImageBlob();
                        downloadBlob(fallbackBlob, `${baseFileName}-story.png`);
                    } catch (_) {
                        // noop
                    }
                }
            } finally {
                setBusy(false);
            }
        });

        copyLinkBtn?.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(window.location.href);
                setFeedback('Link copiado para a area de transferencia.');
            } catch (error) {
                setFeedback('Nao foi possivel copiar o link.', true);
            }
        });
    </script>

    
</body>

</html>
