import mongoose from "mongoose";

const taskSchema = new mongoose.Schema(
  {
    transcriptId: {
      type: mongoose.Schema.Types.ObjectId,
      ref: "Transcript",
      required: true,
    },
    id: {
      type: String,
      required: true,
    },
    description: {
      type: String,
      required: true,
      trim: true,
    },
    priority: {
      type: String,
      enum: ["low", "medium", "high"],
      default: "medium",
    },
    dependencies: [String],

    status: {
      type: String,
      enum: ["pending", "in-progress", "completed", "blocked", "error"],
      default: "pending",
    },
  },
  { timestamps: true },
);

export default mongoose.model("Task", taskSchema);
