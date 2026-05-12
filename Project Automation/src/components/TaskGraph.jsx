import React, { useMemo } from "react";

const COLUMN_WIDTH = 240;
const ROW_HEIGHT = 140;
const NODE_WIDTH = 200;
const NODE_HEIGHT = 96;

const getNodeColor = (status) => {
  switch (status) {
    case "completed":
      return "bg-emerald-500 text-white";
    case "ready":
      return "bg-blue-500 text-white";
    case "blocked":
      return "bg-amber-500 text-white";
    case "error":
      return "bg-red-500 text-white";
    default:
      return "bg-slate-600 text-white";
  }
};

const computeLevels = (tasks) => {
  const byId = new Map(tasks.map((task) => [task.id, task]));
  const memo = new Map();
  const visiting = new Set();

  const dfs = (taskId) => {
    if (memo.has(taskId)) return memo.get(taskId);
    if (visiting.has(taskId)) return 0;
    visiting.add(taskId);
    const task = byId.get(taskId);
    const deps = task?.dependencies ?? [];
    let level = 0;
    deps.forEach((depId) => {
      level = Math.max(level, dfs(depId) + 1);
    });
    visiting.delete(taskId);
    memo.set(taskId, level);
    return level;
  };

  tasks.forEach((task) => dfs(task.id));
  return memo;
};

const TaskGraph = ({ tasks, onComplete }) => {
  const { positions, edges, width, height } = useMemo(() => {
    const levels = computeLevels(tasks);
    const grouped = new Map();

    tasks.forEach((task) => {
      const level = levels.get(task.id) ?? 0;
      if (!grouped.has(level)) grouped.set(level, []);
      grouped.get(level).push(task);
    });

    const sortedLevels = Array.from(grouped.keys()).sort((a, b) => a - b);
    const positionsMap = new Map();
    let maxRows = 1;

    sortedLevels.forEach((level) => {
      const columnTasks = grouped.get(level).slice().sort((a, b) => a.id.localeCompare(b.id));
      maxRows = Math.max(maxRows, columnTasks.length);
      columnTasks.forEach((task, index) => {
        const x = level * COLUMN_WIDTH + 20;
        const y = index * ROW_HEIGHT + 30;
        positionsMap.set(task.id, { x, y });
      });
    });

    const edgesList = [];
    tasks.forEach((task) => {
      (task.dependencies || []).forEach((depId) => {
        if (!positionsMap.has(depId) || !positionsMap.has(task.id)) return;
        const from = positionsMap.get(depId);
        const to = positionsMap.get(task.id);
        edgesList.push({
          id: `${depId}-${task.id}`,
          x1: from.x + NODE_WIDTH,
          y1: from.y + NODE_HEIGHT / 2,
          x2: to.x,
          y2: to.y + NODE_HEIGHT / 2,
        });
      });
    });

    return {
      positions: positionsMap,
      edges: edgesList,
      width: Math.max(1, sortedLevels.length) * COLUMN_WIDTH,
      height: Math.max(1, maxRows) * ROW_HEIGHT + 40,
    };
  }, [tasks]);

  return (
    <div className="relative overflow-auto rounded-2xl border border-slate-700 bg-slate-900/40 p-6">
      <svg className="absolute inset-0" width={width} height={height}>
        {edges.map((edge) => (
          <line
            key={edge.id}
            x1={edge.x1}
            y1={edge.y1}
            x2={edge.x2}
            y2={edge.y2}
            stroke="#94a3b8"
            strokeWidth="2"
            markerEnd="url(#arrow)"
          />
        ))}
        <defs>
          <marker id="arrow" markerWidth="10" markerHeight="10" refX="10" refY="5" orient="auto">
            <path d="M0,0 L10,5 L0,10 Z" fill="#94a3b8" />
          </marker>
        </defs>
      </svg>
      <div style={{ width, height }} className="relative">
        {tasks.map((task) => {
          const position = positions.get(task.id) || { x: 0, y: 0 };
          return (
            <div
              key={task.id}
              className={`absolute rounded-xl p-4 shadow-lg ${getNodeColor(task.status)}`}
              style={{ left: position.x, top: position.y, width: NODE_WIDTH, height: NODE_HEIGHT }}
            >
              <div className="text-xs uppercase tracking-widest opacity-80">Task {task.id}</div>
              <div className="mt-1 text-base font-semibold leading-tight">{task.description}</div>
              <div className="mt-2 flex items-center justify-between text-xs">
                <span className="rounded-full bg-white/20 px-2 py-1">{task.priority}</span>
                <span className="capitalize">{task.status}</span>
              </div>
              {task.status !== "completed" && (
                <button
                  className="mt-3 w-full rounded-lg bg-black/30 px-3 py-1 text-xs font-semibold hover:bg-black/50"
                  onClick={() => onComplete(task.id)}
                  disabled={task.status !== "ready"}
                >
                  {task.status === "ready" ? "Complete" : "Locked"}
                </button>
              )}
            </div>
          );
        })}
      </div>
    </div>
  );
};

export default TaskGraph;
