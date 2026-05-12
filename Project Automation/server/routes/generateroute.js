import express from 'express';
import {generateResponse} from "../controllers/generateController.js"

const router = express.Router();

// Route to handle response generation
router.post('/generate', generateResponse);

export default router;
