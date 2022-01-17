<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220110081909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE supplier_information (id INT AUTO_INCREMENT NOT NULL, supplier_id INT NOT NULL, booking_id INT NOT NULL, due_amount DOUBLE PRECISION DEFAULT NULL, due_date DATE DEFAULT NULL, exchange_rate DOUBLE PRECISION DEFAULT NULL, due_dollars_amount DOUBLE PRECISION DEFAULT NULL, note LONGTEXT DEFAULT NULL, currency VARCHAR(255) DEFAULT NULL, INDEX IDX_F0CEB3922ADD6D8C (supplier_id), INDEX IDX_F0CEB3923301C60 (booking_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE supplier_information ADD CONSTRAINT FK_F0CEB3922ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE supplier_information ADD CONSTRAINT FK_F0CEB3923301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE supplier_information');
    }
}