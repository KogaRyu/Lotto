function fnEventingElements(){
	let eventingElements = {
		'playDetails'	: {
			'lotto_TwitterUserName'		: document.getElementById('lotto_twitter_user_name'),
			'lotto_DrawType'			: document.getElementById('lotto_draw_type'),
			'lotto_DrawDate'			: document.getElementById('lotto_draw_date'),
			'lotto_BallSignature'		: document.getElementById('lotto_ball_signature')
		},
		'playBalls'		: {
			'lotto_b1'					: document.getElementById('lotto_ball_1'),
			'lotto_b2'					: document.getElementById('lotto_ball_2'),
			'lotto_b3'					: document.getElementById('lotto_ball_3'),
			'lotto_b4'					: document.getElementById('lotto_ball_4'),
			'lotto_b5'					: document.getElementById('lotto_ball_5'),
			'lotto_b6'					: document.getElementById('lotto_ball_6')
		},
		'submitButton'	: {
			'lotto_Submit'				: document.getElementById('lotto_submit')
		}			
	};
	return eventingElements;
}

function fnEventingEvents(){
	let eventingEvents	= {
		'playDetails'	: ['click', 'change'],
		'playBalls'		: ['change'],
		'submitButton'	: ['click']
	};
	return eventingEvents;
}

function fnSettingsSend2Server(){
	let settingsSend2Server	= {
		'sendMethod'		: 'POST',
		'serverFileURL'		: 'Lotto_PHP_Class_DB_Talk2World.php',
		'asyncSync'			: true,
		'contentType'		: 'application/x-www-form-urlencoded',
		'userName'			: '',
		'passWord'			: '',		
		'elementIdNameList'	: [
			'combo_this', 'combo_specific', 'combo_history',
			'combo_each_Number', 'combo_Least_Recurring_Number', 'combo_Most_Recurring_Number',
			'combo_Never_Played_Combination', 'combo_Least_Played_Combination', 'combo_Most_Played_Combination'
		]
	};
	return settingsSend2Server;
}

/* 
	function fnServerString2Object(){
		let serverString2Object	= {
			'sender': "",

		};
		return serverString2Object;
	}
*/