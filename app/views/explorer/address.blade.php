@extends('layouts.master')

@section('title')
    Explorer - Address {{$summary['address']}}
@stop

@section('content')

    <section>
        <div class="container">
            <h1>Bitcoin Address</h1>
            <div class="section-heading">{{$summary['address']}}</div>
        </div>
    </section>

    <section>
        <div class="container">
            <h2 class="section-heading">Summary</h2>
            <div><b>Address:</b> {{$summary['address']}}</div>
            <div><b>Balance:</b> {{$summary['balance']}} Satoshi</div>
            <div>
                @if($summary['category'])
                <b>Tag:</b> {{$summary['category']}}: {{$summary['tag']}}
                @endif
            </div>
        </div>
    </section>

    <section class="address-transactions">
        <div class="container">
            <div class="row">
                <div class="one-third column">
                    <h2>Transactions</h2>
                    <div class="row">
                        <div class="one-half column">
                            <h5>Received</h5>
                            <div><b>Total:</b> {{$summary['total_transactions_in']}}</div>
                            <div><b>Amount:</b> {{$summary['received']}}</div>
                            <div><b>Unconfirmed:</b> {{$summary['unconfirmed_received']}}</div>
                        </div>
                        <div class="one-half column">
                            <h5>Sent</h5>
                            <div><b>Total:</b> {{$summary['total_transactions_out']}}</div>
                            <div><b>Amount:</b> {{$summary['sent']}}</div>
                            <div><b>Unconfirmed:</b> {{$summary['unconfirmed_sent']}}</div>
                        </div>
                    </div>
                </div>
                <div class="two-thirds column">
                    <div class="scroll-window">
                        <table class="u-full-width fixed-header transactions">
                            <thead>
                                <tr>
                                    <th><div>Date</div></th>
                                    <th><div>Amount</div></th>
                                    <th><div>Confirmations</div></th>
                                    <th><div>Recipient</div></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>Date</td>
                                    <td>Amount</td>
                                    <td>Confirmations</td>
                                    <td>Recipient</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($transactions as $tx)
                                    @foreach ($tx['outputs'] as $txout)
                                        @if($txout['address'] == $summary['address'])
                                        <tr>
                                            <td>@datetime($tx['time'])</td>
                                            <td class="output">+{{$txout['value']}}</td>
                                            <td>{{$tx['confirmations']}}</td>
                                            <td>-</td>
                                            <td><a href="{{ URL::route('transaction', $tx['hash']) }}">more info</a></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($tx['inputs'] as $txin)
                                        @if($txin['address'] == $summary['address'])
                                        <tr>
                                            <td>@datetime($tx['time'])</td>
                                            <td class="input">-{{$txin['value']}}</td>
                                            <td>{{$tx['confirmations']}}</td>
                                            <td><a href="{{ URL::route('address', $txin['address']) }}">{{ substr($txin['address'], 0, 8)}}</a>...</td>
                                            <td><a href="{{ URL::route('transaction', $tx['hash']) }}">more info</a></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $transactions->links() }}
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <hr>
            <h3 class="section-heading">Need help getting started?</h3>
            <p class="section-description">BlockTrail is an amazingly easy place to start with Bitcoin development. If you want to learn more, just visit the documentation!</p>
            <a class="button button-primary" href="https://www.blocktrail.com/api/docs" target="_blank">View BlockTrail Docs</a>
        </div>
    </section>

    <section></section>
@stop
