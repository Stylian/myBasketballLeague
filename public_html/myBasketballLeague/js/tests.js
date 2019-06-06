
$(document).on("click", "#test_league", testLeague);


function randomPoints() {
    return Math.floor(Math.random() * (10 + 1)) + 20;
}

function testLeague() {
	buildDB();
}

var rounds = 0;

function drawNextRound() {
	rounds ++;
	if(rounds == 1) {
		drawRound("r18");
	}else if(rounds == 2) {
		drawRound("r12");	
	}else if(rounds == 3) {
		drawRound("rpl");	
	}else{
		$("#report").empty().append("<br/> test finished successfully! ");
	}
}

function buildDB() {
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "ajax/buildDatabase.php?season="+$("#season_num").val(),
		dataType: "json",
		success: function() {
			$("#report").empty().append("<br/> built database! ");
			drawNextRound();
		},
		error: function() {
			alert("test failed");
		}
	});

	
}

function drawRound(round) {
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "ajax/generator.php?type=" + round + "&season="+$("#season_num").val(),
		success: function() {
			$("#report").empty().append("<br/> created round " + round + "!");
			testSaveGames();
		},
		error: function() {
			alert("test failed2");
		}
	});	
}

function testSaveGames() {
	$.ajax({
		method: "POST",
		cache: false,
		async: true,
		dataType: "json",
		url: "ajax/save_game.php?" +
			"away=" + randomPoints() +
			"&home=" + randomPoints() +
			"&season="+$("#season_num").val(),
		success: function() {
			$("#report").append("<br/> score added successfully! ");
			testSaveGames();
		},
		error: function() {
			drawNextRound();
		}
	});	
}