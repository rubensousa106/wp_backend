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

## Configuração do Banco de Dados

Antes de iniciar o projeto, é necessário criar a base de dados, as tabelas e inserir dados de exemplo. Siga os passos abaixo:

### Criação da Base de Dados:

Conecte-se ao seu servidor MariaDBe execute a seguinte query para criar a base de dados `wp_db`:

```sql
CREATE DATABASE wp_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
Criação das Tabelas:

Execute as queries abaixo para criar as tabelas :

Tabela Clientes:

```sql
CREATE TABLE Clientes (
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL UNIQUE,
telefone VARCHAR(15) NOT NULL,
senha VARCHAR(255) NOT NULL,
verification_code VARCHAR(10) NULL,
code_expires_at DATETIME NULL,
is_verified BOOLEAN NOT NULL DEFAULT FALSE,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

Tabela Produtos:

```sql
CREATE TABLE Produtos (
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
descricao TEXT,
preco DECIMAL(10,2),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
Tabela Subscricoes:

```sql
CREATE TABLE subscricoes (
id INT AUTO_INCREMENT PRIMARY KEY,
cliente_id INT NOT NULL,
produto_id INT NOT NULL,
data_subscricao DATE,
FOREIGN KEY (cliente_id) REFERENCES Clientes(id),
FOREIGN KEY (produto_id) REFERENCES Produtos(id)
) COLLATE='utf8mb4_unicode_ci' ENGINE=InnoDB;
```

### Inserir Dados de Exemplo:

#### Inserir Utilizadores:

Exemplo para inserir um utilizador com id 1:

```sql
INSERT INTO Clientes (nome, email, telefone, senha)
VALUES ('Utilizador Exemplo', 'exemplo@dominio.com', '912345678', 'senha_hash_aqui');
```
Nota: Utilize password_hash('sua_senha', PASSWORD_DEFAULT) no PHP para gerar o hash da senha e substitua 'senha_hash_aqui'.

#### Inserir Produtos:

```sql
INSERT INTO Produtos (nome, descricao, preco)
VALUES
('Netflix Subscription', 'Serviço de subscrição para streaming de filmes e séries', 15.99),
('Spotify Premium', 'Subscrição para streaming de música sem anúncios', 9.99),
('Amazon Prime', 'Serviço de subscrição que oferece envio gratuito, streaming e outros benefícios', 12.99),
('Adobe Creative Cloud', 'Subscrição com acesso à suite de softwares Adobe', 52.99);
```

#### Inserir Subscrições:

Se o utilizador com id 1 subscreveu todos os produtos

```sql
INSERT INTO subscricoes (cliente_id, produto_id, data_subscricao)
VALUES
(1, 1, CURDATE()),
(1, 2, CURDATE()),
(1, 3, CURDATE()),
(1, 4, CURDATE());
```


### 2. Configuração e Execução do Backend

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

### 3.Configuração e Execução do Frontend
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
w

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
