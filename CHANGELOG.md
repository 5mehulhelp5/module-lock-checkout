# Changelog

Todas as mudanças importantes deste projeto serão documentadas neste arquivo.  
O formato segue as diretrizes de [Versionamento Semântico (SemVer)](https://semver.org/).

---

## [1.1.0] - 2025-01-06
### Adicionado
- 🆕 **Nova funcionalidade**: Bloqueio de checkout para clientes que atingem um limite de pedidos com um status específico configurado no admin.
    - Configuração de **Order Status Filter** para selecionar o status a ser considerado.
    - Configuração de **Order Count Threshold** para definir o número máximo de pedidos permitidos antes do bloqueio.
- Melhorias na documentação com a inclusão da nova funcionalidade no README.

### Corrigido
- 🛠️ Ajustes menores no código para melhorar a legibilidade e seguir os padrões PSR-12.
- Correção de mensagens de log para refletir corretamente as ações realizadas pelo módulo.

---

## [1.0.0] - 2024-12-01
### Adicionado
- 🔒 **Bloqueio de checkout**: Impede que clientes marcados como "bloqueados" avancem para o checkout.
- 📄 **Configurações no Admin**:
    - Mensagem personalizada para clientes bloqueados.
    - Redirecionamento para páginas CMS configuradas pelo admin.
    - Controle ACL para restringir acesso às configurações do módulo.
- 🛒 **Atributo personalizado**: Adicionado ao perfil do cliente para gerenciar manualmente o status de bloqueio.
- 📚 **Documentação inicial**: Instruções detalhadas de instalação e configuração.

---

### Notas
- Para obter mais informações, consulte o [repositório do GitHub](https://github.com/lucaszit/module-lock-checkout).

