<?php

include_once "../../../database/ConexaoBD.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerPedido
 *
 * @author bergonalta
 */

// Classe responsável pelo banco de dados
class BDPedido extends ConexaoBD {

    public function __construct() {
        //vazio
    }

    // Encontrar todos os pedidos válidos
    public function findAll(){

      // Busca a conexão com o banco de dados
      $pdo = $this->abrirBD();

      // Verifica se a conexão foi realizada com sucesso
      if($pdo == null){
        exit;
      }

      // se a query for realizada com sucesso retorna
      // a lista do banco de dados, caso o contrário
      // retorna null  
      try{
        // Query que realiza a busca
        $query = $pdo->query("
          select t1.id from pedido t1
          inner join pedido_ingrediente t2 ON (t1.id = t2.pedido_id)
          inner join ingrediente t3 ON (t3.id = t2.ingrediente)
          inner join tipo t4 ON (t4.id = t3.tipo_id)
          inner join localizacao t5 ON (t5.id = t1.localizacao_id)
          ");
        return $query->fetchAll(PDO::FETCH_OBJ);
      }catch(PDOExcepetion $ex){
        echo "Erro: $ex";
      }
    }

    public function findByCarne($carne = NULL){

      // Busca a conexão com o banco de dados
      $pdo = $this->abrirBD();

      // Verifica se a conexão foi realizada com sucesso
      if($pdo == null || $carne == NULL){
        exit;
      }

      // se a query for realizada com sucesso retorna
      // a lista do banco de dados, caso o contrário
      // retorna null  
      try{
        // Query que realiza a busca
        $query = $pdo->query("

          ");

        return $query->fetchAll(PDO::FETCH_OBJ);
      }catch(PDOExcepetion $ex){
        echo "Erro: $ex";
      }
    }

    public function findByLocalizacao($localizacao = NULL){

      // Busca a conexão com o banco de dados
      $pdo = $this->abrirBD();

      // Verifica se a conexão foi realizada com sucesso
      if($pdo == null || $localizacao == null){
        exit;
      }

      try{
        // Query que realiza a busca
        $query = $pdo->query("

          ");

        return $query->fetchAll(PDO::FETCH_OBJ);
      }catch(PDOExcepetion $ex){
        echo "Erro: $ex";
      }
    }

    public function findByLocalizacaoCarne($carne = NULL, $localizacao = NULL){

      // Busca a conexão com o banco de dados
      $pdo = $this->abrirBD();

      // Verifica se a conexão foi realizada com sucesso
      if($pdo == null || $carne == NULL || $localizacao == NULL){
        exit;
      }

      // se a query for realizada com sucesso retorna
      // a lista do banco de dados, caso o contrário
      // retorna null  
      try{
        // Query que realiza a busca
        $query = $pdo->query("

          ");

        return $query->fetchAll(PDO::FETCH_OBJ);
      }catch(PDOExcepetion $ex){
        echo "Erro: $ex";
      }
    }

}
