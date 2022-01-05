<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220105144647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE supplier_payment DROP due_amount, DROP due_date, DROP exchange_rate, DROP due_dollars_amount, DROP note');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE supplier_payment ADD due_amount DOUBLE PRECISION DEFAULT NULL, ADD due_date DATE DEFAULT NULL, ADD exchange_rate DOUBLE PRECISION DEFAULT NULL, ADD due_dollars_amount DOUBLE PRECISION DEFAULT NULL, ADD note LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
