
function createSeason() {
	 
	startProcess("building database tables...");
		
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "ajax/buildDatabase.php?season="+$("#season_num").val(),
		dataType: "json",
		beforeSend: $.blockUI,
		complete: $.unblockUI,
		success: function() {
			window.location.href = "http://localhost/BasketballLeague/index.php?season=" + $("#season_num").val();
		},
		error: function() {
			$.notify("error: c7d5f70b", "error");
		}
	});

}

function generator() {
	
	var type = $(this).attr("id").split("_")[1];

	startProcess("generating round...");
		
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "ajax/generator.php?type=" + type + "&season="+$("#season_num").val(),
		beforeSend: $.blockUI,
		complete: $.unblockUI,
		success: function() {
			location.reload();
		},
		error: function() {
			$.notify("error: ab116857", "error");
		}
	});

}

function tabSelected() {

	selectTabUI($(this));
	
	var type = $(this).attr("id");

	$(".inner_main").hide();
	$("#main_" + type).show();

}

function daySelected() {
	
	selectDayUI($(this));
	
	var day = $(this).attr("id").split("_")[2];

	$(".day").hide();
	$("#day_" + day).show();

}

function selectDayUI(target) {
	$(".daySelector").removeClass("active_day");
	$(target).addClass("active_day");
}

function selectTabUI(target) {
	$(".tab").removeClass("active");
	$(target).addClass("active");
}

function loaderFunc() {
	
    $('.group_table').DataTable({
		"paging":   false,
		"bFilter":	false,
		"bInfo":	false
	});
	
	var current_phase = $("#current_phase").val();
	var current_day = $("#current_day").val().split("_")[1];

	jQuery( $("#" + current_phase) ).trigger( jQuery.Event( "click" ) );
	jQuery( $("#day_selector_" + current_day) ).trigger( jQuery.Event( "click" ) );	
}

function startProcess(msg) {
	$.blockUI.defaults.message = '<img src="images/ajax-loader.gif" width="16px" height="16px">' +
		'</img><p id="modal_message">' + msg + '</p>';
	
}

function saveGame() {
	
	var away = $("#away_score").val();
	var home = $("#home_score").val();

	if(away == " " && home == " ") {
		startProcess("saving game...");	
		
		$.ajax({
			method: "POST",
			dataType: "json",
			url: "ajax/save_game.php?" +
				"away=" + away +
				"&home=" + home +
				"&season="+$("#season_num").val(),
			beforeSend: $.blockUI,
			complete: $.unblockUI,
			success: function() {
				location.reload();
			},
			error: function() {
				$.notify("error: ad34e70f", "error");
			}
		});	
		return;
	}
	
	if(away != parseInt(away, 10) ||
		home != parseInt(home, 10)	) {
		$.notify("field is not a number", "error");
		return;
	}
	
	if(away == home) {
		$.notify("scores are equal", "error");
		return;
	}

	startProcess("saving game...");
		
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "ajax/save_game.php?" +
			"away=" + away +
			"&home=" + home +
			"&season="+$("#season_num").val(),
		beforeSend: $.blockUI,
		complete: $.unblockUI,
		success: function() {
			location.reload();
		},
		error: function() {
			$.notify("error: 7a380e43", "error");
		}
	});
}

