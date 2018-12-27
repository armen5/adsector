<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <style>
    .am-header {
        overflow: hidden;
        background: #325069;
    }
    .logo-main{
        padding: 10px;
        background-color:#4a7498;;
    }
    .logo-main a{
        border-radius: 10px;
    }
    .am-header-line {
        height: 12px;
        background: #9c9c9c;
        border-top: 1px solid #bdbdbd;
        border-bottom: 1px solid #ebebeb;
    }
    .content-body-wrapper{
        position: relative;
        box-sizing: border-box;
        padding: 10px 13px 0px 13px;
        border-color: #dbdbdb;
        border-width: 0 1px;
        border-style: solid;
        background-color: white;
        height: 100%;
    }
    .content-body{
        box-sizing: border-box;
        padding: 15px;
        width: 100%;
        height: 100%;
    }
    .content-body-footer{
        position: absolute;
        bottom: 0px;
        left: 0px;
        width: 100%;
        background-color: #254a6d;
        padding: 5px 20px;
        font-size: 14px;
        z-index: 2;
        color:white;
    }
    .am-user-identity-block {
        font-weight: bold;
        line-height: 24px;
    }
    section{
        background-color: #ededed;
        width: 100%;
        height: 92vh;
        position: relative;
        overflow: hidden;
        font-family: Tahoma, Arial, san-serif;
    }
    section a{
        font-weight: normal;
        color: #3f7fb0;
    }
    .am-account-toolbar ul{
        background: #f5f5f5;
        border: 1px solid #ccc;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
    }
    .am-account-toolbar ul li{
        border-right: 1px solid #ccc;
    }
     .am-account-toolbar ul a{
        display: block;
        box-sizing: content-box;
        margin: 0;
        height: 1.5em;
        line-height: 1.5em;
        padding: 0.5em 1em;
        border-right: 1px solid #ccc;
        color: #555960;
        font-size: 13px;
        text-shadow: 0 -1px 1px #c7c8c9;
        text-decoration: none;
    }
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        background-color: #e34b3d;
        border-color: #c7665b;
        color: white;
        text-shadow: 0 -1px 1px #c43d33;
    }
    .tab-content h3{
        font-size: 1.4rem;
        font-weight: normal;
        color: #333;
        line-height: 1em;
        height: auto;
        margin-bottom: 0.6em;
    }
    .am-info {
        background: #dfe8f0;
        border: 1px solid #ccddeb;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        margin-bottom: 1em;
        padding: 0.5em 1em;
    }
    .member-info{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width: 100%;
        height: auto;
        background-color: #f5f5f5;
        box-sizing: border-box;
        padding: 10px 0px;
    }
    .member-info>div{
        width: 425px;
        min-height: 180px;
        box-sizing: border-box;
        padding: 0px 5px;
    }
    .am-block {
        color: #666;
        background: #fff;
        border: 1px solid #e0e0e0;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        margin-bottom: 1em;
        padding: 1em;
        box-shadow: 0 1px 1px #e0e0e0;
    }
    .member-info h4 {
        font-size: 1.2rem;
        line-height: 1em;
        height: auto;
        margin-bottom: 0.6em;
    }
    #menu2 table{
        border-radius: 3px;
        border: 1px solid #ddd;
        border-top: 2px solid #d0d0d0;
        box-shadow: 0 1px 1px -1px #b0b0b0;
        background: #fff;
        margin: 0;
        padding: 0;
        text-align: left;
    }
    #menu2 td{
        padding: 15px 0px;
    }
    #menu2 tr{
        border:1px dashed #8a795d;
    }
    #menu2 .hide_password_filds{
        display: none;
    }
    </style>
</head>
<body>
    <header style="height: 8vh;position: relative;">
        <nav class="am-header p-0">
          <!-- Brand/logo -->
          <div class="w-50 m-auto logo-main">
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
        <div class="content-body-wrapper w-50 m-auto">
            <div class="content-body">

                <div class="am-account-toolbar-items">
                    <div class="am-user-identity-block">
                        <img src="{{ asset('images/identity-glyph.png') }}" alt="">
                        <span class="am-user-identity-block_login">{{ $first_name." ".$last_name }}</span>
                        <a href="/account/logout">Logout</a>
                    </div>
               </div>

               <div class="am-account-toolbar" style="padding-top: 15px">
                   <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="pill" href="#home"><img src="{{ asset('images/dashboard.png') }}" alt=""></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#menu1">Add/Renew Subscription</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#menu2">Profile</a>
                    </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div id="home" class="container tab-pane active"><br>
                      <h3>Your Membership Information</h3>
                      <div class='member-info'>
                          <div style="border-right:1px solid #ccc;">
                              <div>
                                <h4>Active Subscriptions</h4>
                                <div class="am-block" id="member-main-subscriptions">
                                        <strong>Premium subscription</strong> -next bill {{ $end_payment }} <a class="cancel-subscription local-link" href="/account/payment/paypal/cancel">cancel</a>
                                </div>
                              </div>
                              <div>
                                  <h4>Unsubscribe from all e-mail messages</h4>
                                  <div class="am-block" id="member-main-unsubscribe">
                                    <label for="checkbox-unsubscribed"><input type="checkbox" name="unsubscribed" id="checkbox-unsubscribed" value="1"> Unsubscribe from all e-mail messages</label>
                                </div>
                              </div>
                          </div>
                          <div></div>
                      </div>
                    </div>
                    <div id="menu1" class="container tab-pane fade"><br>
                      <h3>Create account</h3>
                     <div class="am-info">You are logged-in as <strong>jscanlan84</strong>. <a href="/account/logout?amember_redirect_url=%2Faccount%2Fsignup">Logout</a> to signup as new user.</div>
                      <table>
                          <tbody>
                              <tr>
                                  <td></td>
                                  <td></td>
                              </tr>
                              <tr>
                                  <td></td>
                                  <td></td>
                              </tr>
                              <tr>
                                  <td></td>
                                  <td></td>
                              </tr>
                              <tr>
                                  <td></td>
                                  <td></td>
                              </tr>
                              <tr>
                                  <td colspan="2" >
                                      
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                    </div>
                    <div id="menu2" class="container tab-pane fade"><br>
                      <h3>Customer Profile</h3>
                      <form action=""></form>
                      <table class="w-75 m-auto">
                          <tbody>
                              <tr>
                                  <td class="w-50 text-right "><h5><sup class="text-danger">*</sup> First & Last Name</h5></td>
                                  <td class="w-50">
                                   <div class="row" style="padding-left: 10px">
                                    <div class="col">
                                      <input type="text" class="form-control" placeholder="First name">
                                    </div>
                                    <div class="col">
                                      <input type="text" class="form-control" placeholder="Last name">
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
                                          <input type="text" class="form-control" placeholder="First name">
                                        </div>
                                     </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="text-right">
                                      <h5>password</h5>
                                  </td>
                                  <td style="vertical-align: top;">
                                      <span class="open_password_filds" style="padding-left: 10px;cursor: pointer;">change</span>
                                  </td>
                                  <script>$('.open_password_filds').click(function(){ $('.hide_password_filds').show();$(this).parents('tr').hide()})</script>
                              </tr>
                              <tr class="hide_password_filds">
                                  <td class="text-right">
                                      <h5><sup class="text-danger">*</sup> Your E-Mail Address</h5>
                                      <p>a confirmation email will be sent to you at this address</p>
                                  </td>
                                  <td style="vertical-align: top;">
                                     <div class="row" style="padding-left: 10px">
                                        <div class="col">
                                          <input type="text" class="form-control" placeholder="First name">
                                        </div>
                                     </div>
                                  </td>
                              </tr>
                              <tr class="hide_password_filds">
                                  <td class="text-right">
                                      <h5><sup class="text-danger">*</sup> Your E-Mail Address</h5>
                                      <p>a confirmation email will be sent to you at this address</p>
                                  </td>
                                  <td style="vertical-align: top;">
                                     <div class="row" style="padding-left: 10px">
                                        <div class="col">
                                          <input type="text" class="form-control" placeholder="First name">
                                        </div>
                                     </div>
                                  </td>
                              </tr>
                              <tr class="hide_password_filds">
                                  <td class="text-right">
                                      <h5><sup class="text-danger">*</sup> Your E-Mail Address</h5>
                                      <p>a confirmation email will be sent to you at this address</p>
                                  </td>
                                  <td style="vertical-align: top;">
                                     <div class="row" style="padding-left: 10px">
                                        <div class="col">
                                          <input type="text" class="form-control" placeholder="First name">
                                        </div>
                                     </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td colspan="2" class="text-center">
                                      <button class="btn btn-premary text-info">Save Profile</button>
                                  </td>
                              </tr>
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
</html>