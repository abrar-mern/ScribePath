import React, { useMemo, useState } from "react";

const App = () => {
  const [transcript, setTranscript] = useState("");
  const [tasks, setTasks] = useState([]);
  const [completed, setCompleted] = useState(new Set());
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const tasksWithStatus = useMemo(() => {
    return tasks.map((task) => {
      const isCompleted = completed.has(task.id);
      const dependenciesMet = (task.dependencies || []).every((dep) => completed.has(dep));
      const status = isCompleted ? "completed" : dependenciesMet ? "ready" : "blocked";

      return { ...task, status };
    });
  }, [tasks, completed]);

  const handleGenerate = async () => {
    setLoading(true);
    setError("");
    setCompleted(new Set());

    try {
      const response = await fetch("http://localhost:4000/api/generate", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ transcript }),
      });

      const data = await response.json();
      if (!response.ok) {
        throw new Error(data?.detail || data?.error || "Failed to generate tasks");
      }

      setTasks(data.tasks || []);
    } catch (err) {
      setError(err.message || "Something went wrong");
    } finally {
      setLoading(false);
    }
  };

  const handleComplete = (taskId) => {
    setCompleted((prev) => {
      const next = new Set(prev);
      next.add(taskId);
      return next;
    });
  };

  return (
    <div className="min-h-screen bg-slate-950 px-6 py-10 text-slate-100">
      <div className="mx-auto max-w-3xl space-y-6">
        <header>
          <h1 className="text-3xl font-semibold">Meeting Tasks</h1>
          <p className="mt-2 text-sm text-slate-300">
            Paste meeting notes, generate tasks, and mark them complete to unlock dependencies.
          </p>
        </header>

        <section className="space-y-3 rounded-2xl border border-slate-800 bg-slate-900/40 p-4">
          <label className="text-sm text-slate-200">Meeting transcript</label>
          <textarea
            className="min-h-[120px] w-full rounded-lg border border-slate-700 bg-slate-950 p-3 text-sm text-slate-100"
            placeholder="Paste meeting notes here..."
            value={transcript}
            onChange={(event) => setTranscript(event.target.value)}
          />
          <button
            className="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500 disabled:opacity-60"
            onClick={handleGenerate}
            disabled={!transcript.trim() || loading}
          >
            {loading ? "Generating..." : "Generate tasks"}
          </button>
          {error && <p className="text-sm text-red-400">{error}</p>}
        </section>

        <section className="space-y-3">
          <h2 className="text-lg font-semibold">Tasks</h2>
          {tasksWithStatus.length === 0 ? (
            <p className="text-sm text-slate-400">No tasks yet. Generate from transcript.</p>
          ) : (
            <div className="space-y-3">
              {tasksWithStatus.map((task) => (
                <div
                  key={task.id}
                  className="rounded-xl border border-slate-800 bg-slate-900/40 p-4"
                >
                  <div className="flex items-center justify-between">
                    <div>
                      <div className="text-sm text-slate-400">Task {task.id}</div>
                      <div className="text-base font-semibold">{task.description}</div>
                    </div>
                    <span className="rounded-full bg-white/10 px-3 py-1 text-xs capitalize">
                      {task.status}
                    </span>
                  </div>
                  <div className="mt-2 text-xs text-slate-300">
                    Priority: {task.priority}
                  </div>
                  <div className="mt-2 text-xs text-slate-400">
                    Dependencies: {(task.dependencies || []).join(", ") || "None"}
                  </div>
                  <button
                    className="mt-3 rounded-lg bg-emerald-600 px-3 py-1 text-xs font-semibold text-white hover:bg-emerald-500 disabled:opacity-60"
                    onClick={() => handleComplete(task.id)}
                    disabled={task.status !== "ready"}
                  >
                    {task.status === "ready" ? "Complete" : "Locked"}
                  </button>
                </div>
              ))}
            </div>
          )}
        </section>
      </div>
    </div>
  );
};

export default App;