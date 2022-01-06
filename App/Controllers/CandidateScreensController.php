<?php

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    //Models
    use App\Models\DepartamentosCargos;

    class CandidateScreensController extends Action {
        public function index() {  

        }

        public function editarPerfil() {
            $estadosCidades = Container::getModel('InformacoesGlobais');

            $this->view->estados = $estadosCidades->getEstados();
            $this->view->cidades = $estadosCidades->getCidades();
            
            session_start();

            if(empty($_SESSION['tipo_user'])) {
                $_SESSION['tipo_user'] = 0;
            }

            $viewPerfilCandidato = Container::getModel('EditarPerfil');

            $viewPerfilCandidato->__set('id_perfil', $_SESSION['id_usuario']);

            $this->view->detalhesPerfilCandidato = $viewPerfilCandidato->getPerfilCandidato();

            $this->view->perfilExperiencia = $viewPerfilCandidato->getCandidatoExperiencia();
            $this->view->perfilCompetencia = $viewPerfilCandidato->getCandidatoCompetencia();
            $this->view->perfilFormacao = $viewPerfilCandidato->getCandidatoFormacao();

            $this->render('editar-perfil');
        }

        public function editarPerfilSalvar() {
            $perfil = Container::getModel('EditarPerfil');

            session_start();

            if(empty($_SESSION['tipo_user'])) {
                $_SESSION['tipo_user'] = 0;
            }
            
            $perfil = Container::getModel('EditarPerfil');
        
            $perfil->__set('id_perfil', $_SESSION['id_usuario']);
            $perfil->__set('id_candidato', $_SESSION['id_usuario']);

            $perfil->__set('id_cidade',$_POST['cidade']);
            $perfil->__set('data_nasc',$_POST['data-de-nascimento']);
            $perfil->__set('email',$_POST['email']);
            $perfil->__set('sexo',$_POST['sexo']);
            $perfil->__set('foto',$_POST['foto']); //a
            $perfil->__set('bairro',$_POST['bairro']);
            $perfil->__set('cpf',$_POST['cpf']);
            $perfil->__set('cep',$_POST['cep']);
            $perfil->__set('telefone',$_POST['telefone']);
            $perfil->__set('celular',$_POST['celular']);
            $perfil->__set('num_casa',$_POST['numero']);
            $perfil->__set('cadastro_pessoa',$_POST['cadastro-pessoa']); 
            $perfil->__set('rua',$_POST['rua']);
            $perfil->__set('cnpf',$_POST['cnpj']);
            $perfil->__set('curriculo',$_POST['curriculo']); //a
            $perfil->__set('disponibilidade',$_POST['disponibilidade']);
            $perfil->__set('sobre',$_POST['sobre']); //a
            $perfil->__set('tipo_pessoa',$_POST['tipo_pessoa']);
            $perfil->__set('c_status',$_POST['c_status']);
            $perfil->__set('c_status',$_POST['c_status']); 
            $perfil->__set('nome', $_SESSION['nome']); 

            $perfil->save();

            //****______________Requisitos do perfil _________________****//

            // Experiencia
            $cont = 1;
            while(isset($_POST['exp-formacao-' . $cont])) {
                $perfil->__set('nome_e' , $_POST['exp-formacao-' . $cont]);
                $perfil->__set('c_status_e' , $_POST['exp-status-' . $cont]);
                $perfil->__set('anos_xp' , $_POST['exp-anos-experiencia-' . $cont]);

                $perfil->saveExperiencia();
                $cont++;
            }

            // Competencia
            $cont = 1;
            while(isset($_POST['comp-nome-' . $cont])) {
                $perfil->__set('id_competencia' , $_POST['comp-nome-' . $cont]);
                $perfil->__set('nome_c' , $_POST['comp-nome-' . $cont]);
                $perfil->__set('grau_c' , $_POST['comp-grau-' . $cont]);
                $perfil->__set('c_status_c' , $_POST['comp-status-' . $cont]);

                $perfil->saveCompetencia();
                $cont++;
            }

            // Formacao
            $cont = 1;
            while(isset($_POST['form-tipo-' . $cont])) {
                $perfil->__set('tipo' , $_POST['form-tipo-' . $cont]);
                $perfil->__set('grau_f' , $_POST['form-grau-' . $cont]);
                $perfil->__set('c_status_f' , $_POST['form-status-' . $cont]);
                $perfil->__set('curso' , $_POST['form-nome-' . $cont]);

                $perfil->saveFormacao();
                $cont++;
            }

            header('Location:/perfil_ver');   
        }

        public function perfilVer() {
            session_start();

            if(empty($_SESSION['tipo_user'])) {
                $_SESSION['tipo_user'] = 0;
            }

            $viewPerfilCandidato = Container::getModel('EditarPerfil');

            $viewPerfilCandidato->__set('id_perfil', $_SESSION['id_usuario']);

            $this->view->detalhesPerfilCandidato = $viewPerfilCandidato->getPerfilCandidato();

            $this->view->perfilExperiencia = $viewPerfilCandidato->getCandidatoExperiencia();
            $this->view->perfilCompetencia = $viewPerfilCandidato->getCandidatoCompetencia();
            $this->view->perfilFormacao = $viewPerfilCandidato->getCandidatoFormacao();

            $this->render('perfil');
        }

        public function vagaCandidatadaVer() {
            session_start();

            if(empty($_SESSION['tipo_user'])) {
                $_SESSION['tipo_user'] = 0;
            }

            // $viewVagaCandidatada = Container::getModel('EditarPerfil');

            // $viewPerfilCandidato->__set('id_candidato', $_POST['id_candidato']);

            // $this->view->detalhesVagaCandidatada = $viewVagaCandidatada->getVagaCandidatada(); 

            $this->render('vagas-candidatadas');
        }

        public function visualizarVaga() {
            session_start();

            if(empty($_SESSION['tipo_user'])) {
                $_SESSION['tipo_user'] = 0;
            }

            $vaga = Container::getModel('GerarVaga');

            $vaga->__set('id_vaga', $_GET['vaga']);

            $this->view->vagaDetalhesCand = $vaga->getVaga();
            $this->view->vagaDetalhesCandExperiencia = $vaga->getVagaExperiencia();
            $this->view->vagaDetalhesCandCompetencia = $vaga->getVagaCompetencia();
            $this->view->vagaDetalhesCandFormacao = $vaga->getVagaFormacao();

            $this->render('consultar-quadro-de-vagas');
        }

        public function candidatar() {
            session_start();

            $candidatarse = Container::getModel('EditarPerfil');

            $candidatarse->__set('id_proc', $_GET['proc']);
            $candidatarse->__set('id_perfil', $_SESSION['id_usuario']);

            $candidatarse->candidatarse();

            header('Location: /');
        }

        public function realizarTeste() {
            session_start();

            if(empty($_SESSION['tipo_user'])) {
                $_SESSION['tipo_user'] = 0;
            }

            $this->render('realizar-teste');
        }
    }   

?>