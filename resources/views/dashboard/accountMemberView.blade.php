<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('css/accountMemberView.css') }}">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});</script>
</head>
<body>
    <header style="height: 8vh;position: relative;">
        <nav class="am-header p-0">
          <!-- Brand/logo -->
          <div class="m-auto logo-main">
            <a class="navbar-brand bg-white p-0" href="#" >
                <img src="{{ asset('images/logo.png') }}" alt="logo" style="padding: 0px 20px;">
            </a>
          </div>
        </nav>
        <nav class="navbar navbar-expand-sm am-header am-header-line ">
          <!-- bottom bar -->
        </nav>
    </header>
    <section style="">
        <div class="content-body-wrapper m-auto">
            <div class="content-body">

                <div class="am-account-toolbar-items">
                    <div class="am-user-identity-block">
                        <img src="{{ asset('images/identity-glyph.png') }}" alt="">
                        <span class="am-user-identity-block_login">{{ $user->first_name." ".$user->last_name }}</span>
                        <a href="/account/logout">Logout</a>
                    </div>
               </div>

               <div class="am-account-toolbar" style="padding-top: 15px">
                   <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="pill" href="#home"><img src="{{ asset('images/dashboard.png') }}" alt=""></a>
                    </li>
{{--                     <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#menu1">Add/Renew Subscription</a>
                    </li> --}}
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#menu2">Profile</a>
                    </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">

                    <!-- Your Membership Information -->
                    <div id="home" class="container tab-pane active"><br>
                      <h3>Your Membership Information</h3>
                      <div class='member-info'>
                          <div style="border-right:1px solid #ccc;">
                              <div>
                                <h4>Active Subscriptions</h4>
                                <div class="am-block" id="member-main-subscriptions">
                                  @if(isset ($user->payment_cancel_date) && !empty($user->payment_cancel_date))
                                    <strong>Premium subscription</strong> -canceled <i>{{ $user->payment_cancel_date }}</i> 
                                  @else
                                    <strong>Premium subscription</strong> -next bill {{ $end_payment }} <a class="cancel-subscription local-link" href="/account/payment/paypal/cancel">cancel</a>
                                  @endif
                                </div>
                              </div>
                              <div>
                                  <h4>Unsubscribe from all e-mail messages</h4>
                                  <div class="am-block" id="member-main-unsubscribe">
                                    <label for="checkbox-unsubscribed"><input type="checkbox" name="unsubscribed" id="checkbox-unsubscribed" value="1"> Unsubscribe from all e-mail messages</label>
                                </div>
                              </div>
                          </div>
                          <div> 
                                <h4>Useful Links</h4>
                                <div class="am-block" id="member-main-subscriptions" style="padding: 8px;">
                                    <ul class="nav nav-pills" role="tablist" style="background: unset;border: unset;">
                                        <li class="nav-item" style="border: unset;">
                                            <a class="nav-link menu3" data-toggle="pill" href="#menu3"  style="border: unset;color: #3f7fb0;text-decoration: underline;">Payment History</a>
                                        </li>
                                    </ul>

                                </div>
                          </div>
                      </div>
                    </div>


                    <!-- Create account -->
{{--                     <div id="menu1" class="container tab-pane fade"><br>
                      <h3>Create account</h3>
                     <div class="am-info">You are logged-in as <strong>{{ $user->first_name.' '.$user->last_name }}</strong>. <a href="/logout">Logout</a> to signup as new user.</div>
                      <table class="w-75 m-auto">
                          <tbody>
                              <tr class="mt-2">
                                  <td class="w-50 text-right "><h5><sup class="text-danger">*</sup> Membership Type</h5></td>
                                  <td class="d-flex align-items-center"><p style="padding-left: 10px;margin: 0px"><strong style="color:black">Membership Type</strong> <i>${{ $amount }} for each month</i>/</p></td>
                              </tr>
                              <tr>
                                  <td class="w-50 text-right "><h5><sup class="text-danger">*</sup>Payment System</h5></td>
                                  <td style="vertical-align: top;">
                                      <div class="custom-control custom-radio" style="padding-left: 35px">
                                          <input type="radio" class="custom-control-input" id="defaultChecked2" name="defaultExample2" checked disabled="">
                                          <label class="custom-control-label" for="defaultChecked2">Paypal</label>
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="text-right">
                                      <h5>Enter coupon code</h5>
                                      <p>*price will be updated on second page*</p>
                                  </td>
                                  <td style="vertical-align: top;">
                                     <div class="row" style="padding-left: 10px">
                                        <div class="col">
                                          <input type="text" class="form-control open_input" placeholder="Coupon Code" name="coupon_code" value="">
                                        </div>
                                     </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="w-50 text-right "><h5><sup class="text-danger">*</sup> First & Last Name</h5></td>
                                  <td class="w-50">
                                   <div class="row" style="padding-left: 10px">
                                    <div class="col" style="padding-right: 2px">
                                      <input type="text" class="form-control open_input" placeholder="First name" name="first_name" value="{{ $user->first_name }}">
                                    </div>
                                    <div class="col" style="padding-left: 2px">
                                      <input type="text" class="form-control open_input" placeholder="Last name" name="last_name" value="{{ $user->last_name }}">
                                    </div>
                                  </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td colspan="2" class="text-center">
                                      <button type="button" class="btn btn-outline-secondary save_profile">Next</button>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                    </div> --}}

                    <!-- Customer Profile -->
                    <div id="menu2" class="container tab-pane fade"><br>
                      <h3 class="first_h3">Customer Profile</h3>
                      <table class="w-75 m-auto">
                          <tbody>
                              <tr>
                                  <td class="w-50 text-right "><h5><sup class="text-danger">*</sup> First & Last Name</h5></td>
                                  <td class="w-50">
                                   <div class="row" style="padding-left: 10px">
                                    <div class="col" style="padding-right: 2px">
                                      <input type="text" class="form-control open_input" placeholder="First name" name="first_name" value="{{ $user->first_name }}">
                                    </div>
                                    <div class="col" style="padding-left: 2px">
                                      <input type="text" class="form-control open_input" placeholder="Last name" name="last_name" value="{{ $user->last_name }}">
                                    </div>
                                  </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="text-right">
                                      <h5><sup class="text-danger">*</sup> Your E-Mail Address</h5>
                                      <p>a confirmation email will be sent to you at this address</p>
                                  </td>
                                  <td style="vertical-align: top;">
                                     <div class="row" style="padding-left: 10px">
                                        <div class="col">
                                          <input type="email" class="form-control open_input" placeholder="E-Mail" name="email" value="{{ $user->email }}">
                                        </div>
                                     </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="text-right">
                                      <h5>password</h5>
                                  </td>
                                  <td style="vertical-align: top;">
                                      <span class="open_password_filds">change</span>
                                  </td>
                                  <script>
                                        $(function(){
                                           var change_password = true; 
                                           $('.open_password_filds').click(function(){
                                                $('.hide_password_filds').show();
                                                $('.hide_password_filds').find('input').addClass('open_input');
                                                $(this).parents('tr').hide();
                                            }) 
                                        })
                                  </script>
                              </tr>
                              <tr class="hide_password_filds">
                                  <td class="text-right">
                                      <h5>Your Current Password</h5>
                                      <p>if you are changing password, please enter your current password for validation</p>
                                  </td>
                                  <td style="vertical-align: top;">
                                     <div class="row" style="padding-left: 10px">
                                        <div class="col">
                                          <input type="password" class="form-control" placeholder="Current Password" name="current_password" value="">

                                        </div>
                                     </div>
                                  </td>
                              </tr>
                              <tr class="hide_password_filds">
                                  <td class="text-right">
                                      <h5>New Password</h5>
                                      <p>you can choose new password here or keep it unchanged  must be 6 or more characters</p>
                                  </td>
                                  <td style="vertical-align: top;">
                                     <div class="row" style="padding-left: 10px">
                                        <div class="col">
                                          <input type="password" class="form-control" placeholder="New Password" name="password" value="">
                                        </div>
                                     </div>
                                  </td>
                              </tr>
                              <tr class="hide_password_filds">
                                  <td class="text-right">
                                      <h5>Confirm New Password</h5>
                                  </td>
                                  <td style="vertical-align: top;">
                                     <div class="row" style="padding-left: 10px">
                                        <div class="col">
                                          <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" value=""> 
                                        </div>
                                     </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td colspan="2" class="text-center">
                                      <button type="button" class="btn btn-outline-secondary save_profile">Save Profile</button>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                    </div>
                    {{-- Payment History  --}}
                    <div id="menu3" class="container tab-pane fade" style="padding-top: 25px;">
                        <h3>Your Subscriptions</h3>
                        @if(count($PaymentsHistory) !=0 )
                          <div class="am-active-invoice" style="margin-bottom: 15px">
                              <div class="am-active-invoice-header">
                                  <span class="am-active-invoice-date">{{ date("Y-m-d",strtotime($PaymentsHistory[count($PaymentsHistory)-1]->date)) }}</span> <!-- first subscript date-->
                                  <span class="am-active-invoice-num"><strong style="color:black">#{{ $PaymentsHistory[count($PaymentsHistory)-1]->payer_id }}</strong></span><!-- subscript id -->
                                  <span class="am-active-invoice-paysys">PayPal</span>,<!-- payment method -->
                                  <span class="am-active-invoice-terms"><i style="color:#303030">${{$amount}}.00 for each month</i></span><!-- payment amount -->
                                  @if(isset($user->payment_cancel_date) && !empty($user->payment_cancel_date))
                                  <span>canceled <i>{{ $user->payment_cancel_date }}</i></span>
                                  @else
                                  <span><a class="cancel-subscription local-link" href="/account/payment/paypal/cancel">cancel</a></span>  
                                  @endif
                                  <span class="am-active-invoice-cancel"></span><!-- last subscr date -->
                              </div>
                              <ul class="am-active-invoice-product-list">
                                  <li class="am-active-invoice-product">
                                      <span class="am-active-invoice-item-title">Premium subscription</span>
                                  </li>
                              </ul>
                          </div>
                        @endif
                        <table id="example" class="table table-striped table-bordered" style="width:100%;">
                          <thead class="">
                              <tr>
                                  <th>Date</th>
                                  <th>PayerID</th>
                                  <th>Products</th>
                                  <th>Payment System</th>
                                  <th>Amount</th>
                              </tr>
                          </thead>
                          <tbody class="">
                              @foreach($PaymentsHistory as $key => $value)
                                 <tr>
                                   <td>{{ $value->date }}</td>
                                   <td><a class="cancel-subscription local-link" href="/payment/downloadPDF/{{ $value->payer_id }}">{{ $value->payer_id }}</a></td>
                                   <td>{{ $value->description }}</td>
                                   <td>{{ $value->payment_method }}</td>
                                   <td>{{ "$".$value->amount.".00" }}</td>
                                 </tr>
                              @endforeach
                          </tbody>
                        </table>
                    </div>

                  </div>
               </div>
            </div>
            <div class="content-body-footer">
                AdSector
            </div>
        </div>
    </section>
</body>
<script>
    $(function(){
        $('#example').DataTable({
                "ordering": false,
                "pageLength": 7,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false,
        });
        $("#example_wrapper").children('.row:eq(0)').children("div:eq(0)").html('<h3>Payments History</h3>');
        $(".save_profile").click(function(){
                var input = new Object();
                $(".open_input").each(function(index,item){
                    input[$(this).attr('name')] = $(this).val();
                })
                changeProfile(input);
        });

        function changeProfile(input){
            var url = '/account/change';
            var data = { 
                input : input
             };
            $.post(url,data,function(response){
                $('input').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                $('.success_box').remove();
                if(response != 'success'){
                    for(var key in response){
                        $('input[name='+key+']').addClass('is-invalid').after('<div class="invalid-feedback">'+response[key]+'</div>');
                    }
                }else{
                    $('.first_h3').after('<div class="alert alert-info text-center success_box">Your changes have success saved.</div>');
                    $('.success_box').fadeOut(4000);
                }
            })
        }
        $(".menu3").click(function(){
            $(".nav-link").removeClass('active').removeClass('show');
        })
        $(".nav-link").click(function(){
            $(".menu3").removeClass("active").removeClass('active');
        })
    });
</script>
</html>