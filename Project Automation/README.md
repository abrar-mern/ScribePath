# InsightBoard Dependency Engine (Autonomix Meeting App)

## Links
- GitHub Repository: https://github.com/abrar-khan-WD/assignments.git
- Live Hosted App: https://assignments-psi-seven.vercel.app

## Level Completed
- Level 1 (Core extraction + dependency graph)
- Level 3 (Cycle detection)

## LLM API + Tech Stack
- LLM API: Google Gemini (Generative Language API)
- Frontend: React 19, Vite, Tailwind CSS
- Backend: Node.js, Express
- Database: MongoDB (Mongoose)

## Cycle Detection (Level 3)
Cycle detection is implemented as a DFS over the dependency graph in `server/utils/cycleDetector.js`:
- Build a directed adjacency list from each task's `id` to its `dependencies`.
- Use a `visited` set to avoid re-processing nodes.
- Use a recursion `stack` set to detect back-edges; if a node is encountered while already in the stack, a cycle exists.

## Idempotency Logic (Level 2)
Level 2 was not implemented, so there is no idempotency logic in this submission.

## Local Setup
### Prerequisites
- Node.js 18+ (recommended)
- MongoDB connection string

### Install
1. Install dependencies:
   - `npm install`

2. Create a backend env file at `server/.env`:
   ```
   GEMINI_API_KEY=your_key_here
   GEMINI_MODEL=gemini-2.5-flash
   MONGO_URI=your_mongodb_connection_string
   PORT=4000
   ```

### Run
- Start the backend:
  - `npm run server`
- Start the frontend (in another terminal):
  - `npm run dev`

The app should be available at the Vite dev server URL, and the API at `http://localhost:4000`.

