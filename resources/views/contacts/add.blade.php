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
            <fieldset>
                <legend>
                    Optional:
                </legend>
                <div class="mb-3">
                    <input 
                        type="text" 
                        name="Account_Name" 
                        id="Account_Name" 
                        class="form-control"
                        placeholder="Account Name"
                        value="{{ old('Account_Name') }}"
                    >
                    @if ($errors->has('Account_Name'))
                        <div id="Account_NameFeedback" class="invalid-feedback">
                            {{ $errors->first('Account_Name')}}
                        </div>
                    @endif
                </div>
            </fieldset>
            <hr>
            <button type="submit" class="btn btn-outline-success">
                Add contact
            </button>
        </section>
    </form>
</article>
@endsection