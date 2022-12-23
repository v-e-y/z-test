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
                            <fieldset class="row">
                                <div class="col">
                                    <label for="Account_Name">Create new</label>
                                    <input 
                                        type="text" 
                                        name="Account_Name" 
                                        id="Account_Name" 
                                        class="form-control form-control-sm"
                                        placeholder="Account Name"
                                        value="{{ old('Account_Name') }}"
                                    >
                                    @if ($errors->has('Account_Name'))
                                        <div id="Account_NameFeedback" class="invalid-feedback">
                                            {{ $errors->first('Account_Name')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="col">
                                    <select 
                                        class="form-select form-select-sm" 
                                        aria-label="Select existed account"
                                        id="Account"
                                        name="Account"
                                    >
                                        <option selected>Select account</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    @if ($errors->has('Account_Name'))
                                        <div id="Account_NameFeedback" class="invalid-feedback">
                                            {{ $errors->first('Account_Name')}}
                                        </div>
                                    @endif
                                </div>
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