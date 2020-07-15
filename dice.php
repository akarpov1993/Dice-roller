<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>dices</title>

        <style>
        	body {
		    	width: 600px;
		    	margin: 25px auto;	
        	}
        	.crit-hit {
        		font-size: 20px;
        		color: green;
        	}
        	.crit-miss {
        		font-size: 20px;
        		color: red;
        	}
        	#log {
				height: 300px;
				overflow-y: scroll;
				border: 1px solid;
        	}
        	#result {
				font-size: 45px;
				text-align: center;
				height: 60px;
        	}
        	time {
        		margin-right: 10px;
        		font-size: 10px;
        	}
        	.logcounter {
				margin-right: 10px;
				font-size: 20px;
			}
        </style>
    </head>
    <body>
    	<form>
	    	<label for="how-many">№ of dices</label>
	    	<input type="number" min="1" max="100" name="how-many" id="how-many" value="2"> 
	    	<label for="dice">№ of sides</label>
	    	<input type="number" min="2" max="100" name="dice" id="dice" value="6">
	    	<input type="button" id="throw" value="Throw dices" onclick="diceThrow()">
    	</form>
    	<div id="result"></div>
    	<div id="log"></div>
    </body>
    <script>
    	let button = document.getElementById('throw');
    	button.addEventListener("keypress", function(event) {
			if (event.keyCode === 13) {
				event.preventDefault();
				document.getElementById("throw").click();
			}
		});


    	function diceThrow() {
    		let dices = [];
    		let log = [];
    		const summ = (a, b) => a + b;
			let howMany = validateInputs('how-many');
			let side = validateInputs('dice');
			let time = new Date();
			time = time.getHours() +':'+ time.getMinutes() +':'+ time.getSeconds();

    		for(i = 0; i < howMany; i++) {
    			dices.push(getRandomInt(1, side));
    		}

    		let reduced = dices.reduce(summ);
    		dices = dices.map(a => a == 1 ? a = '<span class="crit-miss">'+a+'</span>' : a == side ? a = '<span class="crit-hit">'+a+'</span>' : a);

    		log = '<time>' + time + '</time><span class="logcounter">'+ howMany+'d'+side +'.</span> ' + dices.join(' + ') + ' = ' + reduced;

    		document.getElementById('log').innerHTML += log + ';<hr>';

    		document.getElementById('result').innerHTML = '<span class="logcounter">'+ howMany+'d'+side +'.</span> ' + reduced;

    		let messages = document.getElementById('log');
			function scrollToBottom() {
				messages.scrollTop = messages.scrollHeight;
			}

			scrollToBottom();
    	}    	

		function getRandomInt(min, max) {
			return Math.floor(Math.random() * (max - min + 1)) + min;
		}

		function validateInputs(inputClass) {
			if (document.getElementById(inputClass).value > 100) {
				document.getElementById(inputClass).value = 100;
			} else if (document.getElementById(inputClass).value < 2 && inputClass == 'dice'){
				document.getElementById(inputClass).value = 2;
			} else if (document.getElementById(inputClass).value < 1) {
				document.getElementById(inputClass).value = 1;
			}
			return document.getElementById(inputClass).value
		}
    </script>