<div class="tab-pane" id="tab-articles">
    <div class="section-header">
        <h3 class="section-title">
            <i class="bi bi-newspaper me-2"></i>
            {{ trans('theme::nomad.config.admin.articles_title') }}
        </h3>
        <p class="section-description text-muted mb-0">
            {{ trans('theme::nomad.config.admin.articles_description') }}
        </p>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-image me-2"></i>
                    {{ trans('theme::nomad.config.admin.articles_default_image_title') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle me-2"></i>
                    {{ trans('theme::nomad.config.admin.articles_default_image_info') }}
                </div>

                <div class="mb-3" v-scope="{ articlesDefaultImage: '{{ old('articles_default_image', theme_config('articles_default_image')) ?? '' }}' }">
                    <label class="form-label" for="articlesDefaultImageSelect">{{ trans('theme::nomad.config.admin.articles_default_image_title') }}</label>
                    <div class="input-group mb-3">
                        <a class="btn btn-outline-success" href="{{ route('admin.images.create') }}" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-upload me-1"></i>
                            {{ trans('theme::nomad.config.admin.upload') }}
                        </a>
                        <select class="form-select @error('articles_default_image') is-invalid @enderror" 
                                id="articlesDefaultImageSelect" 
                                v-model="articlesDefaultImage" 
                                name="articles_default_image">
                            <option value="" @selected(!theme_config('articles_default_image'))>
                                {{ trans('messages.none') }}
                            </option>

                            @foreach($images as $image)
                                <option value="{{ $image->file }}" @selected($image->file === theme_config('articles_default_image'))>
                                    {{ $image->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <img v-if="articlesDefaultImage" 
                         :src="articlesDefaultImage ? '{{ image_url() }}/' + articlesDefaultImage : '#'" 
                         class="img-fluid rounded img-preview-sm" 
                         alt="{{ trans('theme::nomad.config.admin.articles_default_image_title') }}">

                    @error('articles_default_image')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div> 