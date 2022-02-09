<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220207170356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE3414710B');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE3414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE3414710B');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE3414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
