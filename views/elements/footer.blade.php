<footer class="footer">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <h5 class="footer-title">{{ trans('theme::nomad.footer.about') }}</h5>
                <p class="footer-description">{!! theme_config('footer_description') !!}</p>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0">
                        <h5 class="footer-title">{{ trans('theme::nomad.footer.links') }}</h5>
                        <ul class="footer-links">
                            @foreach (theme_config('footer_links') ?? [] as $link)
                                <li>
                                    <a href="{{ $link['value'] }}">{{ $link['name'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5 class="footer-title">{{ trans('theme::nomad.footer.social') }}</h5>
                        <div class="social-links d-flex flex-wrap" style="gap: 0.55rem; max-width: 140px;">
                            @foreach (social_links() as $link)
                                <a href="{{ $link->value }}" target="_blank" rel="noopener noreferrer">
                                    <i class="{{ $link->icon }}"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright">{{ setting('copyright') }} {{ trans('theme::nomad.footer.developed_by') }} <a
                            href="https://discord.wiregency.com/" class="footer-author">WireGency</a>.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    @foreach (theme_config('legal_links') ?? [] as $link)
                        <a href="{{ $link['value'] }}" class="footer-bottom-link">{{ $link['name'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</footer>
