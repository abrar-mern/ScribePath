import Transcript from "../models/Transcript.js";
import Task from "../models/Task.js";
import { extractTasksFromTranscript } from "../services/aiservice.js";

const sanitizeDependencies = (tasks) => {
  const ids = new Set(tasks.map((task) => task.id));
  return tasks.map((task) => ({
    ...task,
    dependencies: (Array.isArray(task.dependencies) ? task.dependencies : [])
      .map((dep) => String(dep))
      .filter((dep) => ids.has(dep) && dep !== task.id),
  }));
};

const detectCycles = (tasks) => {
  const graph = new Map();
  tasks.forEach((task) => {
    graph.set(task.id, task.dependencies || []);
  });

  const visiting = new Set();
  const visited = new Set();
  let hasCycle = false;

  const dfs = (node) => {
    if (visiting.has(node)) {
      hasCycle = true;
      return;
    }
    if (visited.has(node)) return;

    visiting.add(node);
    const neighbors = graph.get(node) || [];
    neighbors.forEach((neighbor) => dfs(neighbor));
    visiting.delete(node);
    visited.add(node);
  };

  for (const node of graph.keys()) {
    if (!visited.has(node)) {
      dfs(node);
    }
  }

  return hasCycle;
};


export const generateResponse = async (req, res) => {
  try {
    const { transcript: text } = req.body;

    if (!text) {
      return res.status(400).json({ error: "Transcript required" });
    }

    // 1️⃣ Save transcript
    const transcript = await Transcript.create({ text });

    // 2️⃣ AI call
    let tasks = await extractTasksFromTranscript(text);

    // 3️⃣ Validate dependencies
    tasks = sanitizeDependencies(tasks);

    // 4️⃣ Cycle detection
    const hasCycle = detectCycles(tasks);
    const status = hasCycle ? "blocked" : "pending";

    // 5️⃣ Save tasks
    const savedTasks = await Task.insertMany(
      tasks.map((task) => ({
        id: task.id,
        description: task.description,
        priority: task.priority,
        dependencies: task.dependencies,
        transcriptId: transcript._id,
        status,
      }))
    );

    // 6️⃣ Return response
    res.json({
      transcriptId: transcript._id,
      status: hasCycle ? "blocked" : "ok",
      tasks: savedTasks,
    });

  } catch (error) {
    res.status(500).json({ error: "Server error", detail: error.message });
  }
};