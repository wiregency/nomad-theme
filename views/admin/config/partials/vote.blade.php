<div class="tab-pane" id="tab-vote">
    <div class="section-header">
        <h3 class="section-title">
            <i class="bi bi-award-fill me-2"></i>
            {{ trans('theme::nomad.config.admin.vote_title') }}
        </h3>
        <p class="section-description text-muted mb-0">
            {{ trans('theme::nomad.config.admin.vote_description') }}
        </p>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-file-text me-2"></i>
                    Textes de la page
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle me-2"></i>
                    {{ trans('theme::nomad.config.admin.vote_page_texts_info') }}
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label fw-semibold" for="votePageDescriptionInput">
                                <i class="bi bi-card-text me-2"></i>
                                {{ trans('theme::nomad.config.admin.vote_page_description_title') }}
                            </label>
                            <textarea class="form-control @error('vote_page_description') is-invalid @enderror" 
                                      id="votePageDescriptionInput" name="vote_page_description" rows="3" 
                                      placeholder="{{ trans('theme::nomad.config.admin.vote_page_description_placeholder') }}">{{ old('vote_page_description', theme_config('vote_page_description', 'Soutenez notre serveur en votant quotidiennement et gagnez des récompenses exclusives !')) }}</textarea>
                            <div class="form-text">
                                {{ trans('theme::nomad.config.admin.vote_page_description_info') }}
                            </div>
                            @error('vote_page_description')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-semibold" for="voteRankingDescriptionInput">
                                <i class="bi bi-trophy me-2"></i>
                                {{ trans('theme::nomad.config.admin.vote_ranking_description_title') }}
                            </label>
                            <textarea class="form-control @error('vote_ranking_description') is-invalid @enderror" 
                                      id="voteRankingDescriptionInput" name="vote_ranking_description" rows="3" 
                                      placeholder="{{ trans('theme::nomad.config.admin.vote_ranking_description_placeholder') }}">{{ old('vote_ranking_description', theme_config('vote_ranking_description', 'Découvrez les meilleurs voteurs de ce mois et leurs récompenses !')) }}</textarea>
                            <div class="form-text">
                                {{ trans('theme::nomad.config.admin.vote_ranking_description_info') }}
                            </div>
                            @error('vote_ranking_description')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-semibold" for="voteRewardsDescriptionInput">
                                <i class="bi bi-gift me-2"></i>
                                {{ trans('theme::nomad.config.admin.vote_rewards_description_title') }}
                            </label>
                            <textarea class="form-control @error('vote_rewards_description') is-invalid @enderror" 
                                      id="voteRewardsDescriptionInput" name="vote_rewards_description" rows="3" 
                                      placeholder="{{ trans('theme::nomad.config.admin.vote_rewards_description_placeholder') }}">{{ old('vote_rewards_description', theme_config('vote_rewards_description', 'Voici les récompenses que vous pouvez gagner en votant !')) }}</textarea>
                            <div class="form-text">
                                {{ trans('theme::nomad.config.admin.vote_rewards_description_info') }}
                            </div>
                            @error('vote_rewards_description')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label fw-semibold" for="voteSiteIconInput">
                                <i class="bi bi-star me-2"></i>
                                {{ trans('theme::nomad.config.admin.vote_site_icon_title') }}
                            </label>
                            <input type="text" class="form-control @error('vote_site_icon') is-invalid @enderror" 
                                   id="voteSiteIconInput" name="vote_site_icon" 
                                   value="{{ old('vote_site_icon', theme_config('vote_site_icon', 'bi bi-award')) }}" 
                                   placeholder="{{ trans('theme::nomad.config.admin.vote_site_icon_placeholder') }}">
                            <div class="form-text">
                                {{ trans('theme::nomad.config.admin.vote_site_icon_info') }} - 
                                <a href="https://icons.getbootstrap.com/" target="_blank" class="text-decoration-none">{{ trans('theme::nomad.config.admin.bootstrap_icons_link') }}</a>
                            </div>
                            @error('vote_site_icon')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-trophy-fill me-2"></i>
                    {{ trans('theme::nomad.config.admin.vote_rewards_title') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle me-2"></i>
                    {{ trans('theme::nomad.config.admin.vote_rewards_info') }}
                </div>

                <div id="vote-rewards-container" class="mb-4">
                    @foreach(theme_config('vote_rewards') ?? [] as $index => $reward)
                    <div class="card mb-3 vote-reward-card border-secondary">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-hash me-2"></i>
                                            {{ trans('theme::nomad.config.admin.vote_reward_position') }}
                                        </label>
                                        <input type="text" class="form-control" 
                                               name="vote_rewards[{{ $index }}][position]" 
                                               placeholder="{{ trans('theme::nomad.config.admin.vote_reward_position_placeholder') }}" value="{{ $reward['position'] }}">
                                        <div class="form-text">
                                            {{ trans('theme::nomad.config.admin.vote_reward_position_info') }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-gift me-2"></i>
                                            {{ trans('theme::nomad.config.admin.vote_reward_reward') }}
                                        </label>
                                        <input type="text" class="form-control" 
                                               name="vote_rewards[{{ $index }}][reward]" 
                                               placeholder="{{ trans('theme::nomad.config.admin.vote_reward_reward_placeholder') }}" value="{{ $reward['reward'] }}">
                                        <div class="form-text">
                                            {{ trans('theme::nomad.config.admin.vote_reward_reward_info') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-palette me-2"></i>
                                            {{ trans('theme::nomad.config.admin.vote_reward_color') }}
                                        </label>
                                        <input type="color" class="form-control form-control-color color-picker" 
                                               name="vote_rewards[{{ $index }}][color]" 
                                               value="{{ $reward['color'] ?? '#f0b000' }}">
                                        <div class="form-text">
                                            {{ trans('theme::nomad.config.admin.vote_reward_color_info') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">&nbsp;</label>
                                        <button class="btn btn-outline-danger btn-sm vote-reward-remove w-100" type="button" title="{{ trans('theme::nomad.config.admin.remove') }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" id="addVoteRewardButton" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>
                        {{ trans('theme::nomad.config.admin.add_vote_reward') }}
                    </button>
                </div>
                
                <div class="alert alert-warning mt-4">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>{{ trans('theme::nomad.config.admin.vote_rewards_warning') }}</strong>
                </div>
            </div>
        </div>
    </div>
</div> 