package com.example.rh.model;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import java.io.Serializable;

    


@Entity
public class funcionario implements Serializable {
// Transformar a Classe em base para o DB

  // Serializable é uma interface que permite que 
    // os objetos da classe sejam convertidos em um formato que 
    // pode ser facilmente armazenado ou transmitido, como um arquivo ou uma rede. 
    // Isso é útil para persistência de dados, comunicação entre sistemas e 
    // outras operações que envolvem a transferência de objetos.
    private static final long serialVersionUID = 1L;  

    // Anotações para integração do JPA @
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private long id;
    private String nome;
    private String email;


    //Gatter and Setters
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
