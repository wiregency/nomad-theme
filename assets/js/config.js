document.addEventListener('DOMContentLoaded', function() {
    initConfigTabs();
    initCtaButtonVisibility();
    initFooterLinksManagement();
    initFooterOrderSortable();
    initBannerManagement();
    initLogoSizeSlider();
    initVoteRewardsManagement();
    initFontSettings();
});

function initConfigTabs() {
    const tabs = document.querySelectorAll('[data-tab]');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    const savedTab = localStorage.getItem('nomad-config-active-tab') || 
                     window.location.hash.replace('#', '') || 
                     (tabs.length > 0 ? tabs[0].dataset.tab : '');
    
    if (savedTab && tabs.length > 0) {
        const activeTab = Array.from(tabs).find(tab => tab.dataset.tab === savedTab);
        const activePane = document.getElementById('tab-' + savedTab);
        
        if (activeTab && activePane) {
            activeTab.classList.add('active');
            activePane.classList.add('active');
        } else {
            tabs[0].classList.add('active');
            const firstTabPane = document.getElementById('tab-' + tabs[0].dataset.tab);
            if (firstTabPane) {
                firstTabPane.classList.add('active');
            }
        }
    }
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            
            tabs.forEach(t => t.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));
            
            this.classList.add('active');
            const targetPane = document.getElementById('tab-' + this.dataset.tab);
            if (targetPane) {
                targetPane.classList.add('active');
            }
            
            localStorage.setItem('nomad-config-active-tab', this.dataset.tab);
            
            history.replaceState(null, null, '#' + this.dataset.tab);
        });
    });
}

function initCtaButtonVisibility() {
    const serverType = document.getElementById('buttonTypeServer');
    const customType = document.getElementById('buttonTypeCustom');

    if (serverType && customType) {
        serverType.addEventListener('change', handleCtaButtonTypeVisibility);
        customType.addEventListener('change', handleCtaButtonTypeVisibility);
        handleCtaButtonTypeVisibility();
    }
}

function handleCtaButtonTypeVisibility() {
    const serverType = document.getElementById('buttonTypeServer');
    const customFields = document.getElementById('customButtonFields');
    
    if (customFields && serverType) {
        customFields.style.display = serverType.checked ? 'none' : 'block';
    }
}

function initFooterLinksManagement() {
    document.querySelectorAll('.link-remove').forEach(function (el) {
        addLinkListener(el);
    });

    document.querySelectorAll('.legal-link-remove').forEach(function (el) {
        addLinkListener(el);
    });

    const addLinkButton = document.getElementById('addLinkButton');
    if (addLinkButton) {
        addLinkButton.addEventListener('click', function () {
            addFooterLink();
        });
    }

    const addLegalLinkButton = document.getElementById('addLegalLinkButton');
    if (addLegalLinkButton) {
        addLegalLinkButton.addEventListener('click', function () {
            addLegalLink();
        });
    }
}

function addLinkListener(el) {
    el.addEventListener('click', function () {
        const element = el.closest('.link-item');
        if (element) {
            element.remove();
        }
    });
}

function addFooterLink() {
    const timestamp = Date.now();
    const nameLabel = document.querySelector('[data-lang="name-label"]')?.textContent || 'Nom du lien';
    const urlLabel = document.querySelector('[data-lang="url-label"]')?.textContent || 'URL du lien';
    const namePlaceholder = document.querySelector('[data-lang="name-placeholder"]')?.textContent || 'Nom';
    const linkPlaceholder = document.querySelector('[data-lang="link-placeholder"]')?.textContent || 'Lien';
    const newTabLabel = document.querySelector('[data-lang="new-tab-label"]')?.textContent || 'Ouvrir dans un nouvel onglet';
    const newTabHelp = document.querySelector('[data-lang="new-tab-help"]')?.textContent || 'Cochez cette case pour que le lien s\'ouvre dans un nouvel onglet';
    
    let input = `<div class="link-item mb-3 p-3 border rounded bg-light">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-semibold">${nameLabel}</label>
                <input type="text" class="form-control" name="footer_links[${timestamp}][name]" placeholder="${namePlaceholder}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">${urlLabel}</label>
                <input type="url" class="form-control" name="footer_links[${timestamp}][value]" placeholder="${linkPlaceholder}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">${newTabLabel}</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="footer_links[${timestamp}][new_tab]" value="1" id="footer_link_new_tab_${timestamp}">
                    <label class="form-check-label small text-muted" for="footer_link_new_tab_${timestamp}">
                        ${newTabHelp}
                    </label>
                </div>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button class="btn btn-outline-danger btn-sm link-remove" type="button" title="Supprimer">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    </div>`;

    document.querySelector('#links').insertAdjacentHTML('beforeend', input);

    const newRemoveButton = document.querySelector('#links .link-item:last-child .link-remove');
    addLinkListener(newRemoveButton);
}

function addLegalLink() {
    const timestamp = Date.now();
    const nameLabel = document.querySelector('[data-lang="name-label"]')?.textContent || 'Nom du lien';
    const urlLabel = document.querySelector('[data-lang="url-label"]')?.textContent || 'URL du lien';
    const namePlaceholder = document.querySelector('[data-lang="name-placeholder"]')?.textContent || 'Nom';
    const linkPlaceholder = document.querySelector('[data-lang="link-placeholder"]')?.textContent || 'Lien';
    const newTabLabel = document.querySelector('[data-lang="new-tab-label"]')?.textContent || 'Ouvrir dans un nouvel onglet';
    const newTabHelp = document.querySelector('[data-lang="new-tab-help"]')?.textContent || 'Cochez cette case pour que le lien s\'ouvre dans un nouvel onglet';
    
    let input = `<div class="link-item mb-3 p-3 border rounded bg-light">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-semibold">${nameLabel}</label>
                <input type="text" class="form-control" name="legal_links[${timestamp}][name]" placeholder="${namePlaceholder}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">${urlLabel}</label>
                <input type="url" class="form-control" name="legal_links[${timestamp}][value]" placeholder="${linkPlaceholder}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">${newTabLabel}</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="legal_links[${timestamp}][new_tab]" value="1" id="legal_link_new_tab_${timestamp}">
                    <label class="form-check-label small text-muted" for="legal_link_new_tab_${timestamp}">
                        ${newTabHelp}
                    </label>
                </div>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button class="btn btn-outline-danger btn-sm legal-link-remove" type="button" title="Supprimer">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    </div>`;

    document.querySelector('#legal-links').insertAdjacentHTML('beforeend', input);

    const newRemoveButton = document.querySelector('#legal-links .link-item:last-child .legal-link-remove');
    addLinkListener(newRemoveButton);
}

function initFooterOrderSortable() {
    if (typeof Sortable === 'undefined') {
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js';
        script.onload = function() {
            setupFooterOrderSortable();
        };
        document.head.appendChild(script);
    } else {
        setupFooterOrderSortable();
    }
}

function setupFooterOrderSortable() {
    const footerOrderList = document.getElementById('footer-order-list');
    
    if (footerOrderList) {
        Sortable.create(footerOrderList, {
            handle: '.sortable-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onStart: function(evt) {
                evt.item.style.opacity = '0.5';
            },
            onEnd: function(evt) {
                evt.item.style.opacity = '1';
                updateFooterOrderInputs();
            }
        });
    }
}

function updateFooterOrderInputs() {
    const footerOrderList = document.getElementById('footer-order-list');
    
    if (footerOrderList) {
        const items = footerOrderList.querySelectorAll('.sortable-item');
        
        items.forEach(function(item, index) {
            const hiddenInput = item.querySelector('input[name="footer_order[]"]');
            if (hiddenInput) {
                const elementKey = item.getAttribute('data-element');
                hiddenInput.value = elementKey;
            }
        });
    }
}

function initBannerManagement() {
    document.querySelectorAll('.banner-remove').forEach(function (el) {
        addBannerListener(el);
    });

    const addBannerButton = document.getElementById('addBannerButton');
    if (addBannerButton) {
        addBannerButton.addEventListener('click', function () {
            addBanner();
        });
    }
}

function addBannerListener(el) {
    el.addEventListener('click', function () {
        const element = el.closest('.banner-item');
        if (element) {
            element.remove();
        }
    });
}

function initLogoSizeSlider() {
    const logoSizeInput = document.getElementById('logoSizeInput');
    const logoSizeValue = document.getElementById('logoSizeValue');
    
    if (logoSizeInput && logoSizeValue) {
        logoSizeInput.addEventListener('input', function() {
            logoSizeValue.textContent = this.value + 'px';
        });
    }
}

function addBanner() {
    const timestamp = Date.now();
    const placeholder = document.querySelector('[data-lang="banner-text-placeholder"]')?.textContent || 'Texte de la bannière';
    
    let input = `<div class="banner-item mb-3 p-3 border rounded bg-light">
        <div class="row g-3">
            <div class="col-md-10">
                <label class="form-label fw-semibold">${placeholder}</label>
                <input type="text" class="form-control" name="banner_texts[${timestamp}][text]" placeholder="${placeholder}" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-outline-danger btn-sm banner-remove" type="button" title="Supprimer">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    </div>`;

    document.querySelector('#banner-texts').insertAdjacentHTML('beforeend', input);

    const newRemoveButton = document.querySelector('#banner-texts .banner-item:last-child .banner-remove');
    addBannerListener(newRemoveButton);
}

function initVoteRewardsManagement() {
    document.querySelectorAll('.vote-reward-remove').forEach(function (el) {
        addVoteRewardListener(el);
    });

    const addVoteRewardButton = document.getElementById('addVoteRewardButton');
    if (addVoteRewardButton) {
        addVoteRewardButton.addEventListener('click', function () {
            addVoteReward();
        });
    }
}

function addVoteRewardListener(el) {
    el.addEventListener('click', function () {
        const element = el.closest('.vote-reward-card');
        if (element) {
            element.remove();
        }
    });
}

function addVoteReward() {
    const timestamp = Date.now();
    const positionLabel = document.querySelector('[data-lang="vote-reward-position"]')?.textContent || 'Position';
    const rewardLabel = document.querySelector('[data-lang="vote-reward-reward"]')?.textContent || 'Récompense';
    const colorLabel = document.querySelector('[data-lang="vote-reward-color"]')?.textContent || 'Couleur';
    const positionPlaceholder = document.querySelector('[data-lang="vote-reward-position-placeholder"]')?.textContent || '1 ou 1-3';
    const rewardPlaceholder = document.querySelector('[data-lang="vote-reward-reward-placeholder"]')?.textContent || '500 crystaux';
    const positionInfo = document.querySelector('[data-lang="vote-reward-position-info"]')?.textContent || 'Position ou plage';
    const rewardInfo = document.querySelector('[data-lang="vote-reward-reward-info"]')?.textContent || 'Description';
    const colorInfo = document.querySelector('[data-lang="vote-reward-color-info"]')?.textContent || 'Couleur de la carte';
    const removeTitle = document.querySelector('[data-lang="remove"]')?.textContent || 'Supprimer';
    
    let input = `<div class="card mb-3 vote-reward-card border-secondary">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-hash me-2"></i>
                            ${positionLabel}
                        </label>
                        <input type="text" class="form-control" name="vote_rewards[${timestamp}][position]" placeholder="${positionPlaceholder}">
                        <div class="form-text">
                            ${positionInfo}
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-gift me-2"></i>
                            ${rewardLabel}
                        </label>
                        <input type="text" class="form-control" name="vote_rewards[${timestamp}][reward]" placeholder="${rewardPlaceholder}">
                        <div class="form-text">
                            ${rewardInfo}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-palette me-2"></i>
                            ${colorLabel}
                        </label>
                        <input type="color" class="form-control form-control-color color-picker" name="vote_rewards[${timestamp}][color]" value="#f0b000">
                        <div class="form-text">
                            ${colorInfo}
                        </div>
                    </div>
                </div>

                <div class="col-md-1">
                    <div class="form-group">
                        <label class="form-label fw-semibold">&nbsp;</label>
                        <button class="btn btn-outline-danger btn-sm vote-reward-remove w-100" type="button" title="${removeTitle}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>`;

    document.querySelector('#vote-rewards-container').insertAdjacentHTML('beforeend', input);

    const newRemoveButton = document.querySelector('#vote-rewards-container .vote-reward-card:last-child .vote-reward-remove');
    addVoteRewardListener(newRemoveButton);
}

function initFontSettings() {
    const fontEnabled = document.getElementById('font_enabled');
    const fontSettings = document.getElementById('font-settings');
    
    if (fontEnabled && fontSettings) {
        fontEnabled.addEventListener('change', function() {
            fontSettings.style.display = this.checked ? 'flex' : 'none';
        });
    }
}