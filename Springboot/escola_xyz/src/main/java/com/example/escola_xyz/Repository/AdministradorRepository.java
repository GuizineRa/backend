package com.example.escola_xyz.Repository;

import com.example.escola_xyz.model.Administrador;

import org.springframework.data.repository.CrudRepository;


public interface AdministradorRepository extends CrudRepository<Administrador,String>{
    // Se precisar criar algum método específico de banco de dados eu crio aqui
    
    Administrador findByCpf(String cpf); //Busaca pelo cpf no banco
}
