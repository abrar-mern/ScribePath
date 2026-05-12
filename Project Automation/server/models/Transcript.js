import mongoose from "mongoose";

const transcriptSchema = new mongoose.Schema(
  {
    text: {
      type: String,
      required: true,
      trim: true,
    },
    status: {
      type: String,
      enum: ["pending", "completed", "error"],
      default: "pending",
    },
  },
  { timestamps: true },
);

export default mongoose.model("Transcript", transcriptSchema);
