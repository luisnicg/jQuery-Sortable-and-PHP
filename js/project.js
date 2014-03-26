$(function() {

	$.fn.sortableli = function() {
		$("#sortable li").each(function(index){
			var parent = $(this);
			$( this ).hover(function(){
				var cb = $(this).find(":checkbox");
				$(this).find("img").toggleClass('display-show');
				if(!cb.is(':checked')){
					cb.toggleClass('display-show');
				}
			});
			$(this).find(".edit-ico").click(function(){
				$("#url").val( parent.find("a").attr('href') );
				$("#id_url").val($(this).attr('id'));
				$("#url").focus();
				return false;
			});
		});

		$(this).find(":checkbox").click(function(){
			$('#delete_button').addClass('display-none');
			$(".checkbox").each(function(index){
				if($(this).is(':checked')){
					$('#delete_button').removeClass('display-none');
				}
			});
		});
		return this;
	};

	// Get all active bookmark
	$.fn.selectable = function() {
		$.post( "form/select.php", function(data){
			$("#sortable").html('');
			$("#sortable").prepend(data);
			$("#sortable").sortableli();
		} );
		return this;
	}; 
	
	// Create sortable
	$( "#sortable" ).selectable();
	$( "#sortable" ).sortable({
		placeholder: "ui-state-highlight",
		update: function( event, ui ) {
			var sorted = $( "#sortable" ).sortable( "serialize", { key: "sort" } );
			$.post( "form/order.php",{ 'choices[]': sorted});
		}
	});
	$( "#sortable" ).disableSelection();

	// Insert new bookmark
	$("#save_button").click(function(){
		$(".error-message").addClass("display-none");

		if($("#url").val().length > 0){
			if(ValidaURL($("#url").val())){
				$.post( "form/insert.php", { url: $("#url").val(),id: $("#id_url").val() }, function(data){
					$( "#sortable" ).selectable();
					$('#url').val('');
				} );
				$("#id_url").val('');
			}else{
				$(".error-message").html("La dirección web proporcionada no es correcta.");
				$(".error-message").removeClass("display-none");
			}
		}else{
			$(".error-message").html("Debes introducir una dirección web.");
			$(".error-message").removeClass("display-none");
		}
		return false;
	});

	// Delete bookmarks
	$("#delete_button").click(function(){
		array_val =  [];

		$(".checkbox").each(function(index){
			if($(this).is(':checked')){
				array_val.push($(this).attr('id'));
			}
		});

		$.post( "form/delete.php",{'choices[]':array_val}, function(data){
			$( "#sortable" ).selectable();
			$('#delete_button').addClass('display-none');
		} );
		return false;
	});

	/*$("#url").blur(function(){
		$(".error-message").addClass("display-none");
		$("#id_url").val('');
		$('#url').val('');
	});*/
});

function ValidaURL(url) {
	var regex=/^(ht|f)tps?:\/\/\w+([\.\-\w]+)?\.([a-z]{2,4}|travel)(:\d{2,5})?(\/.*)?$/i;
	return regex.test(url);
}