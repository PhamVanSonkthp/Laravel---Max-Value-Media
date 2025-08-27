<style>
    :root {
        --loader-bg: rgba(0,0,0,.35);       /* dim overlay */
        --panel-bg: rgba(28,28,30,.85);     /* iOS-like card (dark, translucent) */
        --panel-radius: 20px;
        --panel-padding: 18px 22px;
        --text-color: #fff;
        --font: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
        --spinner-size: 40px;
        --spinner-thickness: 4px;
        --z-loader: 99999;
    }

    /* Overlay */
    #iosLoader {
        position: fixed;
        inset: 0;
        background: var(--loader-bg);
        backdrop-filter: blur(2px);
        display: none;            /* hidden by default */
        align-items: center;
        justify-content: center;
        z-index: var(--z-loader);
    }

    /* Card */
    #iosLoader .panel {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        background: var(--panel-bg);
        color: var(--text-color);
        border-radius: var(--panel-radius);
        padding: var(--panel-padding);
        box-shadow: 0 8px 28px rgba(0,0,0,.35);
        min-width: 140px;
        max-width: 80vw;
        text-align: center;
        animation: pop .18s ease-out;
    }
    @keyframes pop {
        from { transform: scale(.98); opacity: .7; }
        to   { transform: scale(1);   opacity: 1; }
    }

    /* iOS-like spinner (12 fading bars) */
    .ios-spinner {
        position: relative;
        width: var(--spinner-size);
        height: var(--spinner-size);
    }
    .ios-spinner div {
        position: absolute;
        left: calc(50% - var(--spinner-thickness)/2);
        top: 6%;
        width: var(--spinner-thickness);
        height: 24%;
        border-radius: 2px;
        background: #fff;
        transform-origin: center calc(200%); /* pivot to circle */
        opacity: 0.15;
        animation: fade 1s linear infinite;
    }
    /* Create 12 bars rotated 30° each with staggered delays */
    .ios-spinner div:nth-child(1)  { transform: rotate(0deg);    animation-delay: -0.9167s; }
    .ios-spinner div:nth-child(2)  { transform: rotate(30deg);   animation-delay: -0.8333s; }
    .ios-spinner div:nth-child(3)  { transform: rotate(60deg);   animation-delay: -0.7500s; }
    .ios-spinner div:nth-child(4)  { transform: rotate(90deg);   animation-delay: -0.6667s; }
    .ios-spinner div:nth-child(5)  { transform: rotate(120deg);  animation-delay: -0.5833s; }
    .ios-spinner div:nth-child(6)  { transform: rotate(150deg);  animation-delay: -0.5000s; }
    .ios-spinner div:nth-child(7)  { transform: rotate(180deg);  animation-delay: -0.4167s; }
    .ios-spinner div:nth-child(8)  { transform: rotate(210deg);  animation-delay: -0.3333s; }
    .ios-spinner div:nth-child(9)  { transform: rotate(240deg);  animation-delay: -0.2500s; }
    .ios-spinner div:nth-child(10) { transform: rotate(270deg);  animation-delay: -0.1667s; }
    .ios-spinner div:nth-child(11) { transform: rotate(300deg);  animation-delay: -0.0833s; }
    .ios-spinner div:nth-child(12) { transform: rotate(330deg);  animation-delay: 0s; }

    @keyframes fade {
        0%, 39%, 100% { opacity: 0.15; }
        40%           { opacity: 1; }
    }

    /* Text */
    #iosLoader .text {
        font-family: var(--font);
        font-size: 14px;
        line-height: 1.25;
        letter-spacing: .2px;
        user-select: none;
        white-space: pre-line; /* allow line breaks in JS text */
    }

    /* Optional: prevent page scroll while visible */
    body.loading {
        overflow: hidden;
    }

    /* Demo page content styling (optional) */
    /*.demo-wrap { min-height: 100vh; display:flex; align-items:center; justify-content:center; gap:12px; font-family: var(--font); }*/
    /*button { padding:10px 14px; border-radius:10px; border:0; background:#111; color:#fff; cursor:pointer; }*/
    /*button.secondary { background:#444; }*/
</style>

<!-- Loader markup -->
<div id="iosLoader" role="alert" aria-live="polite" aria-busy="true" aria-hidden="true">
    <div class="panel">
        <div class="ios-spinner" aria-hidden="true">
            <!-- 12 bars -->
            <div></div><div></div><div></div><div></div><div></div><div></div>
            <div></div><div></div><div></div><div></div><div></div><div></div>
        </div>
        <div class="text" id="iosLoaderText">Loading…</div>
    </div>
</div>

<script>
    const _LoaderOrverlay = {
        el: document.getElementById('iosLoader'),
        txt: document.getElementById('iosLoaderText'),
        show(message = 'Loading…') {
            this.txt.textContent = message;
            this.el.style.display = 'flex';
            this.el.setAttribute('aria-hidden', 'false');
            document.body.classList.add('loading');
        },
        hide() {
            this.el.style.display = 'none';
            this.el.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('loading');
        }
    };

    // Demo: simulate a task
    function fakeTask() {
        Loading.show('Please wait…');
        setTimeout(Loading.hide.bind(Loading), 2000);
    }

    // OPTIONAL: show during fetch
    // Wrap fetch to auto show/hide the loader
    async function withLoader(promise, message='Loading…') {
        try {
            Loading.show(message);
            return await promise;
        } finally {
            Loading.hide();
        }
    }
    // Example usage:
    // withLoader(fetch('/api/data'), 'Fetching data…').then(r => r.json()).then(console.log);
</script>
