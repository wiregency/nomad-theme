<div class="tab-pane" id="tab-about">
    <div class="section-header">
        <h3 class="section-title">
            <i class="bi bi-info-circle-fill me-2"></i>
            {{ trans('theme::nomad.config.admin.about_title_section') }}
        </h3>
        <p class="section-description text-muted mb-0">
            {{ trans('theme::nomad.config.admin.about_description_section') }}
        </p>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-card-text me-2"></i>
                    {{ trans('theme::nomad.config.admin.about_content_title') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="aboutTitleInput">{{ trans('theme::nomad.config.about_title') }}</label>
                    <input type="text" class="form-control @error('about_title') is-invalid @enderror" 
                           id="aboutTitleInput" name="about_title" 
                           value="{{ old('about_title', theme_config('about_title')) }}"
                           placeholder="{{ trans('theme::nomad.config.about_title_placeholder') }}">

                    @error('about_title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="aboutDescriptionInput">{{ trans('theme::nomad.config.about_description') }}</label>
                    <textarea class="form-control html-editor @error('about_description') is-invalid @enderror" 
                              id="aboutDescriptionInput" name="about_description" rows="4">{{ old('about_description', theme_config('about_description')) }}</textarea>

                    @error('about_description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3" v-scope="{ about_image: '{{ old('about_image', theme_config('about_image')) ?? '' }}' }">
                    <label class="form-label" for="aboutImageSelect">{{ trans('theme::nomad.config.about_image') }}</label>
                    <div class="input-group mb-3">
                        <a class="btn btn-outline-success" href="{{ route('admin.images.create') }}" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-upload"></i> {{ trans('theme::nomad.config.admin.upload') }}
                        </a>
                        <select class="form-select @error('about_image') is-invalid @enderror" 
                                id="aboutImageSelect" v-model="about_image" name="about_image">
                            <option value="" @selected(!theme_config('about_image'))>
                                {{ trans('messages.none') }}
                            </option>
                            @foreach($images as $image)
                                <option value="{{ $image->file }}" @selected($image->file === theme_config('about_image'))>
                                    {{ $image->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <img v-if="about_image" :src="about_image ? '{{ image_url() }}/' + about_image : '#'" 
                         class="img-fluid rounded img-preview-sm" alt="About Image" style="max-height: 200px;">

                    @error('about_image')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>