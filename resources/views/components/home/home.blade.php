@extends('index')

@section('main')
    <article class="row">
        @if ($contacts)
            <section class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Contacts
                        </h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($contacts as $contact)
                                <li class="list-group-item">
                                    {{ $contact->getKeyValue('Full_Name') }} |
                                    {{ $contact->getKeyValue('Phone') ?? $contact->getKeyValue('Mobile') ?? '' }} |
                                    {{ $contact->getKeyValue('Twitter') ?? '' }}
                                    @if ($contact->getKeyValue('Department'))
                                        <br>
                                        {{ $contact->getKeyValue('Department') ?? '' }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        @endif
        @if ($deals)
            <section class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Deals
                        </h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($deals as $deal)
                                <li class="list-group-item">
                                    {{ $deal->getKeyValue('Deal_Name') }} |
                                    {{ $deal->getKeyValue('Closing_Date') ?? '' }} |
                                    {{ $deal->getKeyValue('Type') ?? '' }} |
                                    {{ $deal->getKeyValue('Stage') ?? '' }}
                                    @if ($deal->getKeyValue('Account_Name'))
                                        <br>
                                        {{ $deal->getKeyValue('Account_Name')['name'] }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        @endif
    </article>
@endsection