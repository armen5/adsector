@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row m-t-10">
        <div class="col-md-5 offset-3">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-paypal"></i>
                    Payment
                </div>

                <div class="card-body">
                    <div class="form-group dflex items-center justify-content-center">
                        <p class="dinline_block ls1 fs26 fw600">$ 249</p>
                    </div>
                    <div>
                        <a href="{{ url('subscribe/paypal') }}"><img src="/images/paypal_subscribe.gif"></a>
                        <!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="TRA2MNQGAFDAQ">
                            <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
