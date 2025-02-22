/*  File: app.js
 *  By: WireGency <contact@wiregency.com>
 *  Discord: <discord.wiregency.com>

 *  Created with Trae IDE <traeide.com>
 *  For the project Nomad
 */

document.addEventListener('DOMContentLoaded', () => {
    const serverIpButtons = document.querySelectorAll('.server-ip');
    let isAnimating = false;
    
    serverIpButtons.forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();
            
            if (isAnimating) return;
            
            const textToCopy = button.getAttribute('data-clipboard-text');
            const originalText = button.textContent;
            const copyMessage = button.getAttribute('data-copy-message');
            isAnimating = true;
            
            try {
                await navigator.clipboard.writeText(textToCopy);
                button.textContent = copyMessage;
            } catch (err) {
                button.textContent = 'Erreur de copie';
            }
            
            button.style.pointerEvents = 'none';
            
            setTimeout(() => {
                button.textContent = originalText;
                button.style.pointerEvents = 'auto';
                isAnimating = false;
            }, 2000);
        });
    });
});
