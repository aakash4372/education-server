require("dotenv").config();
const express = require("express");
const cors = require("cors");
const bodyParser = require("body-parser");
const sendMail = require("./nodemailer");

const app = express();
const PORT = 5000;

// Middleware
app.use(cors());
app.use(bodyParser.json());

// API Endpoint to handle form submission
app.post("/send-email", async (req, res) => {
  const { name, email, type, phone, location } = req.body;
  console.log(req.body); // Log incoming request data

  try {
    await sendMail(name, email, type, phone, location);
    res.status(200).json({ message: "Email sent successfully!" });
  } catch (error) {
    console.error("Error sending email:", error); // Log the error
    res.status(500).json({ message: "Error sending email", error });
  }
});


app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
