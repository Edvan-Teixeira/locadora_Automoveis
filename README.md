# Locadora de Automóveis

Bem-vindo ao **Projeto Locadora de Automóveis**! 🏎️

Este sistema, desenvolvido em **Laravel 12** com **PHP**, permite gerenciar o cadastro de veículos, usuários, clientes e locações. Cada veículo possui um custo diário de locação, que é calculado e registrado ao final da locação.

---

## 📋 Funcionalidades Principais

1. **Cadastro de Veículos**

   * Mínimo de 10 veículos cadastrados até o primeiro deploy.
   * Informações como marca, modelo, ano, placa e custo diário de locação.

2. **Cadastro de Usuários**

   * Controle de acesso ao sistema para operacionais (atendentes, gerentes).

3. **Cadastro de Clientes**

   * Armazena dados do cliente que irá alugar o veículo (nome, CPF, telefone, e-mail).

4. **Cadastro de Locações**

   * Vincula cliente, usuário (atendente) e veículo.
   * Registra data de início, data de entrega e custo total (baseado no valor diário).

---

## 🚀 Tecnologias Utilizadas

* **Backend**: PHP 8.4+, Laravel 12
* **Banco de Dados**: SQLite (via arquivo `database/database.sqlite`)
* **Frontend**: Blade (templates do Laravel)
* **Gerenciador de Dependências**: Composer
* **Compilação de Assets**: Node.js + NPM (ou Bun)

---

## 🛠️ Pré-requisitos

Antes de iniciar, verifique se sua máquina possui as seguintes ferramentas:

* **PHP 8.4+**
* **Composer**
* **Laravel Installer** (opcional)
* **Node.js** e **NPM** (ou **Bun**)

### Instalando PHP, Composer e Laravel Installer

Abra um cmd e powershell (windows) ou terminal (linux/mac) para fazer as instalações a seguir

> Algumas etapas podem ser feitas manulamente, como criação de arquivos e ações de copiar e colar

> Baseado na [documentação oficial do Laravel 12](https://laravel.com/docs/12.x#creating-a-laravel-project).

#### No Linux

```bash
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.4)"
```

#### No macOS

```bash
/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.4)"
```

#### No Windows (PowerShell como Administrador)

```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; \
[System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; \
iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.4'))
```

Após executar, reinicie o terminal para atualizar PHP, Composer e o Laravel Installer.

### Instalando Node.js e NPM

Caso não tenha Node.js e NPM instalados, siga:

#### No Linux (Debian/Ubuntu)

```bash
sudo apt update
sudo apt install nodejs npm
```

#### No macOS (Homebrew)

```bash
brew update
brew install node
```

#### No Windows

* Baixe o instalador LTS em [https://nodejs.org/](https://nodejs.org/) e execute.
* Ou via Chocolatey (PowerShell como administrador):

  ```powershell
  choco install nodejs
  ```

---

## 📥 Clonando o Repositório

Para começar a desenvolver, basta clonar este repositório em sua máquina local:

```bash
git clone https://github.com/Edvan-Teixeira/locadora_Automoveis.git

# Não esqueça de entrar no diretorio recem criado, pois os próximos passos devem ser executados na raiz do projeto
ddcd locadora-Automoveis
```

---

## 🔧 Configurando o Projeto

1. **Copie o arquivo de ambiente**

   Crie um arquivo .env na raiz do projeto. Copie o conteudo de .env.example e cole no arquivo .env. Ou se preferir execute:

   ```powershell
   # linux e mac
   cp .env.example .env

   # Windows
   copy .env.example .env
   ```

2. **Instale as dependências do Composer**

   ```bash
   composer install
   ```

3. **Instale as dependências de frontend**

   ```bash
   npm install
   ```

4. **Gere a chave de criptografia**

   ```bash
   php artisan key:generate
   ```

5. **Configure o SQLite**

   * Crie o arquivo de banco:

     ```bash
     # Dentro do projeto, vá para a pasta database e crie manualmente o arquivo: database.sqlite

     # No linux pode usar o comando abaixo se preferir:
     touch database/database.sqlite
     ```
   * No `.env`, ajuste:

     ```dotenv
     DB_CONNECTION=sqlite
     DB_DATABASE= caminho completo da sua máquina para o arquivo /database/database.sqlite
     ```

6. **Execute as migrations e *seeders* (opcional)**

   ```bash
   php artisan migrate
   php artisan db:seed  # insere dados iniciais, incluindo 10 veículos
   ```

7. **Compile os assets frontend**

   ```bash
   npm run dev
   ```

---

## 📁 Configuração de Upload de Arquivos

Para garantir que o upload de arquivos funcione corretamente em diferentes sistemas operacionais, siga as instruções abaixo:

1. **Crie o link simbólico para a pasta de storage**

   * Execute o comando padrão do Laravel para criar o link simbólico:

     ```bash
     php artisan storage:link
     ```

2. **Defina permissões de pasta**

   * **Linux** (usuários de distribuições baseadas em Debian/Ubuntu, CentOS, etc.):

     ```bash
     sudo chown -R www-data:www-data storage bootstrap/cache
     sudo chmod -R 775 storage bootstrap/cache
     ```

   * **macOS**:

     ```bash
     sudo chown -R _www:_www storage bootstrap/cache
     sudo chmod -R 775 storage bootstrap/cache
     ```

   * **Windows** (PowerShell como Administrador):

     ```powershell
     # Defina permissões para o IIS_IUSRS ou seu usuário atual
     icacls storage /grant IIS_IUSRS:(OI)(CI)F /T
     icacls bootstrap\cache /grant IIS_IUSRS:(OI)(CI)F /T
     ```

3. **Verifique a configuração de PHP**

   * Certifique-se de que as configurações `file_uploads`, `upload_max_filesize` e `post_max_size` estejam ajustadas no `php.ini`:

     ```ini
     file_uploads = On
     upload_max_filesize = 10M
     post_max_size = 12M
     ```
   * Reinicie o servidor web (Apache, Nginx ou `php artisan serve`).

4. **Testando o upload**

   * Acesse a funcionalidade de upload no sistema e faça um teste com um arquivo pequeno (por exemplo, imagem JPEG de 50KB) para garantir que tudo esteja funcionando.

> Essas configurações garantem que a pasta de armazenamento seja acessível ao servidor e que as limitações de upload estejam adequadas ao funcionamento do sistema.

---

## 🧪 Usuário de Teste

Para facilitar o desenvolvimento e testes, o projeto já inclui a criação de um usuário padrão:

**Credenciais de acesso:**

* **Email:** `teste@teste.com`
* **Senha:** `12345678`

---

## ▶️ Executando a Aplicação

Após seguir os passos acima, execute o servidor local do Laravel:

```bash
composer run dev
# ou
php artisan serve
```

Acesse: [http://localhost:8000](http://localhost:8000)

---

## 🤝 Contribuindo

1. Clone este repositório
2. Estando na branch main, crie uma branch com seu nome (`git checkout -b seu-nome`)
3. Faça suas alterações e commite (`git commit -m 'Adiciona nova feature'`)
4. Envie para a branch remota no github (`git push -u origin seu-nome`)
5. Abra um Pull Request

---

## 📝 Licença

Este projeto está licenciado sob a MIT License - veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

> Desenvolvido com ❤️ por **Equipe 02**
