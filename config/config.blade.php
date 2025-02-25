@extends('admin.layouts.admin')

@section('title', 'Nomad config')

@include('admin.elements.color-picker')
@include('admin.elements.editor')

@push('footer-scripts')
    <script>
        function handleCtaButtonTypeVisibility() {
            const serverType = document.getElementById('buttonTypeServer');
            const customFields = document.getElementById('customButtonFields');
            
            if (customFields) {
                customFields.style.display = serverType.checked ? 'none' : 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const serverType = document.getElementById('buttonTypeServer');
            const customType = document.getElementById('buttonTypeCustom');

            if (serverType && customType) {
                serverType.addEventListener('change', handleCtaButtonTypeVisibility);
                customType.addEventListener('change', handleCtaButtonTypeVisibility);
                
                handleCtaButtonTypeVisibility();
            }
        });

        function addLinkListener(el) {
            el.addEventListener('click', function () {
                const element = el.closest('.row');
                if (element) {
                    element.remove();
                }
            });
        }

        document.querySelectorAll('.link-remove').forEach(function (el) {
            addLinkListener(el);
        });

        document.getElementById('addLinkButton').addEventListener('click', function () {
            let input = '<div class="row g-3"><div class="mb-3 col-md-6">';
            input += '<input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div>';
            input += '<div class="mb-3 col-md-6"><div class="input-group">';
            input += '<input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}">';
            input += '<button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="bi bi-x-lg"></i></button></div></div></div>';

            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('links').appendChild(newElement);
        });

        document.getElementById('addLegalLinkButton').addEventListener('click', function () {
            let input = '<div class="row g-3"><div class="mb-3 col-md-6">';
            input += '<input type="text" class="form-control" name="legal_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div>';
            input += '<div class="mb-3 col-md-6"><div class="input-group">';
            input += '<input type="url" class="form-control" name="legal_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}">';
            input += '<button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="bi bi-x-lg"></i></button></div></div></div>';

            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('legal-links').appendChild(newElement);
        });

        document.getElementById('configForm').addEventListener('submit', function () {
            let i = 0;
            let j = 0;

            document.getElementById('links').querySelectorAll('.row').forEach(function (el) {
                el.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace('{index}', i.toString());
                });
                i++;
            });

            document.getElementById('legal-links').querySelectorAll('.row').forEach(function (el) {
                el.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace('{index}', j.toString());
                });
                j++;
            });
        });
    </script>
@endpush

@section('content')
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">{{ trans('theme::nomad.config.general') }}</h4>
            <a href="https://discord.com/invite/pu2XxCT6VR" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-discord"></i> Support
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST" id="configForm">
                @csrf

                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="colorInput">{{ trans('messages.fields.color') }}</label>
                            <input type="color" class="form-control form-control-color color-picker @error('color') is-invalid @enderror" id="colorInput" name="color" value="{{ old('color', theme_config('color', '#c0392b')) }}" required>

                            @error('color')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>

                <h4 class="mb-3">{{ trans('theme::nomad.config.about_section') }}</h4>
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="aboutTitleInput">{{ trans('theme::nomad.config.about_title') }}</label>
                            <input type="text" class="form-control @error('about_title') is-invalid @enderror" id="aboutTitleInput" name="about_title" value="{{ old('about_title', theme_config('about_title')) }}">

                            @error('about_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="aboutDescriptionInput">{{ trans('theme::nomad.config.about_description') }}</label>
                            <textarea class="form-control html-editor @error('about_description') is-invalid @enderror" id="aboutDescriptionInput" name="about_description" rows="3">{{ old('about_description', theme_config('about_description')) }}</textarea>

                            @error('about_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3" v-scope="{ about_image: '{{ old('about_image', theme_config('about_image')) ?? '' }}' }">
                            <label class="form-label" for="aboutImageSelect">{{ trans('theme::nomad.config.about_image') }}</label>
                            <div class="input-group mb-3">
                                <a class="btn btn-outline-success" href="{{ route('admin.images.create') }}" target="_blank" rel="noopener noreferrer">
                                    <i class="bi bi-upload"></i>
                                </a>
                                <select class="form-select @error('about_image') is-invalid @enderror" id="aboutImageSelect" v-model="about_image" name="about_image">
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

                            <img v-if="about_image" :src="about_image ? '{{ image_url() }}/' + about_image : '#'" class="img-fluid rounded img-preview-sm" alt="About Image">

                            @error('about_image')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>

                <h4 class="mb-3">{{ trans('theme::nomad.config.cta_section') }}</h4>
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="ctaTitleInput">{{ trans('theme::nomad.config.cta_title') }}</label>
                            <input type="text" class="form-control @error('cta_title') is-invalid @enderror" id="ctaTitleInput" name="cta_title" value="{{ old('cta_title', theme_config('cta_title')) }}">

                            @error('cta_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="ctaDescriptionInput">{{ trans('theme::nomad.config.cta_description') }}</label>
                            <textarea class="form-control @error('cta_description') is-invalid @enderror" id="ctaDescriptionInput" name="cta_description" rows="2">{{ old('cta_description', theme_config('cta_description')) }}</textarea>

                            @error('cta_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ trans('theme::nomad.config.cta_button_type') }}</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cta_button_type" id="buttonTypeServer" value="server" @checked(old('cta_button_type', theme_config('cta_button_type', 'server')) === 'server')>
                                <label class="form-check-label" for="buttonTypeServer">
                                    {{ trans('theme::nomad.config.cta_button_type_server') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cta_button_type" id="buttonTypeCustom" value="custom" @checked(old('cta_button_type', theme_config('cta_button_type')) === 'custom')>
                                <label class="form-check-label" for="buttonTypeCustom">
                                    {{ trans('theme::nomad.config.cta_button_type_custom') }}
                                </label>
                            </div>
                        </div>

                        <div id="customButtonFields" style="display: {{ old('cta_button_type', theme_config('cta_button_type', 'server')) === 'custom' ? 'block' : 'none' }}">
                            <div class="mb-3">
                                <label class="form-label" for="ctaButtonTextInput">{{ trans('theme::nomad.config.cta_button_text') }}</label>
                                <input type="text" class="form-control @error('cta_button_text') is-invalid @enderror" id="ctaButtonTextInput" name="cta_button_text" value="{{ old('cta_button_text', theme_config('cta_button_text')) }}">

                                @error('cta_button_text')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="ctaButtonLinkInput">{{ trans('theme::nomad.config.cta_button_link') }}</label>
                                <input type="url" class="form-control @error('cta_button_link') is-invalid @enderror" id="ctaButtonLinkInput" name="cta_button_link" value="{{ old('cta_button_link', theme_config('cta_button_link')) }}">

                                @error('cta_button_link')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="mb-3">{{ trans('theme::nomad.config.stats_section') }}</h4>
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="statsIcon1Input">{{ trans('theme::nomad.config.stats_icon_1') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                                        <input type="text" class="form-control @error('stats_icon_1') is-invalid @enderror" id="statsIcon1Input" name="stats_icon_1" value="{{ old('stats_icon_1', theme_config('stats_icon_1')) }}">
                                    </div>
                                    @error('stats_icon_1')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="onlinePlayersInput">&nbsp;</label>
                                    <input type="text" class="form-control" disabled readonly value="Auto">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="onlinePlayersLabelInput">{{ trans('theme::nomad.config.online_players_label') }}</label>
                                    <input type="text" class="form-control @error('online_players_label') is-invalid @enderror" id="onlinePlayersLabelInput" name="online_players_label" value="{{ old('online_players_label', theme_config('online_players_label')) }}">
                                    @error('online_players_label')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="statsIcon2Input">{{ trans('theme::nomad.config.stats_icon_2') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                        <input type="text" class="form-control @error('stats_icon_2') is-invalid @enderror" id="statsIcon2Input" name="stats_icon_2" value="{{ old('stats_icon_2', theme_config('stats_icon_2')) }}">
                                    </div>
                                    @error('stats_icon_2')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="uniquePlayersInput">{{ trans('theme::nomad.config.unique_players') }}</label>
                                    <input type="number" class="form-control @error('unique_players') is-invalid @enderror" id="uniquePlayersInput" name="unique_players" value="{{ old('unique_players', theme_config('unique_players')) }}">
                                    @error('unique_players')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="uniquePlayersLabelInput">{{ trans('theme::nomad.config.unique_players_label') }}</label>
                                    <input type="text" class="form-control @error('unique_players_label') is-invalid @enderror" id="uniquePlayersLabelInput" name="unique_players_label" value="{{ old('unique_players_label', theme_config('unique_players_label')) }}">
                                    @error('unique_players_label')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="statsIcon3Input">{{ trans('theme::nomad.config.stats_icon_3') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-trophy-fill"></i></span>
                                        <input type="text" class="form-control @error('stats_icon_3') is-invalid @enderror" id="statsIcon3Input" name="stats_icon_3" value="{{ old('stats_icon_3', theme_config('stats_icon_3')) }}">
                                    </div>
                                    @error('stats_icon_3')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="recordPlayersInput">{{ trans('theme::nomad.config.record_players') }}</label>
                                    <input type="number" class="form-control @error('record_players') is-invalid @enderror" id="recordPlayersInput" name="record_players" value="{{ old('record_players', theme_config('record_players', 0)) }}">
                                    @error('record_players')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="recordPlayersLabelInput">{{ trans('theme::nomad.config.record_players_label') }}</label>
                                    <input type="text" class="form-control @error('record_players_label') is-invalid @enderror" id="recordPlayersLabelInput" name="record_players_label" value="{{ old('record_players_label', theme_config('record_players_label')) }}">
                                    @error('record_players_label')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="mb-3">{{ trans('theme::nomad.config.footer_section') }}</h4>
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="footerDescriptionInput">{{ trans('theme::nomad.config.footer_description') }}</label>
                            <textarea class="form-control @error('footer_description') is-invalid @enderror" id="footerDescriptionInput" name="footer_description" rows="3">{{ old('footer_description', theme_config('footer_description')) }}</textarea>

                            @error('footer_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <label class="form-label">{{ trans('theme::nomad.config.footer_links') }}</label>

                        <div id="links">
                            @foreach(theme_config('footer_links') ?? [] as $link)
                                <div class="row g-3">
                                    <div class="mb-3 col-md-6">
                                        <input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}" value="{{ $link['name'] }}">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <div class="input-group">
                                            <input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}" value="{{ $link['value'] }}">
                                            <button class="btn btn-outline-danger link-remove" type="button">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <button type="button" id="addLinkButton" class="btn btn-sm btn-success">
                                <i class="bi bi-plus-lg"></i> {{ trans('messages.actions.add') }}
                            </button>
                        </div>

                        <label class="form-label">{{ trans('theme::nomad.config.legal_links') }}</label>

                        <div id="legal-links">
                            @foreach(theme_config('legal_links') ?? [] as $link)
                                <div class="row g-3">
                                    <div class="mb-3 col-md-6">
                                        <input type="text" class="form-control" name="legal_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}" value="{{ $link['name'] }}">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <div class="input-group">
                                            <input type="url" class="form-control" name="legal_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}" value="{{ $link['value'] }}">
                                            <button class="btn btn-outline-danger link-remove" type="button">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <button type="button" id="addLegalLinkButton" class="btn btn-sm btn-success">
                                <i class="bi bi-plus-lg"></i> {{ trans('messages.actions.add') }}
                            </button>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
