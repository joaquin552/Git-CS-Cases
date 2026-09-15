const express = require("express");

const app = express();

app.use(express.json());

app.use(express.static("."));

const db = require("./config/db");

const usuarioRoutes = require("./routes/usuarioRoutes");

app.use("/api", usuarioRoutes);

const PORT = 3000;

app.listen(PORT, () => {
    console.log(`Servidor funcionando en http://localhost:${PORT}`);
});
