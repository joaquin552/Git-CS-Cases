// Import the built-in crypto module
const crypto = require('crypto');

/**
 * Generates an MD5 hash of a given string
 * @param {string} text 
 * @returns {string} Hexadecimal hash
 */
function createMD5Hash(text) {
  return crypto
    .createHash('md5')   // Specify the algorithm
    .update(text)        // Pass your data
    .digest('hex');      // Output format (usually hex)
}

const usuarioModel = require("../models/usuarioModel");

const obtenerUsuarios = (req, res) => {
    usuarioModel.obtenerUsuarios((err, usuarios) => {
        if (err) {
            return res.status(500).json({
                mensaje: "Error al obtener los usuarios"
            });
        }

        res.json(usuarios);
    });
};

const obtenerUsuarioPorId = (req, res) => {
    const id = parseInt(req.params.id);

    usuarioModel.obtenerUsuarioPorId(id, (err, usuario) => {
        if (err) {
            return res.status(500).json({
                mensaje: "Error al obtener el usuario"
            });
        }

        if (!usuario) {
            return res.status(404).json({
                mensaje: "Usuario no encontrado"
            });
        }

        res.json(usuario);
    });
};

const crearUsuario = (req, res) => {
    const {
        nombreUsuario,
        email,
        contraseña,
        confirmarContraseña,
        fechaNacimiento,
        telefono,
        terminos,
        novedades
    } = req.body;

    // Comprobar campos obligatorios
    if (
        !nombreUsuario ||
        !email ||
        !contraseña ||
        !confirmarContraseña ||
        !fechaNacimiento ||
        !telefono
    ) {
        return res.status(400).json({
            mensaje: "Todos los campos son obligatorios"
        });
    }

    // Comprobar que las contraseñas coincidan
    if (contraseña !== confirmarContraseña) {
        return res.status(400).json({
            mensaje: "Las contraseñas no coinciden"
        });
    }

    // Comprobar términos y condiciones
    if (!terminos) {
        return res.status(400).json({
            mensaje: "Debes aceptar los términos y condiciones"
        });
    }

    usuarioModel.crearUsuario(
        nombreUsuario,
        email,
        createMD5Hash(contraseña),
        fechaNacimiento,
        telefono,
        novedades,
        (err, nuevoUsuario) => {

            if (err) {
                console.error(err);

                // Usuario o email ya existente
                if (err.code === "ER_DUP_ENTRY") {
                    return res.status(409).json({
                        mensaje: "El nombre de usuario o correo ya está registrado"
                    });
                }

                return res.status(500).json({
                    mensaje: "Error al crear el usuario"
                });
            }

            res.status(201).json({
                mensaje: "Usuario creado correctamente",
                usuario: nuevoUsuario
            });
        }
    );
};


const actualizarUsuario = (req, res) => {
    const id = parseInt(req.params.id);

    const { username, email } = req.body;

    if (!username || !email) {
        return res.status(400).json({
            mensaje: "El nombre de usuario y el email son obligatorios"
        });
    }

    usuarioModel.actualizarUsuario(
        id,
        username,
        email,
        (err, resultado) => {
            if (err) {
                console.error(err);

                return res.status(500).json({
                    mensaje: "Error al actualizar el usuario"
                });
            }

            if (resultado.affectedRows === 0) {
                return res.status(404).json({
                    mensaje: "Usuario no encontrado"
                });
            }

            res.json({
                mensaje: "Usuario actualizado correctamente"
            });
        }
    );
};

const eliminarUsuario = (req, res) => {
    const id = parseInt(req.params.id);

    usuarioModel.eliminarUsuario(id, (err, resultado) => {
        if (err) {
            console.error(err);

            return res.status(500).json({
                mensaje: "Error al eliminar el usuario"
            });
        }

        if (resultado.affectedRows === 0) {
            return res.status(404).json({
                mensaje: "Usuario no encontrado"
            });
        }

        res.json({
            mensaje: "Usuario eliminado correctamente"
        });
    });
};

module.exports = {
    obtenerUsuarios,
    obtenerUsuarioPorId,
    crearUsuario,
    actualizarUsuario,
    eliminarUsuario
};

