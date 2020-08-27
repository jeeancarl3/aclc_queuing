<script>
	var call_numbers;
	var shown
	var arr_count
	var exist_num
	var shown = false
	var o_name
	$(function(){
		time()

		load_queue()
		show_ads()
	    queue_number()
	    
	})
	var bleep = new Audio();
	bleep.src = "<?= base_url()?>assets/images/notif.mp3";

	function playBtnSound(){
		bleep.play();
	}

	function time(){
      var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','','Saturday'];
      var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      var date  = new Date();
      var ampm = date.getHours() < 12 ? 'AM' : 'PM';
      var hours = date.getHours() == 0 ? 12 :     date.getHours() > 12 ? '0'+(date.getHours() - 12) : date.getHours();
      var minutes = date.getMinutes() < 10 ?  '0' + date.getMinutes() : date.getMinutes();
      var seconds = date.getSeconds() < 10 ?  '0' + date.getSeconds() : date.getSeconds();
      var dayOfWeek = days[date.getDay()];
      var month = months[date.getMonth()];
      var day = date.getDate();
      var year = date.getFullYear();

      var dateString = "&nbsp; "+month + " "+day+", "+year + " &nbsp;"+hours+":"+minutes+":"+seconds + " "+ampm;
      $('.Timer').html(dateString);
    }
    window.setInterval(time, 1000);

// function voice_message(num, office, windows){
// 	if('speechSynthesis' in window){
// 		var text = "Number "+num+" Please Proceed to "+office+ " "+ windows;
// 		var msg = new SpeechSynthesisUtterance();
// 		var voices = speechSynthesis.getVoices();
// 		msg.voice = voices[0];
// 		msg.rate = (10 / 10);
// 		msg.pitch = 10;
// 		msg.text = text;

// 		msg.onend = function(e) {
// 			console.log('Finished in ' + event.elapsedTime + ' seconds.');
// 		};

// 		speechSynthesis.speak(msg);
//   	}
// }


function voice_message2(num, office,windows){
	try{
  		var speech = new SpeechSynthesisUtterance();

		// Set the text and voice attributes.
		speech.volume = 1;
		speech.rate = 1;
		speech.pitch = 1;
		var text = "Number "+num+" Please Proceed to "+office+ " "+ windows;
		speech.text = text;
		window.speechSynthesis.speak(speech);

	}catch(e){
		console.error(e);
	}
}

function show_modal(){
	if(typeof call_numbers != "undefined"){
		$('#window_name').html(call_numbers.win_name)
		$('#window_number').html(call_numbers.callN)
		if(call_numbers.shown == false){
			$('#myModal').modal("show");
			playBtnSound()
			voice_message2($('#window_number').html(),o_name,$('#window_name').html())
			setTimeout(function(){
				$('#myModal').modal('hide') 
			}, 3000);
			call_numbers.shown = true 
			
		}
	}
}
 

function queue_number(){
		$.ajax({
	      url: '<?= base_url()?>index.php/monitor/queue',
	      type: 'POST',
	      dataType:"JSON",
	    })
	    .done(function(data) {
	    	var val = data['data'];
	    	var lastVal;
	    	var counter = 0;

	      		$.each(val, function(index1, val1) {
	      			counter = counter + 1;
	      			if(counter == val.length){
	      				// if(arr_count != val1.initial_code+val1.trans_code+"-"+("000"+val1.queue_no).slice(-4)){
	      				if(arr_count != val1.initial_code+val1.trans_code+"-"+val1.queue_no){
		      				// $('#window_name').html(val1.window_name)
		      				// $('#window_number').html(val1.initial_code+val1.trans_code+"-"+("000"+val1.queue_no).slice(-4))
		      				$('#window_number').html(val1.initial_code+val1.trans_code+"-"+val1.queue_no)
		      				call_numbers = {"callN": $('#window_number').html(),'win_name':val1.window_name,'shown':false}
		      				arr_count = $('#window_number').html()
		      				o_name = val1.o_name
		      			}
	      			}
	      			if(val1.window_name.toLowerCase() == "window 1"){
	      				$('#monitor-window-'+val1.o_id).html("W-1");
	      			}else if(val1.window_name.toLowerCase() == "window 2"){
	      				$('#monitor-window-'+val1.o_id).html("W-2");
	      			}else if(val1.window_name.toLowerCase() == "window 3"){
	      				$('#monitor-window-'+val1.o_id).html("W-3");
	      			}else if(val1.window_name.toLowerCase() == "window 4"){
	      				$('#monitor-window-'+val1.o_id).html("W-4");
	      			}else if(val1.window_name.toLowerCase() == "window 5"){
	      				$('#monitor-window-'+val1.o_id).html("W-5");
	      			}
	      			// $('#monitor-window-'+val1.o_id).html(val1.window_name.toLowerCase());
	      	   		// $('#monitor-no-'+val1.o_id).html(val1.initial_code+val1.trans_code+"-"+("000"+val1.queue_no).slice(-4));
	      	   		$('#monitor-no-'+val1.o_id).html(val1.initial_code+val1.trans_code+"-"+val1.queue_no);
						
      			});
	      	show_modal()
	      	queue_number();
	    })

}
function load_queue(){
	$.ajax({
		url: '<?= base_url()?>index.php/monitor/queue/load_queue',
		type: 'POST',
		dataType: 'JSON',
	})
	.done(function(data) {
		$.each(data, function(index, val) {
      		$.each(val, function(index1, val1) {
      			if(val1.window_name.toLowerCase() == "window 1"){
      				$('#monitor-window-'+val1.o_id).html("W-1");
      			}else if(val1.window_name.toLowerCase() == "window 2"){
      				$('#monitor-window-'+val1.o_id).html("W-2");
      			}else if(val1.window_name.toLowerCase() == "window 3"){
      				$('#monitor-window-'+val1.o_id).html("W-3");
      			}else if(val1.window_name.toLowerCase() == "window 4"){
      				$('#monitor-window-'+val1.o_id).html("W-4");
      			}else if(val1.window_name.toLowerCase() == "window 5"){
      				$('#monitor-window-'+val1.o_id).html("W-5");
      			}
      				      		
      	   		// $('#monitor-no-'+val1.o_id).html(val1.initial_code+val1.trans_code+"-"+("000"+val1.queue_no).slice(-4));
      	   		$('#monitor-no-'+val1.o_id).html(val1.initial_code+val1.trans_code+"-"+val1.queue_no);
      		});
      	});
	})

	// show_modal()
}
function show_ads(){
	$('.carousel').carousel();
	var t;

	var start = $('#carouselExampleSlidesOnly').find('.active').attr('data-interval');
	t = setTimeout("$('#carouselExampleSlidesOnly').carousel({interval: 1000});", start-1000);

	$('#carouselExampleSlidesOnly').on('slid.bs.carousel', function () {  
	    clearTimeout(t);  
	    var duration = $(this).find('.active').attr('data-interval');
	    
	    $('#carouselExampleSlidesOnly').carousel('pause');
	    t = setTimeout("$('#carouselExampleSlidesOnly').carousel();", duration-1000);
	    if($(this).find('.item.active video')){
	    	$('.item.active video').get(0).pause()
	    	$('.item.active video').get(0).play()

	    }else{
	    	$('.right.carousel-control').carousel('next')
	    }
	})
	$('.right.carousel-control').on('click', function(){
    	clearTimeout(t);   
	});

	$('.left.carousel-control').on('click', function(){
	    clearTimeout(t);   
	});
}



</script>