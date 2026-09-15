const express = require("express");
const router = express.Router();

const usuarioController = require("../controllers/usuarioController");

router.get("/usuarios", usuarioController.obtenerUsuarios);

router.get("/usuarios/:id", usuarioController.obtenerUsuarioPorId);

router.post("/usuarios", usuarioController.crearUsuario);

router.put("/usuarios/:id", usuarioController.actualizarUsuario);

router.delete("/usuarios/:id", usuarioController.eliminarUsuario);

module.exports = router;
