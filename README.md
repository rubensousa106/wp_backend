# Projeto WP: Integração Backend e Frontend

Este projeto integra um backend em PHP com um frontend em React 
Native (usando Expo). O sistema utiliza também Composer 
para gestão de dependências PHP e Guzzle para chamadas de 
API (ex.: API do Whapi).

## Ferramentas Utilizadas

- **PHP:** Para o backend, executado com o servidor embutido do PHP.
- **Composer:** Gestão de dependências do backend.
- **MySQL/MariaDB:** Base de dados.
- **Intellij Ultimate, PhpStorm:** para desenvolvimento.
- **Postman ou Insomnia:** Para testar os endpoints do backend (opcional).

## Pré-requisitos

- PHP instalado (recomendado PHP 8 ou superior).
- Composer instalado.
- MySQL/MariaDB instalado e configurado (com a base de dados `wp_db` e tabelas configuradas).
- Node.js e npm instalados.
- Expo CLI instalado globalmente (ou use `npx expo`).

## Estrutura do Projeto

O projeto está dividido em duas partes:

- **Backend:** Localizado na pasta `wp_backend`
    - **public/** – Contém os endpoints públicos, como `index.php`, `login.php`, `get_user.php`, `send_verification.php`, `verify_code.php`, etc.
    - **src/** – Contém os controladores, serviços e a classe de conexão com o base de dados.
    - **composer.json** – Gerencia as dependências PHP.
- **Frontend:** Localizado na pasta do aplicativo React Native (geralmente na raiz do projeto ou numa pasta separada)
    - O aplicativo é criado com React Native e Expo.
    - Os componentes, como `Login.js`, `Dashboard.js`, `EditProfile.js`, etc., estão organizados na pasta `src/components`.

## Passo a Passo para Executar o Projeto

### 1. Configuração e Execução do Backend

#### Instalar Dependências do Composer

Abra o terminal na pasta `wp_backend` e execute:
```bash
composer install
```
Isso instalará todas as dependências necessárias definidas no composer.json.

Configurar o Banco de Dados
Crie a base de dados wp_db e execute os scripts SQL para criar as tabelas (Clientes, Produtos, Subscricoes, etc.).
Verifique se as credenciais de conexão estão corretas no arquivo de conexão (por exemplo, em DbConnection.php ou nos controladores que utilizam PDO).
Iniciar o Servidor Backend
No terminal, estando na pasta wp_backend, execute:

```bash
php -S localhost:8000 -t public
```
Isso iniciará o servidor embutido do PHP, usando a pasta public como raiz.

Você pode testar os endpoints (por exemplo, http://localhost:8000/get_user.php?cliente_id=1) usando o navegador ou o Postman.

2. Configuração e Execução do Frontend
Instalar Dependências do Projeto React Native
Navegue até a pasta do projeto React Native (onde está o package.json do aplicativo) e execute:

```bash
npm install
```

```bash
expo start
expo install
```
Isso abrirá a interface do Expo. Se estiver usando um emulador 
Android, certifique-se de que o endereço localhost no código 
seja substituído por 10.0.2.2, caso contrário, o aplicativo 
poderá não conseguir comunicar com o backend.

3. Fluxo de Uso
Backend
Os endpoints (por exemplo, login.php, get_user.php, send_verification.php, verify_code.php, etc.) estão prontos para processar as requisições e interagir com o banco de dados.

Frontend
O aplicativo React Native permite:

Login do usuário.
Exibição do Dashboard com os produtos subscritos.
Edição do perfil (com verificação do número de telefone, envio e verificação de código, etc.).


Testes:
Utilize ferramentas como o Postman para testar individualmente os endpoints do backend antes de integrá-los com o aplicativo.

Documentação das APIs:
Consulte a documentação da API do Whapi (https://github.com/Whapi-Cloud/whatsapp-api-sdk-php) para quaisquer configurações adicionais e opções de integração.

Ordem de Execução
Inicie o backend:
```bash
php -S localhost:8000 -t public
```
Configure e teste os endpoints do backend (por exemplo, com Postman).
Execute o frontend via Expo:
```bash
expo start
```
Ajuste os endereços IP, se necessário (ex.: 10.0.2.2 para emulador Android).
Com essas instruções, outra pessoa poderá seguir a ordem correta para configurar e executar o projeto. Se houver dúvidas ou necessidades de ajustes, consulte as seções correspondentes ou entre em contato.
