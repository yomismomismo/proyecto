<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529123903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cuentas_bank ADD estado VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAAF1D4C0C4');
        $this->addSql('ALTER TABLE pedidos CHANGE id_tarjeta_id id_tarjeta_id INT NULL');
        $this->addSql('DROP INDEX idx_6716ccaaf1d4c0c4 ON pedidos');
        $this->addSql('CREATE INDEX IDX_6716CCAA7DF88940 ON pedidos (id_tarjeta_id)');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT FK_6716CCAAF1D4C0C4 FOREIGN KEY (id_tarjeta_id) REFERENCES cuentas_bank (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cuentas_bank DROP estado');
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAA7DF88940');
        $this->addSql('ALTER TABLE pedidos CHANGE id_tarjeta_id id_tarjeta_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX idx_6716ccaa7df88940 ON pedidos');
        $this->addSql('CREATE INDEX IDX_6716CCAAF1D4C0C4 ON pedidos (id_tarjeta_id)');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT FK_6716CCAA7DF88940 FOREIGN KEY (id_tarjeta_id) REFERENCES cuentas_bank (id)');
    }
}
