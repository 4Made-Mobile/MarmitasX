<?php

function carregaClasse($nomeDaClasse) {
    if (file_exists('../../../fachada/' . $nomeDaClasse . '.php')) {
        require_once '../../../fachada/' . $nomeDaClasse . '.php';
    } else if (file_exists('../../../controller/' . $nomeDaClasse . '.php')) {
        require_once '../../../controller/' . $nomeDaClasse . '.php';
    } else if (file_exists('../../../database/' . $nomeDaClasse . '.php')) {
        require_once '../../../database/' . $nomeDaClasse . '.php';
    } else if (file_exists('./controller/' . $nomeDaClasse . '.php')) {
        require_once './controller/' . $nomeDaClasse . '.php';
    } else if (file_exists('../../../database/' . $nomeDaClasse . '.php')) {
        require_once './database/' . $nomeDaClasse . '.php';
    } else if (file_exists('./fachada/' . $nomeDaClasse . '.php')) {
        require_once './fachada/' . $nomeDaClasse . '.php';
    }
}

spl_autoload_register("carregaClasse");
