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
                            $title = theme_config('footer_about_title') ?: trans('theme::nomad.footer.about');
                            $html = '<h5 class="footer-title">' . $title . '</h5>';
                            $html .= '<p class="footer-description">' . theme_config('footer_description') . '</p>';
                            return $html;
                        }
                    ],
                    'links' => [
                        'class' => 'col-lg-3 col-md-6 mb-4 mb-lg-0',
                        'content' => function() {
                            $title = theme_config('footer_links_title') ?: trans('theme::nomad.footer.links');
                            $html = '<h5 class="footer-title">' . $title . '</h5>';
                            $html .= '<ul class="footer-links">';
                            foreach (theme_config('footer_links') ?? [] as $link) {
                                $target = isset($link['new_tab']) && $link['new_tab'] ? ' target="_blank" rel="noopener noreferrer"' : '';
                                $html .= '<li><a href="' . $link['value'] . '"' . $target . '>' . $link['name'] . '</a></li>';
                            }
                            $html .= '</ul>';
                            return $html;
                        }
                    ],
                    'social' => [
                        'class' => 'col-lg-3 col-md-6',
                        'content' => function() {
                            $title = theme_config('footer_social_title') ?: trans('theme::nomad.footer.social');
                            $html = '<h5 class="footer-title">' . $title . '</h5>';
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
                        @php
                            $target = isset($link['new_tab']) && $link['new_tab'] ? ' target="_blank" rel="noopener noreferrer"' : '';
                        @endphp
                        <a href="{{ $link['value'] }}" class="footer-bottom-link"{{ $target }}>{{ $link['name'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</footer>
