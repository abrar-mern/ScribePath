const GEMINI_API_KEY = process.env.GEMINI_API_KEY;
const GEMINI_MODEL = process.env.GEMINI_MODEL || "gemini-2.5-flash";

const normalizePriority = (value) => {
  const normalized = String(value || "").toLowerCase();
  if (["low", "medium", "high"].includes(normalized)) {
    return normalized;
  }
  return "medium";
};

const buildPrompt = (text) =>
  `You are a project planner. Return ONLY valid JSON (no markdown) containing an array of tasks. Each task must have id (string), description (string), priority (low|medium|high), and dependencies (array of ids).

Transcript:
${text}

Return JSON only.`;

const parseTasksFromModel = (content) => {
  let parsed;
  try {
    parsed = JSON.parse(content);
  } catch (error) {
    throw new Error("Invalid JSON returned by model");
  }

  const tasks = Array.isArray(parsed) ? parsed : parsed.tasks;
  if (!Array.isArray(tasks)) {
    throw new Error("Model response missing tasks array");
  }

  return tasks.map((task, index) => ({
    id: String(task?.id ?? `${index + 1}`),
    description: String(task?.description ?? "").trim(),
    priority: normalizePriority(task?.priority),
    dependencies: Array.isArray(task?.dependencies) ? task.dependencies : [],
  }));
};

export const extractTasksFromTranscript = async (text) => {
  if (!GEMINI_API_KEY) {
    throw new Error("GEMINI_API_KEY is missing");
  }

  const prompt = buildPrompt(text);
  const response = await fetch(
  `https://generativelanguage.googleapis.com/v1/models/${GEMINI_MODEL}:generateContent?key=${GEMINI_API_KEY}`,
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        contents: [
          {
            role: "user",
            parts: [{ text: prompt }],
          },
        ],
        generationConfig: {
          temperature: 0.2,
        },
      }),
    }
  );

  if (!response.ok) {
    const errorText = await response.text();
    throw new Error(`LLM request failed: ${errorText}`);
  }

  const data = await response.json();
  const content = data?.candidates?.[0]?.content?.parts?.[0]?.text;
  if (!content) {
    throw new Error("LLM response missing content");
  }

  return parseTasksFromModel(content);
};