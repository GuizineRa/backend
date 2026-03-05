package com.example.escola_xyz.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.servlet.ModelAndView;

//  Anotação de classe Controlller (Interagir view e model)
@Controller
public class indexController {
    


    // Método mais completo de buscar página
    @GetMapping("/home")
    public ModelAndView acessoHomePage() {
        ModelAndView mv  = new ModelAndView("index");
        return mv;
    }


    //Método mais simples
    @GetMapping("")
    public String acessoHomePage2() {
        return "index";
    }
}


