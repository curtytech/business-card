const shareBtn = document.getElementById("shareBtn");
console.log('dfdfasddasd')

shareBtn.addEventListener("click", async () => {
    console.log('clicou')
    const shareData = {
        title: "Meu Web App",
        text: "Confira este app incrível!",
        url: window.location.href
    };

    if (navigator.share) {
        // Web Share API disponível
        try {
            await navigator.share(shareData);
            console.log("Compartilhado com sucesso!");
        } catch (err) {
            console.log("Erro ao compartilhar:", err);
        }
    } else {
        // Fallback: copiar link
        navigator.clipboard.writeText(window.location.href);
        alert("Link copiado para a área de transferência!");
    }
});