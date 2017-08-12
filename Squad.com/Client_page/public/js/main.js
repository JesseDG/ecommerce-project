/*price range*/

 //$('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};

/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});

});


id = '';
input = true;
function displayMessage(e) {

	input = true;
	id = $(e).attr("id");
	val = $("#message-container").attr("value");

	$.ajax({
		url:'contactUs/getSubject/'+id+"/"+val,
		success:function (data) {

			objJSon = JSON.parse(data);
			$("#spanSubject").html(objJSon['name']);
			$("#nmbMessages").html(objJSon['size']);

		}
	});

	$("#mailbox").html("");

	messageBox = $("#newMsg");
	boxReply = $("#messageBox-adminReply");
	subject = $("#subject");
	span = $("#spanSubject");

	$(boxReply).show(500);
	$("#spanMsg").html($("#preview"+id).html());

	if (messageBox.is(":visible") == false && subject.is(":visible") == false) {
		$(messageBox).show(500);

		$(subject).show(500);
	}
	else if(span.is(":visible") == false){

		$("#newSubject").remove();
		$(span).show(200);
	}
	else{
		$("#spanMsg").html($("#preview"+id).html());
	}

	if($("#trigger").hasClass("triggerNew"))
		$("#trigger").removeClass("triggerNew");

	$("#trigger").addClass("triggerReply");
}



function composeMessage(){

	if(input) {
		//check if the box to send message is visible
		messageBox = $("#newMsg");
		if (messageBox.is(":visible") == false) {
			$(messageBox).show(500);
		}

		//check if the message container from a previous message is visible
		boxReply = $("#messageBox-adminReply");
		if (boxReply.is(":visible")) {
			$(boxReply).hide("slow");
		}

		//check if subject div is visible
		subject = $("#subject");
		if (subject.is(":visible") == false)
			subject.show(100);

		span = $("#spanSubject");

		getParent = $(span).parent();
		$(span).hide();
		$(getParent).append("<input id=\"newSubject\" class='form-control'>");


		if ($("#trigger").hasClass("triggerReply"))
			$("#trigger").removeClass("triggerReply");

		$("#trigger").addClass("triggerNew");
	}
	input = false;
}

function sendMessage(){

	if($("#trigger").hasClass("triggerReply")){

		$subject = $("#spanSubject").html();
		$messageID = id;

		if(checkText($("textarea"))){
			$content = $("textarea").val();
			$.post
			(
				'contactUs/reply',
				{
					subjectName: $subject,
					messageID: $messageID,
					content: $content
				},
				function (data) {
					$("#"+id).hide('slow',function () {
						$this.remove();
					})
					$("textarea").val("");
					$("#newMsg").hide("slow");
					$("#messageBox-adminReply").hide("slow");
					$("#subject").hide("slow");


				}
			)
		}
		else{
			$("textarea").attr("placeholder",'Please type some text before sending');
		}

	}
	else{

		$user = $("#userIn").attr('value');
		if(checkText($("textarea")) && checkText($("#newSubject"))) {
			$content = $("textarea").val();
			$subject = $("#newSubject").val();
			$.post
			(
				'contactUs/compose',
				{
					subjectName: $subject,
					user: $user,
					content: $content
				},
				function (data) {
					$("textarea").val("");
					$("#newMsg").hide("slow");
					$("#messageBox-adminReply").hide("slow");
					$("#subject").hide("slow")
					$("#newSubject").remove();
					input = true;

				}
			)

		}
		else{
			$("textarea").attr("placeholder",'Please type some text before sending');
			$("#newSubject").attr("placeholder",'Please type some text before sending');
		}
	}

}

function checkText(e){
	return $(e).val().trim().length != 0;
}