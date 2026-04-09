package com.example.gerenciamento_estoque.repository;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.gerenciamento_estoque.model.FuncionarioAutenticado;

public interface FuncionarioAutenticadoRepository extends JpaRepository<com.example.gerenciamento_estoque.model.FuncionarioAutenticado, Long> {
	Optional<FuncionarioAutenticado> findByNifAndAtivoTrue(String nif);
	boolean existsByNifAndNomeAndAtivoTrue(String nif, String nome);
}


