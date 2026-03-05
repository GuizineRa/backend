package com.example.rh2.Controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;

import com.example.rh2.Model.Funcionario;
import com.example.rh2.Repository.FuncionarioRepository;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;




@Controller
public class FuncionarioController {

    @Autowired
    FuncionarioRepository fr;

    // Métodos para abrir a página

    @GetMapping("/funcionario")
    public String abrirFuncionario(){
        return "funcionario/funcionario";
    }
    
    @PostMapping("/funcinario")
    public String gravarFuncionario(Funcionario funcionario) { // pega os dados do Formulário (nome e email)
        fr.save(funcionario); // Salva o Funcionario no banco de dados
        return "redirect:/funcionario"; // Recarrega a página que salvar o funcioanrio no banco
        
        
    }
    
    
}
