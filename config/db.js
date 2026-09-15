const mysql = require("mysql2");

const connection = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "cs_cases",
    port: 3306
});

connection.connect((err) => {
    if (err) {
        console.error("Error al conectar con MySQL:", err);
        return;
    }

    console.log("Conectado correctamente a MySQL");
});

module.exports = connection;
