package com.example.rh2.Model;

import java.io.Serializable;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;

//Classe de Conexão com o BD

//anotação de entidade

@Entity
public class Funcionario implements Serializable{
    // Permite transformar os dados em binário => Pode ser lido pelo banco de dados

    private static final long serialVersionUID = 1L;

    //Criação das colunas do banco (atributos da classe)

    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private long id;
    private String nome;
    private String email;


    //source actio (getters an Setters)
    public long getId() {
        return id;
    }
    public void setId(long id) {
        this.id = id;
    }
    public String getNome() {
        return nome;
    }
    public void setNome(String nome) {
        this.nome = nome;
    }
    public String getEmail() {
        return email;
    }
    public void setEmail(String email) {
        this.email = email;
    }



    

    
}
