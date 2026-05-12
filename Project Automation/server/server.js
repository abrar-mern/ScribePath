import express from 'express';
import cors from 'cors';

import connectDB from './config/database.js';
import { generateResponse } from './controllers/generateController.js';

const app = express();

// Middleware
app.use(cors());
app.use(express.json());

// Connect to Database
connectDB();

// Routes
app.get('/', (req, res) => {
    res.send('Welcome to Autonomix API');
});

app.post('/api/generate', generateResponse);

// Start the Server
const PORT = process.env.PORT || 4000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});

