// SERVER CODE is JS. CLIENT CODE is HTML.


require('dotenv').config();
const api_url = process.env.LOL_API_KEY;
console.log(api_url);


const express = require('express');
const app = express();

app.listen(3000, () => console.log('listening at 3000'));
app.use(express.static('public'));
app.use(express.json({ limit: '1mb' }));

app.post('/api', (request, response) => {
	const data = request.body;
	response.json(data);
});

