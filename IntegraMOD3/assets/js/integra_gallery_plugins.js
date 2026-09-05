(() => {
    const readMeta = (name) => {
        const element = document.querySelector(`meta[name="${name}"]`);
        return element ? element.getAttribute('content') || '' : '';
    };

    const initializeHighslide = () => {
        const graphicsDir = readMeta('integra-gallery-highslide-graphics-dir');
        if (!graphicsDir || !globalThis.hs) {
            return;
        }

        globalThis.hs.graphicsDir = graphicsDir;
        globalThis.hs.align = 'center';
        globalThis.hs.transitions = ['expand', 'crossfade'];
        globalThis.hs.fadeInOut = true;
        globalThis.hs.dimmingOpacity = 0.8;
        globalThis.hs.outlineType = 'rounded-white';
        globalThis.hs.captionEval = 'this.thumb.title';
        globalThis.hs.continuePreloading = false;
        globalThis.hs.addSlideshow({
            interval: 5000,
            repeat: false,
            useControls: true,
            fixedControls: 'fit',
            overlayOptions: {
                opacity: 0.75,
                position: 'top center',
                hideOnMouseOut: true
            }
        });
    };

    const initializeLytebox = () => {
        if (!readMeta('integra-gallery-lytebox') || typeof globalThis.LyteBox !== 'function') {
            return;
        }

        globalThis.myLytebox = new globalThis.LyteBox(1280, '');
    };

    const initializeShadowbox = () => {
        if (!readMeta('integra-gallery-shadowbox') || !globalThis.Shadowbox || typeof globalThis.Shadowbox.init !== 'function') {
            return;
        }

        globalThis.Shadowbox.init();
    };

    window.addEventListener('load', () => {
        initializeHighslide();
        initializeLytebox();
        initializeShadowbox();
    });
})();
