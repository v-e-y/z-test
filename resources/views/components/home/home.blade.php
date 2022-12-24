@extends('index')

@section('main')
    <article class="row g-4 home">
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
                                    @if ($contact->getKeyValue('Full_Name')) 
                                        <span>{{ $contact->getKeyValue('Full_Name') }}</span> 
                                    @endif
                                    @if ($contact->getKeyValue('Phone') || $contact->getKeyValue('Mobile')) 
                                        <span>{{ $contact->getKeyValue('Phone') ?? $contact->getKeyValue('Mobile') ?? '' }}</span> 
                                    @endif
                                    @if ($contact->getKeyValue('Twitter')) 
                                        <span>{{ $contact->getKeyValue('Twitter') }}</span> 
                                    @endif
                                    @if ($contact->getKeyValue('Department'))
                                        <br>
                                        <span>{{ $contact->getKeyValue('Department') }}</span>
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
                                    @if ($deal->getKeyValue('Deal_Name')) <span>{{ $deal->getKeyValue('Deal_Name') }}</span> @endif
                                    @if ($deal->getKeyValue('Closing_Date')) <span>{{ $deal->getKeyValue('Closing_Date') }}</span> @endif
                                    @if ($deal->getKeyValue('Type')) <span>{{ $deal->getKeyValue('Type') }}</span> @endif
                                    @if ($deal->getKeyValue('Stage')) <span>{{ $deal->getKeyValue('Stage') }}</span> @endif
                                    @if ($deal->getKeyValue('Account_Name'))
                                        <br>
                                        {{ $deal->getKeyValue('Account_Name')['name'] }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        @endif
        @if ($accounts)
            <section class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Accounts
                        </h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($accounts as $account)
                                <li class="list-group-item">
                                    {{ $account->getKeyValue('Account_Name') }} |
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        @endif
    </article>
@endsection