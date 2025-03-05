<style>		
    #cookieConsent {
      background-color: rgba(20,20,20,0.95);
      min-height: 26px;
      color: #ccc;      
      padding: 8px 0 8px 30px;
      font-family: "Trebuchet MS",Helvetica,sans-serif;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      display: none;
      z-index: 999999;
    }
    #cookieConsent a {
      color: #4B8EE7;
      text-decoration: none;
    }
    #cookieConsentMini{
      position:fixed !important;      
      bottom: 12.5vh;
      left: 0.25rem;
      z-index: 999999;
      display: none;
    }
  </style>
    
	<div id="cookieConsent" class="alert alert-warnings m-1 p-2">		    
		<div class="my-1">
			<?=get('consent_text')?>
		</div>				
    
    <button type="button" class="btn btn-link text-warning cookieConsentOK m-0 py-1 float-right" ><?=get('consent_accept')?></button>    
    <button type="button" class="btn btn-link text-light   cookieConsentLater m-0 py-1 float-right" ><?=get('later')?></button>

    <div id="consent-autohide" class="my-2 small text-muted"><i>Tự động ẩn sau <span class="timer">10</span> giây.</i></div>            
	</div>

  <button id="cookieConsentMini" type="button"
      class="btn-medium btn-violet cookieConsentMini rounded-circle shadow" >
      <i class="fa fa-info-circle fa-1x5" aria-hidden="true"></i>
  </button>
  
  <script>

  </script>
<script>
<?php
	require_once ("js/consent.js");
?>
</script>