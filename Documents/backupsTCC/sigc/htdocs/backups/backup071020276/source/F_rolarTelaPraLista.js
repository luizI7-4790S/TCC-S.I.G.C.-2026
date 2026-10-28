function rolarPraLista() {
    const destino = document.getElementById('destinoBtnRolar');

    // Pega a posição exata do elemento na página
    const elementPosition = destino.getBoundingClientRect().top + window.scrollY;
    const startPosition = window.scrollY;
    const distance = elementPosition - startPosition;
    const duration = 1500; // Tempo em milissegundos (aumente para rolar mais devagar)
    let startTime = null;

    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const run = ease(timeElapsed, startPosition, distance, duration);
        window.scrollTo(0, run);
        if (timeElapsed < duration) requestAnimationFrame(animation);
    }

    // Função de suavização (efeito slow-motion)
    function ease(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return (c / 2) * t * t + b;
        t--;
        return (-c / 2) * (t * (t - 2) - 1) + b;
    }

    requestAnimationFrame(animation);
}

//ou  function rolarPraLista() { const destino = document.getElementById('destinoBtnRolar'); destino.scrollIntoView({ behavior: 'smooth' }); }