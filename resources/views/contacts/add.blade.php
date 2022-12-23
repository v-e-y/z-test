@extends('index')

@section('main')
<article class="row">
    @if (isset($title))
        <h1>{{ $title }}</h1>
    @endif
    <form action="{{ route('contacts.store') }}" method="POST" class="col-12 col-md-6 card">
        <section class="card-body">
            <fieldset>
                @csrf
                <div class="mb-3">
                    <label for="First_Name" class="form-label">First name</label>
                    <input 
                        type="text" 
                        name="First_Name" 
                        id="First_Name" 
                        class="form-control @if ($errors->has('First_Name')) is-invalid @endif"
                        value="{{ old('First_Name') }}"
                        autofocus
                    >
                    @if ($errors->has('First_Name'))
                        <div id="First_NameFeedback" class="invalid-feedback">
                            {{ $errors->first('First_Name')}}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="Last_Name" class="form-label">Last name*</label>
                    <input 
                        type="text" 
                        name="Last_Name" 
                        id="Last_Name" 
                        class="form-control"
                        value="{{ old('Last_Name') }}" 
                        required
                    >
                    @if ($errors->has('Last_Name'))
                        <div id="Last_NameFeedback" class="invalid-feedback">
                            {{ $errors->first('Last_Name')}}
                        </div>
                    @endif
                </div>
            </fieldset>
            <div class="accordion accordion-flush" id="accordionAccount">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button 
                            class="accordion-button collapsed" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#account-collapseOne" 
                            aria-expanded="false" 
                            aria-controls="account-collapseOne"
                        >
                            Account <span class="small text-muted"> (optional)</span>
                        </button>
                    </h2>
                    <div 
                        id="account-collapseOne" 
                        class="accordion-collapse collapse" 
                        aria-labelledby="flush-headingOne" 
                        data-bs-parent="#accordionAccount"
                    >
                        <div class="accordion-body">
                            <fieldset class="row g-2">
                                <div class="col">
                                    <label for="new_account">Create new</label>
                                    <input 
                                        type="text" 
                                        name="new_account" 
                                        id="new_account" 
                                        class="form-control form-control-sm"
                                        placeholder="Account name"
                                        value="{{ old('new_account') }}"
                                    >
                                    @if ($errors->has('new_account'))
                                        <div id="new_accountFeedback" class="invalid-feedback">
                                            {{ $errors->first('new_account')}}
                                        </div>
                                    @endif
                                </div>
                                @if ($accountRecords)
                                    <div class="col">
                                        <label for="existed_account">Select existed</label>
                                        <select 
                                            class="form-select form-select-sm" 
                                            aria-label="Select existed account"
                                            id="existed_account"
                                            name="existed_account"
                                        >
                                            <option selected disabled hidden>Select account</option>
                                            @foreach ($accountRecords as $record)
                                                <option value="{{ $record->getId() }}">
                                                    {{ $record->getKeyValue('Account_Name') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('existed_account'))
                                            <div id="existed_accountFeedback" class="invalid-feedback">
                                                {{ $errors->first('existed_account')}}
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-outline-success">
                Add contact
            </button>
        </section>
    </form>
</article>
@endsection