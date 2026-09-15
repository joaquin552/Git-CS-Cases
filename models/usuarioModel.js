const db = require("../config/db");

const obtenerUsuarios = (callback) => {
    const sql = `
        SELECT
            IDusuario AS id,
            nombreUsuario AS username,
            email
        FROM usuario
    `;

    db.query(sql, (err, resultados) => {
        if (err) {
            callback(err, null);
            return;
        }

        callback(null, resultados);
    });
};

const obtenerUsuarioPorId = (id, callback) => {
    const sql = `
        SELECT
            IDusuario AS id,
            nombreUsuario AS username,
            email
        FROM usuario
        WHERE IDusuario = ?
    `;

    db.query(sql, [id], (err, resultados) => {
        if (err) {
            callback(err, null);
            return;
        }

        callback(null, resultados[0]);
    });
};

const crearUsuario = (
    nombreUsuario,
    email,
    contraseña,
    fechaNacimiento,
    telefono,
    novedades,
    callback
) => {
    const sql = `
        INSERT INTO usuario
        (nombreUsuario, email, contraseña, fechaNacimiento, telefono, novedades)
        VALUES (?, ?, ?, ?, ?, ?)
    `;

    db.query(
        sql,
        [
            nombreUsuario,
            email,
            contraseña,
            fechaNacimiento,
            telefono,
            novedades
        ],
        (err, resultado) => {
            if (err) {
                callback(err, null);
                return;
            }

            const nuevoUsuario = {
                id: resultado.insertId,
                username: nombreUsuario,
                email: email
            };

            callback(null, nuevoUsuario);
        }
    );
};


const actualizarUsuario = (id, nombreUsuario, email, callback) => {
    const sql = `
        UPDATE usuario
        SET nombreUsuario = ?, email = ?
        WHERE IDusuario = ?
    `;

    db.query(sql, [nombreUsuario, email, id], (err, resultado) => {
        if (err) {
            callback(err, null);
            return;
        }

        callback(null, resultado);
    });
};

const eliminarUsuario = (id, callback) => {
    const sql = `
        DELETE FROM usuario
        WHERE IDusuario = ?
    `;

    db.query(sql, [id], (err, resultado) => {
        if (err) {
            callback(err, null);
            return;
        }

        callback(null, resultado);
    });
};

module.exports = {
    obtenerUsuarios,
    obtenerUsuarioPorId,
    crearUsuario,
    actualizarUsuario,
    eliminarUsuario
};
