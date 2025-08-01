<footer class="footer">
    <div class="container">
        <div class="row justify-content-between">
            @php
                $defaultOrder = ['about', 'links', 'social'];
                $footerOrder = theme_config('footer_order') ?? $defaultOrder;
                
                $elementConfigs = [
                    'about' => [
                        'class' => 'col-lg-5 mb-4 mb-lg-0',
                        'content' => function() {
                            $html = '<h5 class="footer-title">' . trans('theme::nomad.footer.about') . '</h5>';
                            $html .= '<p class="footer-description">' . theme_config('footer_description') . '</p>';
                            return $html;
                        }
                    ],
                    'links' => [
                        'class' => 'col-lg-3 col-md-6 mb-4 mb-lg-0',
                        'content' => function() {
                            $html = '<h5 class="footer-title">' . trans('theme::nomad.footer.links') . '</h5>';
                            $html .= '<ul class="footer-links">';
                            foreach (theme_config('footer_links') ?? [] as $link) {
                                $html .= '<li><a href="' . $link['value'] . '">' . $link['name'] . '</a></li>';
                            }
                            $html .= '</ul>';
                            return $html;
                        }
                    ],
                    'social' => [
                        'class' => 'col-lg-3 col-md-6',
                        'content' => function() {
                            $html = '<h5 class="footer-title">' . trans('theme::nomad.footer.social') . '</h5>';
                            $html .= '<div class="social-links d-flex flex-wrap">';
                            foreach (social_links() as $link) {
                                $html .= '<a href="' . $link->value . '" target="_blank" rel="noopener noreferrer"><i class="' . $link->icon . '"></i></a>';
                            }
                            $html .= '</div>';
                            return $html;
                        }
                    ]
                ];
            @endphp

            @foreach($footerOrder as $element)
                @if(isset($elementConfigs[$element]))
                    <div class="{{ $elementConfigs[$element]['class'] }}">
                        {!! $elementConfigs[$element]['content']() !!}
                    </div>
                @endif
            @endforeach
        </div>
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="copyright-wrapper">
                        <p class="copyright-main">{{ setting('copyright') }}</p>
                        <p class="copyright-sub">@lang('messages.copyright') {{ trans('theme::nomad.footer.developed_by') }} <a href="https://discord.wiregency.com/" class="footer-author">WireGency</a></p>
                    </div>
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
