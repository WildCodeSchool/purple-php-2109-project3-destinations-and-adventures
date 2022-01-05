<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104143640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE booking_client');
        $this->addSql('ALTER TABLE booking ADD lead_customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE6A048787 FOREIGN KEY (lead_customer_id) REFERENCES client (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E00CEDDEAEA34913 ON booking (reference)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE6A048787 ON booking (lead_customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking_client (booking_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_7CDE3FAB19EB6921 (client_id), INDEX IDX_7CDE3FAB3301C60 (booking_id), PRIMARY KEY(booking_id, client_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE booking_client ADD CONSTRAINT FK_7CDE3FAB19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_client ADD CONSTRAINT FK_7CDE3FAB3301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE6A048787');
        $this->addSql('DROP INDEX UNIQ_E00CEDDEAEA34913 ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDE6A048787 ON booking');
        $this->addSql('ALTER TABLE booking DROP lead_customer_id');
    }
}
