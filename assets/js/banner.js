function initDynamicBanner() {
    const bannerElement = document.getElementById('dynamicBanner');
    if (!bannerElement) return;

    const banners = JSON.parse(bannerElement.dataset.banners || '[]');
    const interval = parseInt(bannerElement.dataset.interval) || 5000;
    
    if (banners.length <= 1) return;

    let currentIndex = 0;
    
    function changeBanner() {
        currentIndex = (currentIndex + 1) % banners.length;
        bannerElement.style.opacity = '0';
        
        setTimeout(() => {
            bannerElement.textContent = banners[currentIndex];
            bannerElement.style.opacity = '1';
        }, 300);
    }
    
    bannerElement.style.transition = 'opacity 0.3s ease-in-out';
    
    setInterval(changeBanner, interval);
}

document.addEventListener('DOMContentLoaded', initDynamicBanner); 