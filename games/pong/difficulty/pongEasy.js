class Vec {
	constructor(x = 0, y = 0) {
		this.x = x;
		this.y = y;
	}
	get length() {
		return Math.sqrt(this.x * this.x + this.y * this.y);
	}
	set length(value) {
		const fact = value / this.length;
		this.x *= fact;
		this.y *= fact;
	}
}

class Rect {
	constructor(width, height) {
		this.position = new Vec;
		this.size = new Vec(width, height);
	}
	get left() {
		return this.position.x - this.size.x / 2;
	}
	get right() {
		return this.position.x + this.size.x / 2;
	}
	get top() {
		return this.position.y - this.size.y / 2;
	}
	get bottom() {
		return this.position.y + this.size.y / 2;
	}
}

class Ball extends Rect {
	constructor() {
		super(10, 10);
		this.velocity = new Vec;
	}
}

var padelHeight = 100;
class Player extends Rect {
	constructor() {
		super(20, padelHeight);
		this.score = 0;
	}
}

// hasNotBounced and timerId enforce a 0.5 second delay for collision-detection.
var hasNotBounced = true;
let timerId = setInterval(() => hasNotBounced=true, 300);
var playerTurn = 0;

var bounceTimer = true;
let timer2Id = setInterval(() => bounceTimer=true, 300);

class Pong {
	constructor(canvas) {
		this._canvas = canvas;
		this._context = canvas.getContext('2d');

		this.ball = new Ball;

		this.players = [
			new Player, 
			new Player,
		];

		this.players[0].position.x = 40;
		this.players[1].position.x = this._canvas.width - 40;
		this.players.forEach(player => {
			player.position.y = this._canvas.height / 2;
		});

		let lastTime;
		const callback = (milliseconds) => {
			if (lastTime) {
				this.update((milliseconds - lastTime) / 1000);
			}
			lastTime = milliseconds;
			requestAnimationFrame(callback);
		};
		callback();

		this.CHAR_PIXEL = 10;
		this.CHARS = [ 
		'111101101101111', 
		'010010010010010',
		'111001111100111',
		'111001111001111',
		'101101111001001',
		'111100111001111',
		'111100111101111',
		'111001001001001',
		'111101111101111',
		'111101111001111',
		].map(str => {
			const canvas = document.createElement('canvas');
			canvas.height = this.CHAR_PIXEL * 5;
			canvas.width = this.CHAR_PIXEL * 3;
			const context = canvas.getContext('2d');
			context.fillStyle = '#fff';
			str.split('').forEach((fill, i) => {
				if (fill === '1') {
					context.fillRect((i % 3) * this.CHAR_PIXEL, (i / 3 | 0) * this.CHAR_PIXEL,
					this.CHAR_PIXEL,
					this.CHAR_PIXEL);
				}
			});
			return canvas;
		});

		this.reset();
	}

	collide(player, ball) {
		var i = playerTurn % 2;
		if (player.left < ball.right && player.right > ball.left && player.top < ball.bottom && player.bottom > ball.top && hasNotBounced) {
			hasNotBounced = false;
			const length = ball.velocity.length;
			ball.velocity.x = -ball.velocity.x;
			if (this.ball.position.y > this.players[i].position.y && ball.velocity.y < 400) {
				ball.velocity.y += 400 * ((ball.position.y - this.players[i].position.y) / (padelHeight/2));
			}
			else if (this.ball.position.y < this.players[i].position.y && ball.velocity.y > -400) {
				ball.velocity.y += 400 * ((ball.position.y - this.players[i].position.y) / (padelHeight/2));
			}
			else {
				ball.velocity.y = ball.velocity.y + 300*(Math.random() - .5);
				//ball.velocity.y += 300 * (Math.random() - .5);
			}

			if (ball.velocity.length < (this._canvas.width*1.70)) {
				ball.velocity.length = length * 1.08;
			}
		}
		playerTurn++;
	}

	draw() {
		this._context.fillStyle = '#000';
		this._context.fillRect(0, 0, this._canvas.width, this._canvas.height);
		
		this.drawRect(this.ball);
		this.players.forEach(player => this.drawRect(player))

		this.drawScore();
	}
	
	drawRect(rect) {
		this._context.fillStyle = '#fff';
		this._context.fillRect(rect.left, rect.top, 
								rect.size.x, rect.size.y);
	}

	drawScore() {
		const align = this._canvas.width / 3;
		const CHAR_W = this.CHAR_PIXEL * 4;
		this.players.forEach((player, index) => {
			const chars = player.score.toString().split('');
			const offset = align * (index + 1) - (CHAR_W * chars.length / 2) + this.CHAR_PIXEL / 2;
			chars.forEach((char, position) => {
				this._context.drawImage(this.CHARS[char|0], 
					offset + position * CHAR_W, 20);
			});
		});
	}

	reset() {
		this.ball.position.x = this._canvas.width / 2;
		this.ball.position.y = this._canvas.height / 2;
		this.ball.velocity.x = 0;
		this.ball.velocity.y = 0;
	}

	start() {
		if (this.ball.velocity.x === 0 && this.ball.velocity.y === 0) {
			this.ball.velocity.x = 400 * (Math.random() > .5 ? 1 : -1);
			this.ball.velocity.y = 400 * (Math.random() * 2 - 1);
			this.ball.velocity.length = 450;
		}
	}

	update(dt) {
		this.ball.position.x += this.ball.velocity.x * dt;
		this.ball.position.y += this.ball.velocity.y * dt;

		if (this.ball.left < 0 || this.ball.right > this._canvas.width) {
			const playerId = this.ball.velocity.x < 0 | 0;
			this.players[playerId].score++;
			this.reset();
		}
		if (this.ball.top < 0 || this.ball.bottom > this._canvas.width && bounceTimer) {
			this.ball.velocity.y = -this.ball.velocity.y;
			bounceTimer = false;
		}

		// AI DIFFICULTY. Math function is used to give randomness.
		// Ball far away from AI puck
		if (this.ball.position.x > (this._canvas.width/6) && this.ball.position.x < (this._canvas.width*0.583)) {

			if (this.players[1].position.y < this.ball.position.y - this._canvas.width*0.0166) {
				this.players[1].position.y += (this._canvas.height)*0.0066;
			}
			else if (this.players[1].position.y > this.ball.position.y + this._canvas.width*0.0166) {
				this.players[1].position.y -= (this._canvas.height)*0.0066;
			}

		} 
		// Ball very close to AI puck
		else if (this.ball.position.x > (this._canvas.width*0.583)) {

			if (this.players[1].position.y < this.ball.position.y - (padelHeight*0.4)) {
				this.players[1].position.y += (this._canvas.height)*0.025;
			}
			else if (this.players[1].position.y > this.ball.position.y + (padelHeight*0.4)) {
				this.players[1].position.y -= (this._canvas.height)*0.025;
			}
			else {
				this.players[1].position.y += 0.75*(this.ball.position.y - this.players[1].position.y);
			}
			
		}

		this.players.forEach(player => this.collide(player, this.ball));

		this.draw();

		if (this.players[0].score >= 10) {
			alert("YOU WON!");
		} 
		else if (this.players[1].score >= 10) {
			alert("YOU LOST!");
		}
	}
}


const canvas = document.getElementById('pong');
const pong = new Pong(canvas);


canvas.addEventListener('mousemove', event => {
	const scale = event.offsetY / event.target.getBoundingClientRect().height;
	pong.players[0].position.y = canvas.height * scale;
});

canvas.addEventListener('click', event => {
	pong.start()
});





