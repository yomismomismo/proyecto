<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200522105205 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, categoria VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comentario (id INT AUTO_INCREMENT NOT NULL, id_producto_id INT NOT NULL, id_usuario_id INT NOT NULL, puntuacion INT NOT NULL, comentario LONGTEXT NOT NULL, fecha DATETIME NOT NULL, INDEX IDX_4B91E7026E57A479 (id_producto_id), INDEX IDX_4B91E7027EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cuentas_bank (id INT AUTO_INCREMENT NOT NULL, id_cliente_id INT NOT NULL, num_tarjeta INT NOT NULL, ultimos_digitos INT NOT NULL, titular VARCHAR(100) NOT NULL, fecha_caducidad VARCHAR(5) NOT NULL, cvv INT NOT NULL, INDEX IDX_C3098C0C7BF9CE86 (id_cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mensaje (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, apellido VARCHAR(100) NOT NULL, telefono INT NOT NULL, email VARCHAR(255) NOT NULL, mensaje LONGTEXT NOT NULL, fecha DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pedidos (id INT AUTO_INCREMENT NOT NULL, id_cliente_id INT NOT NULL, nombre_cliente VARCHAR(100) NOT NULL, telefono INT NOT NULL, direccion VARCHAR(255) NOT NULL, provincia VARCHAR(100) NOT NULL, fecha_pedido DATETIME NOT NULL, estado VARCHAR(255) NOT NULL, INDEX IDX_6716CCAA7BF9CE86 (id_cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto (id INT AUTO_INCREMENT NOT NULL, categoria_id_id INT NOT NULL, imagen VARCHAR(255) NOT NULL, nombre VARCHAR(100) NOT NULL, descripcion LONGTEXT NOT NULL, unidades_stock INT NOT NULL, unidades_vendidas INT NOT NULL, precio INT NOT NULL, INDEX IDX_A7BB06157E735794 (categoria_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE productoxpedidos (id INT AUTO_INCREMENT NOT NULL, id_producto_id INT NOT NULL, id_pedido_id INT NOT NULL, cantidad INT NOT NULL, INDEX IDX_56CECDD6E57A479 (id_producto_id), INDEX IDX_56CECDDC861D91D (id_pedido_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, apellido VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, fecha_registro DATETIME NOT NULL, telefono INT NOT NULL, provincia VARCHAR(100) NOT NULL, direccion VARCHAR(255) NOT NULL, cod_postal INT NOT NULL, contrasenya VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E7026E57A479 FOREIGN KEY (id_producto_id) REFERENCES producto (id)');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E7027EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE cuentas_bank ADD CONSTRAINT FK_C3098C0C7BF9CE86 FOREIGN KEY (id_cliente_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT FK_6716CCAA7BF9CE86 FOREIGN KEY (id_cliente_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB06157E735794 FOREIGN KEY (categoria_id_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE productoxpedidos ADD CONSTRAINT FK_56CECDD6E57A479 FOREIGN KEY (id_producto_id) REFERENCES producto (id)');
        $this->addSql('ALTER TABLE productoxpedidos ADD CONSTRAINT FK_56CECDDC861D91D FOREIGN KEY (id_pedido_id) REFERENCES pedidos (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB06157E735794');
        $this->addSql('ALTER TABLE productoxpedidos DROP FOREIGN KEY FK_56CECDDC861D91D');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E7026E57A479');
        $this->addSql('ALTER TABLE productoxpedidos DROP FOREIGN KEY FK_56CECDD6E57A479');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E7027EB2C349');
        $this->addSql('ALTER TABLE cuentas_bank DROP FOREIGN KEY FK_C3098C0C7BF9CE86');
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAA7BF9CE86');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE comentario');
        $this->addSql('DROP TABLE cuentas_bank');
        $this->addSql('DROP TABLE mensaje');
        $this->addSql('DROP TABLE pedidos');
        $this->addSql('DROP TABLE producto');
        $this->addSql('DROP TABLE productoxpedidos');
        $this->addSql('DROP TABLE usuario');
    }
}
