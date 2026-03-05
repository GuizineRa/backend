package com.example.rh2.Repository;

import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;

import com.example.rh2.Model.Funcionario;
import java.util.List;

public interface FuncionarioRepository extends CrudRepository<Funcionario, Long>{
    //Permitir a utilização dos métodos do crud JPA

    //métodos auxiliares

    Funcionario findById(long id); //Buscar funcionario plo id

    Funcionario findByNome(String nome); //Buscar funcionario pelo nome

    //Buscar funcionário pelo nome
    @Query(value = "select u from Funcionario u where u.nome like %?1%")
    List<Funcionario> findByLetras(String letras);


    
}
