/**
 * Eventon Sync admin script
 */
jQuery(document).ready(function($){

	// change status on fetched data
		$('#evosy_fetched_events').on('click','.row',function(){
			statusObj = $(this).find('.status');
			status = $(this).attr('data-status');

			console.log('tt');

			if(status == 'ns'){
				$(this).attr('data-status','ss');
				statusObj.removeClass('ns').addClass('ss').attr('title','Selected');
				$(this).addClass('ss').removeClass('ns');
				$(this).find('.input_status').val('ss');

			}else if(status == 'ss'){
				$(this).attr('data-status','ns');
				statusObj.removeClass('ss').addClass('ns').attr('title','Not Selected');
				$(this).addClass('ns').removeClass('ss');
				$(this).find('.input_status').val('ns');
			}
		});
});