package com.example.gerenciamento_estoque.controller;

import jakarta.servlet.http.HttpSession;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;

import com.example.gerenciamento_estoque.model.Funcionario;
import com.example.gerenciamento_estoque.repository.FuncionarioAutenticadoRepository;
import com.example.gerenciamento_estoque.repository.FuncionarioRepository;

@Controller
public class AuthController {


	@Autowired
	private FuncionarioRepository funcionarioRepository;

	@Autowired
	private FuncionarioAutenticadoRepository funcionarioAutenticadoRepository;
	
	
	@GetMapping("/login")
	public String loginPage() {
		return "auth/login"; // templates/auth/login.html
	}

	@PostMapping("/login")
	public String login(@RequestParam String nif,
						@RequestParam String senha,
						HttpSession session,
						Model model) {

		Optional<Funcionario> funcionarioOpt = funcionarioRepository.findByNif(nif);

		boolean credenciaisOk = false;

		if (funcionarioOpt.isPresent()) {
			Funcionario funcionario = funcionarioOpt.get();

			// Comparação simples (SEM HASH - só pra teste)
			if (funcionario.getSenha().equals(senha)) {
				credenciaisOk = true;
			}
		}

		if (!credenciaisOk) {
			model.addAttribute("erro", "NIF ou senha inválidos.");
			return "auth/login";
		}

		// Sessão simples
		session.setAttribute("usuarioLogado", true);
		session.setAttribute("nif", nif);

		return "redirect:/app";
	}


	// Método para acesar a tela de cadastro
	@GetMapping("/cadastro")
	public String cadastroPage() {
		return "/auth/cadastro"; // templates/auth/cadastro.html
	}

	// Método para realizar um cadastro de um funcionário, com nome, nif e senha
	@PostMapping("/cadastro")
	public String cadastro(@RequestParam String nome,
						@RequestParam String nif,
						@RequestParam String senha,
						Model model) {

		if (!funcionarioAutenticadoRepository.existsByNifAndNomeAndAtivoTrue(nif, nome)) {
			model.addAttribute("erro", "O cadastro não foi autorizado por causa do NIF e nome informados. Verifique com o administrador do sistema.");
			return "auth/cadastro";
		}

		if (funcionarioRepository.existsByNif(nif)) {
			model.addAttribute("erro", "Aparentemente já existe um cadastro com esse NIF. Verifique se o NIF está correto ou tente outro.");
			return "auth/cadastro";
		}

		Funcionario funcionario = new Funcionario();
		funcionario.setNome(nome);
		funcionario.setNif(nif);
		funcionario.setSenha(senha);
		funcionario.setAtivo(true);

		funcionarioRepository.save(funcionario);

		model.addAttribute("sucesso", "Seu cadastro foi realizado com sucesso! Agora você pode fazer login.");
		return "auth/login";
	}

	@GetMapping("/logout")
	public String logout(HttpSession session) {
		session.invalidate();
		return "redirect:/";
	}
}

