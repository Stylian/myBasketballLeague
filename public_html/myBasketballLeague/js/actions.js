
$.blockUI.defaults.css = { 
	padding: '5px',
	margin: '5px',
	width: '30%',
	top: '40%',
	left: '35%',
	textAlign: 'center',
	cursor: 'wait',
	border: '2px solid #aaa',
	backgroundColor: '#eee'
};

$(document).on("click", ".tab", tabSelected);
$(document).on("click", ".daySelector", daySelected);
$(document).on("click", "#header", function() {
	location.reload();
});
$(document).ready(loaderFunc);
$(document).on("click", ".generator", generator);
$(document).on("click", "#save_img", saveGame);
$(document).on("click", "#create_season_btn", createSeason);
