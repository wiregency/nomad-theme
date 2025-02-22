@extends('layouts.app')

@section('title', trans('vote::messages.title'))

@section('content')
    <section class="vote-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">{{ trans('vote::messages.sections.vote') }}</h2>
                <p class="subtitle">{{ trans('theme::nomad.vote.description') }}</p>
            </div>
            <div class="card mb-4">
                <div class="card-body text-center position-relative" id="vote-card">
                    <div class="spinner-parent h-100">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                    <div class="@auth d-none @endauth" data-vote-step="1">
                        <form class="row justify-content-center" action="{{ route('vote.verify-user', '') }}"
                            id="voteNameForm">
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-3">
                                    <input type="text" id="stepNameInput" name="name" class="form-control"
                                        value="{{ $name }}" placeholder="{{ trans('messages.fields.name') }}"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('messages.actions.continue') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="@guest d-none @endguest h-100" data-vote-step="2">
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            @forelse($sites as $site)
                                <a class="btn btn-primary" href="{{ $site->url }}" target="_blank"
                                    rel="noopener noreferrer" data-vote-id="{{ $site->id }}"
                                    data-vote-url="{{ route('vote.vote', $site) }}"
                                    @auth data-vote-time="{{ $site->getNextVoteTime($user, $request)?->valueOf() }}" @endauth>
                                    <span class="badge bg-secondary text-white vote-timer"></span> {{ $site->name }}
                                </a>
                            @empty
                                <div class="alert alert-warning" role="alert">
                                    {{ trans('vote::messages.errors.site') }}
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="d-none" data-vote-step="3">
                        <p id="vote-result"></p>
                    </div>

                    <div class="d-none" data-vote-step="server">
                        <p>{{ trans('vote::messages.server') }}</p>
                        <div id="server-select" class="d-flex justify-content-center gap-3 flex-wrap"></div>
                    </div>

                    <div id="status-message" class="mt-3"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ trans('vote::messages.sections.top') }}</h2>
                    <p class="text-muted mb-4">{{ trans('theme::nomad.vote.subtitle') }}</p>
                    <div class="table">
                        @foreach ($votes as $id => $vote)
                            <div class="leaderboard-item">
                                <span class="rank">#{{ $id }}</span>
                                <div class="player-info">
                                    <img src="https://minotar.net/avatar/{{ $vote->user->name }}" alt="Player Avatar"
                                        class="nav-avatar me-3" width="32" height="32">
                                    <span class="player-name">{{ $vote->user->name }}</span>
                                </div>
                                <span class="vote-count">{{ $vote->votes }}
                                    {{ trans('vote::messages.fields.votes') }}</span>
                            </div>
                        @endforeach
                    </div>

                    @auth
                        <p class="text-muted mt-4 mb-0">{{ trans_choice('vote::messages.votes', $userVotes) }}</p>
                    @endauth
                </div>
            </div>
            @if ($displayRewards)
                <div class="card mt-4">
                    <div class="card-body">
                        <h2 class="card-title">{{ trans('vote::messages.sections.rewards') }}</h2>
                        <div class="table">
                            @foreach ($rewards as $reward)
                                <div class="reward-item">
                                    <span class="reward-name">
                                        @if ($reward->image)
                                            <img src="{{ $reward->imageUrl() }}" alt="{{ $reward->name }}" width="45">
                                        @endif
                                        {{ $reward->name }}
                                    </span>
                                    <span class="reward-chance">{{ $reward->chances }} %</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    @if ($ipv6compatibility)
        <script src="https://ipv6-adapter.com/api/v1/api.js" async defer></script>
    @endif

    <script src="{{ plugin_asset('vote', 'js/vote.js') }}" defer></script>
    @auth
        <script>
            window.username = '{{ $user->name }}';
        </script>
    @endauth
@endpush

@push('styles')
    <style>
        #vote-card .spinner-parent {
            display: none;
        }

        #vote-card.voting .spinner-parent {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 10;
            border-radius: 0.25rem;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>
@endpush
