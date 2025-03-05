$(document).ready(function () {
  if (localStorage.getItem("cookieSeen") != "shown") {
    setTimeout(function () {
      $("#cookieConsent").fadeIn(100);      
    }, 1000);

    $(".cookieConsentOK").click(function () {
      localStorage.setItem("cookieSeen", "shown");
      $("#cookieConsent").fadeOut(1000);
	  $('#cookieConsentMini').fadeOut(1000)
    });

    $(".button-close").click(function () {
      let confirmed = confirm("<?=get('consent_disagree_confirm')?>");
      if (confirmed) {
        window.close();
      }
    });
	
	$("#cookieConsentMini").click(function () {      
		$("#cookieConsent").fadeIn(1000);
		$("#cookieConsentMini").fadeOut(1000);
	});
	$(".cookieConsentLater").click(function () {      
		hideConsentBoard()
	});

	function hideConsentBoard(){
		clearInterval(timerAutoHide)
		$("#cookieConsent").fadeOut(1000);
		$('#cookieConsentMini').fadeIn(1000)	  		
		$('#consent-autohide').toggleClass('d-none', true)
	}

	let remainingSecs = 10
	let timerAutoHide = setInterval(()=>{
		if(remainingSecs == 0){
			hideConsentBoard()
		}
		$('#consent-autohide .timer').text(remainingSecs)
		remainingSecs --
	}, 1000)
  }

});
