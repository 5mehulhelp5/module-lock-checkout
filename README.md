# 🌟 LucasZit_LockCheckout

## 📢 Introdução
O módulo **LucasZit_LockCheckout** foi desenvolvido para ajudar lojistas a lidarem com comportamentos de compra suspeitos, proporcionando uma solução rápida e eficiente para bloquear o acesso ao checkout de clientes específicos. Com ele, o administrador pode:

- Impedir que clientes com comportamento suspeito realizem novas compras fraudulentas.
- Configurar mensagens personalizadas para clientes bloqueados.
- Redirecionar clientes bloqueados para páginas customizadas criadas com o Page Builder do Magento.
- Bloquear o avanço para o checkout de clientes que tenham uma quantidade de pedidos definida no admin, com o status também definido no admin.

## 📋 Funcionalidades Principais
- 🔒 **Bloqueio de Checkout**: Impede que clientes com comportamento suspeito avancem para o checkout.
- ⚙️ **Configurações Customizáveis**: Permite configurar redirecionamento e mensagens personalizadas.
- 🛒 **Atributo Customizado no Cliente**: Gerenciamento fácil de bloqueios diretamente no perfil do cliente.
- 🧑‍💻 **Controle Admin**: ACL para garantir que apenas usuários autorizados possam configurar bloqueios.
- 📊 **Bloqueio baseado em pedidos**: Bloqueia clientes que atingem o limite de pedidos com um status específico, configurado no admin.
- 📚 O módulo tem suporte a tradução pt_BR.


## 💻 Instalação
1. ⬇️ **Download**: Faça o download do módulo através do Composer.
   ```bash
   composer require lucaszit/module-lock-checkout
   ```
2. 🛠️ **Habilitação**: Habilite o módulo no Magento 2:
   ```bash
   bin/magento module:enable LucasZit_LockCheckout
   bin/magento setup:upgrade
   bin/magento cache:flush
   ```

## ⚙️ Configuração
As configurações do módulo podem ser acessadas em:
`Stores > Settings > Configuration > LucasZit > Lock Checkout`

### 📜 Opções de Configuração
- **Habilitar**: Ativa ou desativa o módulo.
- **Auto Assign Lock Checkout**: Define se o atributo de bloqueio será ativado automaticamente para novos clientes.
- **Redirect on Lock**: Redireciona clientes bloqueados para uma página CMS personalizável.
- **Message for Locked Checkout**: Mensagem exibida para clientes bloqueados redirecionados à homepage.

### 🛡️ ACL
Uma opção de ACL foi criada no menu Magento_Customer com o nome de Lock Checkout para controlar as permissões de usuários administrativos. Isso garante que apenas usuários autorizados possam ativar ou desativar o bloqueio de checkout.


## 🧪 Testes Unitários
✅ Testes foram implementados para validar as funcionalidades principais do módulo, assegurando sua estabilidade e confiabilidade.

## 🏆 Boas Práticas
- 🎯 Código desenvolvido seguindo padrões PSR-12.
- ✨ Testes unitários para todas as classes principais.
- 📖 Documentação clara e organizada.

## 🤝 Contribuições
Contribuições são bem-vindas! Para colaborar:
1. 💬 Faça um fork deste repositório.
2. 🌍 Crie uma branch para suas alterações.
3. 🙌 Envie um pull request com suas melhorias.

## 📜 Licença
Este módulo está licenciado como **Proprietary**. Consulte o arquivo LICENSE para mais detalhes.


## 💻 Autor
**Lucas Pereira**  
💼 [LinkedIn](https://www.linkedin.com/in/lucaspereira42/) | 🐙 [GitHub](https://github.com/lucaszit)
