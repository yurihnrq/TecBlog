# TecBlog (em precesso de atualização para PPI)
(Futuramente será implementado em React)

O projeto trata-se de um blog que resolvi desenvolver para melhorar, aprender e treinar meus conhecimentos sobre desenvolvimento WEB. Além disso, serviu como trabalho final para a matéria de Desenvolvimento e Projetos em TI do curso Técnico de Manutenção e Suporte em Informática que realizei np IFTM - Campus Uberlândia.

O projeto ainda não está 100% completo, por isso listarei a seguir o que falta (e estou lembrando no momento):
  - Enviar email para usuários cadastrado assim que uma nova publicação é realizada.
  - Upload de imagens nas publicações.
  - Sistema de paginação para publicações (atualmente todas aparacem numa mesma página, o que pode gerar sobrecarregamento caso haja muitas publicações).
  - Retirar os alerts de aviso e substituí-los por modals ou algo que ainda irei pensar (algo mais visualmente bonito).

Utilizei algumas tecnologias (plugins, bibliotecas, etc.) para a construção do site:
 - Bootstrap para responsividade.
 - jQuery e Ajax para tornar loadings mais dinâmicos e realizar interações no site.
 - Normalize.
 - Parsley Validade para realizar a validação dos dados ao cadastrar e fazer login.
 - PHPMailer para envio de email utilizando o PHP.

Cada página foi colocada em uma pasta exclusiva com seu arquivo CSS exclusivo para que os arquivos ficazem mais organizados, facilitando a manutenção. Ex: a página do usuário está na pasta "user" e a página de login está na pasta "login".

