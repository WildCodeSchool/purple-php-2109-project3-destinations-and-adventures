<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220209113152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE supplier_information');
        $this->addSql('ALTER TABLE supplier_payment ADD due_amount DOUBLE PRECISION DEFAULT NULL, ADD due_date DATE DEFAULT NULL, ADD exchange_rate DOUBLE PRECISION DEFAULT NULL, ADD due_dollars_amount DOUBLE PRECISION DEFAULT NULL, ADD currency VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE supplier_information (id INT AUTO_INCREMENT NOT NULL, supplier_id INT NOT NULL, booking_id INT NOT NULL, due_amount DOUBLE PRECISION DEFAULT NULL, due_date DATE DEFAULT NULL, exchange_rate DOUBLE PRECISION DEFAULT NULL, due_dollars_amount DOUBLE PRECISION DEFAULT NULL, note LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, currency VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_F0CEB3922ADD6D8C (supplier_id), INDEX IDX_F0CEB3923301C60 (booking_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE supplier_information ADD CONSTRAINT FK_F0CEB3922ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE supplier_information ADD CONSTRAINT FK_F0CEB3923301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE supplier_payment DROP due_amount, DROP due_date, DROP exchange_rate, DROP due_dollars_amount, DROP currency');
    }
}
