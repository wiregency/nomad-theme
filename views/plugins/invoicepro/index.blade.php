@extends('layouts.app')

@section('title', trans('invoicepro::messages.invoice'))

@section('content')

    @php
        $notRequired = setting('invoicepro_force_required', 0) == 0 
    @endphp

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('invoicepro.store')}}" method="POST">
                        @csrf
                        @empty(auth()->user()->email)
                            <div class="mb-3">
                                <label class="form-label" for="invoicepro_email">{{trans('auth.email')}}</label>
                                <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="invoicepro_email" placeholder="john.doe@mail.com">
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        @endempty
                        <div class="mb-3">
                          <label class="form-label" for="invoicepro_name">{{trans('messages.fields.name')}}</label>
                          <input name="name" value="{{old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror" id="invoicepro_name" placeholder="John Doe">
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="invoicepro_address">{{trans('invoicepro::messages.address')}} @if($notRequired) (optional)@endif</label>
                            <input name="address" value="{{old('address')}}" type="text" class="form-control @error('address') is-invalid @enderror" id="invoicepro_address" placeholder="75 rue de Paris">
                            @error('address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="invoicepro_postal_code">{{trans('invoicepro::messages.postal-code')}} @if($notRequired) (optional)@endif</label>
                            <input name="postal_code" value="{{old('postal_code')}}" type="text" class="form-control @error('postal_code') is-invalid @enderror" id="invoicepro_postal_code" placeholder="10000">
                            @error('postal_code')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="invoicepro_city">{{trans('invoicepro::messages.city')}} @if($notRequired) (optional)@endif</label>
                            <input name="city" type="text" value="{{old('city')}}" class="form-control @error('city') is-invalid @enderror" id="invoicepro_city" placeholder="Paris">
                            @error('city')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="invoicepro_country">{{trans('invoicepro::messages.country')}}</label>
                            <select name="country_id" class="form-control @error('country_id') is-invalid @enderror" id="invoicepro_country" aria-label="Country...">
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="invoicepro_state">
                                {{trans('invoicepro::messages.state')}}
                                <div class="spinner-border spinner-border-sm d-none" role="status" id="state_spinner">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </label>
                            <select name="state_id" class="form-control selectpicker @error('state_id') is-invalid @enderror" data-live-search="true" id="invoicepro_state" aria-label="State/Region...">
                            </select>
                            @error('state_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{trans('messages.actions.continue')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.card {
    border-radius: 1rem;
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.form-control, .form-select {
    border-radius: 0.5rem;
    border: 2px solid #e9ecef;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(var(--primary-color-rgb), 0.15);
}

.btn-primary {
    background: var(--primary-color);
    border: none;
    border-radius: 0.5rem;
    padding: 0.75rem 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(var(--primary-color-rgb), 0.3);
}
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function(){
        let endpoint = '{{route('invoicepro.state', ["country" => ":country"])}}';
        document.querySelector('#invoicepro_country').addEventListener('change', async (event) => {
            const stateSelect = document.querySelector('#invoicepro_state');
            const state_spinner = document.querySelector('#state_spinner');
            stateSelect.setAttribute('disabled', '');
            state_spinner.classList.remove('d-none');
            const response = await axios.get(endpoint.replace(':country', event.target.value));
            while (stateSelect.firstChild && !stateSelect.firstChild.remove());
            
            response.data.forEach(element => {
                let option = document.createElement("option");
                option.text = element.name;
                option.value = element.id;
                stateSelect.appendChild(option);
            });
            stateSelect.removeAttribute('disabled')
            state_spinner.classList.add('d-none');
        });
    });
</script>
@endpush