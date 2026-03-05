package com.example.escola_xyz.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import com.example.escola_xyz.Repository.AdministradorRepository;
import com.example.escola_xyz.model.Administrador;
import com.example.escola_xyz.Repository.VerificaCadastroAdmRepository;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.servlet.ModelAndView;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RequestBody;




@Controller
public class AdmController {
    // Atributos
    @Autowired // Permite a transformação de um obj java em entidade de Banco de Dados (cada obj criado vira uma linha do Banco de Dados)
    AdministradorRepository ar;

    @Autowired
    VerificaCadastroAdmRepository vcar;

    // verificar acesso e cadastro
    boolean acessoAdm = false;

    // Métodos Públicos
    //Método para navegar na página de cadastro
    @GetMapping("/cadastrar-adm")
    public String acessoCadastroAdmPage() {
        return "cadastro/cadastro-adm";
    }

    @PostMapping("/cadastrar-adm")
    public ModelAndView cadastrarAdmBD(Administrador adm, RedirectAttributes attributes) {
        boolean verificarCpf = vcar.existsById(adm.getCpf()); // Se existir cpf do adm cadastrado no BD, retorna true, caso contrário, retorna false
        ModelAndView mv = new ModelAndView("redirect:/login-adm");
        if(verificarCpf) {
            ar.save(adm); // obj adm -> pega as informações do formulário e cria um obj da classe adm
            String mensagem = "Cadastro realizado com sucesso!"; //cria uma mensagem para o usuário
            System.out.println(mensagem);
            attributes.addFlashAttribute("msg", mensagem); //leva a mensagem para a tela de view
            attributes.addFlashAttribute("classe", "verde");
        } else { // deu errado , pessoa não pode se cadastrar (caso o CPF não esteja no pré-cadastro)
            String mensagem = "Cadastro não permitido";
            System.out.println(mensagem);
            attributes.addFlashAttribute("msg", mensagem);
            attributes.addFlashAttribute("classe", "vermelho");

        }
        return mv;
    }

    //método para página de login do Adm
    @GetMapping("/login-adm")
    public String acessoLoginPageAdm() {
        return "login/login-adm";
    }

    // Método para carregar a página interna após o Login
    @PostMapping("acesso-adm")
    public ModelAndView acessoAdm(@RequestParam String cpf, @RequestParam String senha, RedirectAttributes attributes) {
        ModelAndView mv = new ModelAndView("redirect:/interna-adm");
        boolean verificaCpf = ar.existsById(cpf);
        boolean verificaSenha = ar.findByCpf(cpf).getSenha().equals(senha);

        if(verificaCpf && verificaSenha) {
            acessoAdm = true;
        } else {
            String mensagem = "CPF ou Senha incorreto!";
            System.out.println(mensagem);
            attributes.addFlashAttribute("msg", mensagem);
            attributes.addFlashAttribute("classe", "vermelho");
            mv.setViewName("redirect:/login-adm");
        }
        
        return mv;
    }

    // Acessar a página interna
    @GetMapping("/interna-adm")
    public ModelAndView acessoInternaPageAdm (RedirectAttributes attributes) {
        String vaiPara = ""; //endereço do redirecionamento

        if (acessoAdm) { //verifica se o usuário está logado
            vaiPara = "interna/interna-adm"; //se estiver logado, o caminho será para a página interna
        } else { // caso contrário, nega o acesso e o caminho será redirecionado para a página de login do ADM
            String mensagem = "Acesso não permitido";
            System.out.println(mensagem);
            attributes.addFlashAttribute("msg", mensagem);
            attributes.addFlashAttribute("classe", "vermelha");
            vaiPara = "redirect:/login-adm";
        }
        ModelAndView mv = new ModelAndView(vaiPara); // modelandview, vai direcionar a navegação
        return mv;
    }

}

