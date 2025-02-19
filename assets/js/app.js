/*  File: app.js
 *  By: WireGency <contact@wiregency.com>
 *  Discord: <discord.wiregency.com>

 *  Created with Trae IDE <traeide.com>
 *  For the project Nomad
 */

document.addEventListener('DOMContentLoaded', () => {
    const clipboard = new ClipboardJS('#server-ip');
    let isAnimating = false;
    
    clipboard.on('success', (e) => {
        if (isAnimating) return;
        
        const button = e.trigger;
        const originalText = button.textContent;
        const copyMessage = button.getAttribute('data-copy-message');
        isAnimating = true;
        
        button.textContent = copyMessage;
        button.style.pointerEvents = 'none';
        
        setTimeout(() => {
            button.textContent = originalText;
            button.style.pointerEvents = 'auto';
            isAnimating = false;
        }, 2000);
        
        e.clearSelection();
    });

    clipboard.on('error', () => {
        if (isAnimating) return;
        
        const button = document.querySelector('#server-ip');
        isAnimating = true;
        button.textContent = 'Erreur de copie';
        button.style.pointerEvents = 'none';
        
        setTimeout(() => {
            button.textContent = 'play.hyping.fr';
            button.style.pointerEvents = 'auto';
            isAnimating = false;
        }, 2000);
    });
});