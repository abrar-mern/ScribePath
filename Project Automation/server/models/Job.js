import mongoose from "mongoose";

const jobSchema = new mongoose.Schema(
  {
    transcriptId: mongoose.Schema.Types.ObjectId,

    transcriptText: String,

    status: {
      type: String,
      enum: ["pending", "processing", "completed", "failed"],
      default: "pending",
    },

    result: Object,
  },
  { timestamps: true },
);

export default mongoose.model("Job", jobSchema);
