# MGTEC-RH
Repositório do trabalho de conclusão de curso.

Será necessário possuir o PHP7 ou superior, um servidor PHP e um servidor MySQL. Para isso, será necessário o download do XAMPP, disponível em: <https://www.apachefriends.org/pt_br/index.html>. 

Após o download do XAMPP, será necessário a sua inicialização, assim como a inicialização do servidor do Apache (que irá rodar o PHP) e o servidor do Mysql.

Logo após, será primordial a criação da base de dados (o script de criação está localizado junto com os arquivos do código fonte). A criação deve ser feita pelo phpMyAdmin em: 
<http://localhost/phpmyadmin/index.php?>.

Em seguida, será preciso iniciar a variável de ambiente do PHP. Ela será feita pelo Prompt de Comando do Windows (CMD). No CMD será feita a mudança de diretório para o arquivo “Public” do projeto: MGTEC---RH --> Public. Dentro do diretório “Public” será digitado: php -S localhost:3000.

Com tudo isso executado, será preciso digitar: localhost:3000/home na barra de navegação do navegador. Na home será possível navegar por todo o sistema.

Os diferentes níveis de acesso do sistema, tais como: funcionário, gestor e líder poderão ser visualizados com os seguintes logins: 
- Candidato: Login - “candidato”; Senha - “candidato123”;
- Funcionário: Login - “funcionario”; Senha - “funcionario123”;
- Gestor: Login - “gestor”; Senha - “gestor123”;
- Líder: Login - “chefe”; Senha - “chefe123”;
- Adm (Tem acesso a todos os níveis): Login - “adm”; Senha - “adm123”;
