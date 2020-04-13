include("Lotto_JS_XHR_UltraModular.js");

/* let ball_sign = document.getElementsByName("ball_signature")[0];
let ballz = document.getElementsByClassName("ball");
let eventingElements = {
	'playDetails'	: {
		'twitterUserName'		: document.getElementById('twitter_user_name'),
		'twitterDrawType'		: document.getElementById('twitter_draw_type'),
		'twitterDrawDate'		: document.getElementById('twitter_draw_date'),
		'twitterBallSignature'	: document.getElementById('twitter_ball_signature')
	},
	'playBalls'		: {
		'b1'					: document.getElementById('twitter_ball_1'),
		'b2'					: document.getElementById('twitter_ball_2'),
		'b3'					: document.getElementById('twitter_ball_3'),
		'b4'					: document.getElementById('twitter_ball_4'),
		'b5'					: document.getElementById('twitter_ball_5'),
		'b6'					: document.getElementById('twitter_ball_6')
	},
	'submitButton'	: {
		'submit'				: document.getElementById('twitter_summit')
	}			
};
let eventingEvents	= {
'playDetails'	: ['click', 'change', 'blur'],
'playBalls'		: ['change', 'blur'],
'submitButton'	: ['click']
}; */			

function addAllEvents(elements2Add,events2Add) {
	for (let eventingEachElementName in elements2Add) {
		let eventingEachElementObject = elements2Add[eventingEachElementName];
		for (let eventingEventNames in eventingEachElementObject) {
			let eventingEventsArray = events2Add[eventingEachElementName];
			for (let eventingEachSpecificEvent of eventingEventsArray) {
				eventingEachElementObject[eventingEventNames].addEventListener(eventingEachSpecificEvent, submitRequest2Server);
			}
		}
	}
}

function orderDigits2(ball_sign,ballz) {
	if(!anyElementHasFocus(ballz)){
		let ballz_valz = [];
		let count_ballz = 0;					
		let for_tempHolder = "";

		for(let ball of ballz){
			ballz_valz[count_ballz] = Number(ball.value);
			count_ballz++;
		}

		ballz_valz.sort(function(a, b){return a-b});

		for(let ball_val of ballz_valz){
			if(for_tempHolder == ""){
				for_tempHolder = ball_val;
			}
			else{						
				for_tempHolder += ("-" + ball_val);
			}
		}

		ball_sign.value = for_tempHolder;
		console.log(ball_sign.value);
	}
}

function orderDigits(ball_sign,ballz) {
	let elementHasFocus = anyElementHasFocus(ballz);
	if(!elementHasFocus){
		let ballVals = BallzValues(ballz);
		let ballSortedValz = BallzSort(ballVals);
		let ballJoined = BallzJoin(ballSortedValz);

		ball_sign.value = ballJoined;
		console.log(ball_sign.value);
	}
}

function BallzValues(ballzElementsInput) {
	//	Since it's a collection and not an array.
	//	https://medium.com/@chuckdries/traversing-the-dom-with-filter-map-and-arrow-functions-1417d326d2bc
	let ballzValues = Array.prototype.map.call(ballzElementsInput, ball => ball.value );
	return ballzValues;
}

function BallzSort(ballzArrayValues) {
	let ballzSortedValues = ballzArrayValues.sort( (a, b) => a-b );
	return ballzSortedValues;
}

function BallzJoin(ballzValues2Join) {
	const ballzReducerJoin = (reduced, arrayElement) => reduced+"-"+arrayElement;
	let ballzSignature = ballzValues2Join.reduce(ballzReducerJoin);

	return ballzSignature;
}

function anyElementHasFocus2(arrayElements) {
	let anyFocused = false;
	for(let arrayElement of arrayElements){
		if(arrayElement.hasfocus){
			anyFocused = true;
			break;
		}
	}
	return anyFocused;
}

function anyElementHasFocus(arrayElements) {
	let anyFocused = Array.prototype.filter.call(arrayElements,(arrayElement) => arrayElement.hasfocus==true);
	return anyFocused.lenght==0;
}

/* orderDigits(ball_sign,ballz);
addAllEvents(eventingElements,eventingEvents); */