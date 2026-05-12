export const detectCycle = (tasks) => {
  const graph = {};
  tasks.forEach(t => graph[t.id] = t.dependencies);

  const visited = new Set();
  const stack = new Set();

  const hasCycle = (node) => {
    if (stack.has(node)) return true;
    if (visited.has(node)) return false;

    visited.add(node);
    stack.add(node);

    for (const dep of graph[node]) {
      if (hasCycle(dep)) return true;
    }

    stack.delete(node);
    return false;
  };

  return tasks.some(task => hasCycle(task.id));
};