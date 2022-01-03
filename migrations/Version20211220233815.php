<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211220233815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent CHANGE agent_name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE232AD8AB');
        $this->addSql('DROP INDEX IDX_E00CEDDE232AD8AB ON booking');
        $this->addSql('ALTER TABLE booking CHANGE client_name_id lead_customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE6A048787 FOREIGN KEY (lead_customer_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE6A048787 ON booking (lead_customer_id)');
        $this->addSql('ALTER TABLE client CHANGE client_name name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent CHANGE name agent_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE6A048787');
        $this->addSql('DROP INDEX IDX_E00CEDDE6A048787 ON booking');
        $this->addSql('ALTER TABLE booking CHANGE lead_customer_id client_name_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE232AD8AB FOREIGN KEY (client_name_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E00CEDDE232AD8AB ON booking (client_name_id)');
        $this->addSql('ALTER TABLE client CHANGE name client_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}