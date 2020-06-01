<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529091456 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cuentas_bank (id INT AUTO_INCREMENT NOT NULL, id_cliente_id INT NOT NULL, num_tarjeta VARCHAR(100) NOT NULL, ultimos_digitos INT NOT NULL, titular VARCHAR(100) NOT NULL, fecha_caducidad VARCHAR(5) NOT NULL, cvv VARCHAR(100) NOT NULL, INDEX IDX_C3098C0C7BF9CE86 (id_cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cuentas_bank ADD CONSTRAINT FK_C3098C0C7BF9CE86 FOREIGN KEY (id_cliente_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE pedidos CHANGE tarjeta_id_id tarjeta_id_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAAF1D4C0C4');
        $this->addSql('DROP TABLE cuentas_bank');
        $this->addSql('ALTER TABLE pedidos CHANGE tarjeta_id_id tarjeta_id_id INT DEFAULT NULL');
    }
}
