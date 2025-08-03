@extends('layouts.base')

@section('title', trans('messages.home'))

@section('app')
    @if (!$posts->isEmpty())
        <section class="blog-section">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title">{{ trans('theme::nomad.home.blog.title') }}</h2>
                    <p class="subtitle">{{ trans('theme::nomad.home.blog.subtitle') }}</p>
                </div>
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-lg-4 mb-4">
                            <a href="{{ route('posts.show', $post->slug) }}" class="blog-card-link">
                                <div class="blog-card">
                                    @if ($post->hasImage())
                                        <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="blog-image">
                                    @elseif (theme_config('articles_default_image'))
                                        <img src="{{ image_url(theme_config('articles_default_image')) }}" alt="{{ $post->title }}" class="blog-image">
                                    @endif
                                    <div class="blog-content">
                                        <h3 class="blog-title">{{ $post->title }}</h3>
                                        <div class="blog-meta">
                                            <span
                                            class="blog-date">{{ format_date($post->created_at) }}</span>
                                            </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('posts.index') }}"
                        class="btn btn-primary">{{ trans('theme::nomad.home.blog.more') }}</a>
                </div>
            </div>
        </section>
    @endif

    <section class="about-section @if ($posts->isEmpty()) pt-5 mt-4 @endif">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img src="{{ theme_config('about_image') ? image_url(theme_config('about_image')) : theme_asset('img/steve.webp') }}"
                        alt="About Image" class="about-image">
                </div>
                <div class="col-lg-7">
                    <div class="about-content">
                        <h1 class="section-title">
                            {{ theme_config('about_title') }}
                        </h1>
                        <p class="description">
                            {!! theme_config('about_description') !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cta-section">
        <div class="container">
            <div class="cta-wrapper">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="cta-title">{{ theme_config('cta_title') }}</h2>
                        <p class="cta-description">{{ theme_config('cta_description') }}</p>
                        @if(theme_config('cta_button_type', 'server') === 'server')
                            @if (!$servers->isEmpty())
                                @foreach ($servers as $server)
                                    <button class="btn btn-primary cta-button server-ip"
                                        data-clipboard-text="{{ $server->fullAddress() }}"
                                        data-copy-message="{{ trans('theme::nomad.home.ip') }}">
                                        {{ $server->fullAddress() }}
                                    </button>
                                @endforeach
                            @endif
                        @else
                            <a href="{{ theme_config('cta_button_link') }}" class="btn btn-primary cta-button">
                                {{ theme_config('cta_button_text') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="{{ theme_config('stats_icon_1') }}"></i>
                        </div>
                        <div class="stats-value">
                            @if (!$servers->isEmpty())
                                {{ $server->getOnlinePlayers() }}
                            @else
                                0
                            @endif
                        </div>
                        <div class="stats-label">{{ theme_config('online_players_label') }}</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="{{ theme_config('stats_icon_2') }}"></i>
                        </div>
                        <div class="stats-value">
                            {{ theme_config('unique_players', 0) }}
                        </div>
                        <div class="stats-label">{{ theme_config('unique_players_label') }}</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="{{ theme_config('stats_icon_3') }}"></i>
                        </div>
                        <div class="stats-value">{{ theme_config('record_players', 0) }}</div>
                        <div class="stats-label">{{ theme_config('record_players_label') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
