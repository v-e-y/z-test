@extends('index')

@section('main')
<article class="row">
    @if (isset($title))
        <h1>{{ $title }}</h1>
    @endif
    <form action="{{ route('deals.store') }}" method="POST" class="col-12 col-md-7 col-lg-6 card">
        <section class="card-body">
            <fieldset>
                @csrf
                <div class="mb-3">
                    <label for="Deal_Name" class="form-label">
                        Deal name*
                    </label>
                    <input 
                        type="text" 
                        name="Deal_Name" 
                        id="Deal_Name" 
                        class="form-control" 
                        value="{{ old('Deal_Name') }}"
                        required
                    >
                </div>
                <section class="row g-2 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="Closing_Date" class="form-label">Closing Date*</label>
                        <input 
                            type="date" 
                            id="Closing_Date" 
                            name="Closing_Date" 
                            class="form-control form-control-sm @error('Closing_Date') is-invalid @enderror"
                            value="{{ old('Closing_Date') }}"
                            required
                        >
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="existed_account" class="form-label">
                            Select stage
                        </label>
                        <select 
                            class="form-select form-select-sm" 
                            aria-label="Deal stage"
                            id="Stage"
                            name="Stage"
                        >
                            <option selected disabled hidden>Select stage</option>
                            <option value="Qualification">Qualification</option>
                            <option value="Needs Analysis">Needs Analysis</option>
                            <option value="Value Proposition">Value Proposition</option>
                            
                        </select>
                        @if ($errors->has('Stage'))
                            <div id="eStageFeedback" class="invalid-feedback">
                                {{ $errors->first('Stage')}}
                            </div>
                        @endif
                    </div>
                </section>
                <section class="row g-2">
                    @if ($accountRecords)
                        <div class="col-12 mb-3">
                            <label for="Account_Name">Deal account*</label>
                            <select 
                                class="form-select form-select-sm" 
                                aria-label="Select existed account"
                                id="Account_Name"
                                name="Account_Name"
                            >
                                <option selected disabled hidden>Select account</option>
                                @foreach ($accountRecords as $record)
                                    <option value="{{ $record->getId() }}">
                                        {{ $record->getKeyValue('Account_Name') }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('Account_Name'))
                                <div id="Account NameFeedback" class="invalid-feedback">
                                    {{ $errors->first('Account_Name')}}
                                </div>
                            @endif
                        </div>
                    @endif
                    @if ($accountRecords || $contacts)
                        <p class="m-0">Deal contacct</p>
                    @endif
                    @if ($accountRecords)
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="true" name="account_contact" id="account_contact">
                                <label class="form-check-label" for="account_contact">
                                    use account contact
                                </label>
                            </div>
                        </div>
                    @endif
                    @if ($contacts)
                        <div class="col-5">
                            Or another one:
                        </div>
                        <div class="col-7">
                            <select 
                                class="form-select form-select-sm" 
                                aria-label="Select existed account"
                                id="Contact_Name"
                                name="Contact_Name"
                            >
                                <option selected disabled hidden>Select contact</option>
                                @foreach ($contacts as $contact)
                                    <option value="{{ $contact->getId() }}">
                                        {{ $contact->getKeyValue('Full_Name')}}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('Contact_Name'))
                                <div id="Contact_NameFeedback" class="invalid-feedback">
                                    {{ $errors->first('Contact_Name')}}
                                </div>
                            @endif
                        </div>
                    @endif  
                </section>
            </fieldset>
            <hr>
            <button type="submit" class="btn btn-outline-success">
                Create deal
            </button>
        </section>
    </form>
@endsection