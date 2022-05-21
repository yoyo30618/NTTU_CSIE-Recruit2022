
var mydate = new Date();
if	(mydate.getMinutes() < 30){
	var counter = 1800-mydate.getMinutes()*60-mydate.getSeconds();
}
if (mydate.getMinutes() > 30) {
	var counter = 3600-mydate.getMinutes()*60-mydate.getSeconds();
}

setInterval( function() {
	counter--;


	if ( counter >= 0 ) {
		id = document.getElementById("count");
		id.innerHTML = Math.floor(counter/60%60) + '分' + Math.floor(counter%60) + '秒';
	}
	if ( counter === 0 ) {
		id.innerHTML = "COMPLETE";
		document.getElementById('submit-btn').click();
	}
}, 1000);