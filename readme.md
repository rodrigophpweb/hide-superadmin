# Hide Superadmin

**Versão / Version:** 4.0  
**Autor / Author:** [Rodrigo Vieira](https://www.programadorweb.com.br/plugins/hide-superadmin/)  
**Licença / License:** GPLv2  
**Compatibilidade / Compatibility:** WordPress 5.0+ | PHP 7.0+

---

## 📌 Descrição / Description

**PT-BR:**  
Este plugin oculta o usuário `rodrigo` da listagem de usuários e restringe o acesso a determinados menus, plugins e funcionalidades do painel administrativo do WordPress para todos os usuários, exceto o próprio `rodrigo`.

**EN:**  
This plugin hides the user `rodrigo` from the users list and restricts access to certain menus, plugins, and WordPress admin panel features for all users except `rodrigo`.

---

## 🔐 Funcionalidades / Features

- **PT-BR:** Oculta o usuário `rodrigo` da lista de usuários (`wp-admin/users.php`)  
  **EN:** Hides the user `rodrigo` from the users list (`wp-admin/users.php`)

- **PT-BR:** Remove menus e submenus sensíveis para outros usuários  
  **EN:** Removes sensitive admin menus and submenus for other users

- **PT-BR:** Oculta plugins específicos da lista de plugins  
  **EN:** Hides specific plugins from the plugin list

- **PT-BR:** Oculta este próprio plugin (opcional)  
  **EN:** Optionally hides this plugin itself

- **PT-BR:** Remove o menu e ícones do ACF (Advanced Custom Fields)  
  **EN:** Removes the ACF (Advanced Custom Fields) menu and icons

- **PT-BR:** Remove notificações de atualização (update-nag)  
  **EN:** Hides update notifications (update-nag)

- **PT-BR:** Ativa atualizações automáticas para todos os plugins e temas  
  **EN:** Enables automatic updates for all plugins and themes

---

## 🧠 Como Funciona / How It Works

**PT-BR:**  
O plugin utiliza hooks do WordPress como `pre_user_query`, `admin_menu`, `admin_head`, `all_plugins` para verificar o usuário logado e, se não for `rodrigo`, oculta funcionalidades críticas.

**EN:**  
The plugin uses WordPress hooks like `pre_user_query`, `admin_menu`, `admin_head`, `all_plugins` to check if the logged-in user is `rodrigo`, and if not, hides critical features.

---

## ⚙️ Plugins Ocultados / Hidden Plugins

- All-in-One WP Migration  
- Google Site Kit  
- Bing URL Submission  
- Yoast SEO  
- LoginPress  
- WP Rocket  
- Redirection  
- Really Simple SSL  
- Health Check  
- WordPress Importer  
- Minify HTML  
- ACF (via JS and menu filtering)  
- **Hide Superadmin** (opcional / optional)

> **PT-BR:** Você pode editar o array `$plugins_ocultos` para adicionar ou remover plugins.  
> **EN:** You can edit the `$plugins_ocultos` array to add or remove plugins.

---

## 🛠️ Instalação / Installation

1. **PT-BR:** Clone o repositório ou baixe o `.zip`:  
   **EN:** Clone the repository or download the `.zip`:

   ```bash
   git clone https://github.com/seuusuario/hide-superadmin.git

2. **PT-BR:** Coloque a pasta em wp-content/plugins/
   **EN:** Place the folder in wp-content/plugins/

3. **PT-BR:** Ative o plugin no painel WordPress
   **EN:** Activate the plugin in the WordPress dashboard

4. **PT-BR:** Certifique-se de que o usuário rodrigo existe
   **EN:** Make sure the rodrigo user exists

---

## ⚠️ Observações / Notes

- **PT-BR:** O nome de usuário deve ser exatamente rodrigo.
  **EN:** The username must be exactly rodrigo.

- **PT-BR:** Você pode modificar o nome no código para proteger outro usuário.
  **EN:** You can change the name in the code to protect another user.

- **PT-BR:** Este plugin é voltado para segurança leve e organização do painel.
  **EN:** This plugin focuses on light admin security and panel organization.

---

## 📄 Licença / License

**PT-BR:**
Este plugin está licenciado sob a GPLv2.
Mais informações: https://www.gnu.org/licenses/gpl-2.0.html

**EN:**
This plugin is licensed under GPLv2.
More info: https://www.gnu.org/licenses/gpl-2.0.html

---

## ✉️ Contato / Contact
**Rodrigo Vieira Eufrasio da Silva**
🌐 [www.programadorweb.com.br](https://programadorweb.com.br)
📧 [contato@programadorweb.com.br](mailto:contato@programadorweb.com.br)
