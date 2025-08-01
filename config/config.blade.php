@extends('admin.layouts.admin')

@section('title', trans('theme::nomad.config.admin.title'))

@include('admin.elements.color-picker')
@include('admin.elements.editor')

@push('footer-scripts')
    <script src="{{ theme_asset('js/config.js') }}"></script>
@endpush

@push('styles')
<style>
.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

.section-header {
    border-bottom: 2px solid var(--bs-primary);
    padding-bottom: 1rem;
    margin-bottom: 2rem;
}

.section-title {
    color: var(--bs-primary);
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 1.5rem;
}

.section-description {
    font-size: 0.95rem;
    opacity: 0.8;
}

.config-card {
    margin-bottom: 2rem;
}

.config-card .card {
    border: 1px solid var(--bs-border-color);
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    transition: box-shadow 0.15s ease-in-out;
}

.config-card .card:hover {
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
}

.config-card .card-header {
    background-color: var(--bs-light);
    border-bottom: 1px solid var(--bs-border-color);
    font-weight: 600;
}

[data-bs-theme="dark"] .config-card .card-header {
    background-color: var(--bs-dark);
    border-bottom-color: var(--bs-border-color);
    color: var(--bs-body-color);
}

[data-bs-theme="dark"] .section-description {
    color: var(--bs-secondary-color);
}

.nav-pills .nav-link {
    border-radius: 0.375rem;
    margin-bottom: 0.5rem;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
    color: var(--bs-body-color);
}

.nav-pills .nav-link:not(.active):hover {
    background-color: var(--bs-secondary-bg);
    color: var(--bs-primary);
}

.nav-pills .nav-link.active {
    background-color: var(--bs-primary);
    color: white;
}

.mb-4:last-child {
    margin-bottom: 2rem !important;
}

.alert {
    border-radius: 0.5rem;
}

.img-preview-sm {
    border: 2px solid var(--bs-border-color);
    border-radius: 0.375rem;
}

.border.rounded.p-3 {
    border-color: var(--bs-border-color) !important;
    background-color: var(--bs-body-bg);
}

[data-bs-theme="dark"] .border.rounded.p-3 {
    background-color: var(--bs-dark);
}

.btn-outline-danger:hover {
    color: white;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
}

.sortable-list {
    min-height: 60px;
}

.sortable-item {
    transition: all 0.3s ease;
    cursor: default;
}

.sortable-item:hover {
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
}

.sortable-handle {
    transition: color 0.2s ease;
}

.sortable-handle:hover {
    color: var(--bs-primary) !important;
}

.sortable-ghost {
    opacity: 0.4;
    background-color: var(--bs-primary-bg) !important;
    border-color: var(--bs-primary) !important;
}

.sortable-chosen {
    cursor: grabbing !important;
}

.sortable-drag {
    cursor: grabbing !important;
    transform: rotate(2deg);
}

[data-bs-theme="dark"] .sortable-item {
    background-color: var(--bs-dark) !important;
    border-color: var(--bs-border-color) !important;
}
</style>
@endpush

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center">
                            <img src="https://cdn.discordapp.com/attachments/1263537425389457570/1301888046601601075/image.png?ex=688e06ba&is=688cb53a&hm=662d1b6fd7574923a667ace93506e43fec2a3081d61c0f23f75a572ce2535a29&" height="80" alt="img" class="img-fluid mb-3">
                        </div>
                        <div class="col-md-9">
                            <h4 class="mb-2 text-primary">{{ trans('theme::nomad.config.admin.theme_name') }}</h4>
                            <p class="text-muted mb-2">{{ trans('theme::nomad.config.admin.theme_description') }}</p>
                            <p class="small text-muted mb-3">{{ trans('theme::nomad.config.admin.theme_philosophy') }}</p>
                            
                            <div class="d-flex align-items-center mb-3">
                                <span class="text-muted me-2">{{ trans('theme::nomad.config.admin.theme_authors') }}</span>
                                <a href="https://github.com/akira13345" target="_blank" rel="noopener noreferrer" class="badge bg-primary me-2">
                                    <i class="bi bi-github me-1"></i>{{ trans('theme::nomad.config.admin.theme_author_akira') }}
                                </a>
                                <a href="https://github.com/pkhemae" target="_blank" rel="noopener noreferrer" class="badge bg-primary">
                                    <i class="bi bi-github me-1"></i>{{ trans('theme::nomad.config.admin.theme_author_pkhemae') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center d-flex flex-column">
                    <div>
                        <h5 class="card-title">{{ trans('theme::nomad.config.admin.theme_support_title') }}</h5>
                        <p class="card-text">{{ trans('theme::nomad.config.admin.theme_support_description') }}</p>
                    </div>
                    <div class="mt-auto pt-3">
                        <div class="d-grid gap-2">
                            <a href="https://discord.com/invite/pu2XxCT6VR" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-discord me-2"></i>Discord
                            </a>
                            <a href="https://market.azuriom.com/resources/170" class="btn btn-outline-primary" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-trophy me-2"></i>Ranking
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST" id="configForm">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills" role="tablist">
                            <a class="nav-link" data-tab="general" href="#" role="tab">
                                <i class="bi bi-gear-fill me-2"></i> {{ trans('theme::nomad.config.admin.nav_general') }}
                            </a>
                            <a class="nav-link" data-tab="banner" href="#" role="tab">
                                <i class="bi bi-megaphone-fill me-2"></i> {{ trans('theme::nomad.config.admin.nav_banner') }}
                            </a>
                            <a class="nav-link" data-tab="about" href="#" role="tab">
                                <i class="bi bi-info-circle-fill me-2"></i> {{ trans('theme::nomad.config.admin.nav_about') }}
                            </a>
                            <a class="nav-link" data-tab="cta" href="#" role="tab">
                                <i class="bi bi-cursor-fill me-2"></i> {{ trans('theme::nomad.config.admin.nav_cta') }}
                            </a>
                            <a class="nav-link" data-tab="stats" href="#" role="tab">
                                <i class="bi bi-graph-up me-2"></i> {{ trans('theme::nomad.config.admin.nav_stats') }}
                            </a>
                            <a class="nav-link" data-tab="footer" href="#" role="tab">
                                <i class="bi bi-layout-text-window-reverse me-2"></i> {{ trans('theme::nomad.config.admin.nav_footer') }}
                            </a>
                    </div>
                </div>

                    <div class="col-md-9">
                        @include('admin.config.partials.general')
                        @include('admin.config.partials.banner')
                        @include('admin.config.partials.about')
                        @include('admin.config.partials.cta')
                        @include('admin.config.partials.stats')
                        @include('admin.config.partials.footer')
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-save me-2"></i> {{ trans('messages.actions.save') }}
                        </button>
                </div>
            </form>
        </div>
    </div>
@endsection