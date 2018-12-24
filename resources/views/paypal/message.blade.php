<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@if ($message = Session::get('success'))
<div class="w3-panel w3-green w3-display-container">
<span onclick="this.parentElement.style.display='none'"
class="w3-button w3-green w3-large w3-display-topright">&times;</span>
<p>{!! $message !!}</p>
</div>
<?php Session::forget('success');?>
@endif
@if ($message = Session::get('error'))
<div class="w3-panel w3-red w3-display-container">
<span onclick="this.parentElement.style.display='none'"
class="w3-button w3-red w3-large w3-display-topright">&times;</span>
<p>{!! $message !!}</p>
</div>
<?php Session::forget('error');?>
@endif